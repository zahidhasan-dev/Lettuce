@extends('layouts.frontend')



@section('content')
    <!-- WISHLIST AREA START -->
    <div class="liton__wishlist-area pb-70" style="padding-top:50px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- PRODUCT TAB AREA START -->
                    <div class="ltn__product-tab-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="ltn__tab-menu-list mb-50">
                                        <div class="nav">
                                            <a class="active show" data-toggle="tab" href="#liton_tab_1_1">Dashboard <i class="fas fa-home"></i></a>
                                            <a data-toggle="tab" href="#liton_tab_1_2">Orders <i class="fas fa-file-alt"></i></a>
                                            <a data-toggle="tab" href="#liton_tab_1_4">Address <i class="fas fa-map-marker-alt"></i></a>
                                            <a data-toggle="tab" href="#liton_tab_1_5">Account Details <i class="fas fa-user"></i></a>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">{{ __('Sign out') }}
                                                <i class="fas fa-sign-out-alt"></i>
                                            </a>
                                            <form id="logout_form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="liton_tab_1_1">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>Hello, <strong>{{ auth()->user()->name }} !</strong> </p>
                                                <p>From your account dashboard you can view your <span>recent orders</span>, manage your <span>billing address</span>, and <span>edit your password and account details</span>.</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_2">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($orders as $order)
                                                            <tr>
                                                                <td>#{{ $order->id }}</td>
                                                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                                <td><span class="badge {{ $order->order_status == 'completed' ? 'bg-success' : 'bg-warning' }} text-white">{{ $order->order_status }}</span></td>
                                                                <td>${{ number_format(($order->order_total / 100),2) }}</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="btn text-white" id="view_order_details_btn" style="background-color:#80B500;padding: 8px 30px;" data-id="{{ $order->id }}" data-toggle="modal" data-target="#order_item_modal">View</a>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center">Not available!</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_4">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>The following addresses will be used on the checkout page by default.</p>
                                                <div class="row">
                                                    <div class="col-md-10 col-12 learts-mb-30" id="customer_address_wrapper">
                                                        <div class="alert alert-success success_status" style="display:none;"></div>
                                                        <h4>Billing Address <small><span id="customer_address_edit_btn" class="btn">Edit</span></small></h4>
                                                        <div class="show" id="address_content">
                                                            <address>
                                                                <p><strong>{{ auth()->user()->name }}</strong></p>
                                                                <p>{!! auth()->user()->userDetails->address != null ? auth()->user()->userDetails->address.' <br>' : '' !!}
                                                                    {{ auth()->user()->userDetails->getcity->city_name ?? '' }} 
                                                                    {{ (auth()->user()->userDetails->getcountry != null ) ? ', '.auth()->user()->userDetails->getcountry->country_name: ''}}</p>
                                                                <p>Mobile: {{ auth()->user()->userDetails->phone ?? 'N/A' }}</p>
                                                            </address>
                                                        </div>
                                                        <div class="hide" id="edit_customer_address_form">
                                                            <form action="{{ route('customer.account.details.update') }}" method="POST" id="customer_address_form">
                                                                @csrf 
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="">Phone :</label>
                                                                    <input type="number" class="form-control" name="customer_phone" placeholder="Phone number" value="{{ auth()->user()->userDetails->phone }}">
                                                                    <small class="customer_phone_error customer_input_error text-danger"></small>
                                                                </div>
                                                                <div class="form-group input-item" id="customer_country_wrap">
                                                                    <label for="">Country :</label>
                                                                    <select class="nice-select" name="customer_country" id="customer_country_input">
                                                                        <option selected disabled>Select Country</option>
                                                                        @foreach (countries() as $country)
                                                                            <option value="{{ $country->id }}" {{ auth()->user()->userDetails->country == $country->id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <small class="customer_country_error customer_input_error text-danger"></small>
                                                                </div>
                                                                <div class="form-group input-item" id="customer_city_wrap">
                                                                    <label for="">City :</label>
                                                                    <select class="nice-select" name="customer_city" id="customer_city_input">
                                                                        <option selected disabled>Select City</option>
                                                                        @foreach (cityByCountry(auth()->user()->userDetails->country) as $city)
                                                                            <option value="{{ $city->id }}" {{ auth()->user()->userDetails->city ==  $city->id ? 'selected' : '' }}>{{ $city->city_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <small class="customer_city_error customer_input_error text-danger"></small>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Address :</label>
                                                                    <input type="text" class="form-control" name="customer_address" placeholder="House number and street name" value="{{ auth()->user()->userDetails->address }}">
                                                                    <small class="customer_address_error customer_input_error text-danger"></small>
                                                                </div>

                                                                <button type="submit" class="btn">Save</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_5">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>The following addresses will be used on the checkout page by default.</p>
                                                <div class="ltn__form-box">
                                                    <div class="alert alert-success customer_account_success_status" style="display:none;"></div>
                                                    <form action="{{ route('customer.account.update') }}" method="POST" autocomplete="off" id="customer_account_form">
                                                        @csrf 
                                                        @method('PUT')
                                                        <div class="row mb-50">
                                                            <div class="col-md-6">
                                                                <label>Full Name:</label>
                                                                <input type="text" name="customer_name" value="{{ auth()->user()->name }}" placeholder="Full Name">
                                                                <div class="text-danger customer_name_error customer_account_input_error"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Email:</label>
                                                                <input type="email" name="customer_email" value="{{ auth()->user()->email }}" placeholder="Email" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
                                                                <div class="text-danger customer_email_error customer_account_input_error"></div>
                                                            </div>
                                                        </div>
                                                        <fieldset>
                                                            <legend>Change Password</legend>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label>Current password (leave blank to leave unchanged):</label>
                                                                    <input type="password" name="current_password" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
                                                                    <div class="text-danger current_password_error customer_account_input_error"></div>

                                                                    <label>New password (leave blank to leave unchanged):</label>
                                                                    <input type="password" name="password" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
                                                                    <div class="text-danger password_error customer_account_input_error"></div>

                                                                    <label>Confirm new password:</label>
                                                                    <input type="password" name="password_confirmation" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
                                                                    <div class="text-danger password_confirmation_error customer_account_input_error"></div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="btn-wrapper">
                                                            <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PRODUCT TAB AREA END -->
                </div>
            </div>
        </div>
    </div>
    <!-- WISHLIST AREA START -->


    <!-- MODAL AREA START (Order Item Modal) -->
    <div class="ltn__modal-area ltn__quick-view-modal-area">
        <div class="modal fade" id="order_item_modal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="position:relative">
                    <div class="modal-header" style="padding:20px 30px;">
                        <h5 class="modal-title" id="orderdetailsModalLabel&quot;">Order Details</h5>
                        <button type="button" class="close modal_close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="min-height: 300px">
                        {{-- @include('frontend.customer.order.order_items') --}}
                    </div>
                    <div class="preloader d-none" style="position:absolute" id="order_item_preloader">
                        <div class="preloader_inner">
                            <div class="spinner">
                                <div class="dot1"></div>
                                <div class="dot2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL AREA END -->

@endsection


@section('footer_script')
    
        <script>

            $(document).ready(function(){

                $(document).on('click','#customer_address_edit_btn', function(){

                    $('select').niceSelect();

                    if($(this).text() === 'Edit'){
                        $(this).text('Cancel');
                        $(this).addClass('bg-danger active');
                    }
                    else{
                        $(this).text('Edit');
                        $(this).removeClass('bg-danger active');
                    }

                    if($(this).hasClass('active')){
                        $('#address_content').addClass('hide').removeClass('show');
                        $('#edit_customer_address_form').addClass('show').removeClass('hide');
                    }
                    else{
                        $('#address_content').addClass('show').removeClass('hide');
                        $('#edit_customer_address_form').addClass('hide').removeClass('show');
                        $('#edit_customer_address_form').load(' #edit_customer_address_form >* ');
                    }
                    
                    
                });


                $(document).on('submit','#customer_address_form', function(e){
                    e.preventDefault();

                    let formData = $(this).serialize();
                    let url = "{{ route('customer.account.details.update') }}";

                    $.ajax({
                        type:'PUT',
                        url:url,
                        data:formData,
                        success:function(data){
                            $('.customer_input_error').html('');
                            if(data.error){
                                $.each(data.error,function(key,error){
                                    $('.'+key+'_error').html(error);
                                });
                            }
                            else if(data.success){
                                $('#customer_address_wrapper').load(' #customer_address_wrapper >* ');

                                setTimeout(() => {
                                    $('.success_status').html(data.success);
                                    $('.success_status').fadeIn().delay(1000).fadeOut();
                                }, 800);
                                
                            }
                            
                        },
                        error:function(){
                            if(confirm('Something went wrong! Try reloading the page.')){
                                window.location.reload();
                            }
                        }
                    });
                });


                $(document).on('change','#customer_country_input', function(){

                    let country_id = $(this).val();
                    let url = "{{ route('getcity',':country') }}";
                    url = url.replace(':country',country_id);

                    $.ajax({
                        type:'GET',
                        url:url,
                        success:function(data){
                            $('#customer_city_input').html('<option selected="" disabled="">Select City</option>'+data.city_options);
                            $('#customer_city_wrap .nice-select .current').html('Select City');
                            $('#customer_city_wrap .nice-select .list').html('<li data-value="Select City" class="option selected disabled focus">Select City</li>'+data.city_lists);
                        },
                        error:function(){
                            if(confirm('Something went wrong! Try reloading the page.')){
                                window.location.reload();
                            }
                        }
                    });

                });



                $(document).on('submit','#customer_account_form', function(e){
                    e.preventDefault();

                    let formData = $(this).serialize();
                    let url = "{{ route('customer.account.update') }}";
                    
                    $.ajax({
                        type:'PUT',
                        url:url,
                        data:formData,
                        success:function(data){
                           
                            $('.customer_account_input_error').html('');

                            if(data.error){
                                $.each(data.error, function(key,error){
                                   $('.'+key+'_error').html(error);
                                });
                            }
                            else if(data.success){
                                setTimeout(() => {
                                    $('.customer_account_success_status').html(data.success);
                                    $('.customer_account_success_status').fadeIn().delay(1200).fadeOut();
                                }, 500);
                            }

                        },
                        error:function(){
                            if(confirm('Something went wrong! Try reloading the page.')){
                                window.location.reload();
                            }
                        }
                    });

                });



                $(document).on('click','#view_order_details_btn',function(e){
                    e.preventDefault();

                    let order_id = $(this).data('id');
                    let url = "{{ route('customer.order',':order_id') }}";
                        url = url.replace(':order_id',order_id);

                    $.ajax({
                        type:'GET',
                        url:url,
                        beforeSend:function(){
                            $('#order_item_modal').find('#order_item_preloader').removeClass('d-none');
                        },
                        success:function(data){
                            $('#order_item_modal').find('.modal-body').html(data.order_details);
                        },
                        complete:function(){
                            setTimeout(() => {
                                $('#order_item_modal').find('#order_item_preloader').addClass('d-none');
                            }, 100);
                        },
                        error:function(){
                            $('#order_item_modal').find('.modal-body').html('<h2 class="text-center m-0" style="padding:150px 20px">Something went wrong! Try reloading the page.</h2>');
                            $('#order_item_modal').find('#order_item_preloader').addClass('d-none');
                        }
                    });
                    
                })


            });



        </script>

@endsection