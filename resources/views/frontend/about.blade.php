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
    <div class="ltn__feature-area pb-90">
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
                        <div class="feature_item ltn__feature-item ltn__feature-item-7">
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


   
@endsection


@section('footer_script')
    
    <script>
        
        window.addEventListener('load', function(){
            adjustElemHeight('.feature_item');
        });


        window.addEventListener('resize', function () {
            adjustElemHeight('.feature_item');
        });

        function adjustElemHeight(elem){
            let elems = [];
            let h_height = 0;

            if(typeof elem === 'string'){
                elems = document.querySelectorAll(elem);
            }
            else if(typeof elem === 'object'){
                elem.forEach(function(el){
                    elems.push(document.querySelector(el));
                });
            }

            elems.forEach(function(elem){
                elem.style = `min-height:${0+"px"}`;

                if(elem.offsetHeight > h_height){
                    h_height = elem.offsetHeight;
                }
            });

            elems.forEach(function(elem){
                elem.style = `min-height:${h_height+"px"}`;
            });
        }

    </script>

@endsection