
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
        <meta charset="utf-8" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        

        <!-- Responsive -->
        <link href="{{ asset('dashboard_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> 

        <!-- Bootstrap Css -->
        <link  href="{{ asset('dashboard_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link  href="{{ asset('dashboard_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link  href="{{ asset('dashboard_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />


        <style>
            
            #viewUserDetails .profile_avatar {
                height: 120px;
                width:120px;
                border-radius:50%;
            }
            .user_details_loading .profile_avatar {
                background-color: #f2f2f2;
            }
            .user_details_loading .profile_avatar >* {
                display: none;
            }
            .user_details_loading .close_user_view {
                background-color: #f2f2f2;
                height: 30px;
                width:50px;
                font-size: 0;
                padding:0;
                border-radius: 0;
                border:none;
                opacity: 1;
            }
            .user_details_loading .modal-title{
                background-color: #f2f2f2;
                height: 30px;
                width:calc(100% - 60px);
                font-size: 0;
            }
            .user_details_loading .card-title{
                background-color: #f2f2f2;
                height: 30px;
                font-size: 0;
            }
            .user_details_loading h4.card-title{
                width:50%;
            }
            .user_details_loading h5.card-title{
                width:40%;
            }
            .user_details_loading .user_details_table{
                border-collapse: separate;
                border-spacing: 15px;
            }
            .user_details_loading .user_details_table td,
            .user_details_loading .user_details_table th{
                background-color: #f2f2f2;
                height: 30px;
                font-size: 0;
                margin-bottom:15px;
            }
            .user_details_loading .user_details_table th{
                width:35%;
            }
            .user_details_loading .user_details_table td{
                width:65%;
            }


            .faq_view_loading h4{
                background-color: #f2f2f2;
                height: 40px;
                width: 100%;
                font-size: 0;
            }
            .faq_view_loading h5{
                background-color: #f2f2f2;
                height: 40px;
                width: 100%;
                font-size: 0;
            }
            .faq_view_loading p{
                background-color: #f2f2f2;
                height: 70px;
                width: 100%;
                font-size: 0;
            }

            .faq_edit_loading h5{
                background-color: #f2f2f2;
                height: 40px;
                width: 100%;
                font-size: 0;
            }
            .faq_edit_loading label{
                background-color: #f2f2f2;
                height: 25px;
                width: 100%;
                font-size: 0;
            }
            .faq_edit_loading input,
            .faq_edit_loading textarea{
                background-color: #f2f2f2;
                height: 50px;
                width: 100%;
                border:none;
                margin-top:15px;
            }
            .country_edit_loading h5{
                background-color: #f2f2f2;
                height: 40px;
                width: 100%;
                font-size: 0;
            }
            .country_edit_loading label{
                background-color: #f2f2f2;
                height: 25px;
                width: 100%;
                font-size: 0;
            }
            .country_edit_loading input{
                background-color: #f2f2f2;
                height: 50px;
                width: 100%;
                border:none;
                margin-top:15px;
            }
            .city_edit_loading h5{
                background-color: #f2f2f2;
                height: 40px;
                width: 100%;
                font-size: 0;
            }
            .city_edit_loading label{
                background-color: #f2f2f2;
                height: 25px;
                width: 100%;
                font-size: 0;
            }
            .city_edit_loading input,
            .city_edit_loading select{
                background-color: #f2f2f2;
                height: 50px;
                width: 100%;
                border:none;
                margin-top:15px;
                font-size:0;
            }

            .coupon_edit_loading label,
            .discount_edit_loading label,
            .category_edit_loading label,
            .size_edit_loading label{
                background-color: #f2f2f2;
                height: 25px;
                width: 100%;
                font-size: 0;
            }
            .coupon_edit_loading input,
            .coupon_edit_loading select,
            .discount_edit_loading input,
            .discount_edit_loading select,
            .category_edit_loading input,
            .category_edit_loading select,
            .size_edit_loading input{
                background-color: #f2f2f2;
                height: 50px;
                width: 100%;
                border:none;
                margin-top:15px;
                font-size:0;
            }

            .coupon_edit_loading .modal-title,
            .discount_edit_loading .modal-title,
            .category_edit_loading .modal-title,
            .size_edit_loading .modal-title{
                background-color: #f2f2f2;
                height: 30px;
                width:calc(100% - 60px);
                font-size: 0;
            }

            .coupon_edit_loading .close_coupon_form,
            .coupon_edit_loading .coupon_update_btn,
            .discount_edit_loading .close_discount_form,
            .discount_edit_loading .discount_update_btn,
            .category_edit_loading .close_category_form,
            .category_edit_loading .category_update_btn,
            .size_edit_loading .close_size_form,
            .size_edit_loading .size_update_btn {
                background-color: #f2f2f2;
                height: 30px;
                width:50px;
                font-size: 0;
                padding:0;
                border-radius: 0;
                border:none;
                opacity: 1;
            }


            .category_edit_loading #category_image {
                background-color: #f2f2f2;
                height: 80px;
                width:80px;
                border:none;
                text-indent: -999999px;
            }
            .category_edit_loading input[type=file]::file-selector-button {
                border:none;
            }

            #save_avatar{
                display: none;
                visibility: hidden;
                opacity: 0;
            }
            #save_avatar.show{
                display: inline-block;
                visibility: visible;
                opacity: 1;
            }

           
            #avatar_change.hide{
                display: none;
                visibility: hidden;
                opacity: 0;
            }
            
            .avatar_remove.hide{
                display: none;
                visibility: hidden;
                opacity: 0;
            }

            #profile_img.hide{
                display: none;
                visibility: hidden;
                opacity: 0;
            }
            .avatar-title.hide{
                display: none;
                visibility: hidden;
                opacity: 0;
            }

            .multiple_img_preview img{
                width:200px;
                padding:10px;
            }

            #product_thumbnail_wrapper {
                height: 180px;
                width: 180px;
                position: relative;
                border: 1px dashed gray;
            }
            #product_thumbnail_wrapper #product_thumbnail_preview{
                position: absolute;
                height: 100%;
                width:100%;
                max-width:100%;
                padding:10px;
            }
            #product_thumbnail_label {
                position: absolute;
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                margin-bottom: 0 !important;
                cursor:pointer;
                z-index:9;
            }
           
           
            .has_preview .preview_overlay{
                position: absolute;
                height: 100%;
                width: 100%;
                background: #000;
                opacity: 0;
                z-index: -1;
            }
            .has_preview > *{
                opacity:0;
                color:#fff !important;
                
            }
            
            .has_preview:hover.has_preview > *{
                opacity:1;
                transition: opacity .3s ease;
            }
            .has_preview:hover .preview_overlay{
                opacity: .5;
            }

            #product_multiple_photo_label {
                position: absolute;
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                margin-bottom: 0 !important;
                cursor:pointer;
                z-index: 9;
            }

            .product_multiple_photo_wrapper {
                position: relative;
                width: 100%;
                min-height: 200px;
                border: 1px dashed gray;
                overflow: hidden;
            }

        </style>

    </head>
    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                           <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('dashboard_assets/images/logo-light.svg') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('dashboard_assets/images/logo-light.png') }}" alt="" height="19">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(auth()->user()->userDetails->avatar != null)
                                <img class="rounded-circle header-profile-user" src="{{ asset('uploads/users') }}/{{ auth()->user()->userDetails->avatar }}" alt="Header Avatar">
                                @else 
                                <div class="avatar-xs d-inline-block">
                                    <span class="avatar-title rounded-circle">
                                        {{ substr(auth()->user()->name,0,1) }}
                                    </span>
                                </div>
                                @endif
                                
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ auth()->user()->name }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Menu</li>

                            <li>
                                <a href="{{ route('admin.home') }}" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-layout"></i>
                                    <span key="t-layouts">Frontend</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('banner.index') }}" key="t-light-sidebar">Banner</a></li>
                                    <li><a href="{{ route('faq.index') }}" key="t-compact-sidebar">FAQ</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user-circle"></i>
                                    <span key="t-layouts">Users</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('user.admin') }}" key="t-light-sidebar">Admins</a></li>
                                    <li><a href="{{ route('user.customer') }}" key="t-compact-sidebar">Customers</a></li>
                                    <li><a href="{{ route('admin.user.register') }}" key="t-compact-sidebar">Add User</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('category.index') }}" class="waves-effect">
                                    <i class="bx bx-list-ul"></i>
                                    <span key="t-layouts">Category</span>
                                </a>
                            </li>
                            <li class="@yield('parent_active')">
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxl-product-hunt"></i>
                                    <span key="t-maps">Product</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('product.index') }}" class="@yield('active')">Products</a></li>
                                    <li><a href="{{ route('product.create') }}">Add Product</a></li>
                                    <li><a href="{{ route('product.create') }}">Product Discount</a></li>
                                    <li><a href="{{ route('size.index') }}">Size</a></li>
                                    <li><a href="{{ route('product.create') }}">Trash</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-map"></i>
                                    <span key="t-maps">Regions</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('country.index') }}">Country</a></li>
                                    <li><a href="{{ route('city.index') }}">City</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-discount"></i>
                                    <span key="t-maps">Offers</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('coupon.index') }}">Coupon</a></li>
                                    <li><a href="{{ route('discount.index') }}">Discount</a></li>
                                </ul>
                            </li>
                            

                            <li class="menu-title" key="t-apps">Apps</li>

                

                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="bx bx-calendar"></i><span class="badge rounded-pill bg-success float-end">New</span>
                                    <span key="t-dashboards">Calendars</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="calendar.html" key="t-tui-calendar">TUI Calendar</a></li>
                                    <li><a href="calendar-full.html" key="t-full-calendar">Full Calendar</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="chat.html" class="waves-effect">
                                    <i class="bx bx-chat"></i>
                                    <span key="t-chat">Chat</span>
                                </a>
                            </li>

                            <li>
                                <a href="apps-filemanager.html" class="waves-effect">
                                    <i class="bx bx-file"></i>
                                    <span class="badge rounded-pill bg-success float-end" key="t-new">New</span>
                                    <span key="t-file-manager">File Manager</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Ecommerce</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="ecommerce-products.html" key="t-products">Products</a></li>
                                    <li><a href="ecommerce-product-detail.html" key="t-product-detail">Product Detail</a></li>
                                    <li><a href="ecommerce-orders.html" key="t-orders">Orders</a></li>
                                    <li><a href="ecommerce-customers.html" key="t-customers">Customers</a></li>
                                    <li><a href="ecommerce-cart.html" key="t-cart">Cart</a></li>
                                    <li><a href="ecommerce-checkout.html" key="t-checkout">Checkout</a></li>
                                    <li><a href="ecommerce-shops.html" key="t-shops">Shops</a></li>
                                    <li><a href="ecommerce-add-product.html" key="t-add-product">Add Product</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-bitcoin"></i>
                                    <span key="t-crypto">Crypto</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="crypto-wallet.html" key="t-wallet">Wallet</a></li>
                                    <li><a href="crypto-buy-sell.html" key="t-buy">Buy/Sell</a></li>
                                    <li><a href="crypto-exchange.html" key="t-exchange">Exchange</a></li>
                                    <li><a href="crypto-lending.html" key="t-lending">Lending</a></li>
                                    <li><a href="crypto-orders.html" key="t-orders">Orders</a></li>
                                    <li><a href="crypto-kyc-application.html" key="t-kyc">KYC Application</a></li>
                                    <li><a href="crypto-ico-landing.html" key="t-ico">ICO Landing</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-envelope"></i>
                                    <span key="t-email">Email</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="email-inbox.html" key="t-inbox">Inbox</a></li>
                                    <li><a href="email-read.html" key="t-read-email">Read Email</a></li>
                                    <li>
                                        <a href="javascript: void(0);">
                                            <span class="badge rounded-pill badge-soft-success float-end" key="t-new">New</span>
                                            <span key="t-email-templates">Templates</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="email-template-basic.html" key="t-basic-action">Basic Action</a></li>
                                            <li><a href="email-template-alert.html" key="t-alert-email">Alert Email</a></li>
                                            <li><a href="email-template-billing.html" key="t-bill-email">Billing Email</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-receipt"></i>
                                    <span key="t-invoices">Invoices</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="invoices-list.html" key="t-invoice-list">Invoice List</a></li>
                                    <li><a href="invoices-detail.html" key="t-invoice-detail">Invoice Detail</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-briefcase-alt-2"></i>
                                    <span key="t-projects">Projects</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="projects-grid.html" key="t-p-grid">Projects Grid</a></li>
                                    <li><a href="projects-list.html" key="t-p-list">Projects List</a></li>
                                    <li><a href="projects-overview.html" key="t-p-overview">Project Overview</a></li>
                                    <li><a href="projects-create.html" key="t-create-new">Create New</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-task"></i>
                                    <span key="t-tasks">Tasks</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="tasks-list.html" key="t-task-list">Task List</a></li>
                                    <li><a href="tasks-kanban.html" key="t-kanban-board">Kanban Board</a></li>
                                    <li><a href="tasks-create.html" key="t-create-task">Create Task</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-user-detail"></i>
                                    <span key="t-contacts">Contacts</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="contacts-grid.html" key="t-user-grid">Users Grid</a></li>
                                    <li><a href="contacts-list.html" key="t-user-list">Users List</a></li>
                                    <li><a href="contacts-profile.html" key="t-profile">Profile</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <span class="badge rounded-pill bg-success float-end" key="t-new">New</span>
                                    <i class="bx bx-detail"></i>
                                    <span key="t-blog">Blog</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="blog-list.html" key="t-blog-list">Blog List</a></li>
                                    <li><a href="blog-grid.html" key="t-blog-grid">Blog Grid</a></li>
                                    <li><a href="blog-details.html" key="t-blog-details">Blog Details</a></li>
                                </ul>
                            </li>

                            <li class="menu-title" key="t-pages">Pages</li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <span class="badge rounded-pill bg-success float-end" key="t-new">New</span>
                                    <i class="bx bx-user-circle"></i>
                                    <span key="t-authentication">Authentication</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="auth-login.html" key="t-login">Login</a></li>
                                    <li><a href="auth-login-2.html" key="t-login-2">Login 2</a></li>
                                    <li><a href="auth-register.html" key="t-register">Register</a></li>
                                    <li><a href="auth-register-2.html" key="t-register-2">Register 2</a></li>
                                    <li><a href="auth-recoverpw.html" key="t-recover-password">Recover Password</a></li>
                                    <li><a href="auth-recoverpw-2.html" key="t-recover-password-2">Recover Password 2</a></li>
                                    <li><a href="auth-lock-screen.html" key="t-lock-screen">Lock Screen</a></li>
                                    <li><a href="auth-lock-screen-2.html" key="t-lock-screen-2">Lock Screen 2</a></li>
                                    <li><a href="auth-confirm-mail.html" key="t-confirm-mail">Confirm Email</a></li>
                                    <li><a href="auth-confirm-mail-2.html" key="t-confirm-mail-2">Confirm Email 2</a></li>
                                    <li><a href="auth-email-verification.html" key="t-email-verification">Email verification</a></li>
                                    <li><a href="auth-email-verification-2.html" key="t-email-verification-2">Email Verification 2</a></li>
                                    <li><a href="auth-two-step-verification.html" key="t-two-step-verification">Two Step Verification</a></li>
                                    <li><a href="auth-two-step-verification-2.html" key="t-two-step-verification-2">Two Step Verification 2</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-file"></i>
                                    <span key="t-utility">Utility</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="pages-starter.html" key="t-starter-page">Starter Page</a></li>
                                    <li><a href="pages-maintenance.html" key="t-maintenance">Maintenance</a></li>
                                    <li><a href="pages-comingsoon.html" key="t-coming-soon">Coming Soon</a></li>
                                    <li><a href="pages-timeline.html" key="t-timeline">Timeline</a></li>
                                    <li><a href="pages-faqs.html" key="t-faqs">FAQs</a></li>
                                    <li><a href="pages-pricing.html" key="t-pricing">Pricing</a></li>
                                    <li><a href="pages-404.html" key="t-error-404">Error 404</a></li>
                                    <li><a href="pages-500.html" key="t-error-500">Error 500</a></li>
                                </ul>
                            </li>

                            <li class="menu-title" key="t-components">Components</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-tone"></i>
                                    <span key="t-ui-elements">UI Elements</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="ui-alerts.html" key="t-alerts">Alerts</a></li>
                                    <li><a href="ui-buttons.html" key="t-buttons">Buttons</a></li>
                                    <li><a href="ui-cards.html" key="t-cards">Cards</a></li>
                                    <li><a href="ui-carousel.html" key="t-carousel">Carousel</a></li>
                                    <li><a href="ui-dropdowns.html" key="t-dropdowns">Dropdowns</a></li>
                                    <li><a href="ui-grid.html" key="t-grid">Grid</a></li>
                                    <li><a href="ui-images.html" key="t-images">Images</a></li>
                                    <li><a href="ui-lightbox.html" key="t-lightbox">Lightbox</a></li>
                                    <li><a href="ui-modals.html" key="t-modals">Modals</a></li>
                                    <li><a href="ui-offcanvas.html" key="t-offcanvas">Offcanvas</a></li>
                                    <li><a href="ui-rangeslider.html" key="t-range-slider">Range Slider</a></li>
                                    <li><a href="ui-session-timeout.html" key="t-session-timeout">Session Timeout</a></li>
                                    <li><a href="ui-progressbars.html" key="t-progress-bars">Progress Bars</a></li>
                                    <li><a href="ui-placeholders.html" key="t-placeholders">Placeholders</a></li>
                                    <li><a href="ui-sweet-alert.html" key="t-sweet-alert">Sweet-Alert</a></li>
                                    <li><a href="ui-tabs-accordions.html" key="t-tabs-accordions">Tabs & Accordions</a></li>
                                    <li><a href="ui-typography.html" key="t-typography">Typography</a></li>
                                    <li><a href="ui-toasts.html" key="t-toasts">Toasts</a></li>
                                    <li><a href="ui-video.html" key="t-video">Video</a></li>
                                    <li><a href="ui-general.html" key="t-general">General</a></li>
                                    <li><a href="ui-colors.html" key="t-colors">Colors</a></li>
                                    <li><a href="ui-rating.html" key="t-rating">Rating</a></li>
                                    <li><a href="ui-notifications.html" key="t-notifications">Notifications</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="bx bxs-eraser"></i>
                                    <span class="badge rounded-pill bg-danger float-end">10</span>
                                    <span key="t-forms">Forms</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="form-elements.html" key="t-form-elements">Form Elements</a></li>
                                    <li><a href="form-layouts.html" key="t-form-layouts">Form Layouts</a></li>
                                    <li><a href="form-validation.html" key="t-form-validation">Form Validation</a></li>
                                    <li><a href="form-advanced.html" key="t-form-advanced">Form Advanced</a></li>
                                    <li><a href="form-editors.html" key="t-form-editors">Form Editors</a></li>
                                    <li><a href="form-uploads.html" key="t-form-upload">Form File Upload</a></li>
                                    <li><a href="form-xeditable.html" key="t-form-xeditable">Form Xeditable</a></li>
                                    <li><a href="form-repeater.html" key="t-form-repeater">Form Repeater</a></li>
                                    <li><a href="form-wizard.html" key="t-form-wizard">Form Wizard</a></li>
                                    <li><a href="form-mask.html" key="t-form-mask">Form Mask</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-list-ul"></i>
                                    <span key="t-tables">Tables</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="tables-basic.html" key="t-basic-tables">Basic Tables</a></li>
                                    <li><a href="tables-datatable.html" key="t-data-tables">Data Tables</a></li>
                                    <li><a href="tables-responsive.html" key="t-responsive-table">Responsive Table</a></li>
                                    <li><a href="tables-editable.html" key="t-editable-table">Editable Table</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-bar-chart-alt-2"></i>
                                    <span key="t-charts">Charts</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="charts-apex.html" key="t-apex-charts">Apex Charts</a></li>
                                    <li><a href="charts-echart.html" key="t-e-charts">E Charts</a></li>
                                    <li><a href="charts-chartjs.html" key="t-chartjs-charts">Chartjs Charts</a></li>
                                    <li><a href="charts-flot.html" key="t-flot-charts">Flot Charts</a></li>
                                    <li><a href="charts-tui.html" key="t-ui-charts">Toast UI Charts</a></li>
                                    <li><a href="charts-knob.html" key="t-knob-charts">Jquery Knob Charts</a></li>
                                    <li><a href="charts-sparkline.html" key="t-sparkline-charts">Sparkline Charts</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-aperture"></i>
                                    <span key="t-icons">Icons</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="icons-boxicons.html" key="t-boxicons">Boxicons</a></li>
                                    <li><a href="icons-materialdesign.html" key="t-material-design">Material Design</a></li>
                                    <li><a href="icons-dripicons.html" key="t-dripicons">Dripicons</a></li>
                                    <li><a href="icons-fontawesome.html" key="t-font-awesome">Font Awesome</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-map"></i>
                                    <span key="t-maps">Maps</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="maps-google.html" key="t-g-maps">Google Maps</a></li>
                                    <li><a href="maps-vector.html" key="t-v-maps">Vector Maps</a></li>
                                    <li><a href="maps-leaflet.html" key="t-l-maps">Leaflet Maps</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-share-alt"></i>
                                    <span key="t-multi-level">Multi Level</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" key="t-level-1-1">Level 1.1</a></li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Level 1.2</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="javascript: void(0);" key="t-level-2-1">Level 2.1</a></li>
                                            <li><a href="javascript: void(0);" key="t-level-2-2">Level 2.2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                
                @yield('content')
                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <span id="copyright_text"></span>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->


        <!-- JAVASCRIPT -->
        <script src="{{ asset('dashboard_assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/app.js') }}"></script>

        @yield('footer_script')

        <script>

            document.getElementById('copyright_text').innerHTML = new Date().getFullYear() + " © Lettuce."

        </script>

    </body>

</html>
