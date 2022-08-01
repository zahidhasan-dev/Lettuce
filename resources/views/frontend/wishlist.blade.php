@extends('layouts.frontend')


@section('content')
    <!-- WISHLIST AREA START -->
    <div class="liton__wishlist-area mt-100 mb-105">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table" id="wishlists_table">
                                <tbody>
                                    @forelse (getWishlists() as $wishlist)
                                        <tr>
                                            <td>
                                                <form action="{{ route('wishlist.destroy',$wishlist->id) }}" method="POST"  class="wishlist_delete_form" id="wishlist_delete_{{ $wishlist->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="javascript:void(0);" class="wishlist_delete_btn" data-id="{{ $wishlist->id }}" style="display: inline-block"><i class="fa fa-times"></i></a>
                                                </form>
                                            </td>
                                            <td class="cart-product-image">
                                                <a href="{{ route('product.details',$wishlist->slug) }}"><img src="{{ asset('uploads/product/'.$wishlist->thumbnail) }}" alt="#"></a>
                                            </td>
                                            <td class="cart-product-info">
                                                <h4 class="m-0">
                                                    <a href="{{ route('product.details',$wishlist->slug) }}">{{ $wishlist->product_name }}</a>
                                                    <br>
                                                    <h6>{{ '('.productSize($wishlist->id).')' }}</h6>
                                                </h4>
                                            </td>
                                            <td class="cart-product-price">${{ number_format(($wishlist->price / 100),2) }}</td>
                                            <td class="cart-product-stock">
                                                {{-- {{ $wishlist->in_stock > 0 ? ($wishlist->in_stock > 20 ? 'In Stock' : 'Low In Stock') : 'Out of Stock'}} --}}
                                                {{-- @if ($wishlist->in_stock > 20)
                                                    <span class="text-success">In Stock</span>                        
                                                @elseif ($wishlist->in_stock > 0 && $wishlist->in_stock <= 20)
                                                    <span class="text-warning">Low Stock</span>        
                                                @else
                                                    <span class="text-danger">Out Of Stock</span>
                                                @endif --}}
                                                {{ getStockStatus($wishlist->id) }}
                                            </td>
                                            <td class="cart-product-add-cart">
                                                @if($wishlist->in_stock <= 0)
                                                    <span class="submit-button-1 btn_disabled">Add to Cart</span>
                                                @else
                                                    <form action="{{ route('cart.store') }}" method="post" class="cart_form" id="cart_form_{{ $wishlist->id }}">
                                                        @csrf 
                                                        <input type="hidden" name="product_id" value="{{ $wishlist->id }}">
                                                        <input type="hidden" name="product_quantity" value="1">
                                                        <input type="hidden" name="wishlist_to_cart" value="1">
                                                    </form>
                                                    <a href="javascript:void(0);" class="submit-button-1 add_to_cart_btn wishlist_to_cart_btn" data-id="{{ $wishlist->id }}">
                                                        Add to Cart
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <h4 class="text-center">YOUR WISHLIST IS EMPTY!</h4>
                                                <div class="mt-20 text-center">
                                                    <a href="{{ url('shop') }}" style="background-color:#80B500;border:none" class="btn btn-success">Shop Now</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                        
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



@section('footer_script')

    <script>
        
        $(document).ready(function(){

            $(document).on('click','.wishlist_to_cart_btn', function(event){
                $('#wishlists_table').load(' #wishlists_table >* ');
            });

        });

    </script>

@endsection