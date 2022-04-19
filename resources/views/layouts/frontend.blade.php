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
    </head>

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
                                        <form id="#123" method="get"  action="#">
                                            <input type="text" name="search" value="" placeholder="Search here..."/>
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
                                                            <li><a href="{{ url('/wishlist') }}">Wishlist</a></li>
                                                            
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mini-cart-icon mini-cart-icon-2">
                                                <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                                    <span class="mini-cart-icon">
                                                        <i class="icon-shopping-cart"></i>
                                                        <sup>2</sup>
                                                    </span>
                                                    <h6><span>Your Cart</span> <span class="ltn__secondary-color">$89.25</span></h6>
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
                                                <li><a href="{{ route('index') }}">Home</a></li>
                                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                                <li><a href="{{ url('/contact') }}">Contact</a></li>
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
                        <div class="mini-cart-item clearfix">
                            <div class="mini-cart-img">
                                <a href="#"><img src="{{ asset('frontend_assets/img/product/1.png') }}" alt="Image"></a>
                                <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                            </div>
                            <div class="mini-cart-info">
                                <h6><a href="#">Red Hot Tomato</a></h6>
                                <span class="mini-cart-quantity">1 x $65.00</span>
                            </div>
                        </div>
                        <div class="mini-cart-item clearfix">
                            <div class="mini-cart-img">
                                <a href="#"><img src="{{ asset('frontend_assets/img/product/2.png') }}" alt="Image"></a>
                                <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                            </div>
                            <div class="mini-cart-info">
                                <h6><a href="#">Vegetables Juices</a></h6>
                                <span class="mini-cart-quantity">1 x $85.00</span>
                            </div>
                        </div>
                        <div class="mini-cart-item clearfix">
                            <div class="mini-cart-img">
                                <a href="#"><img src="{{ asset('frontend_assets/img/product/3.png') }}" alt="Image"></a>
                                <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                            </div>
                            <div class="mini-cart-info">
                                <h6><a href="#">Orange Sliced Mix</a></h6>
                                <span class="mini-cart-quantity">1 x $92.00</span>
                            </div>
                        </div>
                        <div class="mini-cart-item clearfix">
                            <div class="mini-cart-img">
                                <a href="#"><img src="{{ asset('frontend_assets/img/product/4.png') }}" alt="Image"></a>
                                <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                            </div>
                            <div class="mini-cart-info">
                                <h6><a href="#">Orange Fresh Juice</a></h6>
                                <span class="mini-cart-quantity">1 x $68.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="mini-cart-footer">
                        <div class="mini-cart-sub-total">
                            <h5>Subtotal: <span>$310.00</span></h5>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{ url('/cart') }}" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                            <a href="{{ url('/checkout') }}" class="theme-btn-2 btn btn-effect-2">Checkout</a>
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
            <div class="ltn__feature-area before-bg-bottom-2 mb--30--- plr--5">
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
            </div>
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
                                            <li><a href="{{ url('/about') }}">About</a></li>
                                            <li><a href="{{ route('shop') }}">Shop</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                                <div class="footer-widget footer-menu-widget clearfix">
                                    <h4 class="footer-title">Help</h4>
                                    <div class="footer-menu">
                                        <ul>
                                            <li><a href="{{ route('customer.account') }}">My account</a></li>
                                            <li><a href="{{ url('/wishlist') }}">Wish List</a></li>
                                            <li><a href="{{ url('/cart') }}">Cart</a></li>
                                            <li><a href="{{ url('/faq') }}">FAQ</a></li>
                                            <li><a href="{{ url('/contact') }}">Contact us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
                                <div class="footer-widget footer-newsletter-widget">
                                    <h4 class="footer-title">Newsletter</h4>
                                    <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                                    <div class="footer-newsletter">
                                        <form action="#">
                                            <input type="email" name="email" placeholder="Email*">
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
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <!-- <i class="fas fa-times"></i> -->
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="ltn__quick-view-modal-inner">
                                    <div class="modal-product-item">
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="modal-product-img">
                                                    <img src="{{ asset('frontend_assets/img/product/4.png') }}" alt="#">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="modal-product-info">
                                                    <div class="product-ratting">
                                                        <ul>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                            <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                                        </ul>
                                                    </div>
                                                    <h3>Vegetables Juices</h3>
                                                    <div class="product-price">
                                                        <span>$149.00</span>
                                                        <del>$165.00</del>
                                                    </div>
                                                    <div class="modal-product-meta ltn__product-details-menu-1">
                                                        <ul>
                                                            <li>
                                                                <strong>Categories:</strong> 
                                                                <span>
                                                                    <a href="#">Parts</a>
                                                                    <a href="#">Car</a>
                                                                    <a href="#">Seat</a>
                                                                    <a href="#">Cover</a>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="ltn__product-details-menu-2">
                                                        <ul>
                                                            <li>
                                                                <div class="cart-plus-minus">
                                                                    <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="theme-btn-1 btn btn-effect-1" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                    <i class="fas fa-shopping-cart"></i>
                                                                    <span>ADD TO CART</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="ltn__product-details-menu-3">
                                                        <ul>
                                                            <li>
                                                                <a href="#" class="" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                    <i class="far fa-heart"></i>
                                                                    <span>Add to Wishlist</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="" title="Compare" data-toggle="modal" data-target="#quick_view_modal">
                                                                    <i class="fas fa-exchange-alt"></i>
                                                                    <span>Compare</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <hr>
                                                    <div class="ltn__social-media">
                                                        <ul>
                                                            <li>Share:</li>
                                                            <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                            <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                                            <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                            
                                                        </ul>
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
                                                <div class="modal-product-img">
                                                    <img src="{{ asset('frontend_assets/img/product/1.png') }}" alt="#">
                                                </div>
                                                <div class="modal-product-info">
                                                    <h5><a href="product-details.html">Vegetables Juices</a></h5>
                                                    <p class="added-cart"><i class="fa fa-check-circle"></i>  Successfully added to your Cart</p>
                                                    <div class="btn-wrapper">
                                                        <a href="cart.html" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                                                        <a href="checkout.html" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                                                    </div>
                                                </div>
                                                <!-- additional-info -->
                                                <div class="additional-info d-none">
                                                    <p>We want to give you <b>10% discount</b> for your first order, <br>  Use discount code at checkout</p>
                                                    <div class="payment-method">
                                                        <img src="{{ asset('frontend_assets/img/icons/payment.png') }}" alt="#">
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
                                                <div class="modal-product-img">
                                                    <img src="{{ asset('frontend_assets/img/product/7.png') }}" alt="#">
                                                </div>
                                                <div class="modal-product-info">
                                                    <h5><a href="product-details.html">Vegetables Juices</a></h5>
                                                    <p class="added-cart"><i class="fa fa-check-circle"></i>  Successfully added to your Wishlist</p>
                                                    <div class="btn-wrapper">
                                                        <a href="wishlist.html" class="theme-btn-1 btn btn-effect-1">View Wishlist</a>
                                                    </div>
                                                </div>
                                                <!-- additional-info -->
                                                <div class="additional-info d-none">
                                                    <p>We want to give you <b>10% discount</b> for your first order, <br>  Use discount code at checkout</p>
                                                    <div class="payment-method">
                                                        <img src="{{ asset('frontend_assets/img/icons/payment.png') }}" alt="#">
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
        <div class="preloader d-none" id="preloader">
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

    </body>
</html>