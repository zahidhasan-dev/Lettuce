
@php
    $product = $product ?? null;
@endphp

@if($product != null)
    <div class="ltn__quick-view-modal-inner">
        <div class="modal-product-item">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="modal-product-img">
                        <img src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="#">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="modal-product-info">
                        <div class="product-ratting">
                            <ul>
                                {{ getAvgRating($product->id) }}
                                <li class="review-total"> <span> ( {{ getReviewNumber($product->id) }} Reviews )</span></li>
                            </ul>
                        </div>
                        <h3>{{ $product->product_name }}</h3>
                        <div class="product-price">
                            @if (productHasDiscount($product->id) === true)
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
                            <form action="{{ route('cart.store') }}" method="post" class="quick_view_cart_form" id="quick_view_cart_form">
                                @csrf 
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <ul>
                                    <li>
                                        <div class="cart-plus-minus" data-id="{{ getProductStock($product->id) }}">
                                            <input type="number" value="1" name="product_quantity" class="cart-plus-minus-box">
                                        </div>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="theme-btn-1 btn btn-effect-1 quick_view_add_to_cart_btn" data-id="{{ $product->id }}">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span>ADD TO CART</span>
                                        </a>
                                    </li>
                                </ul>
                            </form>
                        </div>
                        <div class="ltn__product-details-menu-3">
                            <ul>
                                <li>
                                    <form action="{{ route('wishlist.store') }}" method="POST" class="quick_view_wishlist_form" id="quick_view_wishlist_form">
                                        @csrf 
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <a href="javascript:void(0);" onclick="$('#quick_view_wishlist_form').submit();" class="add_to_wishlist_btn" >
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
    </div>
@endif