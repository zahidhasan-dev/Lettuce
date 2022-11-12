@extends('layouts.frontend')


@section('content')
    
        <!-- ABOUT US AREA START -->
        <div class="ltn__about-us-area pt-120--- pb-120" style="padding-top:120px;">
            <div class="container">
                <div class="row">
                    @if ($about != null)   
                        <div class="col-lg-6 align-self-center">
                            <div class="about-us-img-wrap about-img-left">
                                <img src="{{ asset('uploads/about/'.$about->about_image) }}" alt="About Us Image">
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center">
                            <div class="about-us-info-wrap">
                                <div class="section-title-area ltn__section-title-2">
                                    <h6 class="section-subtitle ltn__secondary-color">{{ $about->about_sub_title }}</h6>
                                    <h1 class="section-title">{{ $about->about_title }}</h1>
                                    <p>{{ $about->about_desc_1 }}</p>
                                </div>
                                <p>{{ $about->about_desc_2 }}</p>
                                <div class="about-author-info d-flex">
                                    <div class="author-name-designation  align-self-center">
                                        @if ( $about->about_author_name != null)
                                            <h4 class="mb-0">{{ $about->about_author_name }}</h4>
                                        @endif
                                        @if ( $about->about_author_title != null)
                                            <small>/ {{ $about->about_author_title }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="ltn__section-title-2 col-12 text-center">
                        <h1 class="section-title">About Us</h1>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- ABOUT US AREA END -->

    <!-- FEATURE AREA START ( Feature - 6) -->
    <div class="ltn__feature-area section-bg-1 pt-115 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h6 class="section-subtitle ltn__secondary-color">//  features  //</h6>
                        <h1 class="section-title">Why Choose Us<span>.</span></h1>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($features as $feature)    
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="ltn__feature-item ltn__feature-item-7">
                            <div class="ltn__feature-icon-title">
                                <div class="ltn__feature-icon">
                                    <span><img src="{{ asset('uploads/feature/'.$feature->feature_image) }}" alt="#"></span>
                                </div>
                                <h3><span>{{ $feature->feature_title }}</span></h3>
                            </div>
                            <div class="ltn__feature-info">
                                <p>{{ $feature->feature_desc }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- FEATURE AREA END -->


    <!-- FAQ AREA START (faq-2) (ID > accordion_2) -->
    <div class="ltn__faq-area pt-115 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title white-color---">Some Questions</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ltn__faq-inner ltn__faq-inner-2">
                        <div id="accordion_2">

                            @foreach ($faqs as $key => $faq )
                            <!-- card -->
                            <div class="card">
                                <h6 class="collapsed ltn__card-title" data-toggle="collapse" data-target="#faq-item-{{ $faq->id }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">
                                    How to buy a product?
                                </h6>
                                <div id="faq-item-{{ $faq->id }}" class="collapse {{ $key == 0 ? 'show' : '' }}" data-parent="#accordion_2">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Scelerisque eleifend donec pretium vulputate sapien nec sagittis. Proin libero nunc consequat interdum. Condimentum lacinia quis vel eros donec ac.</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <aside class="sidebar-area ltn__right-sidebar mt-60">
                        <!-- Banner Widget -->
                        <div class="widget ltn__banner-widget">
                            <a href="{{ route('shop') }}"><img src="{{ asset('frontend_assets/img/bg/12.png') }}" alt="Banner Image"></a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ AREA START -->

   
@endsection