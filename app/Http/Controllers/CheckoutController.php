<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{


    public function pay($json_obj)
    {

        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET'));

        $intent = null;
        try {

            if (isset($json_obj->payment_method_id)) {
                # Create the PaymentIntent
                $intent = \Stripe\PaymentIntent::create([
                    'payment_method' => $json_obj->payment_method_id,
                    'amount' => 1099,
                    'currency' => 'usd',
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                ]);
            }

            if (isset($json_obj->payment_intent_id)) {
                $intent = \Stripe\PaymentIntent::retrieve(
                    $json_obj->payment_intent_id
                );
                $intent->confirm();
            }

            $this->generateResponse($intent);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            DB::rollback();
            # Display error on client
            echo json_encode([
                'error' => $e->getMessage()
            ]);
        }
        
    }
    
    public function generateResponse($intent) {

        # Note that if your API version is before 2019-02-11, 'requires_action'
        # appears as 'requires_source_action'.
        if ($intent->status == 'requires_action' &&
            $intent->next_action->type == 'use_stripe_sdk') {
            DB::rollback();
            # Tell the client to handle the action
            echo json_encode([
                'requires_action' => true,
                'payment_intent_client_secret' => $intent->client_secret
            ]);
        } else if ($intent->status == 'succeeded') {
            # The payment didn’t need any additional actions and completed!
            # Handle post-payment fulfillment
            $this->destroyCart();
            echo json_encode([
                "success" => true
            ]);
        
        } else {
            DB::rollback();
            # Invalid status
            http_response_code(500);
            echo json_encode(['error' => 'Invalid PaymentIntent status']);
        }

    }

    


    public function checkoutPost(Request $request)
    {

        if(!request()->header('X-CSRF-TOKEN')){
            return redirect()->back()->with(['request_error'=>'Invalid request error! Try enbaling javascript.']);
        }

        header('Content-Type: application/json');

        # retrieve json from POST body
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str);

        $request_data = (array)$json_obj->formData;

        
        DB::beginTransaction();
        
        try {

            $validator = $this->validateCheckout($request_data);
    
            if($validator->fails()){
                return response()->json(['validation_error'=>$validator->errors()]);
            }

            if($this->cartProductNotAvailable()){
                return response()->json(['quantity_error'=>'Sorry! One of the items in your cart is no longer available.']);
            }

            $order = $this->createOrder($request_data);

            $this->decreaseProductQuantity();
    
            if($request_data['payment_method'] === 'card'){
               $this->pay($json_obj);
            }
           
            DB::commit();

            session()->flash('order_success','Order Successfull!');

            if($request_data['payment_method'] === 'cod'){
                $this->destroyCart();
               return response()->json(['success'=>'order success!']);
            }

        } catch (\Exception $e) {
            DB::rollback();

            echo json_encode([
                'error' => $e->getMessage(),
            ]);
        }


    }
    
    
    
    
    protected function createOrder(array $request)
    {
        $cart = getCart();
        $cart_data = getCartTotal();
        $hasCoupon = 0;
        $coupon_value_type = null;

        if(session()->has('coupon') && session()->get('coupon') != null){
            $hasCoupon = 1;
            $coupon_value_type = session()->get('coupon')['coupon_value_type'];
        }

        $user_id = auth()->user()->id ?? null;
        $payment_status = 'due';

        if($request['payment_method'] === 'card' ){
            $payment_status = 'paid';
        }

        $order = Order::create([
            'user_id'=>$user_id,
            'billing_name'=>$request['billing_name'],
            'billing_email'=>$request['billing_email'],
            'billing_phone'=>$request['billing_phone'],
            'billing_country'=>$request['billing_country'],
            'billing_city'=>$request['billing_city'],
            'billing_city'=>$request['billing_city'],
            'billing_zipcode'=>$request['billing_zipcode'],
            'billing_address'=>$request['billing_address'],
            'order_note'=>$request['order_note'],
            'payment_method'=>$request['payment_method'],
            'payment_status'=>$payment_status,
            'coupon'=>$hasCoupon,
            'coupon_code'=>$cart_data['coupon_code'],
            'coupon_value'=>$coupon_value_type,
            'coupon_amount'=>$cart_data['coupon_discount_amount'],
            'order_subtotal'=>$cart_data['new_sub_total'],
            'order_total'=>$cart_data['cartTotal'],
            'order_shipping'=>$cart_data['shipping'],
            'order_vat'=>$cart_data['vat'],
            'vat_value'=>$cart_data['vat_value'],
            'order_status'=>'pending',
            'created_at'=>Carbon::now(),
        ]);


        foreach($cart as $cart_item){

            $product_price = productPrice($cart_item->id) * 100;

            if(productHasDiscount($cart_item->id)){
                $product_price = discountPrice($cart_item->id) * 100;
            }

            $order_items = OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$cart_item->id,
                'price'=>$product_price,
                'quantity'=>$cart_item->quantity,
            ]);

        }

        return $order;

    }



    protected function destroyCart()
    {
        if(auth()->check()){
            $cart = Cart::where('user_id',auth()->user()->id)->get();

            foreach($cart as $cart_item){
                $cart_item->delete();
            }
        }
        else{
            session()->forget('cart');
        }

        session()->forget('coupon');

    }



    protected function decreaseProductQuantity()
    {
        foreach(getCart() as $cart){
            Product::where('id',$cart->id)->decrement('in_stock',$cart->quantity);
        }
    }




    protected function cartProductNotAvailable()
    {
        foreach(getCart() as $cart){
            $product = Product::where('id',$cart->id)->first();
            if($cart->quantity > $product->in_stock){
                return true;
            }
        }

        return false;
    }
    
    
    
    
    protected function validateCheckout(array $request)
    {
        $validator = Validator::make($request,[
            'billing_name'=>'required|string|max:40',
            'billing_email'=>'required|email|max:100',
            'billing_phone'=>'required|numeric|digits_between:4,16',
            'billing_country'=>'required|exists:countries,id',
            'billing_city'=>'required|exists:cities,id',
            'billing_zipcode'=>'required|numeric|digits_between:4,10',
            'billing_address'=>'required|string|max:50',
            'payment_method'=>'required|string|in:card,cod',
            'order_note'=>'max:500',
        ]);
        
        return $validator;
    }

    



}
