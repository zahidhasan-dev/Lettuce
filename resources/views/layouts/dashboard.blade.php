
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
        
        <!-- Place favicon.png in the root directory -->
        <link rel="shortcut icon" href="{{ get_logo_image('favicon') }}" type="image/x-icon" />
        <!-- Responsive -->
        <link href="{{ asset('dashboard_assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
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


            #top_product_wrapper .table>:not(caption)>*>*{
                padding:8px;
            }

            #top_product_wrapper .product_name{
                width:40%;
                padding:8px;
            }
            
            #top_product_wrapper .product_image{
                width:20%;
                padding:8px;
            }

            #top_product_wrapper .product_sale,
            #top_product_wrapper .product_view,
            #top_product_wrapper .product_rating_count {
                width:40%;
                text-align:center;
            }

            .dash_product_link{
                color: #495057;
                transition: .3s;
            }

            .dash_product_link:hover{
                color:#556ee6;
            }

            #top_rated_product .product_rating li i{
                font-size: 10px;
            }

            .product_rating ul{
                padding:0;
            }
            
            .product_rating li{
                list-style: none;
                display: inline-block;
                color:#FFB800;
            }


            .user_text_avatar {
                margin: 0;
                height: 2rem;
                width: 2rem;
                max-width: 100%;
                display: grid;
                align-content: center;
                justify-content: center;
                background-color: #F7F5EB;
                border-radius: 50%;
                color: #80B500;
            }


            #editPermission .modal-content,
            #editRole .modal-content{
                position: relative;
            }

            .edit_user_details_loading .modal_preloader,
            .permission_edit_loading .modal_preloader,
            .role_edit_loading .modal_preloader{
                display: flex;
            }

            .modal_preloader{
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                background-color: #f2f2f2;
                height: 100%;
                width: 100%;
                z-index: 99;
                display: none;
                align-items: center;
                justify-content: center;
            }

            #message_reply_btn.hide{
                display: none;
            }

            #reply_message_form_wrapper{
                display: none;
            }

            #reply_message_form_wrapper.show{
                display: block;
            }

            .reply_message_form_btn{
                min-width:75px;
            }

            #reply_message_form_container{
                background: #fff;
                border:1px solid #e7e7e7;
                padding: 10px;
                border-radius: 5px;
                transition: .1s;
            }

            #reply_message_form_container:hover,
            #reply_message_form_container:focus-within{
                box-shadow: 0px 0px 11px 7px #e7e7e7;
            }

            #reply_message_form textarea{
                border: 0;
            }

            #reply_message_cancel_btn{
                margin-right:5px;
            }

            .page-content {
                min-height: 100vh;
            }

            .order_sort_btn{
                margin-right:8px;
                margin-bottom: 8px;
            }
            .order_sort_btn:last-child{
                margin-right:0px;
            }

            #newsletter_preview_preloader.active{
                display: flex;
            }

            .newsletter_form_error{
                margin-top:5px;
                font-size:14px;
                display: block;
            }

            #newsletter_preview_preloader {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                height: 100%;
                width: 100%;
                background: #021d2e;
                display: none;
                justify-content: center;
                align-items: center;
                border-radius:3px;
            }

            #newsletter_preview_preloader h5{
                color:#fff;
            }


            #newsletter_preview_wrapper{
                position: relative;
            }

            #newsletter_preview {
                border-radius: 3px;
                background: #eff2f7;
            }

            #newsletter_preview iframe{
                min-height: 600px;
                width: 100%;
                display: block;
                padding: 10px;
            }

            #newsletter_code_input,
            #newsletter_details_code{
                background: #021d2e;
                color: #fff;
            }
            
            #newsletter_details_code{
                padding: 20px;
                line-height: 30px;
                height: 600px;
                overflow-y: scroll;
                border-radius: 3px;
            }
            #newsletter_code_input::placeholder{
                color: #fff;
            }

            .newsletter_tab_wrapper {
                display:none;
            }
            .newsletter_tab_wrapper.active{
                display:block;
            }
            
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
            .user_details_loading .edit_user_details_btn{
                display: none;
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

            .edit_contact_email_loading label,
            .coupon_edit_loading label,
            .discount_edit_loading label,
            .category_edit_loading label,
            .size_edit_loading label{
                background-color: #f2f2f2;
                height: 25px;
                width: 100%;
                font-size: 0;
            }

            .edit_contact_email_loading input,
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

            .edit_contact_email_loading .modal-title,
            .coupon_edit_loading .modal-title,
            .discount_edit_loading .modal-title,
            .category_edit_loading .modal-title,
            .size_edit_loading .modal-title{
                background-color: #f2f2f2;
                height: 30px;
                width:calc(100% - 60px);
                font-size: 0;
            }

            .edit_contact_email_loading .close_contact_email_edit_form,
            .edit_contact_email_loading #editContactEmailBtn,
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
            
            #banner_image_wrapper,
            #about_image_wrapper,
            #feature_image_wrapper,
            .logo_image_wrapper {
                max-width: 100%;
                height: 180px;
                width: 230px;
                position: relative;
                border: 1px dashed gray;
            }

            #product_thumbnail_wrapper #product_thumbnail_preview,
            #banner_image_wrapper #banner_image_preview,
            #about_image_wrapper #about_image_preview,
            #feature_image_wrapper #feature_image_preview,
            .logo_image_wrapper .logo_image_preview{
                position: absolute;
                height: 100%;
                width:100%;
                max-width:100%;
                padding:10px;
            }

            .logo_image_wrapper{
                max-width: 100%;
                width: 160px;
                height: 160px;
                background-color: #d3d3d3;
                border: none;
            }

            .logo_wrapper a{
                min-width: 74px;
            }

            .logo_image_wrapper .logo_image_preview{
                object-fit: scale-down;
            }

            #logo_success_alert.hide{
                opacity: 0;
            }

            #feature_image_wrapper #feature_image_preview {
                height: 100px;
                width: 100px;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
            }

            #product_thumbnail_label,
            #banner_image_label,
            #about_image_label,
            #feature_image_label,
            .logo_image_label {
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

            .logo_image_label > *{
                color:#474545 !important;
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
            .product_table_btn_wrapper {
                display: flex;
                justify-content: end;
            }
            .product_delete_all{
                cursor: pointer;
            }

            div#current_photos_wrapper {
                position: relative;
                max-width: 100%;
                min-height: 200px;
                border: 1px dashed gray;
                overflow: hidden;
                margin: 15px 0px 30px;
                display: flex;
                flex-wrap: wrap;
            }

            .photo_container {
                min-width:200px;
                max-width: 200px;
                height: 200px;
                margin: 15px 10px;
                position: relative;
                flex: 1;
            }
            .photo_container img{
                max-width:100%;
                width:100%;
                height: 100%;
            }

            .photo_overlay_wrapper {
                position: absolute;
                height: 70px;
                width:70px;
                display: flex;
                justify-content: center;
                align-items: center;
                z-index:9;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }
            .photo_overlay_wrapper .photo_overlay{
                height: 100%;
                width:100%;
                background-color: #fff;
                opacity: .8;
                border-radius: 5px;
                position: absolute;
            }
            .photo_overlay_wrapper .delete_photo_btn{
                cursor:pointer;
                color:#000;
                z-index:99;
                height: 100%;
                width: 100%;
                text-align: center;
                font-size: 56px;
            }

            .dash_banner_img_container,
            .dash_about_img_container{
                max-width:100%;
                width:570px;
            }


            #layout-wrapper{
                position:relative;
            }


            #lettuce_dashboard_preloader {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                height: 100%;
                width: 100%;
                background: #021d2e;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 3px;
                z-index: 9999;
                opacity: 0.9;
            }

            #lettuce_dashboard_preloader.hide{
                display:none;
                opacity: 0;
            }

            #lettuce_dashboard_preloader h3{
                color:#fff;
                letter-spacing: .15rem;
            }


            span#dash_menu_message_count {
                font-size: 9.75px;
                font-weight: 500;
                color:#fff;
                margin-top:2px;
            }

            span#dash_menu_order_count {
                font-size: 9.75px;
                font-weight: 500;
                color:#fff;
                position: absolute;
                right: 25px;    
                top:15px;
            }
            
                        
            .vertical-collpsed .vertical-menu #sidebar-menu>ul>li>a span#dash_menu_order_count {
                padding-left: 0.6em;
                right: unset;
                left: 40px;
                top: 3px;
                display: inline-block;
            }

            .vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>a span#dash_menu_order_count {
                left: unset;
                right: 20px;
                top:20px;
            }

            
        </style>

    </head>
    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div id="lettuce_dashboard_preloader" class="hide">
                <h3>Loading...</h3>
            </div>

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                           <a href="{{ route('index') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ get_logo_image('mobile') }}" alt="logo" height="25">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ get_logo_image('light') }}" alt="logo" height="30">
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

                            @if (auth()->user()->hasAnyPermission(['view-logo','create-logo','view-about','create-about','view-feature','create-feature','view-banner','create-banner','view-contact','view-faq']) || auth()->user()->isSuperAdmin())
                                <li class="@yield('about_parent_active')">
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-layout"></i>
                                        <span key="t-multi-level">Frontend</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                                        
                                        @canany(['create', 'view-any'], \App\Models\Logo::class)
                                            <li><a href="{{ route('admin.logo.index') }}" key="t-compact-sidebar">Logo</a></li>
                                        @endcanany
                                        
                                        @canany (['view-any','create'], \App\Models\About::class)
                                            <li class="@yield('about_parent_active')">
                                                <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">About</a>
                                                <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                    @can('view-any', \App\Models\About::class)
                                                        <li><a href="{{ route('about.index') }}" key="t-level-2-1" class="@yield('about_active')">Abouts</a></li>
                                                    @endcan
                                                    @can('create', \App\Models\About::class)
                                                        <li><a href="{{ route('about.create') }}" key="t-level-2-2">Add New About</a></li>
                                                    @endcan
                                                </ul>
                                            </li>
                                        @endcanany
                                        @canany(['view-any','create'], \App\Models\Feature::class)
                                            <li class="@yield('feature_parent_active')">
                                                <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Feature</a>
                                                <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                    @can('view-any', \App\Models\Feature::class)
                                                        <li><a href="{{ route('feature.index') }}" key="t-level-2-1" class="@yield('feature_active')">Features</a></li>
                                                    @endcan
                                                    @can('create', \App\Models\Feature::class)
                                                        <li><a href="{{ route('feature.create') }}" key="t-level-2-2">Add New Feature</a></li>
                                                    @endcan
                                                </ul>
                                            </li>
                                        @endcanany
                                        @canany(['view-any','create'], \App\Models\Banner::class)    
                                            <li class="@yield('banner_parent_active')">
                                                <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Banner</a>
                                                <ul class="sub-menu mm-collapse" aria-expanded="true">
                                                    @can('view-any', \App\Models\Banner::class)
                                                        <li><a href="{{ route('banner.index') }}" key="t-level-2-1" class="@yield('banner_active')">Banners</a></li>
                                                    @endcan
                                                    @can('create', \App\Models\Banner::class)
                                                        <li><a href="{{ route('banner.create') }}" key="t-level-2-2">Add New Banner</a></li>
                                                    @endcan
                                                </ul>
                                            </li>
                                        @endcanany
                                        @if (auth()->user()->hasPermissionTo('view-contact') || auth()->user()->isSuperAdmin())
                                            <li>
                                                <a href="javascript: void(0);" class="has-arrow" key="t-level-1-2">Contact</a>
                                                <ul class="sub-menu mm-collapse" aria-expanded="true">

                                                    @can('view-any', \App\Models\ContactEmail::class)
                                                        <li><a href="{{ route('email.index') }}" key="t-level-2-1">Email</a></li>
                                                    @endcan

                                                    @can('view-any', \App\Models\ContactPhone::class)
                                                        <li><a href="{{ route('phone.index') }}" key="t-level-2-1">Phone</a></li>
                                                    @endcan

                                                    @can('view-any', \App\Models\ContactAddress::class)
                                                        <li><a href="{{ route('address.index') }}" key="t-level-2-1">Address</a></li>
                                                    @endcan
                                                </ul>
                                            </li>
                                        @endif
                                        @can('view-any', \App\Models\Faq::class)
                                            <li><a href="{{ route('faq.index') }}" key="t-compact-sidebar">FAQ</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endif

                            @can('view-any', \App\Models\Category::class)
                                <li>
                                    <a href="{{ route('category.index') }}" class="waves-effect">
                                        <i class="bx bx-list-ul"></i>
                                        <span key="t-layouts">Category</span>
                                    </a>
                                </li>
                            @endcan

                            @if (auth()->user()->hasAnyPermission(['view-product','create-product','view-size','create-product-discount','delete-product-discount']) || auth()->user()->isSuperAdmin())                                
                                <li class="@yield('parent_active')">
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bxl-product-hunt"></i>
                                        <span key="t-maps">Product</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        @can('view-any', \App\Models\Product::class)
                                            <li><a href="{{ route('product.index') }}" class="@yield('active')">Products</a></li>
                                        @endcan

                                        @can('create', \App\Models\Product::class)
                                            <li><a href="{{ route('product.create') }}">Add Product</a></li>
                                        @endcan

                                        @canany (['create-product-discount','delete-product-discount'], \App\Models\Product::class)
                                            <li><a href="{{ route('product.discount.create') }}">Product Discount</a></li>
                                        @endcan

                                        @can('view-any', \App\Models\ProductSize::class)
                                            <li><a href="{{ route('size.index') }}">Size</a></li>                                        
                                        @endcanany
                                        @can('view-any', \App\Models\Product::class)                                        
                                            <li><a href="{{ route('product.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['view-coupon','view-discount']) || auth()->user()->isSuperAdmin())
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bxs-discount"></i>
                                        <span key="t-maps">Offer</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        @can('view-any', \App\Models\Coupon::class)
                                            <li><a href="{{ route('coupon.index') }}">Coupon</a></li>
                                        @endcan

                                        @can('view-any', \App\Models\Discount::class)
                                            <li><a href="{{ route('discount.index') }}">Discount</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endif

                            @can('view-any', \App\Models\Order::class)
                                <li>
                                    <a href="{{ route('order.index') }}" class="waves-effect position-relative" id="dash_menu_order_btn">
                                        <i class="mdi mdi-cart-arrow-down"></i>
                                        @if (pending_orders_count() > 0)
                                            <span class="rounded-pill bg-danger float-end" id="dash_menu_order_count">{{ pending_orders_count() }}</span>                                        
                                        @endif
                                        <span key="t-maps">Order</span>
                                    </a>
                                </li>
                            @endcan

                            @if (auth()->user()->hasAnyPermission(['view-country','view-city']) || auth()->user()->isSuperAdmin())
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-map"></i>
                                        <span key="t-maps">Region</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        @can('view-any', \App\Models\Country::class)
                                            <li><a href="{{ route('country.index') }}">Country</a></li>
                                        @endcan
                                        @can('view-any', \App\Models\City::class)
                                            <li><a href="{{ route('city.index') }}">City</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endif

                            @if (auth()->user()->hasAnyPermission(['view-subscriber','view-newsletter','create-newsletter']) || auth()->user()->isSuperAdmin())
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="mdi mdi-email-newsletter"></i>
                                        <span key="t-maps">Newsletter</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        @can('view-any', \App\Models\Subscriber::class)
                                            <li><a href="{{ route('newsletter.subscriber') }}">Subscribers</a></li>
                                        @endcan

                                        @can('view-any', \App\Models\Newsletter::class)
                                            <li><a href="{{ route('newsletter.index') }}">Newsletters</a></li>
                                        @endcan

                                        @can('create', \App\Models\Newsletter::class)
                                            <li><a href="{{ route('newsletter.create') }}">Create Newsletter</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endif
                            
                            
                            @can('view-any', \App\Models\Message::class)
                                <li class="@yield('message_parent_active')">
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="mdi mdi-email"></i>
                                        <span key="t-maps">Message</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        <li id="dash_menu_inbox_btn">
                                            <a href="{{ route('admin.message.index') }}" class="@yield('message_inbox_active')">Inbox
                                                @if (total_unread_message() > 0)
                                                    <span class="rounded-pill bg-danger float-end" id="dash_menu_message_count">{{ total_unread_message() }}</span>
                                                @endif
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.message.trash') }}">Trash</a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan

                            @if (auth()->user()->hasAnyPermission('view-user','create-user','view-role','view-permission') || auth()->user()->isSuperAdmin())
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-user-circle"></i>
                                        <span key="t-layouts">User Management</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        @can('view-any', \App\Models\User::class)                                    
                                            <li><a href="{{ route('user.admin') }}" key="t-light-sidebar">Admin</a></li>
                                            <li><a href="{{ route('user.customer') }}" key="t-compact-sidebar">Customer</a></li>
                                        @endcan

                                        @can('create', \App\Models\User::class)
                                            <li><a href="{{ route('admin.user.register') }}" key="t-compact-sidebar">Add User</a></li>                                        
                                        @endcan

                                        @can('view-any', \App\Models\Role::class)                                        
                                            <li id="dash_menu_inbox_btn"><a href="{{ route('admin.role.index') }}">Role</a></li>
                                        @endcan
                                        
                                        @can('view-any', \App\Models\Permission::class)                                        
                                            <li><a href="{{ route('admin.permission.index') }}">Permission</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endif

                            @if (auth()->user()->hasAnyPermission(['view-mail-settings','update-mail-settings']) || auth()->user()->isSuperAdmin())
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-cog"></i>
                                        <span key="t-layouts">Settings</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        @canany(['view-any', 'create-or-update',], \App\Models\MailSetting::class)
                                            <li><a href="{{ route('admin.settings.mail') }}" key="t-light-sidebar">Mail</a></li>
                                        @endcanany
                                    </ul>
                                </li>
                            @endif

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
                                <span id="copyright_text"><?=  date('Y').' © Lettuce.' ?></span>
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
        <script src="{{ asset('dashboard_assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('dashboard_assets/js/app.js') }}"></script>

        @yield('footer_script')

        <script>


            function roundNumber(number) {
                var results = Number((Math.abs(number) * 100).toPrecision(15));
                return Math.round(results) / 100 * Math.sign(number);
            }


            //check all input

            function checkAllInput(master_input,target_input) {

                $(document).on('click',master_input, function(){
                    $(target_input).not(this).prop('checked',this.checked);
                });

                $(document).on('click',target_input, function(){

                    has_unchecked = false;

                    $(target_input).each(function(key,elem){
                        if(!elem.checked){
                            has_unchecked = true;
                        }
                    });

                    if(has_unchecked){
                        $(master_input).prop('checked',false);
                    }
                    else{
                        $(master_input).prop('checked',true);
                    }

                });
            }



            // sort message

            $(document).on('click', '.message_sort_btn', function(e){

                e.preventDefault();

                $('.message_sort_btn').removeClass('active');
                $(this).addClass('active');

                let url = "{{ route('admin.message.search') }}";
                let message_status = $('#message_status').val();
                let message_sort_by = $(this).data('value');
                let message_query = $('#message_search').val().trim();
                $('#current_page').val(1);

                messageQuery(message_status,message_sort_by,message_query,url);

            });


            // paginate message

            $(document).on('click','#messages_table_wrapper .pagination a', function(e){
                e.preventDefault();

                let url = "{{ route('admin.message.search') }}";
                let message_status = $('#message_status').val();
                let message_sort_by = $('.message_sort_btn.active').data('value');
                let message_query = $('#message_search').val().trim();
                let page = $(this).attr('href').split('page=')[1];

                $('#hidden_page').val(page);
                $('#current_page').val(page);

                messageQuery(message_status,message_sort_by,message_query,url,page);

            });


            // search message

            $(document).on('search','#message_search', function(){
                $('#messages_table_wrapper').load(' #messages_table_wrapper>* ');
            });


            $(document).on('keyup','#message_search', function(){

                let url = "{{ route('admin.message.search') }}";
                let message_status = $('#message_status').val();
                let message_sort_by = $('.message_sort_btn.active').data('value');
                let message_query = $(this).val().trim();

                $('#current_page').val(1);

                messageQuery(message_status,message_sort_by,message_query,url);

            });
            


            //message query 

            function messageQuery(message_status,message_sort_by='',message_query='',url,page=''){

                let formData = {
                    message_status: message_status,
                    message_sort_by: message_sort_by,
                    message_query: message_query,
                    page: page
                };

                $.ajax({
                    type:'POST',
                    url:url,
                    data:formData,
                    success:function(data){
                        $('#messages_table').find('tbody').html(data);
                    },
                    error:function(error){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            }


            // delete message 

            function deleteMessage(url){

                $.ajax({
                    type:'DELETE',
                    url:url,
                    success:function(data){
                        if(data.status == 'success'){

                            $('.modal_delete_message_btn').data('id','');

                            let url = "{{ route('admin.message.search') }}";
                            let message_status = $('#message_status').val();
                            let message_sort_by = $('.message_sort_btn.active').data('value');
                            let message_query = $('#message_search').val().trim();
                            let page = $('#messages_table_wrapper').find('#current_page').val();
                            
                            $('#hidden_page').val(page);

                            messageQuery(message_status,message_sort_by,message_query,url,page);

                            $('.message_alert').text('Deleted Successfully!').fadeIn().delay(1500).fadeOut();
                            
                            setTimeout(() => {
                                $('.message_alert').text('');
                            }, 2000);

                        }
                    },
                    error:function(error){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            }


            function massDeleteMessage(url,ids){
                $.ajax({
                    type:'POST',
                    url:url,
                    data:{ids:ids},
                    success:function(data){

                        if(data.status == 'success'){

                            $('.modal_message_delete_all').data('id','');
                            $('#checkAllMessage').prop('checked',false);

                            let url = "{{ route('admin.message.search') }}";
                            let message_status = $('#message_status').val();
                            let message_sort_by = $('.message_sort_btn.active').data('value');
                            let message_query = $('#message_search').val().trim();
                            let page = $('#messages_table_wrapper').find('#current_page').val();
                            
                            $('#hidden_page').val(page);

                            messageQuery(message_status,message_sort_by,message_query,url,page);

                            $('.message_alert').text('Deleted Successfully!').fadeIn().delay(1500).fadeOut();
                            
                            setTimeout(() => {
                                $('.message_alert').text('');
                            }, 2000);
                            
                        }

                    },
                    error:function(error){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
            }



            //generate banner slug
            
            function generateBannerSlug(callback,category_id,discount_id){

                $.ajax({
                    type:'POST',
                    url:"{{ route('banner.slug.create') }}",
                    data:{category_id:category_id,discount_id:discount_id},
                    success:function(data){
                        callback(data)
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            }



            // remove input photo

            function removeInputPhoto(input,parentElem,remove_btn,overlayParentELem){
                $(input).val('');
                $(parentElem).find('img').remove();
                $(overlayParentELem).removeClass('has_preview');
                $(overlayParentELem).find('.preview_overlay').remove();
                $(remove_btn).remove();
            }


            // add image preview overlay 

            function addPreviewOverlay(parentElem,input_label){
                if($(parentElem).children('.has_preview').length == 0){
                    $(input_label).addClass('has_preview');
                    $(parentElem).find('.has_preview').prepend('<span class="preview_overlay"></span>');
                }
            }



            // reset modal form

            function resetModalForm(modal){

                if(typeof modal === 'string'){
                    $(modal).on('hide.bs.modal', function (){
                        let form = $(this).find('form').attr('id');
                        $('#'+form).load(' #'+form+'>* ');
                    });
                }
                
                if(typeof modal === 'object'){
                    $.each(modal, function(key,elem){
                        $(elem).on('hide.bs.modal', function (){
                            let form = $(this).find('form').attr('id');
                            $('#'+form).load(' #'+form+'>* ');
                        });
                    });
                }
                
            }
            
            
            // document.getElementById('copyright_text').innerHTML = new Date().getFullYear() + " © Lettuce.";

        </script>

    </body>

</html>
