@extends('layouts.frontend')

@section('content')
    <!-- SHOP DETAILS AREA START -->
    <div class="ltn__shop-details-area pt-60 pb-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="ltn__shop-details-inner mb-60">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ltn__shop-details-img-gallery">
                                    <div class="ltn__shop-details-large-img">
                                        <div class="single-large-img">
                                            <a href="{{ asset('uploads/product/'.$product->thumbnail) }}" data-rel="lightcase:myCollection">
                                                <img src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="Image">
                                            </a>
                                        </div>
                                        @if ($product->multiple_photos->count() > 0)
                                            @foreach ($product->multiple_photos as $product_photo)
                                                <div class="single-large-img">
                                                    <a href="{{ asset('uploads/product/'.$product_photo->multiple_photo) }}" data-rel="lightcase:myCollection">
                                                        <img src="{{ asset('uploads/product/'.$product_photo->multiple_photo) }}" alt="Image">
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                        
                                    </div>
                                    <div class="ltn__shop-details-small-img slick-arrow-2">
                                        <div class="single-small-img">
                                            <img src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="Image">
                                        </div>
                                        @if ($product->multiple_photos->count() > 0)
                                            @foreach ($product->multiple_photos as $product_photo)
                                                <div class="single-small-img">
                                                    <img src="{{ asset('uploads/product/'.$product_photo->multiple_photo) }}" alt="Image">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-product-info shop-details-info pl-0">
                                    <div class="product-ratting">
                                        <ul>
                                            {{-- <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                            <li><a href="#"><i class="far fa-star"></i></a></li> --}}
                                            {{ getAvgRating($product->id) }}
                                            <li class="review-total"> ( {{ getReviewNumber($product->id) }} Reviews )</li>
                                        </ul>
                                    </div>
                                    <h3>{{ $product->product_name }}</h3>
                                    <div class="product-price">
                                        @if(productHasDiscount($product->id) === true)
                                            <span>${{ discountPrice($product->id) }}</span>
                                            <del>${{ number_format(($product->price / 100), 2) }}</del>
                                        @else
                                            <span>${{ number_format(($product->price / 100), 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="modal-product-meta ltn__product-details-menu-1">
                                        <ul>
                                            <li>
                                                <strong>Categories:</strong> 
                                                <span>
                                                    @foreach($product->categories as $category)
                                                        @if ($category->main_category != null)
                                                            <a href="{{ url('shop',['category'=>$category->main_category->category_slug]) }}" class="text-capitalize">{{ $category->main_category->category_name }}</a>
                                                        @endif
                                                        @if ($category->main_category == null)
                                                            <a href="{{ url('shop',['category'=>$category->category_slug]) }}" class="text-capitalize">{{ $category->category_name}}</a>
                                                        @else
                                                            <a href="{{ url('shop',['category'=>$category->main_category->category_slug,'subCategory'=>$category->category_slug]) }}" class="text-capitalize">{{ $category->category_name}}</a>
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </li>
                                            <li>
                                                <strong>Weight / Piece:</strong> 
                                                <span>{{ productSize($product->id) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ltn__product-details-menu-2">
                                        @if($product->in_stock > 0)
                                            <form action="{{ route('cart.store') }}" method="post" class="cart_form" id="cart_form_{{ $product->id }}">
                                                @csrf 
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <ul>
                                                    <li>
                                                        <div class="cart-plus-minus" data-id="{{ getProductStock($product->id) }}">
                                                            <input type="number" value="1" name="product_quantity" class="cart-plus-minus-box">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="theme-btn-1 btn btn-effect-1 add_to_cart_btn" data-id="{{ $product->id }}">
                                                            <i class="fas fa-shopping-cart"></i>
                                                            <span>ADD TO CART</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </form>
                                        @endif
                                    </div>
                                    @if($product->in_stock <= 20)
                                        <div class="product_stock_status">
                                            {{ getStockStatus($product->id) }}
                                        </div>
                                    @endif
                                    <div class="ltn__product-details-menu-3">
                                        <ul>
                                            <li>
                                                <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist_form" id="wishlist_form_{{ $product->id }}">
                                                    @csrf 
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <a href="javascript:void(0);" onclick="$('#wishlist_form_{{ $product->id }}').submit();" class="add_to_wishlist_btn" >
                                                        <i class="far fa-heart"></i>
                                                        <span>Add to Wishlist</span>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="ltn__social-media">
                                        <ul>
                                            <li>Share:</li>
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('product.details',$product->slug) }}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="https://twitter.com/intent/tweet?url={{ route('product.details',$product->slug) }}" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('product.details',$product->slug) }}" target="_blank" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>                                          
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab Start -->
                    <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                        <div class="ltn__shop-details-tab-menu">
                            <div class="nav">
                                <a class="{{ session()->has('success') || $errors->count() > 0 ? '' : 'active show' }}" data-toggle="tab" href="#liton_tab_details_1_1">Description</a>
                                <a data-toggle="tab" href="#liton_tab_details_1_2" class="{{ session()->has('success') || $errors->count() > 0 ? 'active show' : '' }}">Reviews</a>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade {{ session()->has('success') || $errors->count() > 0 ? '' : 'active show' }}" id="liton_tab_details_1_1">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <p>{{ ($product->product_desc) ?? 'Not Available!' }}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade {{ session()->has('success') || $errors->count() > 0 ? 'active show' : '' }}" id="liton_tab_details_1_2">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <h4 class="title-2">Customer Reviews</h4>
                                    <div class="product-ratting">
                                        <ul>
                                            {{ getAvgRating($product->id) }}
                                            <li class="review-total"> ( {{ getReviewNumber($product->id) }} Reviews )</li>
                                        </ul>
                                        @if($product->reviews->count() <= 0)
                                            <h4 class="text-warning mt-4">No reviews yet!</h4>
                                        @endif
                                    </div>
                                    <hr>
                                    <!-- comment-area -->
                                    <div class="ltn__comment-area mb-30">
                                        <div class="ltn__comment-inner">
                                            <ul>
                                                @foreach ($product->reviews as $review)
                                                    <li>
                                                        <div class="ltn__comment-item clearfix">
                                                            <div class="ltn__commenter-img">
                                                                @if(getUser($review->user_id)->userDetails->avatar !== null)
                                                                <img src="{{ asset('uploads/users/'.getUser($review->user_id)->userDetails->avatar) }}" alt="Image">
                                                                @else
                                                                <h2 class="text-uppercase user_text_avatar">{{ substr($review->user_name,0,1) }}</h2>
                                                                @endif
                                                            </div>
                                                            <div class="ltn__commenter-comment">
                                                                <h6>{{ $review->user_name }}</h6>
                                                                <div class="product-ratting">
                                                                    <ul>
                                                                        @for ($i=1;$i<=5;$i++)
                                                                           @if($review->review_rating >= $i)
                                                                            <li style="margin:8px 0.5px 0px;"><i class="fas fa-star"></i></li>
                                                                           @else
                                                                            <li style="margin:8px 0.5px 0px;"><i class="far fa-star"></i></li>
                                                                           @endif
                                                                        @endfor
                                                                    </ul>
                                                                </div>
                                                                <p>{{ $review->review_feedback }}</p>
                                                                <span class="ltn__comment-reply-btn">{{ $review->created_at->format('F d, Y') }}</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- comment-reply -->
                                    <div class="ltn__comment-reply-area ltn__form-box mb-30">
                                        @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                                        <h4 class="title-2">Add a Review</h4>
                                        @auth
                                            @if(!checkPurchase($product->id))
                                                <p class="text-danger">You must purchase this product to add a review!</p>
                                            @elseif (checkReview($product->id))
                                                <p style="color:#80B500;">You already have a review for this product!</p>
                                            @else
                                                <form action="{{ route('review.store') }}" method="POST">
                                                    @csrf
                                                    <div class="mb-30">
                                                        <div class="add-a-review">
                                                            <h6>Your Ratings:</h6>
                                                            <div class="product-ratting">
                                                                <ul>
                                                                    <li style="margin:0px 1px; font-size:16px;">
                                                                        <label class="m-0">
                                                                            <i class="far fa-star rating_star" id="star_1"></i>
                                                                            <input type="radio" name="review_rating" class="review_rating_input d-none" value="1" {{ old('review_rating') == 1 ? 'checked' : '' }}>
                                                                        </label>
                                                                    </li>
                                                                    <li style="margin:0px 1px; font-size:16px;">
                                                                        <label class="m-0">
                                                                            <i class="far fa-star rating_star" id="star_2"></i>
                                                                            <input type="radio" name="review_rating" class="review_rating_input d-none" value="2" {{ old('review_rating') == 2 ? 'checked' : '' }} >
                                                                        </label>
                                                                    </li>
                                                                    <li style="margin:0px 1px; font-size:16px;">
                                                                        <label class="m-0">
                                                                            <i class="far fa-star rating_star" id="star_3"></i>
                                                                            <input type="radio" name="review_rating" class="review_rating_input d-none" value="3" {{ old('review_rating') == 3 ? 'checked' : '' }} >
                                                                        </label>
                                                                    </li>
                                                                    <li style="margin:0px 1px; font-size:16px;">
                                                                        <label class="m-0">
                                                                            <i class="far fa-star rating_star" id="star_4"></i>
                                                                            <input type="radio" name="review_rating" class="review_rating_input d-none" value="4" {{ old('review_rating') == 4 ? 'checked' : '' }} >
                                                                        </label>
                                                                    </li>
                                                                    <li style="margin:0px 1px; font-size:16px;">
                                                                        <label class="m-0">
                                                                            <i class="far fa-star rating_star" id="star_5"></i>
                                                                            <input type="radio" name="review_rating" class="review_rating_input d-none" value="5" {{ old('review_rating') == 5 ? 'checked' : '' }} >
                                                                        </label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @error('review_rating')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                    <div class="input-item input-item-textarea ltn__custom-icon">
                                                        <textarea placeholder="Type your comments...." name="review_feedback" style="margin-bottom:0">{{ old('review_feedback') }}</textarea>
                                                        @error('review_feedback')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="input-item input-item-name ltn__custom-icon">
                                                        <input type="text" name="user_name" value="{{ old('user_name',auth()->user()->name) }}">
                                                        @error('user_name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="input-item input-item-email ltn__custom-icon">
                                                        <input type="email" name="user_email" value="{{ old('user_email',auth()->user()->email) }}">
                                                        @error('user_email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="btn-wrapper">
                                                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Submit</button>
                                                    </div>
                                                </form>
                                            @endif
                                        @endauth

                                        @guest
                                            <p class="text-danger">You must <a href="{{ url('login') }}" style="color:#80B500;">login</a>  to add a review!</p>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab End -->
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
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
                                                <h6><a href="{{ route('product.details',$top_rated_product->slug) }}">{{ $top_rated_product->product_name.' ('.productSize($top_rated_product->id).')'  }}</a></h6>
                                                <div class="product-price">
                                                    @if(productHasDiscount($top_rated_product->id))
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

                        @if ($banner != null)
                            <!-- Banner Widget -->
                            <div class="widget ltn__banner-widget">
                                <a href="{{ $banner->url }}"><img src="{{ asset('uploads/banner/'.$banner->banner_image) }}" alt="#"></a>
                            </div>
                        @endif
                        
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOP DETAILS AREA END -->

    <!-- PRODUCT SLIDER AREA START -->
    <div class="ltn__product-slider-area ltn__product-gutter pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2">
                        <h1 class="section-title">Related Products<span>.</span></h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__related-product-slider-one-active slick-arrow-1">
                @forelse (relatedProduct($product->id) as $related_product)
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="{{ route('product.details',$related_product->slug) }}"><img src="{{ asset('uploads/product/'.$related_product->thumbnail) }}" alt="#"></a>
                                <div class="product-badge">
                                    <ul>
                                        @if (productHasDiscount($related_product->id) === true)
                                            <li class="sale-badge">-{{ discountValueType(getProductDiscount($related_product->id)->id) }}</li>
                                        @elseif (product_is_latest($related_product->id) === true)
                                            <li class="sale-badge">New</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);" class="quick_view_product" data-id="{{ $related_product->id }}" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        @if($related_product->in_stock > 0)
                                        <li>
                                            <form action="{{ route('cart.store') }}" method="post" class="cart_form" id="cart_form_{{ $related_product->id }}">
                                                @csrf 
                                                <input type="hidden" name="product_id" value="{{ $related_product->id }}">
                                                <input type="hidden" name="product_quantity" value="1">
                                            </form>
                                            <a href="javascript:void(0);" class="add_to_cart_btn" data-id="{{ $related_product->id }}">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        @endif
                                        <li>
                                            <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist_form" id="wishlist_form_{{ $related_product->id }}">
                                                @csrf 
                                                <input type="hidden" name="product_id" value="{{ $related_product->id }}">
                                                <a href="javascript:void(0);" onclick="$('#wishlist_form_{{ $related_product->id }}').submit();" class="add_to_wishlist_btn">
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
                                        {{ getAvgRating($related_product->id) }}
                                    </ul>
                                </div>
                                <h2 class="product-title"><a href="{{ route('product.details',$related_product->slug) }}">{{ $related_product->product_name }}</a></h2>
                                <div class="product_weight" style="margin:5px 0px">
                                    <span style="font-size:14px;">{{ productSize($related_product->id) }}</span>
                                </div>
                                <div class="product-price">
                                    @if (productHasDiscount($related_product->id) === true)
                                        <span>${{ discountPrice($related_product->id) }}</span>
                                        <del>${{ number_format(($related_product->price / 100), 2) }}</del>
                                    @else
                                        <span>${{ number_format(($related_product->price / 100), 2) }}</span>
                                    @endif
                                </div>
                                @if ($related_product->in_stock <= 0)
                                    <div class="product_stock_status">
                                        {{ getStockStatus($related_product->id) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--  -->
                @empty
                    <div class="col-12">
                        <h4>No Product Found!</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- PRODUCT SLIDER AREA END -->

@endsection



@section('footer_script')

    <script>

            $(document).ready(function() {

                let checked_value = $("input[name='review_rating']:checked").val();

                if(checked_value > 0){
                    select_rating_star(checked_value);
                }


                $('.review_rating_input').change(function(){

                    let value = $("input[name='review_rating']:checked").val();

                    select_rating_star(value);
                    
                });

                function select_rating_star(value){
                    $(".rating_star").addClass('far').removeClass('fas');

                    for(let i = 1; i <= 5; i++){

                        $("#star_"+i).addClass('fas').removeClass('far');

                        if(i == value){
                            break;
                        }

                    }
                }

            });

    </script>

@endsection


