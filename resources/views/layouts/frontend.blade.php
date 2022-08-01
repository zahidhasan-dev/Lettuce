<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="robots" content="noindex, follow" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Place favicon.png in the root directory -->
        <link rel="shortcut icon" href="{{ asset('frontend_assets/img/favicon.png') }}" type="image/x-icon" />
        <!-- Font Icons css -->
        <link rel="stylesheet" href="{{ asset('frontend_assets/css/font-icons.css') }}">
        <!-- plugins css -->
        <link rel="stylesheet" href="{{ asset('frontend_assets/css/plugins.css') }}">
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">
        <!-- Responsive css -->
        <link rel="stylesheet" href="{{ asset('frontend_assets/css/responsive.css') }}">

        @yield('header_script')
    </head>
    



    <style>

        #order_item_modal .table td, #order_item_modal .table th {
            vertical-align: middle;
        }

        #order_item_modal .modal-header{
            padding:20px 30px;
            border-bottom:1px solid #eff2f7;
        }

        .customer_account_input_error {
            margin-bottom: 25px;
        }

        #customer_account_form input[type="password"],
        #customer_account_form input[type="text"],
        #customer_account_form input[type="email"]{
            margin-bottom:0px;
        }

        #customer_address_edit_btn{
            background-color: #80B500;
            color: #fff;
            cursor: pointer;
            padding: 2px 15px;
            border-radius: 3px;
        }

        #edit_customer_address_form.hide,
        #address_content.hide{
            display: none;
        }

        #address_content.show,
        #edit_customer_address_form.show{
            display: block;
        }

        #edit_customer_address_form button{
            background-color: #80B500;
            color: #fff;
            padding: 8px 30px;
        }
        #edit_customer_address_form input{
            margin-bottom:0 !important;
        }
        #edit_customer_address_form input[type="number"]{
            background-color: var(--white);
            border: 2px solid;
            border-color: var(--border-color-9);
            height: 65px;
            -webkit-box-shadow: none;
            box-shadow: none;
            padding-left: 20px;
            font-size: 16px;
            color: var(--ltn__paragraph-color);
            width: 100%;
            border-radius: 0;
            padding-right: 40px;
        }
        #edit_customer_address_form input[type="number"]:focus{
            border: 1px solid var(--ltn__secondary-color);
            outline: none;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .stock_out_cart_quantity{
            border: 2px solid #ededed;
            cursor: not-allowed;
            height: 63px;
            width:140px;
            display: flex;
        }
        .stock_out_cart_quantity span{
            font-size: 20px;
            font-weight: 700;
            height: 100%;
            display: grid;
            justify-content: center;
            align-content: center;
        }
        .cart_minus_icon{
            width:30%;
            border-right: 2px solid #ededed;
        }
        
        .cart_plus_icon{
            width:30%;
            border-left: 2px solid #ededed;
        }

        .cart_quantity_value{
            width:40%;
        }


        .user_text_avatar{
            margin: 0;
            height: 100px;
            width: 100px;
            max-width:100%;
            display: grid;
            align-content: center;
            justify-content: center;
            background-color: #F7F5EB;
            border-radius: 50%;
            color: #80B500;
        }
        .modal-dialog {
            margin-top: 250px !important;
        }
        .billing_details_input_wrap{
            margin-bottom:30px;
        }
        .billing_details_input_wrap input,
        .billing_details_input_wrap .nice-select{
            margin-bottom: 0px;
        }

        .billing_input_error{
            margin-top: 5px;
        }

        .billing_details_input_wrap::before{
            top:50% !important;
        }
        .billing_details_input_wrap.number_wrap::before{
            top:50% !important;
        }
        .billing_details_input_wrap input[type="number"]{
            background-color: var(--white);
            border: 2px solid;
            border-color: var(--border-color-9);
            height: 65px;
            -webkit-box-shadow: none;
            box-shadow: none;
            padding-left: 20px;
            font-size: 16px;
            color: var(--ltn__paragraph-color);
            width: 100%;
            /* margin-bottom: 30px; */
            border-radius: 0;
            padding-right: 40px;
        }

        .ltn__main-menu li.active a,
        .footer-menu li.active a,
        .ltn__drop-menu li.active a{
            color:#80B500;
        }

        #parentCategories li.active > a{
            color:#80B500;
        }

        #subCategories.hide {
            display: none;
        }

        #subCategories.show {
            display: block;
        }

        #quick_view_preloader ,
        #order_item_preloader{
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 9;
        }

        .preloader_inner {
            left: 0;
            top: 0;
            z-index: 9999999;
            background-color: #071c1f;
            width: 100%;
            height: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .modal-header .close{
            z-index:99 !important;
        }

        .submit-button-1.btn_disabled {
            cursor:not-allowed;
        }
        .submit-button-1.btn_disabled:hover {
            background-color: var(--ltn__primary-color);
            color: var(--white);
        }

        @media (min-width:768px){
            .cart-product-info{
                width:30%;
            }
            td.cart-product-image {
                width: 100px;
            }
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .utilize_cart_menu_btn{
            padding:15px 30px;
        }

        @media (min-width:768px) and (max-width:991px){
            .utilize_cart_menu_btn{
                padding:12px 25px;
            }
        }

        @media (max-width:767px){
            .utilize_cart_menu_btn{
                padding:12px 15px;
            }
        }

        .coupon_form_status{
            text-align: left;
            display: block;
            margin-bottom: 5px;
        }












        /* Variables */
* {
  box-sizing: border-box;
}


#payment-form form {
  width: 100%;
  min-width: 500px;
  align-self: center;
  box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
    0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
  border-radius: 7px;
  padding: 40px;
}

#payment-form .hidden {
  display: none;
}

