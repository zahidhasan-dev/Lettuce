@extends('layouts.frontend')


@section('content')
    <!-- WISHLIST AREA START -->
    <div class="liton__wishlist-area mb-105">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                <!-- <thead>
                                    <th class="cart-product-remove">X</th>
                                    <th class="cart-product-image">Image</th>
                                    <th class="cart-product-info">Title</th>
                                    <th class="cart-product-price">Price</th>
                                    <th class="cart-product-quantity">Quantity</th>
                                    <th class="cart-product-subtotal">Subtotal</th>
                                </thead> -->
                                <tbody>
                                    <tr>
                                        <td class="cart-product-remove">x</td>
                                        <td class="cart-product-image">
                                            <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                                        </td>
                                        <td class="cart-product-info">
                                            <h4><a href="product-details.html">Vegetables Juices</a></h4>
                                        </td>
                                        <td class="cart-product-price">$85.00</td>
                                        <td class="cart-product-stock">In Stock</td>
                                        <td class="cart-product-add-cart">
                                            <a class="submit-button-1" href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">Add to Cart</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-remove">x</td>
                                        <td class="cart-product-image">
                                            <a href="product-details.html"><img src="img/product/2.png" alt="#"></a>
                                        </td>
                                        <td class="cart-product-info">
                                            <h4><a href="product-details.html">Orange Fresh Juice</a></h4>
                                        </td>
                                        <td class="cart-product-price">$89.00</td>
                                        <td class="cart-product-stock">In Stock</td>
                                        <td class="cart-product-add-cart">
                                            <a class="submit-button-1" href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">Add to Cart</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-remove">x</td>
                                        <td class="cart-product-image">
                                            <a href="product-details.html"><img src="img/product/4.png" alt="#"></a>
                                        </td>
                                        <td class="cart-product-info">
                                            <h4><a href="product-details.html">Poltry Farm Meat</a></h4>
                                        </td>
                                        <td class="cart-product-price">$149.00</td>
                                        <td class="cart-product-stock">In Stock</td>
                                        <td class="cart-product-add-cart">
                                            <a class="submit-button-1" href="#" title="Add to Cart" data-toggle="modal" data-target="#add_to_cart_modal">Add to Cart</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- WISHLIST AREA START -->

    
@endsection