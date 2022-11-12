@extends('layouts.frontend')

@section('content')
    <!-- SLIDER AREA START (slider-3) -->
    <div class="ltn__slider-area ltn__slider-3---  section-bg-1--- mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- CATEGORY-MENU-LIST START -->
                    <div class="ltn__category-menu-wrap">
                        <div class="ltn__category-menu-title">
                            <h2 class="section-bg-1 text-color-white---">categories</h2>
                        </div>
                        <div class="ltn__category-menu-toggle ltn__one-line-active">
                            <ul>
                                @foreach($categories as $parentCategory)
                                <li class="ltn__category-menu-item ltn__category-menu-drop text-capitalize">
                                    <a href="{{ url('/shop',['category'=>$parentCategory->category_slug]) }}">
                                        <img width="25px" style="margin-right:10px" src="{{ asset('uploads/category/'.$parentCategory->category_photo) }}" alt="">
                                        {{ $parentCategory->category_name.' ('.$parentCategory->products_count+$parentCategory->sub_category->sum('products_count').')' }}
                                    </a>
                                    @if($parentCategory->sub_category->count() > 0)
                                        <ul class="ltn__category-submenu">
                                            <li class="ltn__category-submenu-title ltn__category-menu-drop text-capitalize">
                                                <a href="javascript:void(0);">{{ $parentCategory->category_name }}</a>
                                                <ul class="ltn__category-submenu-children">
                                                    @foreach ($parentCategory->sub_category as $subCategory)
                                                        <li>
                                                            <a href="{{ url('/shop',['category'=>$parentCategory->category_slug, 'subCategory'=>$subCategory->category_slug]) }}">
                                                                <img width="25px" style="margin-right:10px" src="{{ asset('uploads/category/'.$subCategory->category_photo) }}" alt="">
                                                                {{ $subCategory->category_name.' ('.$subCategory->products_count.')' }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- END CATEGORY-MENU-LIST -->
                </div>
                <div class="col-lg-9">
                    <div class="ltn__slide-active-2 slick-slide-arrow-1 slick-slide-dots-1">
                        <!-- ltn__slide-item -->
                        <div class="ltn__slide-item ltn__slide-item-10 section-bg-1 bg-image" data-bg="{{ asset('frontend_assets/img/slider/61.jpg') }}">
                            <div class="ltn__slide-item-inner">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-7 align-self-center">
                                            <div class="slide-item-info">
                                                <div class="slide-item-info-inner ltn__slide-animation">
                                                    <h4 class="slide-sub-title ltn__secondary-color animated text-uppercase">Welcome to our shop</h4>
                                                    <h1 class="slide-title  animated">Tasty & Healthy <br>  Organic Food</h1>
                                                    <div class="btn-wrapper  animated">
                                                        <a href="{{ route('shop') }}" class="theme-btn-1 btn btn-effect-1 text-uppercase">Shop now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($hero_banners as $hero_banner)     
                            <!-- ltn__slide-item -->
                            <div class="ltn__slide-item ltn__slide-item-10 section-bg-1 bg-image" data-bg="{{ asset('uploads/banner/'.$hero_banner->banner_image) }}">
                                <div class="ltn__slide-item-inner">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-7 col-md-7 col-sm-7 align-self-center">
                                                <div class="slide-item-info">
                                                    <div class="slide-item-info-inner ltn__slide-animation">
                                                        <h5 class="slide-sub-title ltn__secondary-color animated text-uppercase">{{ $hero_banner->banner_sub_title }}</h5>
                                                        <h1 class="slide-title  animated">{{ $hero_banner->banner_title }}</h1>
                                                        
                                                        <div class="btn-wrapper  animated">
                                                            <a href="{{ $hero_banner->url }}" class="theme-btn-1 btn btn-effect-1 text-uppercase">{{ $hero_banner->banner_button }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SLIDER AREA END -->

    <!-- FEATURE AREA START ( Feature - 3) -->
    <div class="ltn__feature-area mt-35 mt--65---">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__feature-item-box-wrap ltn__feature-item-box-wrap-2 ltn__border section-bg-6">
                        <div class="ltn__feature-item ltn__feature-item-8">
                            <div class="ltn__feature-icon">
                                <img src="{{ asset('frontend_assets/img/icons/svg/8-trolley.svg') }}" alt="#">
                            </div>
                            <div class="ltn__feature-info">
                                <h4>Free shipping</h4>
                                <p>On all orders over $100</p>
                            </div>
                        </div>
                        <div class="ltn__feature-item ltn__feature-item-8">
                            <div class="ltn__feature-icon">
                                <img src="{{ asset('frontend_assets/img/icons/svg/9-money.svg') }}" alt="#">
                            </div>
                            <div class="ltn__feature-info">
                                <h4>7 days return</h4>
                                <p>Moneyback guarantee</p>
                            </div>
                        </div>
                        <div class="ltn__feature-item ltn__feature-item-8">
                            <div class="ltn__feature-icon">
                                <img src="{{ asset('frontend_assets/img/icons/svg/10-credit-card.svg') }}" alt="#">
                            </div>
                            <div class="ltn__feature-info">
                                <h4>Secure checkout</h4>
                                <p>Protected by Stripe</p>
                            </div>
                        </div>
                        <div class="ltn__feature-item ltn__feature-item-8">
                            <div class="ltn__feature-icon">
                                <img src="{{ asset('frontend_assets/img/icons/svg/11-gift-card.svg') }}" alt="#">
                            </div>
                            <div class="ltn__feature-info">
                                <h4>Offer & gift here</h4>
                                <p>On all orders over $300</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FEATURE AREA END -->

    <!-- PRODUCT TAB AREA START (product-item-3) -->
    <div class="ltn__product-tab-area ltn__product-gutter pt-115 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <!-- <h6 class="section-subtitle ltn__secondary-color">// Cars</h6> -->
                        <h1 class="section-title">Our Products</h1>
                        <p>A highly efficient slip-ring scanner for today's diagnostic requirements.</p>
                    </div>
                    <div class="ltn__tab-menu ltn__tab-menu-2 ltn__tab-menu-top-right-- text-uppercase text-center">
                        <div class="nav">
                            @foreach ($parent_categories as $key => $parent_category)
                                <a data-toggle="tab" href="#liton_tab_3_{{ $parent_category->id }}" class="{{ $key == 0 ? 'active show' : '' }}">{{ $parent_category->category_name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-content">
                        @foreach ($parent_categories as $key => $parent_category)
                        @php
                            $products = productsByCategory($parent_category->id)->inRandomOrder()->limit(12)->get();
                        @endphp
                        <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}" id="liton_tab_3_{{ $parent_category->id }}">
                            <div class="ltn__product-tab-content-inner">
                                <div class="row ltn__tab-product-slider-one-active slick-arrow-1 text-center">
                                    <!-- ltn__product-item -->
                                    @forelse ($products as $product)
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="{{ route('product.details',$product->slug) }}"><img src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        @if (product_is_latest($product->id) === true || productHasDiscount($product->id) === true)
                                                            <li class="sale-badge">
                                                                @if (productHasDiscount($product->id) === true)
                                                                    -{{ discountValueType(getProductDiscount($product->id)->id) }}
                                                                @elseif(product_is_latest($product->id) === true)
                                                                    New
                                                                @endif
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="javascript:void(0);" class="quick_view_product" data-id="{{ $product->id }}" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        @if($product->in_stock > 0)
                                                        <li>
                                                            <form action="{{ route('cart.store') }}" method="post" class="cart_form" id="cart_form_{{ $product->id }}">
                                                                @csrf 
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <input type="hidden" name="product_quantity" value="1">
                                                            </form>
                                                            <a href="javascript:void(0);" class="add_to_cart_btn" data-id="{{ $product->id }}">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        <li>
                                                            <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist_form" id="wishlist_form_{{ $product->id }}">
                                                                @csrf 
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <a href="javascript:void(0);" onclick="$('#wishlist_form_{{ $product->id }}').submit();" class="add_to_wishlist_btn">
                                                                    <i class="far fa-heart"></i>
                                                                </a>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        {{ getAvgRating($product->id) }}
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="{{ route('product.details',$product->slug) }}">{{ $product->product_name }}</a></h2>
                                                <div class="product_weight" style="margin:5px 0px">
                                                    <span style="font-size:14px;">{{ productSize($product->id) }}</span>
                                                </div>
                                                <div class="product-price">
                                                    @if(productHasDiscount($product->id) === true)
                                                        <span>${{ discountPrice($product->id) }}</span>
                                                        <del>${{ number_format(($product->price / 100), 2) }}</del>
                                                    @else 
                                                        <span>${{ number_format(($product->price / 100), 2) }}</span>
                                                    @endif
                                                </div>
                                                @if ($product->in_stock <= 0)
                                                    <div class="product_stock_status">
                                                        {{ getStockStatus($product->id) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        <div class="col-lg-12">
                                            <h4 class="text-center">No Product Found!</h4>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT TAB AREA END -->
    
    <!-- CATEGORY AREA START -->
    <div class="ltn__category-area section-bg-1 pt-110 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h1 class="section-title white-color---">Top Catagories</h1>
                        <p class="white-color---">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam, saepe.</p>
                    </div>
                </div>
            </div>
            <div class="row ltn__category-slider-active slick-arrow-1">
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-3 text-center">
                        <div class="ltn__category-item-img">
                            <a href="{{ url('/shop') }}">
                                <img src="{{ asset('frontend_assets/img/icons/icon-img/category-1.png') }}" alt="Image">
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h5><a href="{{ url('shop') }}">Browse all</a></h5>
                            <h6>({{ $total_products }} item)</h6>
                        </div>
                    </div>
                </div>
                @foreach ($top_categories as $top_category)
                @php
                    $url = url('shop');
                    if($top_category->main_category != null){
                        $url =  url('shop',['category'=>$top_category->main_category->category_slug,'subCategory'=>$top_category->category_slug]) ;
                    }
                    else{
                        $url = url('shop',['category'=>$top_category->category_slug]);
                    }
                @endphp
                    <div class="col-12">
                        <div class="ltn__category-item ltn__category-item-3 text-center">
                            <div class="ltn__category-item-img">
                                <a href="{{ $url }}">
                                    <img src="{{ asset('uploads/category/'.$top_category->category_photo) }}" alt="Image">
                                </a>
                            </div>
                            <div class="ltn__category-item-name">
                                <h5 class="text-capitalize"><a href="{{ $url }}">{{ $top_category->category_name }}</a></h5>
                                <h6>({{ $top_category->products_count }} item)</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
                @php
                    $category_product_count = $top_categories->sum('products_count');
                @endphp
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-3 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <img src="{{ asset('frontend_assets/img/icons/icon-img/category-3.png') }}" alt="Image">
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h5><a href="{{ url('/shop') }}">Others</a></h5>
                            <h6>({{ $total_products - $category_product_count }} item)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CATEGORY AREA END -->

    <!-- PRODUCT SLIDER AREA START -->
    <div class="ltn__product-slider-area ltn__product-gutter pt-115 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h1 class="section-title">Special Offers</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__product-slider-item-four-active slick-arrow-1">
                @forelse ($discounted_products as $discounted_product)
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="{{ route('product.details',$discounted_product->slug) }}"><img src="{{ asset('uploads/product/'.$discounted_product->thumbnail) }}" alt="#"></a>
                                @if(productHasDiscount($discounted_product->id) === true)
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badge">-{{ discountValueType(getProductDiscount($discounted_product->id)->id) }}</li>
                                        </ul>
                                    </div>
                                @endif
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);" class="quick_view_product" data-id="{{ $discounted_product->id }}" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        @if($discounted_product->in_stock > 0)
                                        <li>
                                            <form action="{{ route('cart.store') }}" method="post" class="cart_form" id="cart_form_{{ $discounted_product->id }}">
                                                @csrf 
                                                <input type="hidden" name="product_id" value="{{ $discounted_product->id }}">
                                                <input type="hidden" name="product_quantity" value="1">
                                            </form>
                                            <a href="javascript:void(0);" class="add_to_cart_btn" data-id="{{ $discounted_product->id }}">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        @endif
                                        <li>
                                            <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist_form" id="wishlist_form_{{ $discounted_product->id }}">
                                                @csrf 
                                                <input type="hidden" name="product_id" value="{{ $discounted_product->id }}">
                                                <a href="javascript:void(0);" onclick="$('#wishlist_form_{{ $discounted_product->id }}').submit();" class="add_to_wishlist_btn">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    <ul>
                                        {{ getAvgRating($discounted_product->id) }}
                                    </ul>
                                </div>
                                <h2 class="product-title"><a href="{{ route('product.details',$discounted_product->slug) }}">{{ $discounted_product->product_name }}</a></h2>
                                <div class="product_weight" style="margin:5px 0px">
                                    <span style="font-size:14px;">{{ productSize($discounted_product->id) }}</span>
                                </div>
                                <div class="product-price">
                                    @if(productHasDiscount($discounted_product->id) === true)
                                        <span>${{ discountPrice($discounted_product->id) }}</span>
                                        <del>${{ number_format(($discounted_product->price / 100), 2) }}</del>
                                    @else
                                        <span>${{ number_format(($discounted_product->price / 100), 2) }}</span>
                                    @endif
                                </div>
                                @if ($discounted_product->in_stock <= 0)
                                    <div class="product_stock_status">
                                        {{ getStockStatus($discounted_product->id) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--  -->
                @empty
                    <div class="col-lg-12">
                        <h4 class="text-center">No Product Found!</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- PRODUCT SLIDER AREA END -->

    @if ($banners != null)  
    <!-- BANNER AREA START -->
    <div class="ltn__banner-area mt-120">
        <div class="container">
            <div class="row ltn__custom-gutter--- justify-content-center">
                @foreach ($banners as $banner)
                    <div class="col-lg-4 col-md-6">
                        <div class="ltn__banner-item">
                            <div class="ltn__banner-img" style="height:220px">
                                <a href="{{ $banner->url }}">
                                    <img width="100%" height="100%" src="{{ asset('uploads/banner/'.$banner->banner_image) }}" alt="Banner Image">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- BANNER AREA END -->
    @endif

    <!-- SMALL PRODUCT LIST AREA START -->
    <div class="ltn__small-product-list-area pt-80 pb-85">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title-area ltn__section-title-2--- text-center---">
                                <h1 class="section-title-2 border-bottom">Featured Products</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row ltn__small-product-slider-active slick-arrow-1  slick-arrow-1-inner---">
                        @forelse ($featured_products as $featured_product)
                        <!-- small-product-item -->
                        <div class="col-12">
                            <div class="ltn__small-product-item">
                                <div class="small-product-item-img">
                                    <a href="{{ route('product.details',$featured_product->slug) }}"><img src="{{ asset('uploads/product/'.$featured_product->thumbnail) }}" alt="Image"></a>
                                </div>
                                <div class="small-product-item-info">
                                    <div class="product-ratting">
                                        <ul>
                                            {{ getAvgRating($featured_product->id) }}
                                        </ul>
                                    </div>
                                    <h2 class="product-title"><a href="{{ route('product.details',$featured_product->slug) }}">{{ $featured_product->product_name }}</a></h2>
                                    <div class="product_weight" style="margin:5px 0px">
                                        <span style="font-size:14px;">{{ productSize($featured_product->id) }}</span>
                                    </div>
                                    <div class="product-price">
                                        @if(productHasDiscount($featured_product->id) === true)
                                            <span>${{ discountPrice($featured_product->id) }}</span>
                                            <del>${{ number_format(($featured_product->price / 100), 2) }}</del>
                                        @else
                                            <span>${{ number_format(($featured_product->price / 100), 2) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="col-12">
                                <h4 class="text-center">No Product Found!</h4>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title-area ltn__section-title-2--- text-center---">
                                <h1 class="section-title-2 border-bottom">Most View Products</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row ltn__small-product-slider-active slick-arrow-1">
                        @forelse ($most_viewed_products as $most_viewed_product)
                            <!-- small-product-item -->
                            <div class="col-12">
                                <div class="ltn__small-product-item">
                                    <div class="small-product-item-img">
                                        <a href="{{ route('product.details',$most_viewed_product->slug) }}"><img src="{{ asset('uploads/product/'.$most_viewed_product->thumbnail) }}" alt="Image"></a>
                                    </div>
                                    <div class="small-product-item-info">
                                        <div class="product-ratting">
                                            <ul>
                                                {{ getAvgRating($most_viewed_product->id) }}
                                            </ul>
                                        </div>
                                        <h2 class="product-title"><a href="{{ route('product.details',$most_viewed_product->slug) }}">{{ $most_viewed_product->product_name }}</a></h2>
                                        <div class="product_weight" style="margin:5px 0px">
                                            <span style="font-size:14px;">{{ productSize($most_viewed_product->id) }}</span>
                                        </div>
                                        <div class="product-price">
                                            @if(productHasDiscount($most_viewed_product->id) === true)
                                                <span>${{ discountPrice($most_viewed_product->id) }}</span>
                                                <del>${{ number_format(($most_viewed_product->price / 100), 2) }}</del>
                                            @else
                                                <span>${{ number_format(($most_viewed_product->price / 100), 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                        @empty
                            <div class="col-12">
                                <h4 class="text-center">No Product Found!</h4>
                            </div>    
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title-area ltn__section-title-2--- text-center---">
                                <h1 class="section-title-2 border-bottom">Bestseller Products</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row ltn__small-product-slider-active slick-arrow-1">
                        @forelse ($best_seller_products as $best_seller_product)
                        <!-- small-product-item -->
                        <div class="col-12">
                                <div class="ltn__small-product-item">
                                    <div class="small-product-item-img">
                                        <a href="{{ route('product.details',$best_seller_product->slug) }}"><img src="{{ asset('uploads/product/'.$best_seller_product->thumbnail) }}" alt="Image"></a>
                                    </div>
                                    <div class="small-product-item-info">
                                        <div class="product-ratting">
                                            <ul>
                                                {{ getAvgRating($best_seller_product->id) }}
                                            </ul>
                                        </div>
                                        <h2 class="product-title"><a href="{{ route('product.details',$best_seller_product->slug) }}">{{ $best_seller_product->product_name }}</a></h2>
                                        <div class="product_weight" style="margin:5px 0px">
                                            <span style="font-size:14px;">{{ productSize($best_seller_product->id) }}</span>
                                        </div>
                                        <div class="product-price">
                                            @if (producthasDiscount($best_seller_product->id))                                                
                                                <span>${{ discountPrice($best_seller_product->id) }}</span>
                                                <del>${{ number_format(($best_seller_product->price / 100),2) }}</del>
                                            @else
                                                <span>${{ number_format(($best_seller_product->price / 100),2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="col-12">
                                    <h4 class="text-center">No Product Found!</h4>
                                </div> 
                            @endforelse
                        <!--  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SMALL PRODUCT LIST AREA END -->

@endsection


@section('footer_script')

    <script>
        $(document).ready(function(){
            
        });

    </script>

@endsection