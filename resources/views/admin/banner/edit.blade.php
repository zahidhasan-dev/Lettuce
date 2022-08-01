@extends('layouts.dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Banner</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">Banner</a></li>
                                <li class="breadcrumb-item active">Edit Banner</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                            @if (session('success'))
                               <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="row align-items-center mb-4">
                                <div class="col-6">
                                    <h4 class="mb-0">Edit Banner</h4>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:history.back()" class="btn btn-dark float-end"><i class="bx bx-arrow-back"></i> Back</a>
                                </div>
                            </div>

                            <form action="{{ route('banner.update',$banner->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">

                                        <div class="mb-3">
                                            <label class="control-label">Banner Type</label>
                                            <select class="form-control" name="banner_type">
                                                <option selected disabled>Select Type</option>
                                                <option {{ (old('banner_type',$banner->banner_type) == 'hero')?'selected':'' }} value="hero">Hero</option>
                                                <option {{ (old('banner_type',$banner->banner_type) == 'campaign')?'selected':'' }} value="campaign">Campaign</option>
                                            </select>
                                            @error('banner_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="bannerTitle">Banner Title</label>
                                            <input id="bannerTitle" name="banner_title" type="text" class="form-control" placeholder="Banner Title" value="{{ old('banner_title',$banner->banner_title) }}">
                                            @error('banner_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="banner_button_text">Banner Button</label>
                                            <input id="banner_button_text" name="banner_button_text" type="text" class="form-control" placeholder="Button Text" value="{{ old('banner_button_text',$banner->banner_button) }}">
                                            @error('banner_button_text')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="control-label">Category</label>
                                            <select class="form-control text-capitalize" name="banner_category">
                                                <option selected disabled>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option style="font-weight:600;" {{ (old('banner_category', $banner->category_id) == $category->id)?'selected':'' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @if($category->sub_category->count() > 0)
                                                        @foreach ($category->sub_category as $sub_category)
                                                            <option {{ (old('banner_category', $banner->category_id) == $sub_category->id)?'selected':'' }} value="{{ $sub_category->id }}">-- {{ $sub_category->category_name }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('banner_category')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    
                                        <div class="mb-3"  id="discount_select_wrapper">
                                            <label for="">Discount</label>
                                            <select class="form-control" name="banner_discount">
                                                <option selected disabled>Select Discount</option>
                                                @foreach ($discounts as $discount)
                                                    <option {{  old('banner_discount',$banner->discount_id) == $discount->id ? 'selected' : '' }} value="{{ $discount->id }}">{{ $discount->discount_name.' ( '.discountValueType($discount->id).' )' }}</option>
                                                @endforeach
                                            </select>
                                            @error('banner_discount')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="banner_slug">Banner Slug</label>
                                            <input id="banner_slug" name="banner_slug" type="text" class="form-control" placeholder="Banner Slug" value="{{ old('banner_slug',$banner->banner_slug) }}">
                                            @error('banner_slug')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-4">
                                            <h6>Banner Image</h6>
                                            <div id="banner_image_wrapper">
                                                <label for="banner_image" id="banner_image_label" class="{{ $banner->banner_image != null ? 'has_preview' : '' }}">
                                                    @if ($banner->banner_image != null)
                                                        <span class="preview_overlay"></span>
                                                    @endif
                                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                    <h5>click to upload</h5>
                                                </label>
                                                <input name="banner_image" type="file" id="banner_image" value="{{ asset('uploads/banner/'.$banner->banner_image) }}" hidden/>
                                                @if ($banner->banner_image != null)
                                                    <img id="banner_image_preview" src="{{ asset('uploads/banner/'.$banner->banner_image) }}">
                                                @endif
                                            </div>
                                            @error('banner_image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <h6>Status</h6>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="bannerStatusCheck" value="1" name="banner_status" {{ (old('banner_status',$banner->status) == 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bannerStatusCheck">
                                                    Is Active
                                                </label>
                                            </div>
                                            @error('banner_status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update Banner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    

@endsection

 

@section('footer_script')

 
    <script>

        $(document).ready(function()
        {   

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            $(document).on('change','#banner_image', function(event){
               let file = event.target.files[0];

               if(file){
                    let reader = new FileReader();

                    reader.onload = function(e){
                        $('#banner_image_preview').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(file);

                    if($('#banner_image_wrapper').next('a').length < 1){
                        $('#banner_image_wrapper').after('<a href="javascript:void(0);" class="btn btn-danger text-capitalize mt-3" id="remove_banner_image">Cancel</a>');
                    }
                    if($('#banner_image_wrapper').find('img').length == 0){
                        $('#banner_image_wrapper').append('<img id="banner_image_preview" src="">');
                    }

                    addPreviewOverlay('#banner_image_wrapper','#banner_image_label');


               }

            });
            
            $(document).on('click','#remove_banner_image', function(event){
                event.preventDefault();
                $('#banner_image_wrapper').load(' #banner_image_wrapper > * ');
                
                setTimeout(() => {
                    $('#remove_banner_image').remove();
                }, 300);
            });



            function addPreviewOverlay(preview_wrapper,input_label){

                if($(preview_wrapper).children('.has_preview').length == 0){
                    $(input_label).addClass('has_preview');
                    $(preview_wrapper).find('.has_preview').prepend('<span class="preview_overlay"></span>');
                }

            }



        });


    </script>
    
@endsection