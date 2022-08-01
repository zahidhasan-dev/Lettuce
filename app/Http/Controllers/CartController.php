<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{



    public function store(Request $request)
    {   

        if(request()->ajax()){
            
            $product = Product::where('id',$request->product_id)->where('status',1)->firstOrFail();

            $this->validateProductQuantity($product,$request);

            $product_quantity = 1;

            if($request->has('product_quantity')){
                $product_quantity = $request->product_quantity;
            }
            
            if(auth()->check()){

                if(auth()->user()->is_admin){
                    return response()->json(['status'=>'unauthorized']);
                }

                $cart_exists = Cart::where('product_id',$product->id)->where('user_id',auth()->user()->id)->exists();

                DB::beginTransaction();

                try {

                    if($cart_exists){

                        $cart = Cart::where('product_id',$product->id)->where('user_id',auth()->user()->id)->first();
                        $request['product_quantity'] = $cart->quantity + $request->product_quantity;
    
                        $this->validateProductQuantity($product,$request);
    
                        $cart->quantity += $product_quantity;
                        $cart->save();
    
                    }
                    else{
    
                        Cart::insert([
                            'user_id'=>auth()->user()->id,
                            'product_id'=>$product->id,
                            'quantity'=>$product_quantity,
                            'created_at'=>Carbon::now(),
                        ]);
    
                    }
    
                    if($request->has('wishlist_to_cart') && $request->get('wishlist_to_cart') == 1){
                        $wishlist = Wishlist::where('product_id',$product->id)->where('user_id',auth()->user()->id)->firstOrFail();
                        $wishlist->delete();
                    }

                    DB::commit();

                } catch (\Throwable $th) {
                    DB::rollback();
                    throw $th;
                }
                

            }
            else {

                $cart = session('cart',[]);

                if(isset($cart[$product->id])){

                    $request['product_quantity'] = $cart[$product->id]['quantity'] + $request->product_quantity;

                    $this->validateProductQuantity($product,$request);

                    $cart[$product->id]['quantity'] += $product_quantity;
                    session()->put('cart',$cart);

                }
                else{

                    $cart[$product->id] = [
                        'id'=>$product->id,
                        'product_name'=>$product->product_name,
                        'thumbnail'=>$product->thumbnail,
                        'price'=>$product->price,
                        'quantity'=>$product_quantity,
                        'slug'=>$product->slug,
                    ];
    
                    session()->put('cart',$cart);

                }

                if($request->has('wishlist_to_cart') && $request->get('wishlist_to_cart') == 1){

                    $wishlist =session('wishlist');

                    if(isset($wishlist[$product->id])){
                        unset($wishlist[$product->id]);
                        session()->put('wishlist',$wishlist);
                    }
                }

            }

            $product_data = [
                'product_name'=>$product->product_name,
                'thumbnail'=>asset('uploads/product/'.$product->thumbnail),
                'cart_count'=>getCartNumber(),
                'cart_sub_total'=> getCartSubTotal(),
            ];

            return response()->json(['status'=>'success','product'=>$product_data]);
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }




    public function update(Request $request)
    {
        if(request()->ajax()){

            $cart_data = [];

            $product = Product::where('id',$request->product_id)->firstOrFail();

            $this->validateProductQuantity($product, $request);

            $product_quantity = $request->product_quantity;

            if(auth()->check()){

                if(auth()->user()->is_admin){
                    return response()->json(['status'=>'unauthorized']);
                }

                $cart = Cart::where('product_id',$product->id)->where('user_id',auth()->user()->id)->firstOrFail();

                $cart->quantity = $product_quantity;
                $cart->save();

                $cart_quantity = $cart->quantity;
                
            }
            else{

                $cart = session('cart');

                if(isset($cart[$product->id])){
                    $cart[$product->id]['quantity'] = $product_quantity;
                }

                session()->put('cart',$cart);

                $cart_quantity = $cart[$product->id]['quantity'];

            }

            $cart_data = [
                'cart_product_id'=>$product->id,
                'cart_count'=>getCartNumber(),
                'product_quantity'=>$cart_quantity,
                'product_total_price'=>productTotalPrice($product->id,$cart_quantity),
                'cart_sub_total'=>getCartSubTotal(),
                'cart_total_details'=>getCartTotal(),
            ];

            return response()->json(['status'=>'success','cart_data'=>$cart_data]);
        };

        return response(null, Response::HTTP_NO_CONTENT);
    }



    public function destroy($id)
    {
        if(request()->ajax()){
            if(auth()->check()){
                $cart = Cart::where('user_id',auth()->user()->id)->where('product_id',$id)->firstOrFail();
                $cart->delete();
                $cart_count = Cart::where('user_id',auth()->user()->id)->count();
            }
            else{
                if(session()->has('cart')){
                    $carts = session('cart');
                    
                    if(isset($carts[$id])){
                        unset($carts[$id]);
                        session()->put('cart',$carts);
                    }

                    $cart_count = count($carts);
                }
            }

            $cart_data = [
                'cart_count'=>$cart_count,
                'cart_total_details'=>getCartTotal(),
            ];

            return response()->json(['status'=>'success','cart_data'=>$cart_data]);
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }



    public function applyCoupon(Request $request)
    {   
        if($request->ajax()){

            $this->validateCoupon($request);

            if($this->checkCoupon($request->coupon_code)){

                $coupon = $this->checkCoupon($request->coupon_code);

                $coupon_data = [
                    'id'=>$coupon['id'],
                    'coupon_code'=>$coupon['coupon_code'],
                    'coupon_type'=>$coupon['coupon_type'],
                    'coupon_value'=>$coupon['coupon_value'],
                    'coupon_value_type'=>couponValueType($coupon['id']),
                ];

                session()->put('coupon',$coupon_data);

                return response()->json(['success'=>'Coupon Applied!']);
            }

            return response()->json(['invalid_coupon'=>'Invalid Coupon Code!']);

        }

        return response(null, Response::HTTP_NO_CONTENT);
    }



    public function removeCoupon($coupon_code)
    {
       if(request()->ajax()){

            if(session()->get('coupon')['coupon_code'] == $coupon_code){

                session()->forget('coupon');

                return response()->json(['success'=>'Coupon removed!']);
            }

            return response()->json(['error'=>'Error! Please try again.']);

       }

       return response(null, Response::HTTP_NO_CONTENT);
    }


    protected function checkCoupon($coupon_code)
    {
        $coupon = Coupon::where('coupon_code',$coupon_code)->where('status',1)->where('coupon_validity','>=',Carbon::now())->first();

        if(!is_null($coupon)){
            return $coupon;
        }

        return false;
    }


    protected function validateCoupon(Request $request)
    {
        $request->validate([
            'coupon_code'=>'required|string',
        ]);
    }




    private function validateProductQuantity(Product $product,Request $request)
    {   

        if($product->in_stock > 0 && $product->in_stock <= 20){
            $request->validate([
                'product_quantity'=>'required|numeric|min:1|max:1'
            ]);
        }

        if($product->in_stock > 20){
            $request->validate([
                'product_quantity'=>'required|numeric|min:1|max:10'
            ]);
        }

    }

    


}
