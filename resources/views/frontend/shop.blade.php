@extends('layouts.frontend')

@section('content')
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
                                        <a class="active show" data-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                        <a data-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                               <div class="short-by text-center">
                                    <select class="nice-select">
                                        <option>Default sorting</option>
                                        <option>Sort by popularity</option>
                                        <option>Sort by new arrivals</option>
                                        <option>Sort by price: low to high</option>
                                        <option>Sort by price: high to low</option>
                                    </select>
                                </div> 
                            </li>
                            <li>
                               <div class="showing-product-number text-right">
                                    <span>Showing 9 of 20 results</span>
                                </div> 
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_product_grid">
                            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                <div class="row">
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Red Hot Tomato</a></h2>
                                                <div class="product-price">
                                                    <span>$149.00</span>
                                                    <del>$162.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/2.png" alt="#"></a>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Vegetables Juices</a></h2>
                                                <div class="product-price">
                                                    <span>$62.00</span>
                                                    <del>$85.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/3.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">Hot</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Orange Fresh Juice</a></h2>
                                                <div class="product-price">
                                                    <span>$75.00</span>
                                                    <del>$92.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/4.png" alt="#"></a>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Poltry Farm Meat</a></h2>
                                                <div class="product-price">
                                                    <span>$78.00</span>
                                                    <del>$85.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/5.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">Sell -25%</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Fresh Butter Cake</a></h2>
                                                <div class="product-price">
                                                    <span>$150.00</span>
                                                    <del>$180.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/6.png" alt="#"></a>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Orange Sliced Mix</a></h2>
                                                <div class="product-price">
                                                    <span>$152.00</span>
                                                    <del>$158.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/7.png" alt="#"></a>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Red Hot Tomato</a></h2>
                                                <div class="product-price">
                                                    <span>$149.00</span>
                                                    <del>$162.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/8.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Vegetables Juices</a></h2>
                                                <div class="product-price">
                                                    <span>$62.00</span>
                                                    <del>$85.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/9.png" alt="#"></a>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Orange Fresh Juice</a></h2>
                                                <div class="product-price">
                                                    <span>$75.00</span>
                                                    <del>$92.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/10.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">Sell</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Poltry Farm Meat</a></h2>
                                                <div class="product-price">
                                                    <span>$78.00</span>
                                                    <del>$85.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/11.png" alt="#"></a>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Fresh Butter Cake</a></h2>
                                                <div class="product-price">
                                                    <span>$150.00</span>
                                                    <del>$180.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/12.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Orange Sliced Mix</a></h2>
                                                <div class="product-price">
                                                    <span>$165.00</span>
                                                    <del>$1720.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Red Hot Tomato</a></h2>
                                                <div class="product-price">
                                                    <span>$149.00</span>
                                                    <del>$162.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/2.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Vegetables Juices</a></h2>
                                                <div class="product-price">
                                                    <span>$62.00</span>
                                                    <del>$85.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/3.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Orange Fresh Juice</a></h2>
                                                <div class="product-price">
                                                    <span>$75.00</span>
                                                    <del>$92.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/4.png" alt="#"></a>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Poltry Farm Meat</a></h2>
                                                <div class="product-price">
                                                    <span>$78.00</span>
                                                    <del>$85.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/5.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Fresh Butter Cake</a></h2>
                                                <div class="product-price">
                                                    <span>$150.00</span>
                                                    <del>$180.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/7.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Orange Sliced Mix</a></h2>
                                                <div class="product-price">
                                                    <span>$165.00</span>
                                                    <del>$1720.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/11.png" alt="#"></a>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Fresh Butter Cake</a></h2>
                                                <div class="product-price">
                                                    <span>$150.00</span>
                                                    <del>$180.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/12.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Orange Sliced Mix</a></h2>
                                                <div class="product-price">
                                                    <span>$165.00</span>
                                                    <del>$1720.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h2 class="product-title"><a href="product-details.html">Red Hot Tomato</a></h2>
                                                <div class="product-price">
                                                    <span>$149.00</span>
                                                    <del>$162.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="liton_product_list">
                            <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                <div class="row">
                                    <!-- ltn__product-item -->
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-3">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h2 class="product-title"><a href="product-details.html">Vegetables Juices</a></h2>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <span>$165.00</span>
                                                    <del>$1720.00</del>
                                                </div>
                                                <div class="product-brief">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae asperiores sit odit nesciunt,  aliquid, deleniti non et ut dolorem!</p>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-3">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/2.png" alt="#"></a>
                                            </div>
                                            <div class="product-info">
                                                <h2 class="product-title"><a href="product-details.html">Poltry Farm Meat</a></h2>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <span>$165.00</span>
                                                    <del>$1720.00</del>
                                                </div>
                                                <div class="product-brief">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae asperiores sit odit nesciunt,  aliquid, deleniti non et ut dolorem!</p>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-3">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/3.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h2 class="product-title"><a href="product-details.html">Vegetables Juices</a></h2>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <span>$165.00</span>
                                                    <del>$1720.00</del>
                                                </div>
                                                <div class="product-brief">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae asperiores sit odit nesciunt,  aliquid, deleniti non et ut dolorem!</p>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-3">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/4.png" alt="#"></a>
                                            </div>
                                            <div class="product-info">
                                                <h2 class="product-title"><a href="product-details.html">Red Hot Tomato</a></h2>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <span>$165.00</span>
                                                    <del>$1720.00</del>
                                                </div>
                                                <div class="product-brief">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae asperiores sit odit nesciunt,  aliquid, deleniti non et ut dolorem!</p>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-3">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/5.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">Hot</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h2 class="product-title"><a href="product-details.html">Orange Sliced Mix</a></h2>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <span>$165.00</span>
                                                    <del>$1720.00</del>
                                                </div>
                                                <div class="product-brief">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae asperiores sit odit nesciunt,  aliquid, deleniti non et ut dolorem!</p>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-3">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/6.png" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h2 class="product-title"><a href="product-details.html">Orange Sliced Mix</a></h2>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <span>$165.00</span>
                                                    <del>$1720.00</del>
                                                </div>
                                                <div class="product-brief">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae asperiores sit odit nesciunt,  aliquid, deleniti non et ut dolorem!</p>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ltn__product-item -->
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-3">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="img/product/4.png" alt="#"></a>
                                            </div>
                                            <div class="product-info">
                                                <h2 class="product-title"><a href="product-details.html">Red Hot Tomato</a></h2>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <span>$165.00</span>
                                                    <del>$1720.00</del>
                                                </div>
                                                <div class="product-brief">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae asperiores sit odit nesciunt,  aliquid, deleniti non et ut dolorem!</p>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-toggle="modal" data-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="Wishlist" data-toggle="modal" data-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ltn__pagination-area text-center">
                        <div class="ltn__pagination">
                            <ul>
                                <li><a href="#"><i class="fas fa-angle-double-left"></i></a></li>
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">10</a></li>
                                <li><a href="#"><i class="fas fa-angle-double-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  mb-120">
                    <aside class="sidebar ltn__shop-sidebar">
                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
                            <ul>
                                <li><a href="#">Body <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Interior <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Lights <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Parts <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Tires <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Uncategorized <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Wheel <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            </ul>
                        </div>
                        
                        <!-- Search Widget -->
                        <div class="widget ltn__search-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Search Products</h4>
                            <form action="#">
                                <input type="text" name="search" placeholder="Search your keyword...">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>

                        <!-- Top Rated Product Widget -->
                        <div class="widget ltn__top-rated-product-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
                            <ul>
                                <li>
                                    <div class="top-rated-product-item clearfix">
                                        <div class="top-rated-product-img">
                                            <a href="product-details.html"><img src="{{ asset('frontend_assets/img/product/1.png') }}" alt="#"></a>
                                        </div>
                                        <div class="top-rated-product-info">
                                            <div class="product-ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h6><a href="product-details.html">Mixel Solid Seat Cover</a></h6>
                                            <div class="product-price">
                                                <span>$49.00</span>
                                                <del>$65.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="top-rated-product-item clearfix">
                                        <div class="top-rated-product-img">
                                            <a href="product-details.html"><img src="{{ asset('frontend_assets/img/product/2.png') }}" alt="#"></a>
                                        </div>
                                        <div class="top-rated-product-info">
                                            <div class="product-ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h6><a href="product-details.html">Vegetables Juices</a></h6>
                                            <div class="product-price">
                                                <span>$49.00</span>
                                                <del>$65.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="top-rated-product-item clearfix">
                                        <div class="top-rated-product-img">
                                            <a href="product-details.html"><img src="{{ asset('frontend_assets/img/product/3.png') }}" alt="#"></a>
                                        </div>
                                        <div class="top-rated-product-info">
                                            <div class="product-ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h6><a href="product-details.html">Coil Spring Conversion</a></h6>
                                            <div class="product-price">
                                                <span>$49.00</span>
                                                <del>$65.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        
                        
                        <!-- Banner Widget -->
                        <div class="widget ltn__banner-widget">
                            <a href="shop.html"><img src="{{ asset('frontend_assets/img/banner/banner-1.jpg') }}" alt="#"></a>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS AREA END -->

@endsection

