@extends('layouts.frontend')



@section('content')
    <!-- SHOPING CART AREA START -->
    <div class="liton__shoping-cart-area mt-100 mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table" id="cart_table">
                                <tbody>
                                    @forelse (getCart() as $cart)
                                        <tr id="cart_row_{{ $cart->id }}">
                                            <td class="cart-product-remove">
                                                <form action="{{ route('cart.destroy',$cart->id) }}" method="POST"class="cart_delete_form" id="cart_delete_form_{{ $cart->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="javascript:void(0);" class="cart_delete_btn" data-id="{{ $cart->id }}" style="display: inline-block"><i class="fa fa-times"></i></a>
                                                </form>
                                            </td>
                                            <td class="cart-product-image">
                                                <a href="{{ route('product.details',$cart->slug) }}"><img src="{{ asset('uploads/product/'.$cart->thumbnail) }}" alt="#"></a>
                                            </td>
                                            <td class="cart-product-info">
                                                <h4>
                                                    <a href="{{ route('product.details',$cart->slug) }}">{{ $cart->product_name }}</a>
                                                    <br>
                                                    <h6>{{ '('.productSize($cart->id).')' }}</h6>
                                                </h4>
                                            </td>
                                            <td class="cart-product-price">
                                                @if (productHasDiscount($cart->id))
                                                    <span>${{ discountPrice($cart->id) }}</span>
                                                    <br>
                                                    <del class="text-danger">${{ productPrice($cart->id) }}</del>
                                                @else
                                                    <span>${{ productPrice($cart->id) }}</span>
                                                @endif
                                            </td>
                                            <td class="cart-product-quantity">
                                                @if($cart->in_stock > 0)
                                                    <form action="{{ route('cart.update') }}" method="POST" class="cart_update_form">
                                                        @csrf 
                                                        @method('PATCH')
                                                        <input type="hidden" name="product_id" value="{{ $cart->id }}">
                                                        <div class="cart-plus-minus" data-id="{{ getProductStock($cart->id) }}">
                                                            <input type="number" value="{{ $cart->quantity }}" name="product_quantity" class="cart-plus-minus-box cart_product_quantity">
                                                        </div>
                                                    </form>
                                                @else
                                                    <div class="stock_out_cart_quantity">
                                                        <span class="cart_minus_icon">-</span>
                                                        <span class="cart_quantity_value">{{ $cart->quantity }}</span>
                                                        <span class="cart_plus_icon">+</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="cart-product-stock-status">
                                                {{ getStockStatus($cart->id) }}
                                            </td>
                                            <td class="cart-product-subtotal cart_product_total_price">
                                                <span>${{ productTotalPrice($cart->id,$cart->quantity) }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <h4 class="text-center">YOUR SHOPPING BAG IS EMPTY!</h4>
                                                <div class="mt-20 text-center">
                                                    <a href="{{ url('shop') }}" style="background-color:#80B500;border:none" class="btn btn-success">Shop Now</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse

                                    @if(getCart() != null)
                                        <tr class="cart-coupon-row" id="cart_coupon_row">
                                            <td colspan="6">
                                                <span class="coupon_form_status" style="display: none;"></span>
                                                <div class="cart-coupon" id="coupon_form_wrapper">
                                                    @if (session()->has('coupon') && session()->get('coupon') != null)
                                                        <form action="{{ route('cart.coupon.destroy',session()->get('coupon')['coupon_code']) }}" method="POST" id="remove_coupon_form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="text" name="coupon_code" value="{{ session()->get('coupon')['coupon_code'] }}" id="coupon_code_input" placeholder="Coupon code" required>
                                                            <button type="submit" class="btn bg-danger theme-btn-2 btn-effect-2 remove_coupon_btn">Remove Coupon</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('cart.coupon.store') }}" method="POST" id="apply_coupon_form">
                                                            @csrf
                                                            <input type="text" name="coupon_code" value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }}" placeholder="Coupon code" required>
                                                            <button type="submit" class="btn theme-btn-2 btn-effect-2 apply_coupon_btn">Apply Coupon</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if(getCart() != null)
                            <div class="shoping-cart-total mt-50" id="shopping_cart_total">
                                <h3>Cart Totals :</h3>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><h5>Cart Subtotal</h5></td>
                                            <td class="cart_sub_total_value">${{ number_format(getCartSubTotal(),2) }}</td>
                                        </tr>
                                        @if(session()->has('coupon') && session()->get('coupon') != null)
                                            <tr>
                                                <td>Coupon {{ ' ('.session()->get('coupon')['coupon_code'].' - '.session()->get('coupon')['coupon_value_type'].')' }}</td>
                                                <td class="coupon_discount_amount">- ${{ number_format((couponDiscountAmount(session()->get('coupon')['coupon_code']) / 100),2) }}</td>
                                            </tr>
                                            <tr>
                                                <td><h5>New Subtotal</h5></td>
                                                <td class="new_sub_total_value">${{ number_format((getCartTotal()['new_sub_total'] / 100),2) }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Shipping</td>
                                            <td class="cart_shipping_value">${{ number_format((getCartTotal()['shipping'] / 100),2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Vat {{ ' ('.(getCartTotal()['vat'] * 100).'%)' }}</td>
                                            <td class="cart_vat_value">${{ number_format((getCartTotal()['vat_value'] / 100),2) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Order Total</strong></td>
                                            <td class="cart_total_value"><strong>${{ number_format((getCartTotal()['cartTotal'] / 100),2) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-wrapper text-right">
                                    <a href="{{ url('checkout') }}" class="theme-btn-1 btn btn-effect-1">Proceed to checkout</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOPING CART AREA END -->


@endsection



@section('footer_script')

    <script>
        $(document).ready(function(){

            $(document).on('click','.cart_update_form .qtybutton', function(event){
                event.preventDefault();
                $(this).closest('form').submit();
            });

            $(document).on('submit','.cart_update_form', function(event){
                event.preventDefault();

                let formData = $(this).serialize();
                let url = "{{ route('cart.update') }}";

                $.ajax({
                    type:'POST',
                    url:url,
                    data:formData,
                    success:function(data){
                        if(data != null){

                            $('#ltn__utilize-cart-menu').load(' #ltn__utilize-cart-menu >* ');
                            $('#cart_row_'+data.cart_data.cart_product_id).find('.cart_product_quantity').val(data.cart_data.product_quantity);
                            $('#cart_row_'+data.cart_data.cart_product_id).find('.cart_product_total_price span').text('$'+data.cart_data.product_total_price);
                            $('.cart_sub_total_value').text('$'+(data.cart_data.cart_total_details.cart_sub_total / 100).toFixed(2));
                            $('.new_sub_total_value').text('$'+(data.cart_data.cart_total_details.new_sub_total / 100).toFixed(2));
                            $('.coupon_discount_amount').text('- $'+(data.cart_data.cart_total_details.coupon_discount_amount / 100).toFixed(2));
                            $('.cart_shipping_value').text('$'+(data.cart_data.cart_total_details.shipping / 100).toFixed(2));
                            $('.cart_vat_value').text('$'+(data.cart_data.cart_total_details.vat_value / 100).toFixed(2));
                            $('.cart_total_value').html('<strong>'+'$'+(data.cart_data.cart_total_details.cartTotal / 100).toFixed(2)+'</strong>');
                            $('.your_cart_total').text('$'+(data.cart_data.cart_total_details.cart_sub_total / 100).toFixed(2));

                        }
                    },
                    error:function(error){
                        let errorMsg = "Something went wrong!";
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


        });
    </script>

@endsection