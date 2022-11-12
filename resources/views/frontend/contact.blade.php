@extends('layouts.frontend')



@section('content')
    <!-- CONTACT ADDRESS AREA START -->
    <div class="ltn__contact-address-area mb-90 pt-70">
        <div class="container">
            <div class="row justify-content-center">
                @if ($contact_emails->count() > 0)
                    <div class="col-lg-4">
                        <div class="contact_address_item ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                            <div class="ltn__contact-address-icon">
                                <img src="{{ asset('frontend_assets/img/icons/10.png') }}" alt="Icon Image">
                            </div>
                            <h3>Email Address</h3>
                            <p>
                                @foreach ($contact_emails as $email)
                                    {{ $email->contact_email }}<br>
                                @endforeach
                            </p>
                        </div>
                    </div>
                @endif

                @if ($contact_phones->count() > 0)
                    <div class="col-lg-4">
                        <div class="contact_address_item ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                            <div class="ltn__contact-address-icon">
                                <img src="{{ asset('frontend_assets/img/icons/11.png') }}" alt="Icon Image">
                            </div>
                            <h3>Phone Number</h3>
                            <p>
                                @foreach ($contact_phones as $phone)
                                    +{{ $phone->contact_phone }}<br>
                                @endforeach
                            </p>
                        </div>
                    </div>
                @endif

                @if (contact_address() != null)
                    <div class="col-lg-4">
                        <div class="contact_address_item ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                            <div class="ltn__contact-address-icon">
                                <img src="{{ asset('frontend_assets/img/icons/12.png') }}" alt="Icon Image">
                            </div>
                            <h3>Office Address</h3>
                            <p>{{ contact_address() }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- CONTACT ADDRESS AREA END -->
    
    <!-- CONTACT MESSAGE AREA START -->
    <div class="ltn__contact-message-area mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">
                        @if (session('message_success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message_success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                        @endif
                        <h4 class="title-2">Get A Quote</h4>
                        <form id="contact-form" action="{{ route('message.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-item-name ltn__custom-icon mb-5">
                                        <input type="text" name="contact_name" placeholder="Enter your name" value="{{ old('contact_name') }}" class="m-0">
                                        @error('contact_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-item-email ltn__custom-icon mb-5">
                                        <input type="email" name="contact_email" placeholder="Enter email address" value="{{ old('contact_email') }}" class="m-0">
                                        @error('contact_email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-item input-item-textarea ltn__custom-icon mb-5">
                                <textarea name="contact_message" placeholder="Enter message" class="m-0">{{ old('contact_message') }}</textarea>
                                @error('contact_message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="btn-wrapper mt-0">
                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase" id="contact_form_submit_btn" type="submit">Send Message</button>
                            </div>
                            <p class="form-messege mb-0 mt-20"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT MESSAGE AREA END -->


@endsection



@section('footer_script')
    
    <script>

        $(document).ready(function(){

            $(document).on('submit','#contact-form', function(){
                $(this).find('#contact_form_submit_btn').attr('disabled',true);
            });

        });

    </script>

@endsection