#payment-form #payment-message {
  color: rgb(105, 115, 134);
  font-size: 16px;
  line-height: 20px;
  padding-top: 12px;
  text-align: center;
}

#payment-form #payment-element {
  margin-bottom: 24px;
}

/* Buttons and links */
#payment-form button {
  background: #80B500;
  font-family: Arial, sans-serif;
  color: #ffffff;
  border: 0;
  padding: 12px 16px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  display: block;
  transition: all 0.2s ease;
  box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
  width: 100%;
}
#payment-form button:hover {
  filter: contrast(115%);
  color:#000;
  border:1px solid #000;
}
#payment-form button:disabled {
  opacity: 0.5;
  cursor: default;
}

/* spinner/processing state, errors */
#payment-form .spinner,
#payment-form .spinner:before,
#payment-form .spinner:after {
  border-radius: 50%;
}
#payment-form .spinner {
  color: #ffffff;
  font-size: 22px;
  text-indent: -99999px;
  margin: 0px auto;
  position: relative;
  width: 20px;
  height: 20px;
  box-shadow: inset 0 0 0 2px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
#payment-form .spinner:before,
#payment-form .spinner:after {
  position: absolute;
  content: "";
}
#payment-form .spinner:before {
  width: 10.4px;
  height: 20.4px;
  background: #80B500;
  border-radius: 20.4px 0 0 20.4px;
  top: -0.2px;
  left: -0.2px;
  -webkit-transform-origin: 10.4px 10.2px;
  transform-origin: 10.4px 10.2px;
  -webkit-animation: loading 2s infinite ease 1.5s;
  animation: loading 2s infinite ease 1.5s;
}
#payment-form .spinner:after {
  width: 10.4px;
  height: 10.2px;
  background: #80B500;
  border-radius: 0 10.2px 10.2px 0;
  top: -0.1px;
  left: 10.2px;
  -webkit-transform-origin: 0px 10.2px;
  transform-origin: 0px 10.2px;
  -webkit-animation: loading 2s infinite ease;
  animation: loading 2s infinite ease;
}

@-webkit-keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

