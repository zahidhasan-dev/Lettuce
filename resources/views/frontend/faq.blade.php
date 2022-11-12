@extends('layouts.frontend')


@section('content')
    <!-- FAQ AREA START (faq-2) (ID > accordion_2) -->
    <div class="ltn__faq-area mb-100 pt-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ltn__faq-inner ltn__faq-inner-2">
                        <div id="accordion_2">
                            @foreach ($faqs as $key => $faq)
                                <!-- card -->
                                <div class="card">
                                    <h6 class="collapsed ltn__card-title" data-toggle="collapse" data-target="#faq-item-2-{{ $faq->id }}" aria-expanded="{{ $key == 0 ? 'true' : 'false'}}">
                                        {{ $faq->faq_ques }}
                                    </h6>
                                    <div id="faq-item-2-{{ $faq->id }}" class="collapse {{ $key == 0 ? 'show' : ''}}" data-parent="#accordion_2">
                                        <div class="card-body">
                                            <p>{{ $faq->faq_ans }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="need-support text-center mt-100">
                            <h2>Still need help? Reach out to support 24/7:</h2>
                            <div class="btn-wrapper mb-30">
                                <a href="{{ url('/contact') }}" class="theme-btn-1 btn">Contact Us</a>
                            </div>
                            @if (primary_contact_phone() != null)
                                <h3><i class="fas fa-phone"></i> +{{ primary_contact_phone() }}</h3>
                            @endif
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar-area ltn__right-sidebar">
                        @if($banner != null)
                            <!-- Banner Widget -->
                            <div class="widget ltn__banner-widget">
                                <a href="{{ $banner->url }}"><img src="{{ asset('uploads/banner/'.$banner->banner_image) }}" alt="Banner Image"></a>
                            </div>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ AREA START -->
@endsection