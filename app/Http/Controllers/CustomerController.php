<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CustomerAccountFormRequest;
use App\Http\Requests\CustomerDetailsFormRequest;

class CustomerController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth','verified','customer']);
    }


    public function customerAccount()
    {
        $orders = Order::where('user_id',auth()->user()->id)->get();

        return view('frontend.customer.account', compact('orders'));
    }


    public function customerOrderItems($order_id)
    {
        if(!request()->ajax()){
            abort(404);
        }

        $order = Order::where('id',$order_id)->where('user_id',auth()->user()->id)->with('order_items')->firstOrFail();

        $order_details = view('frontend.customer.order.order_items', compact('order'))->render();

        return response()->json(['order_details'=>$order_details]);

    }





    public function customerOrderInvoice($order_id)
    {
        $order = Order::where('id',$order_id)->where('user_id',auth()->user()->id)->with('order_items')->firstOrFail();

        // $data = [
        //     'order'=>$order,
        // ];

        Pdf::setOptions([
            'dpi'=>150,
            'isHtml5ParserEnabled'  =>true,
        ]);

        $invoice = view('frontend.customer.order.invoice', compact('order'))->render();

        $pdf = Pdf::loadHTML($invoice)->setPaper('a4','portrait')->save(public_path().'/uploads/invoice/order/invoice.pdf');
        // $pdf = Pdf::loadView('frontend.customer.order.invoice', $data)->setPaper('a4','portrait')->save(public_path().'/uploads/invoice/order/invoice.pdf');

        return $pdf->stream('invoice.pdf');
    }




    public function customerDetailsUpdate(CustomerDetailsFormRequest $request)
    {
        if($request->ajax()){

            if($request->validator->fails()){
                return response()->json(['error'=>$request->validator->errors()]);
            }
    
            $userDetails = auth()->user()->userDetails;
    
            $userDetails->phone = $request->customer_phone;
            $userDetails->city = $request->customer_city;
            $userDetails->country = $request->customer_country;
            $userDetails->address = $request->customer_address;
    
            $userDetails->save();
    
            return response()->json(['success'=>'updated successfully!']);
        }

        return redirect()->back();
    }



    public function CustomerAccountUpdate(Request $request)
    {
        if($request->ajax()){
            $validator = $this->validateCustomerAccountForm($request->all());

            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()]);
            }

            $user = User::find(auth()->user()->id);

            $user->name = $request->customer_name;
            $user->email = $request->customer_email;

            if($request->current_password != null && $request->password != null){
                $user->password = Hash::make($request->password);
            }

            $user->save();
            
            return response()->json(['success'=>'Updated Successfully!']);
        }

        return response('Try enabling javascript!');
    }




    protected function validateCustomerAccountForm(array $request)
    {
        $current_password_rule = 'nullable';
        $new_password_rule = 'nullable';
        
        if($request['current_password'] != null || $request['password'] != null){
            $current_password_rule = 'required|current_password';
            $new_password_rule = 'confirmed|required|min:8';
        }

        $validator = Validator::make($request,[
            'customer_name'=>'required|string|max:50',
            'customer_email'=>'required|email|unique:users,email,'.auth()->user()->id.'id',
            'current_password'=>$current_password_rule,
            'password'=>$new_password_rule,
            'password_confirmation'=>'nullable|required_with:password',
        ]);

        return $validator;
    }



    
}