@media only screen and (max-width: 600px) {
  #payment-form form {
    width: 80vw;
    min-width: initial;
  }
}


    </style>


    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        

    <!-- Body main wrapper start -->
        <div class="body-wrapper">
            <!-- HEADER AREA START (header-3) -->
            <header class="ltn__header-area ltn__header-3 section-bg-6">       
                <!-- ltn__header-top-area start -->
                <div class="ltn__header-top-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="ltn__top-bar-menu">
                                    <ul>
                                        <li><a href="javascript:void(0);"><i class="icon-mail"></i> info@lettuce.com</a></li>
                                        <li><a href="javascript:void(0);"><i class="icon-placeholder"></i> 1966 Old House Drive, Ohio</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="top-bar-right text-right">
                                    <div class="ltn__top-bar-menu">
                                        <ul>
                                            <li>
                                                <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                                                    <ul>
                                                        <li><a href="javascript:void(0);" class="dropdown-toggle"><span class="active-currency">English</span></a>
                                                            <ul>
                                                                <li><a href="javascript:void(0);">English</a></li>
                                                                <li><a href="javascript:void(0);">Espanol</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ltn__social-media">
                                                    <ul>
                                                        <li><a href="https://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                        <li><a href="https://www.instagram.com/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                                        <li><a href="https://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ltn__header-top-area end --> 

                <!-- ltn__header-middle-area start -->
                <div class="ltn__header-middle-area">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="site-logo">
                                    <a href="{{ route('index') }}"><img src="{{ asset('frontend_assets/img/logo.png') }}" alt="Logo"></a>
                                </div>
                            </div>
                            <div class="col header-contact-serarch-column d-none d-lg-block">
                                <div class="header-contact-search">
                                    <!-- header-feature-item -->
                                    <div class="header-feature-item">
                                        <div class="header-feature-icon">
                                            <i class="icon-call"></i>
                                        </div>
                                        <div class="header-feature-info">
                                            <h6>Phone</h6>
                                            <p><a href="tel:0123456789">+0123-456-789</a></p>
                                        </div>
                                    </div>
                                    <div class="header-search-2">
                                        <form action="{{ url('shop',['category'=>request()->category->category_slug ?? '','subCategory'=>request()->subCategory->category_slug ?? '']) }}" method="GET">
                                            <input type="text" name="search" placeholder="Search here..." value="{{ request()->search }}">
                                            <input type="hidden" name="sort_by" value="{{ request()->sort_by }}">
                                            <input type="hidden" id="view_type_val" name="view_type" value="{{ request()->view_type ?? 'grid' }}">
                                            <button type="submit">
                                                <span><i class="icon-search"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="ltn__header-options">
                                    <ul>
                                        <li class="d-none---"> 
                                            <div class="ltn__drop-menu user-menu">
                                                <ul>
                                                    <li>
                                                        <a href="#"><i class="icon-user"></i></a>
                                                        <ul>


                                                            @guest
                                                                <li><a href="{{ route('login') }}">Sign in</a></li>
                                                                <li><a href="{{ route('register') }}">Sign up</a></li>
                                                            @else 
                                                                <li>
                                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Sign out') }}</a>
                                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                        @csrf
                                                                    </form>
                                                                </li>
                                                                @customer
                                                                    <li><a href="{{ route('customer.account') }}">My Account</a></li>
                                                                @endcustomer
                                                            @endguest
                                                            <li class="{{ (request()->is('wishlist*')) ? 'active' : '' }}"><a href="{{ url('/wishlist') }}">Wishlist</a></li>
                                                            
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mini-cart-icon mini-cart-icon-2">
                                                <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                                    <span class="mini-cart-icon your_cart_count">
                                                        <i class="icon-shopping-cart"></i>
                                                        <sup>{{ getCartNumber() }}</sup>
                                                    </span>
                                                    <h6><span>Your Cart</span> <span class="ltn__secondary-color your_cart_total">${{ number_format(getCartSubTotal(),2) }}</span></h6>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ltn__header-middle-area end -->
                <!-- header-bottom-area start -->
                <div class="header-bottom-area ltn__border-top ltn__header-sticky  ltn__sticky-bg-white ltn__primary-bg--- section-bg-1 menu-color-white--- d-none d-lg-block">
                    <div class="container">
                        <div class="row">
                            <div class="col header-menu-column justify-content-center">
                                <div class="sticky-logo">
                                    <div class="site-logo">
                                        <a href="index.html"><img src="{{ asset('frontend_assets/img/logo.png') }}" alt="Logo"></a>
                                    </div>
                                </div>
                                <div class="header-menu header-menu-2">
                                    <nav>
                                        <div class="ltn__main-menu">
                                            <ul>
                                                <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{ route('index') }}">Home</a></li>
                                                <li class="{{ (request()->is('shop*')) ? 'active' : '' }}"><a href="{{ route('shop') }}">Shop</a></li>
                                                <li class="{{ (request()->is('contact*')) ? 'active' : '' }}"><a href="{{ url('/contact') }}">Contact</a></li>
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- header-bottom-area end -->
            </header>
            <!-- HEADER AREA END -->

            <!-- Utilize Cart Menu Start -->
            <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
                <div class="ltn__utilize-menu-inner ltn__scrollbar">
                    <div class="ltn__utilize-menu-head">
                        <span class="ltn__utilize-menu-title">Cart</span>
                        <button class="ltn__utilize-close">×</button>
                    </div>
                    <div class="mini-cart-product-area ltn__scrollbar">
                        @forelse (getCart() as $cart)
                            <div class="mini-cart-item clearfix">
                                <div class="mini-cart-img">
                                    <a href="{{ route('product.details',$cart->slug) }}"><img src="{{ asset('uploads/product/'.$cart->thumbnail) }}" alt="Image"></a>
                                    <form action="{{ route('cart.destroy',$cart->id) }}" method="POST"class="cart_delete_form" id="cart_delete_form_{{ $cart->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void(0);" class="cart_delete_btn mini-cart-item-delete" data-id="{{ $cart->id }}" style="display: inline-block"><i class="icon-cancel"></i></a>
                                    </form>
                                </div>
                                <div class="mini-cart-info">
                                    <h6><a href="{{ route('product.details',$cart->slug) }}">{{ $cart->product_name }}</a></h6>
                                    <span class="mini-cart-quantity">
                                        {{ $cart->quantity }} x 
                                            @if (productHasDiscount($cart->id) === true )
                                                ${{ discountPrice($cart->id) }}
                                            <del class="text-danger">${{ productPrice($cart->id) }}</del>
                                            @else
                                                ${{ productPrice($cart->id) }}
                                            @endif
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="mini-cart-item clearfix">
                                <h4 class="text-center">You Cart is Empty!</h4>
                            </div>
                        @endforelse
                    </div>
                    <div class="mini-cart-footer">
                        <div class="mini-cart-sub-total">
                            <h5>Subtotal: <span>${{ number_format(getCartSubTotal(),2) }}</span></h5>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{ url('/cart') }}" class="theme-btn-1 btn btn-effect-1 utilize_cart_menu_btn">View Cart</a>
                            @if(getCartNumber() > 0)
                            <a href="{{ url('/checkout') }}" class="theme-btn-2 btn btn-effect-2 utilize_cart_menu_btn">Checkout</a>
                            @endif
                        </div>
                        <p>Free Shipping on All Orders Over $100!</p>
                    </div>

                </div>
            </div>
            <!-- Utilize Cart Menu End -->

            <!-- Utilize Mobile Menu Start -->
            <div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
                <div class="ltn__utilize-menu-inner ltn__scrollbar">
                    <div class="ltn__utilize-menu-head">
                        <div class="site-logo">
                            <a href="index.html"><img src="{{ asset('frontend_assets/img/logo.png') }}" alt="Logo"></a>
                        </div>
                        <button class="ltn__utilize-close">×</button>
                    </div>
                    <div class="ltn__utilize-menu-search-form">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="ltn__utilize-menu">
                        <ul>
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li><a href="{{ route('shop') }}">Shop</a></li>
                            <li><a href="{{ url('/contact') }}">Contact</a></li>
                        </ul>
                    </div>
                    <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
                        <ul>
                            <li>
                                <a href="{{ route('customer.account') }}" title="My Account">
                                    <span class="utilize-btn-icon">
                                        <i class="far fa-user"></i>
                                    </span>
                                    My Account
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/wishlist') }}" title="Wishlist">
                                    <span class="utilize-btn-icon">
                                        <i class="far fa-heart"></i>
                                        <sup>3</sup>
                                    </span>
                                    Wishlist
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/cart') }}" title="Shoping Cart">
                                    <span class="utilize-btn-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                        <sup>5</sup>
                                    </span>
                                    Shoping Cart
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="ltn__social-media-2">
                        <ul>
                            <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Utilize Mobile Menu End -->

            <div class="ltn__utilize-overlay"></div>

            
            <div class="mobile-header-menu-fullwidth">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Mobile Menu Button -->
                            <div class="mobile-menu-toggle d-lg-none">
                                <span>MENU</span>
                                <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                                    <svg viewBox="0 0 800 600">
                                        <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                        <path d="M300,320 L540,320" id="middle"></path>
                                        <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--  Main Content -->
           <div class="main_content">
                @yield('content')
           </div>
            <!--  Main Content  End-->


            <!-- FEATURE AREA START ( Feature - 3) -->
            {{-- <div class="ltn__feature-area before-bg-bottom-2 mb--30--- plr--5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ltn__feature-item-box-wrap ltn__border-between-column white-bg">
                                <div class="row">
                                    <div class="col-xl-3 col-md-6 col-12">
                                        <div class="ltn__feature-item ltn__feature-item-8">
                                            <div class="ltn__feature-icon">
                                                <img src="{{ asset('frontend_assets/img/icons/icon-img/11.png') }}" alt="#">
                                            </div>
                                            <div class="ltn__feature-info">
                                                <h4>Curated Products</h4>
                                                <p>Provide Curated Products for
                                                    all product over $100</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 col-12">
                                        <div class="ltn__feature-item ltn__feature-item-8">
                                            <div class="ltn__feature-icon">
                                                <img src="{{ asset('frontend_assets/img/icons/icon-img/12.png') }}" alt="#">
                                            </div>
                                            <div class="ltn__feature-info">
                                                <h4>Handmade</h4>
                                                <p>We ensure the product quality
                                                    that is our main goal</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 col-12">
                                        <div class="ltn__feature-item ltn__feature-item-8">
                                            <div class="ltn__feature-icon">
                                                <img src="{{ asset('frontend_assets/img/icons/icon-img/13.png') }}" alt="#">
                                            </div>
                                            <div class="ltn__feature-info">
                                                <h4>Natural Food</h4>
                                                <p>Return product within 3 days
                                                    for any product you buy</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 col-12">
                                        <div class="ltn__feature-item ltn__feature-item-8">
                                            <div class="ltn__feature-icon">
                                                <img src="{{ asset('frontend_assets/img/icons/icon-img/14.png') }}" alt="#">
                                            </div>
                                            <div class="ltn__feature-info">
                                                <h4>Free home delivery</h4>
                                                <p>We ensure the product quality
                                                    that you can trust easily</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- FEATURE AREA END -->


            <!-- FOOTER AREA START -->
            <footer class="ltn__footer-area  ">
                <div class="footer-top-area  section-bg-1 plr--5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                                <div class="footer-widget footer-about-widget">
                                    <div class="footer-logo mb-10">
                                        <div class="site-logo">
                                            <img src="{{ asset('frontend_assets/img/logo.png') }}" alt="Logo">
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam sequi exercitationem nemo? Odio blanditiis numquam eaque!</p>
                                    <div class="footer-address">
                                        <ul>
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="icon-placeholder"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p>Proctorville, Ohio, United States</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="icon-call"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p><a href="tel:+0123-456789">+0123-456789</a></p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="icon-mail"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p><a href="#">info@lettuce.com</a></p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ltn__social-media mt-20">
                                        <ul>
                                            <li><a href="https://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="https://www.instagram.com/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="https://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                                <div class="footer-widget footer-menu-widget clearfix">
                                    <h4 class="footer-title">Corporate Info</h4>
                                    <div class="footer-menu">
                                        <ul>
                                            <li class="{{ (request()->is('about*')) ? 'active' : '' }}"><a href="{{ url('/about') }}">About</a></li>
                                            <li class="{{ (request()->is('shop*')) ? 'active' : '' }}"><a href="{{ route('shop') }}">Shop</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                                <div class="footer-widget footer-menu-widget clearfix">
                                    <h4 class="footer-title">Help</h4>
                                    <div class="footer-menu">
                                        <ul>
                                            <li class="{{ (request()->is('customer*')) ? 'active' : '' }}"><a href="{{ route('customer.account') }}">My account</a></li>
                                            <li class="{{ (request()->is('wishlist*')) ? 'active' : '' }}"><a href="{{ url('/wishlist') }}">Wishlist</a></li>
                                            <li class="{{ (request()->is('cart*')) ? 'active' : '' }}"><a href="{{ url('/cart') }}">Cart</a></li>
                                            <li class="{{ (request()->is('faq*')) ? 'active' : '' }}"><a href="{{ url('/faq') }}">FAQ</a></li>
                                            <li class="{{ (request()->is('contact*')) ? 'active' : '' }}"><a href="{{ url('/contact') }}">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                                <div class="footer-widget footer-newsletter-widget">
                                    <h4 class="footer-title">Newsletter</h4>
                                    <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                                    <div class="footer-newsletter">
                                        <form action="{{ route('subscribe') }}" method="POST" id="newsletter_form">
                                            @csrf
                                            <input type="email" name="subscriber_email" placeholder="Email*">
                                            <div class="btn-wrapper">
                                                <button class="theme-btn-1 btn" type="submit"><i class="fas fa-location-arrow"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ltn__copyright-area ltn__copyright-2 section-bg-1 border-top  ltn__border-top-2--- plr--5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-12 text-center">
                                <div class="ltn__copyright-design clearfix">
                                    <p>Copyright &copy; Lettuce <span class="current-year"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- FOOTER AREA END -->

            <!-- MODAL AREA START (Quick View Modal) -->
            <div class="ltn__modal-area ltn__quick-view-modal-area">
                <div class="modal fade" id="quick_view_modal" tabindex="-1">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" style="position:relative">
                            <div class="modal-header">
                                <button type="button" class="close modal_close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <!-- <i class="fas fa-times"></i> -->
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('frontend.quick_view_product')
                            </div>
                            <div class="preloader d-none" style="position:absolute" id="quick_view_preloader">
                                <div class="preloader_inner">
                                    <div class="spinner">
                                        <div class="dot1"></div>
                                        <div class="dot2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL AREA END -->

            <!-- MODAL AREA START (Add To Cart Modal) -->
            <div class="ltn__modal-area ltn__add-to-cart-modal-area">
                <div class="modal fade" id="add_to_cart_modal" tabindex="-1">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="ltn__quick-view-modal-inner">
                                    <div class="modal-product-item">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="modal-product-img cart_modal_product_img">
                                                    <img src="" alt="#">
                                                </div>
                                                <div class="modal-product-info">
                                                    <h5 class="cart_modal_product_name"></h5>
                                                    <p class="added-cart cart_modal_product_response"></p>
                                                    <div class="btn-wrapper">
                                                        <a href="{{ url('cart') }}" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                                                        <a href="{{ url('checkout') }}" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL AREA END -->

            <!-- MODAL AREA START (Wishlist Modal) -->
            <div class="ltn__modal-area ltn__add-to-cart-modal-area">
                <div class="modal fade" id="liton_wishlist_modal" tabindex="-1">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="ltn__quick-view-modal-inner">
                                    <div class="modal-product-item">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="modal-product-img wishlist_modal_img">
                                                    <img src="" alt="#">
                                                </div>
                                                <div class="modal-product-info">
                                                    <h5 class="wishlist_modal_product_name"></h5>
                                                    <p class="added-cart wishlist_modal_added_response"><i class="fa fa-check-circle"></i></p>
                                                    <div class="btn-wrapper">
                                                        <a href="{{ url('/wishlist') }}" class="theme-btn-1 btn btn-effect-1">View Wishlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL AREA END -->
        </div>
        <!-- Body main wrapper end -->    

        <!-- preloader area start -->
        <div class="preloader" id="preloader">
            <div class="preloader-inner">
                <div class="spinner">
                    <div class="dot1"></div>
                    <div class="dot2"></div>
                </div>
            </div>
        </div>
        <!-- preloader area end -->

        <!-- All JS Plugins -->
        <script src="{{ asset('frontend_assets/js/plugins.js') }}"></script>
        <!-- Main JS -->
        <script src="{{ asset('frontend_assets/js/main.js') }}"></script>

        
        <script>

            
            $(document).ready(function(){
                
                $('#preloader').addClass('d-none');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $(document).on("click",".qtybutton", function() {
                    var button = $(this);
                    var prodcutInStock = $(this).parent().data('id');
                    var max_quantity = 10;
                   
                    if(prodcutInStock > 0 && prodcutInStock <= 20 ){
                        max_quantity = 1;
                    }

                    var oldValue = button.parent().find("input").val();
                    if (button.text() == "+") {
                        var newVal = parseFloat(oldValue) + 1;
                        if(newVal > max_quantity){
                            newVal = max_quantity;
                            alert('The product quantity must not be greater than'+max_quantity+' .');
                        }
                    } 
                    else {
                        if (oldValue > 1) {
                            var newVal = parseFloat(oldValue) - 1;
                        } 
                        else {
                            newVal = 1;
                            alert('The product quantity must be at least 1.');
                        }
                    }
                    button.parent().find("input").val(newVal);
                });


                $(document).on('submit','#apply_coupon_form', function(event){

                    event.preventDefault();

                    let formData = $(this).serialize();
                    let url = "{{ route('cart.coupon.store') }}";

                    $.ajax({
                        type:'POST',
                        url:url,
                        data:formData,
                        success:function(data){
                            if(data != null){
                                if(data.success){
                                    $('#coupon_form_wrapper').load(' #coupon_form_wrapper >* ');
    
                                    $('.coupon_form_status').text(data.success);
                                    $('.coupon_form_status').removeClass('text-danger').addClass('text-success');
                                    $('.coupon_form_status').fadeIn().delay(1500).fadeOut();
    
                                    $('#shopping_cart_total').load(' #shopping_cart_total >* ');
    
                                }
                                else if(data.invalid_coupon){
                                    $('.coupon_form_status').text(data.invalid_coupon);
                                    $('.coupon_form_status').addClass('text-danger');
                                    $('.coupon_form_status').fadeIn().delay(1500).fadeOut();
                                }
                            }
                        },
                        error:function(error){
                            let errorMsg = "Something went wrong! Try reloading the page.";
                            if(error.status === 422){
                                var errors = $.parseJSON(error.responseText);
                                $.each(errors, function (key, value) {
                                    if($.isPlainObject(value)) {
                                        $.each(value, function (key, value) {  
                                            errorMsg = value[0];
                                        });
                                    }else{
                                        errorMsg = value;
                                    }
                                });
                            }
                            alert(errorMsg);
                        }
                    });

                });


                $(document).on('submit','#remove_coupon_form', function(event){

                    event.preventDefault();

                    let coupon_code = $(this).find('#coupon_code_input').val();
                    let formData = $(this).serialize();
                    let url = "{{ route('cart.coupon.destroy',':coupon') }}";
                        url = url.replace(':coupon',coupon_code);
                    
                    $.ajax({
                        type:'DELETE',
                        url:url,
                        data:formData,
                        success:function(data){
                            if(data != null){
                                if(data.success){
        
                                    $('#coupon_form_wrapper').load(' #coupon_form_wrapper >* ');

                                    $('.coupon_form_status').text(data.success);
                                    $('.coupon_form_status').removeClass('text-danger').addClass('text-success');
                                    $('.coupon_form_status').fadeIn().delay(1500).fadeOut();

                                    $('#shopping_cart_total').load(' #shopping_cart_total >* ');

                                }
                                else if(data.error){
                                    $('.coupon_form_status').text(data.error);
                                    $('.coupon_form_status').addClass('text-danger');
                                    $('.coupon_form_status').fadeIn().delay(1500).fadeOut();
                                }
                            }
                        },
                        error:function(){
                            alert("Something went wrong! Try reloading the page.")
                        }
                    });


                });

                
                $(function(){
                    $(document).on('click','.quick_view_product',function(event){
                        event.preventDefault();
                        let product_id = $(this).data('id');
                        let url = "{{ route('product.quick_view',':product_id') }}";
                            url = url.replace(':product_id',product_id);

                        $.ajax({
                            type:'GET',
                            url:url,
                            beforeSend:function(){
                                $('#quick_view_modal').find('#quick_view_preloader').removeClass('d-none');
                            },
                            success:function(data){
                                if(data.error){
                                    $('#quick_view_modal').find('.modal-body').html('<h1 class="text-center" style="padding:150px 20px">'+data.error+'</h1>');
                                }
                                else{
                                    $('#quick_view_modal').find('.modal-body').html(data);
                                    $('#quick_view_modal').find(".cart-plus-minus").prepend('<div class="dec qtybutton">-</div>');
                                    $('#quick_view_modal').find(".cart-plus-minus").append('<div class="inc qtybutton">+</div>');
                                }
                            },
                            complete:function(){
                                setTimeout(() => {
                                    $('#quick_view_modal').find('#quick_view_preloader').addClass('d-none');
                                }, 100);
                            },
                            error:function(){
                                $('#quick_view_modal').find('.modal-body').html('<h1 class="text-center" style="padding:150px 20px">Something went wrong!</h1>');
                                $('#quick_view_modal').find('#quick_view_preloader').addClass('d-none');
                            }
                        });
                    });
                });

                $(document).on('click','.modal_close', function(){
                    $('#quick_view_modal').find('#quick_view_preloader').addClass('d-none');
                });

                $('#quick_view_modal').on('hide.bs.modal', function () {
                    $('#quick_view_modal').find('#quick_view_preloader').addClass('d-none');
                });


                $(document).on('click','.add_to_wishlist_btn', function(event){
                    event.preventDefault();
                });

                $('.wishlist_form').on('submit', function(event){
                    event.preventDefault();
                    let path = "{{ asset('uploads/product/') }}";
                    let formData = $(this).serialize();
                    let url = "{{ route('wishlist.store') }}";
                    addToWishlist(path,formData,url);
                });

                $(document).on('submit','#quick_view_wishlist_form', function(event){
                    event.preventDefault();
                    let path = "{{ asset('uploads/product/') }}";
                    let formData = $(this).serialize();
                    let url = "{{ route('wishlist.store') }}";
                    addToWishlist(path,formData,url);
                });


                $(document).on('click','.wishlist_delete_btn', function(event){
                    event.preventDefault();
                    let id = $(this).data('id');
                    $('#wishlist_delete_'+id).submit();
                });

                $(document).on('submit','.wishlist_delete_form', function(event){
                    event.preventDefault();
                    let id = $(this).find('.wishlist_delete_btn').data('id');
                    let formData = $(this).serialize();
                    let url = "{{ route('wishlist.destroy',':wishlist') }}";
                        url = url.replace(':wishlist',id);

                    $.ajax({
                        type:'DELETE',
                        url:url,
                        data:formData,
                        success:function(data){
                            $('#wishlists_table').load(' #wishlists_table >* ');
                        },
                        error:function(){
                            alert("Something went wrong!");
                        }
                    });

                });


                $(document).on('click','.add_to_cart_btn', function(event){
                    event.preventDefault();
                    let id = $(this).data('id');
                    $('#cart_form_'+id).submit();
                });

                $(document).on('submit','.cart_form', function(event){
                    event.preventDefault();
                    let formData = $(this).serialize();
                    let url = "{{ route('cart.store') }}";
                    addToCart(formData,url);
                });


                $(document).on('click','.quick_view_add_to_cart_btn', function(event){
                    event.preventDefault();
                    let id = $(this).data('id');
                    $('#quick_view_cart_form').submit();
                });

                $(document).on('submit','#quick_view_cart_form', function(event){
                    event.preventDefault();
                    let formData = $(this).serialize();
                    let url = "{{ route('cart.store') }}";
                    addToCart(formData,url);
                });


                $(document).on('click','.cart_delete_btn', function(event){
                    event.preventDefault();
                    let id = $(this).data('id');
                    $('#cart_delete_form_'+id).submit();
                });


                $(document).on('submit','.cart_delete_form', function(event){
                    event.preventDefault();
                    let id = $(this).find('.cart_delete_btn').data('id');
                    let formData = $(this).serialize();
                    let url = "{{ route('cart.destroy',':cart') }}";
                        url = url.replace(':cart',id);

                    $.ajax({
                        type:'DELETE',
                        url:url,
                        data:formData,
                        success:function(data){
                            if(data != null && data.status == 'success'){

                                $('#cart_row_'+id).remove();
                                $('.your_cart_count').html('<i class="icon-shopping-cart"></i><sup>'+data.cart_data.cart_count+'</sup>');
                                $('.your_cart_total').text('$'+(data.cart_data.cart_total_details.cart_sub_total / 100).toFixed(2));
                                $('#shopping_cart_total').load(' #shopping_cart_total >* ');

                                $('#ltn__utilize-cart-menu').load(' #ltn__utilize-cart-menu >* ');
    
                                if(data.cart_data.cart_count <= 0){
                                    $('#cart_table').html('<tr><td colspan="6" style="border-bottom:1px solid #dee2e6;"><h4 class="text-center">YOUR SHOPPING BAG IS EMPTY!</h4><div class="mt-20 text-center"><a href="{{ url("shop") }}" style="background-color:#80B500;border:none" class="btn btn-success">Shop Now</a></div></tr>');
                                    $('#cart_coupon_row').remove();
                                    $('#shopping_cart_total').remove();
                                }

                            }

                        },
                        error:function(){
                            alert("Something went wrong! Try reloading the page.");
                        }
                    });
                });
                

                function addToCart(formData,url){

                    $.ajax({
                        type:'POST',
                        url:url,
                        data:formData,
                        success:function(data){

                            if(data != null){
                                if(data.status == 'unauthorized'){
                                   alert('Unauthorized Action!');
                                }
                                else{

                                    let status = '';
                                    if(data.status == 'success'){
                                        status = '<i class="fa fa-check-circle"></i> Added Successfully!';
                                    }
                                    else if(data.status == 'exists'){
                                        status = '<i class="fa fa-check-circle"></i> Product already added!';
                                    }

                                    $('#ltn__utilize-cart-menu').load(' #ltn__utilize-cart-menu >* ');

                                    $('.your_cart_count').html('<i class="icon-shopping-cart"></i><sup>'+data.product.cart_count+'</sup>');
                                    $('.your_cart_total').text('$'+data.product.cart_sub_total.toFixed(2));
                                    $('#add_to_cart_modal').find('.cart_modal_product_img img').attr('src',data.product.thumbnail);
                                    $('#add_to_cart_modal').find('.cart_modal_product_name').text(data.product.product_name);
                                    $('#add_to_cart_modal').find('.cart_modal_product_response').html(status);
                                    $('#add_to_cart_modal').modal('show');

                                }
                                
                            }

                        },
                        error:function(error){
                            let errorMsg = "Something went wrong! Try reloading the page.";
                            if(error.status === 422){
                                var errors = $.parseJSON(error.responseText);
                                $.each(errors, function (key, value) {
                                    if($.isPlainObject(value)) {
                                        $.each(value, function (key, value) {  
                                            errorMsg = value[0];
                                        });
                                    }else{
                                        errorMsg = value;
                                    }
                                });
                            }
                            alert(errorMsg);
                        }
                    });

                }

                function addToWishlist(path,formData,url){

                    $.ajax({
                        type:'POST',
                        url:url,
                        data:formData,
                        success:function(data){

                            if(data != null){

                                if(data.status == 'unauthorized'){
                                    alert("Unauthorized Action!");
                                }
                                else{

                                    $('#liton_wishlist_modal').find('.wishlist_modal_img img').attr('src',path+'/'+data.product.thumbnail);
                                    $('#liton_wishlist_modal').find('.wishlist_modal_product_name').text(data.product.product_name);
    
                                    if(data.status == 'exists'){
                                        $('#liton_wishlist_modal').find('.wishlist_modal_added_response').html('<i class="fa fa-check-circle"></i> Product already added!');
                                    }
                                    else if(data.status == 'success'){
                                        $('#liton_wishlist_modal').find('.wishlist_modal_added_response').html('<i class="fa fa-check-circle"></i> Added Successfully');
                                    }
                                    
                                    $('#liton_wishlist_modal').modal('show');

                                }
                                
                            }

                        },
                        error:function(){
                            alert("Something went wrong! Try reloading the page.");
                        }
                    });

                }


                $(document).on('submit','#newsletter_form', function(e){

                    e.preventDefault();

                    let formData = $(this).serialize();

                    let url = "{{ route('subscribe') }}";


                    $.ajax({
                        type:'POST',
                        url:url,
                        data:formData,
                        success:function(data){

                            if(data.error){
                                $.each(data.error, function(key,error){
                                    alert(error);
                                });
                            }
                            else if(data.subscriber_exists){
                                alert(data.subscriber_exists);
                            }
                            else if(data.success){
                                alert(data.success);
                            }
                            
                        },
                        error:function(){
                            alert('Something went wrong! Try reloading the page');
                        }
                    });


                });

            });

        </script>

        @yield('footer_script')
        
    </body>
</html>





