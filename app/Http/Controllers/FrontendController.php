<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{



    public function shop()
    {

        return view('frontend.shop');

    }


    public function productDetails()
    {

        return view('frontend.product_details');

    }


    public function about()
    {

        return view('frontend.about');

    }


    public function contact()
    {

        return view('frontend.contact');

    }


    public function faq()
    {

        return view('frontend.faq');

    }



    public function wishlist()
    {

        return view('frontend.wishlist');

    }



    public function cart()
    {

        return view('frontend.cart');

    }


    public function checkout()
    {

        return view('frontend.checkout');

    }


    
}
