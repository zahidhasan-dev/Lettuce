@extends('layouts.frontend')

@section('content')
    <div class="liton__shoping-cart-area mt-100 mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Thank You!</h1>
                    <p>A confirmation mail will be sent to your email.</p>
                    <a href="{{ url('shop') }}" class="theme-btn-1 btn btn-effect-1">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>

@endsection
