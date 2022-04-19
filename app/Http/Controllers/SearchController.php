<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class SearchController extends Controller
{



    // public function queryCouponData(Request $request)
    // {

    //     if($request->ajax()){

    //         $query =  $request->coupon_query;
            
    //         if($query != ''){
    //             $coupons = Coupon::where('coupon_code', 'like', '%'.$query.'%')
    //                                     ->orWhere('coupon_value', 'like', '%'.$query.'%')
    //                                     ->orWhere('coupon_type', 'like', '%'.$query.'%')
    //                                     ->orderBy('created_at','desc')
    //                                     ->paginate(5);
                
    //             return view('admin.offers.coupon.query_data',compact('coupons'))->render();
    //         }
    //     }

    //     return false;
    // }


}
