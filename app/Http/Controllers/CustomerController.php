<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','customer']);
    }


    public function customerAccount()
    {

        return view('frontend.customer.account');

    }

    
}
