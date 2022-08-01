@extends('layouts.frontend')

@section('content')
    {{-- @php
        request()->merge(['view_type' => 'grid']);
    @endphp --}}
    <!-- PRODUCT DETAILS AREA START -->
    <div class="ltn__product-area ltn__product-gutter pt-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-lg-2 mb-120">
                    <div class="ltn__shop-options">
                        <ul>
                            <li>
                                <div class="ltn__grid-list-tab-menu ">
                                    <div class="nav">
                                        <a class="{{ request()->view_type != 'list' ? 'active show' : '' }}" id="grid_view_btn" data-toggle="tab" href="javascript:void(0);"><i class="fas fa-th-large"></i></a>
                                        <a class="{{ request()->view_type == 'list' ? 'active show' : '' }}" id="list_view_btn" data-toggle="tab" href="javascript:void(0);"><i class="fas fa-list"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                               <div class="short-by text-center">
                                    <form id="sort_form" action="{{ url('shop',['category'=>request()->category->category_slug ?? '','subCategory'=>request()->subCategory->category_slug ?? '']) }}" method="GET">
                                        <input type="hidden" name="search" value="{{ request()->search }}">
                                        <select class="nice-select" name="sort_by" onchange="$('#sort_form').submit()">
                                            <option {{ request()->sort_by == 'default' ? 'selected' : ''}} value="default">Default sorting</option>
                                            <option {{ request()->sort_by == 'popular' ? 'selected' : ''}} value="popular">Sort by popularity</option>
                                            <option {{ request()->sort_by == 'latest' ? 'selected' : ''}} value="latest">Sort by new arrivals</option>
                                            <option {{ request()->sort_by == 'low_to_high' ? 'selected' : ''}} value="low_to_high">Sort by price: low to high</option>
                                            <option {{ request()->sort_by == 'high_to_low' ? 'selected' : ''}} value="high_to_low">Sort by price: high to low</option>
                                        </select>
                                        <input type="hidden" id="view_type_val" name="view_type" value="{{ request()->view_type ?? 'grid' }}">
                                        <input type="hidden" name="page" value="{{ $products->currentPage() }}">
                                    </form>
                                </div> 
                            </li>
                            <li>
                               <div class="showing-product-number text-right">
                                    <span>Showing {{ $products->firstItem()  ?? '0' }} to {{ $products->lastItem() ?? '0' }} of {{ $products->total() }} results</span>
                                </div> 
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade {{ request()->view_type != 'list' ? 'active show' : '' }}" id="liton_product_grid">
                            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                <div class="row">
                                    @forelse ($products as $product)
                                        <!-- ltn__product-item -->
                                        <div class="col-xl-4 col-sm-6 col-6">
                                            <div class="ltn__product-item ltn__product-item-3 text-center">
                                                <div class="product-img">
                                                    <a href="{{ route('product.details',$product->slug) }}"><img src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="#"></a>
                                                    <div class="product-badge">
                                                        <ul>
                                                            @if (productHasDiscount($product->id) === true)
                                                                <li class="sale-badge">-{{ discountValueType(getProductdiscount($product->id)->id) }}</li>
                                                            @elseif (product_is_latest($product->id))
                                                                <li class="sale-badge">New</li>
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
                                                                </form>
                                                                <a href="javascript:void(0);" onclick="$('#wishlist_form_{{ $product->id }}').submit();" class="add_to_wishlist_btn">
                                                                    <i class="far fa-heart"></i>
                                                                </a>
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
                                                        @if (productHasDiscount($product->id) === true)
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
                                        <!--  -->
                                    @empty
                                        <div class="col-12"><h4 class="text-center">No Product Found!</h4></div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ request()->view_type == 'list' ? 'active show' : '' }}" id="liton_product_list">
                            <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                <div class="row">
                                    @forelse ($products as $product)
                                    <!-- ltn__product-item -->
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-3">
                                            <div class="product-img">
                                                <a href="{{ route('product.details',$product->slug) }}" style="display:block"><img src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        @if (productHasDiscount($product->id) === true)
                                                            <li class="sale-badge">-{{ discountValueType(getProductDiscount($product->id)->id) }}</li>
                                                        @elseif(product_is_latest($product->id) === true)
                                                            <li class="sale-badge">New</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h2 class="product-title"><a href="{{ route('product.details',$product->slug) }}">{{ $product->product_name }}</a></h2>
                                                <div class="product-ratting">
                                                    <ul>
                                                        {{ getAvgRating($product->id) }}
                                                    </ul>
                                                </div>
                                                <div class="product_weight" style="margin:5px 0px">
                                                    <span style="font-size:14px;">{{ productSize($product->id) }}</span>
                                                </div>
                                                <div class="product-price">
                                                    @if(productHasDiscount($product->id) === true)
                                                        <span>${{ discountPrice($product->id) }}</span>
                                                        <del>${{ number_format(($product->price / 100),2) }}</del>
                                                    @else
                                                        <span>${{ number_format(($product->price / 100),2) }}</span>
                                                    @endif
                                                </div>
                                                <div class="product-brief">
                                                    <p>{{ $product->product_desc }}</p>
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
                                                @if ($product->in_stock <= 0)
                                                    <div class="product_stock_status">
                                                        {{ getStockStatus($product->id) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    @empty
                                        <div class="col-12"><h4 class="text-center">No Product Found!</h4></div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ $products->appends(request()->input())->links('vendor.pagination.custom') }}
                </div>
                <div class="col-lg-4  mb-120">
                    <aside class="sidebar ltn__shop-sidebar">
                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
                            <ul id="parentCategories">
                                <li class="{{ request()->category == null && request()->subCategory == null ? 'active' : '' }}"><a href="{{ url('shop') }}" class="text-capitalize">View All</a></li> 
                                @foreach ($categories as $category)
                                    <li class="{{ request()->category != null && request()->category->category_slug == $category->category_slug ? 'active' : '' }}">
                                        <a href="{{ url('shop',['category'=>$category->category_slug]) }}" class="text-capitalize">{{ $category->category_name }}
                                            @if($category->sub_category->count() > 0) 
                                                <span><i class="fas{{ request()->category != null && request()->category->category_slug == $category->category_slug ? ' fa-long-arrow-alt-down' : ' fa-long-arrow-alt-right' }}"></i></span>
                                            @endif
                                        </a>
                                        @if($category->sub_category->count() > 0)
                                            <ul id="subCategories" class="{{ request()->category != null && request()->category->category_slug == $category->category_slug ? 'active' : 'hide' }}">
                                                @foreach ($category->sub_category as $childCategory)
                                                    <li class="{{ request()->subCategory != null && request()->subCategory->category_slug == $childCategory->category_slug ? 'active' : '' }}"><a href="{{ url('shop',['category'=>$category->category_slug,'subCategory'=>$childCategory->category_slug]) }}" class="text-capitalize">{{ $childCategory->category_name }}</a></li> 
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>  
                                    
                                @endforeach
                            </ul>
                        </div>
                        
                        <!-- Search Widget -->
                        <div class="widget ltn__search-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Search Products</h4>
                            <form action="{{ url('shop',['category'=>request()->category->category_slug ?? '','subCategory'=>request()->subCategory->category_slug ?? '']) }}" method="GET">
                                <input type="text" name="search" placeholder="Search Product" value="{{ request()->search }}">
                                <input type="hidden" name="sort_by" value="{{ request()->sort_by }}">
                                <input type="hidden" id="view_type_val" name="view_type" value="{{ request()->view_type ?? 'grid' }}">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>

                        <!-- Top Rated Product Widget -->
                        <div class="widget ltn__top-rated-product-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
                            <ul>
                                @forelse ($top_rated_products as $top_rated_product)
                                    <li>
                                        <div class="top-rated-product-item clearfix">
                                            <div class="top-rated-product-img">
                                                <a href="{{ route('product.details',$top_rated_product->slug) }}"><img src="{{ asset('uploads/product/'.$top_rated_product->thumbnail) }}" alt="#"></a>
                                            </div>
                                            <div class="top-rated-product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        {{ getAvgRating($top_rated_product->id) }}
                                                    </ul>
                                                </div>
                                                <h6><a href="{{ route('product.details',$top_rated_product->slug) }}">{{ $top_rated_product->product_name.' ('.productSize($top_rated_product->id).')' }}</a></h6>
                                                <div class="product-price">
                                                    @if (productHasDiscount($top_rated_product->id))
                                                        <span>${{ discountPrice($top_rated_product->id) }}</span>
                                                        <del>${{ number_format(($top_rated_product->price / 100),2) }}</del>
                                                    @else
                                                        <span>${{ number_format(($top_rated_product->price / 100),2) }}</span>                                                         
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li>
                                        <h6>No Product Found!</h6>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        
                        <!-- Banner Widget -->
                        <div class="widget ltn__banner-widget">
                            <a href="{{ url('/shop') }}"><img src="{{ asset('uploads/banner/'.$banner->banner_image) }}" alt="#"></a>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS AREA END -->


@endsection


@section('footer_script')

    <script>
        $(document).ready(function(){

            let param_value = $('#view_type_val').val();

            $('#list_view_btn').click(function(event){
                event.preventDefault();
                param_value = 'list';
                $('#view_type_val').val(param_value)
                changeUrlParam(param_value)
                window.location.reload();
            });

            $('#grid_view_btn').click(function(event){
                event.preventDefault();
                param_value = 'grid';
                $('#view_type_val').val(param_value)
                changeUrlParam(param_value)
                window.location.reload();
            });

            function changeUrlParam(param_value){
                const url = new URL(window.location);
                url.searchParams.set('view_type',param_value);
                window.history.pushState({}, '', url);
            }

        });


    </script>

@endsection

