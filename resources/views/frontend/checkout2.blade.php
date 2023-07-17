@extends('layouts.frontend')


@section('content')
    <!-- WISHLIST AREA START -->
    <div class="ltn__checkout-area mt-100 mb-105">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__checkout-inner">
                        @guest
                        <div class="ltn__checkout-single-content ltn__returning-customer-wrap">
                            <h5>Returning customer? <a class="ltn__secondary-color" href="#ltn__returning-customer-login" data-toggle="collapse">Click here to login</a></h5>
                            <div id="ltn__returning-customer-login" class="collapse ltn__checkout-single-content-info">
                                <div class="ltn_coupon-code-form ltn__form-box">
                                    <p>Please login your accont.</p>
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-item input-item-email ltn__custom-icon">
                                                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-name ltn__custom-icon">
                                                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase">Login</button>
                                        <label class="input-info-save mb-0"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me</label>
                                        @if(Route::has('password.request'))
                                            <p class="mt-30">
                                                <a href="{{ route('password.request') }}">Lost your password?</a>
                                            </p>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endguest
                        <div class="ltn__checkout-single-content ltn__coupon-code-wrap">
                            <h5>Have a coupon? <a class="ltn__secondary-color" href="#ltn__coupon-code" data-toggle="collapse">Click here to enter your code</a></h5>
                            <div id="ltn__coupon-code" class="collapse ltn__checkout-single-content-info {{ session()->has('coupon') && session()->get('coupon') != null ? 'show' : '' }}">
                                <div class="ltn__coupon-code-form">
                                    <p>If you have a coupon code, please apply it below.</p>
                                    <span class="coupon_form_status" style="display: none;"></span>
                                    <div id="coupon_form_wrapper">
                                        @if (session()->has('coupon') && session()->get('coupon') != null)
                                            <form action="{{ route('cart.coupon.destroy',session()->get('coupon')['coupon_code']) }}" method="POST" id="remove_coupon_form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="text" name="coupon_code" value="{{ session()->get('coupon')['coupon_code'] }}" id="coupon_code_input" placeholder="Coupon code" required>
                                                <button type="submit" class="btn bg-danger theme-btn-2 btn-effect-2 text-uppercase remove_coupon_btn">Remove Coupon</button>
                                            </form>
                                        @else
                                            <form action="{{ route('cart.coupon.store') }}" method="POST" id="apply_coupon_form">
                                                @csrf
                                                <input type="text" name="coupon_code" value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }}" placeholder="Coupon code" required>
                                                <button type="submit" class="btn theme-btn-2 btn-effect-2 text-uppercase apply_coupon_btn">Apply Coupon</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (session('request_error'))
                    <div class="col-md-6 col-12">
                        <div class="alert alert-danger" role="alert">
                            {{ session('request_error') }}
                        </div>
                    </div>
                @endif
                <form action="{{ route('checkout.post') }}" method="POST" id="payment-form">
                    @csrf 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ltn__checkout-single-content mt-50">
                                <h4 class="title-2">Billing Details</h4>
                                <div class="ltn__checkout-single-content-info">
                                    <h6>Personal Information <span class="text-danger">*</span></h6>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-4">
                                            <div class="input-item input-item-name ltn__custom-icon billing_details_input_wrap">
                                                <input type="text" name="billing_name" placeholder="Full name *" value="{{ auth()->user()->name ?? '' }}">
                                                @error('billing_name')
                                                    <div class="text-danger billing_input_error" style="font-size:14px">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="input-item input-item-email ltn__custom-icon billing_details_input_wrap">
                                                <input type="email" name="billing_email" placeholder="Email address" value="{{ auth()->user()->email ?? '' }}">
                                                @error('billing_email')
                                                    <div class="text-danger billing_input_error" style="font-size:14px">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="input-item input-item-phone ltn__custom-icon billing_details_input_wrap number_wrap">
                                                <input type="number" size="16" name="billing_phone" placeholder="Phone number *" value="{{ auth()->user()->userDetails->phone ?? '' }}">
                                                @error('billing_phone')
                                                    <div class="text-danger billing_input_error" style="font-size:14px">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <h6>Country <span class="text-danger">*</span></h6>
                                            <div class="input-item billing_details_input_wrap">
                                                <select class="nice-select" name="billing_country"  id="billing_country">
                                                    <option selected disabled>Select Country</option>
                                                    @foreach (countries() as $country)
                                                        @auth
                                                            <option value="{{ $country->id }}" {{ auth()->user()->userDetails->country ==  $country->id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                                                        @endauth
                                                        @guest
                                                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                                        @endguest
                                                    @endforeach
                                                </select>
                                                @error('billing_country')
                                                    <div class="text-danger billing_input_error" style="font-size:14px">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h6>Town / City <span class="text-danger">*</span></h6>
                                            <div class="input-item billing_details_input_wrap" id="billig_city_wrap">
                                                <select class="nice-select" name="billing_city" id="billig_city">
                                                    <option selected disabled>Select City</option>
                                                    @auth
                                                        @foreach (cityByCountry(auth()->user()->userDetails->country) as $city)
                                                            <option value="{{ $city->id }}" {{ auth()->user()->userDetails->city ==  $city->id ? 'selected' : '' }}>{{ $city->city_name }}</option>
                                                        @endforeach
                                                    @endauth
                                                </select>
                                                @error('billing_city')
                                                    <div class="text-danger billing_input_error" style="font-size:14px">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h6>Zip <span class="text-danger">*</span></h6>
                                            <div class="input-item billing_details_input_wrap">
                                                <input type="text" name="billing_zipcode" placeholder="Zip">
                                                @error('billing_zipcode')
                                                    <div class="text-danger billing_input_error" style="font-size:14px">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-6">
                                            <h6>Address <span class="text-danger">*</span></h6>
                                            <div class="input-item billing_details_input_wrap">
                                                <input type="text" name="billing_address" placeholder="House number and street name">
                                                @error('billing_address')
                                                    <div class="text-danger billing_input_error" style="font-size:14px">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <p><label class="input-info-save mb-0"><input type="checkbox" name="create_account" value="1"> Create an account?</label></p> --}}
                                    <h6>Order Notes (optional)</h6>
                                    <div class="input-item input-item-textarea ltn__custom-icon">
                                        <textarea name="order_note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ltn__checkout-payment-method mt-50">
                                <h4 class="title-2">Payment Method</h4>
                                <div id="checkout_accordion_1">
                                
                                    @error('payment_method')
                                    <div class="text-danger" style="margin-bottom:5px">{{ $message }}</div>
                                    @enderror
                                    <!-- card -->
                                    <div class="card">
                                        <label for="payment_method_cod">
                                            <h5 class="ltn__card-title payment_method_card_title" data-toggle="collapse" data-target="#payment_method_1" aria-expanded="true"> 
                                                Cash on delivery 
                                            </h5>
                                        </label>
                                        <div id="payment_method_1" class="collapse show" data-parent="#checkout_accordion_1">
                                            <div class="card-body">
                                                <p>Pay with cash upon delivery.</p>
                                            </div>
                                        </div>
                                        <input class="d-none payment_method_input" type="radio" name="payment_method" id="payment_method_cod" value="cod" data-waschecked="true" checked>
                                    </div>                          
                                    <!-- card -->
                                    <div class="card" id="stripe_parent_card">
                                        <label for="payment_method_card">
                                            <h5 class="collapsed ltn__card-title payment_method_card_title" data-toggle="collapse" data-target="#payment_method_2" aria-expanded="false">
                                                Online Payment (Stripe)
                                            </h5>
                                        </label>
                                        <div id="payment_method_2" class="collapse" data-parent="#checkout_accordion_1">
                                            <div class="card-body">
                                                <p>Pay via Stripe; you can pay with your credit card if you don’t have a Stripe account.</p>
                                                <div id="card-element">
                                                    loading...
                                                </div>
                                            </div>
                                        </div>
                                        <input class="d-none payment_method_input" type="radio" name="payment_method" id="payment_method_card" value="card">
                                    </div>
                                </div>
                                <button id="order_submit" class="btn theme-btn-1 btn-effect-1 text-uppercase mt-30 place_order_btn">
                                <div class="spinner hidden" id="spinner"></div>
                                <span id="button-text">Place Order</span>
                                </button>
                                <div id="payment-message" class="hidden text-danger"></div>
                                <div class="ltn__payment-note mt-30 mb-30">
                                    <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="shoping-cart-total mt-50" id="shopping_cart_total">
                                <h4 class="title-2">Cart Totals :</h4>
                                <table class="table">
                                    <tbody>
                                        @foreach (getCart() as $cart)
                                            <tr>
                                                <td>{{ $cart->product_name }} <strong>× {{ $cart->quantity }}</strong></td>
                                                <td>${{ productTotalPrice($cart->id,$cart->quantity) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td><h6 class="m-0">Subtotal</h6></td>
                                            <td>${{ number_format((getCartTotal()['cart_sub_total'] / 100),2) }}</td>
                                        </tr>
                                        @if(session()->has('coupon') && session()->get('coupon') != null)
                                            <tr>
                                                <td>Coupon {{ ' ('.session()->get('coupon')['coupon_code'].' - '.session()->get('coupon')['coupon_value_type'].')' }}</td>
                                                <td>- ${{ number_format((couponDiscountAmount(session()->get('coupon')['coupon_code']) / 100),2) }}</td>
                                            </tr>
                                            <tr>
                                                <td><h6 class="m-0">New Subtotal</h6></td>
                                                <td class="new_sub_total_value">${{ number_format((getCartTotal()['new_sub_total'] / 100),2) }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Shipping</td>
                                            <td>${{ number_format((getCartTotal()['shipping'] / 100),2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Vat {{ ' ('.(getCartTotal()['vat']).'%)' }}</td>
                                            <td>${{ number_format((getCartTotal()['vat_value'] / 100),2) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Order Total</strong></td>
                                            <td><strong>${{ number_format((getCartTotal()['cartTotal'] / 100),2) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- WISHLIST AREA START -->

    
@endsection

@section('header_script')
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
@endsection

@section('footer_script')

    <script type="text/javascript">

        $(document).ready(function(){

            $(document).on('change','#billing_country', function(){
                let country_id = $(this).val();
                getCitiesByCountry(country_id);
            });


            function getCitiesByCountry(country_id){
                let url = "{{ route('getcity',':country') }}";
                    url = url.replace(':country',country_id);

                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){
                        $('#billig_city').html('<option selected="" disabled="">Select City</option>'+data.city_options);
                        $('#billig_city_wrap .nice-select .current').html('Select City');
                        $('#billig_city_wrap .nice-select .list').html('<li data-value="Select City" class="option selected disabled focus">Select City</li>'+data.city_lists);
                    },
                    error:function(){
                        alert("Something went wrong!");
                    }
                });
            }

        });

        
        $(function(){
            $('.payment_method_input').click(function(){
                let radio = $(this);
                if (radio.data('waschecked') == true){
                    radio.prop('checked', false);
                    radio.data('waschecked', false);
                }
                else{
                    radio.data('waschecked', true);
                }
                radio.siblings('.payment_method_input').data('waschecked', false);
            });
        });



        function getPaymentType(){
            let payment_method_inputs = document.querySelectorAll('.payment_method_input');
            let input_value;
            payment_method_inputs.forEach(element => {
                if(element.checked == true){
                    input_value = element.value;
                }
            });

            return input_value;
        };



        function storeOrder(formData){
            
            let form_response = {};
            // let hasError = false;
            // let order_id;
            
           $.ajax({
                async:false,
                type:'POST',
                url:"{{ route('checkout.post') }}",
                data:formData,
                success:function(data){
                    if(data.errors){
                        form_response = {
                            hasError: true,
                        }
                    }else if(data.success){
                        form_response = {
                            success: true,
                            order_id: 2,
                        }
                    }
                },
                error:function(){
                    alert("Something went wrong! Try reloading the page.");
                    hasError = true;
                }
           });

           return form_response;
        }


        function updateOrderStatus(order_id){

        }


        // This is your test publishable API key.
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");

        // Fetches a payment intent and captures the client secret
        var elements = stripe.elements();

        // Set up Stripe.js and Elements to use in checkout form
        var style = {
            base: {
                color: "#32325d",
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            },
        };

        var cardElement = elements.create('card', {
            style: style,
            hidePostalCode: true,
        });
        cardElement.mount('#card-element');


        var form = document.getElementById('payment-form');
        let formDataValue;

        form.addEventListener('submit', function(event) {
            // We don't want to let default form submission happen here,
            // which would refresh the page.
            event.preventDefault();
            setLoading(true);

            let formData = new FormData(event.target);

            formDataValue = Object.fromEntries(formData);

            const form_response = storeOrder(formDataValue);

            if(form_response.hasError){
                alert('has error');
                setLoading(false);
                return;
            }

            if(getPaymentType() === 'cod'){
                alert('dfgdfg');
                setLoading(false);
                return window.location.href = "{{ url('thankyou') }}";
            }

            stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
                billing_details: {
                // Include any additional collected billing details.
                name: 'Jenny Rosen',
                },
            }).then(stripePaymentMethodHandler);

           
        });


        function stripePaymentMethodHandler(result) {
            if (result.error) {
                // Show error in payment form
                setLoading(false);
                showMessage(result.error.message);
            } else {

                // Otherwise send paymentMethod.id to your server (see Step 4)
                fetch('/checkout/pay', {
                    method: 'POST',
                    headers: { "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value },
                    body: JSON.stringify({
                        payment_method_id: result.paymentMethod.id,
                    })
                }).then(function(result) {
                    // Handle server response (see Step 4)
                    result.json().then(function(json) {
                        handleServerResponse(json);
                    })
                });
            }
        }


        function handleServerResponse(response) {
            if (response.error) {
                // Show error from server on payment form
                setLoading(false);
                showMessage(response.error);
            } else if (response.requires_action) {
                // Use Stripe.js to handle required card action
                stripe.handleCardAction(
                    response.payment_intent_client_secret
                ).then(handleStripeJsResult);
            } else {
                // Show success message
                setLoading(false);
                showMessage(response.success);
            }
        }

        function handleStripeJsResult(result) {
            if (result.error) {
                // Show error in payment form
                setLoading(false);
                showMessage(result.error.message);
            } else {
                // The card action has been handled
                // The PaymentIntent can be confirmed again on the server
                fetch('/checkout/pay', {
                    method: 'POST',
                    headers: { "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value },
                    body: JSON.stringify({ payment_intent_id: result.paymentIntent.id })
                }).then(function(confirmResult) {
                    return confirmResult.json();
                }).then(handleServerResponse);
            }
        }


        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function () {
                messageContainer.classList.add("hidden");
                messageText.textContent = "";
            }, 4000);
        }

            // Show a spinner on payment submission
            function setLoading(isLoading) {
                if (isLoading) {
                    // Disable the button and show a spinner
                    document.querySelector("#order_submit").disabled = true;
                    document.querySelector("#spinner").classList.remove("hidden");
                    document.querySelector("#button-text").classList.add("hidden");
                } else {
                    document.querySelector("#order_submit").disabled = false;
                    document.querySelector("#spinner").classList.add("hidden");
                    document.querySelector("#button-text").classList.remove("hidden");
                }
            }


        

    </script>

@endsection