@extends('layouts.dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Product</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                                <li class="breadcrumb-item active">Add Product</li>
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

                            <h4 class="mb-4">Add Product</h4>

                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="control-label">Product Category</label>
                                            <select class="form-control text-capitalize" name="product_category">
                                                <option selected disabled>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option style="font-weight:600;" {{ (old('product_category') == $category->id)?'selected':'' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @if($category->sub_category->count() > 0)
                                                        @foreach ($category->sub_category as $sub_category)
                                                            <option {{ (old('product_category') == $sub_category->id)?'selected':'' }} value="{{ $sub_category->id }}">-- {{ $sub_category->category_name }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('product_category')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="productName">Product Name</label>
                                            <input id="productName" name="product_name" type="text" class="form-control" placeholder="Product Name" value="{{ old('product_name') }}">
                                            @error('product_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Scale</label>
                                            <select class="form-control" name="product_scale">
                                                <option selected disabled>Select Scale</option>
                                                @foreach ($sizes as $size)
                                                    <option {{ (old('product_scale') == $size->id)?'selected':'' }} value="{{ $size->id }}">{{ $size->scale_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_scale')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="size_value">Size Value</label>
                                            <input id="size_value" name="size_value" type="number" min="0" class="form-control" placeholder="Size Value" value="{{ old('size_value') }}">
                                            @error('size_value')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="price">Price</label>
                                            <input id="price" name="price" type="number" min="0" step="any" class="form-control" placeholder="Price" value="{{ old('price') }}">
                                            @error('price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="stock">Stock</label>
                                            <input id="stock" name="stock" type="number" min="0" class="form-control" placeholder="Stock" value="{{ old('stock') }}">
                                            @error('stock')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    
                                    </div>

                                    <div class="col-sm-6">
                                        
                                        <div class="mb-3">
                                            <label for="productDesc">Product Description</label>
                                            <textarea class="form-control" id="productDesc" rows="5" placeholder="Product Description" name="product_desc">{{ old('product_desc') }}</textarea>
                                            @error('product_desc')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="hasDiscountCheck" value="1" name="product_has_discount" {{ old('product_has_discount') == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hasDiscountCheck">
                                                    Has Discount
                                                </label>
                                            </div>
                                            @error('product_has_discount')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3"  id="discount_select_wrapper" style="{{ old('product_has_discount') == 1 ? 'display:block;' :'display:none;' }}">
                                            <select class="form-control" name="product_discount">
                                                <option selected disabled>Select Discount</option>
                                                @foreach ($discounts as $discount)
                                                    <option {{ (old('product_has_discount') == 1 && old('product_discount') == $discount->id)?'selected':'' }} value="{{ $discount->id }}">{{ $discount->discount_name.' ( '.discountValueType($discount->id).' )' }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_discount')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="featuredCheck" value="1" name="product_featured">
                                                <label class="form-check-label" for="featuredCheck">
                                                    Is Featured
                                                </label>
                                            </div>
                                            @error('product_featured')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="productStatusCheck" value="1" name="product_status">
                                                <label class="form-check-label" for="productStatusCheck">
                                                    Is Active
                                                </label>
                                            </div>
                                            @error('product_status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h4 class="card-title mb-3">Product Images</h4>

                                        <div class="mb-4">
                                            <h6>Thumbnail</h6>
                                            <div id="product_thumbnail_wrapper">
                                                <label for="product_thumbnail" id="product_thumbnail_label">
                                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                    <h5>click to upload</h5>
                                                </label>
                                                <input name="product_thumbnail" type="file" id="product_thumbnail" hidden/>
                                            </div>
                                            @error('product_thumbnail')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <h6>Multiple Photos</h6>
                                            <div class="product_multiple_photo_wrapper">
                                                <label for="product_multiple_photo" id="product_multiple_photo_label">
                                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                    <h5>click to upload</h5>
                                                </label>
                                                <input name="product_multiple_photo[]" type="file" id="product_multiple_photo" multiple hidden/>
                                                <div class="multiple_img_preview">
                                                </div>
                                            </div>
                                            @error('product_multiple_photo.*')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Product</button>
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


    function toggleDiscountSelect(){

        let discount_select_box = document.getElementById('discount_select_wrapper');
        let discount_checkbox = document.getElementById('hasDiscountCheck');

        if(discount_checkbox.checked === true ){
            discount_select_box.style.display = 'block';
        }
        else{
            discount_select_box.style.display = 'none';
        }

    }

    document.getElementById('hasDiscountCheck').addEventListener('change',function(){
        toggleDiscountSelect();
    });


        $(document).ready(function(){   


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            $(document).on('change','#product_thumbnail', function(event){
               let file = event.target.files[0];

               if(file){
                    let reader = new FileReader();

                    reader.onload = function(e){
                        $('#product_thumbnail_preview').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(file);

                    if($('#product_thumbnail_wrapper').next('a').length < 1  && $('#product_thumbnail_wrapper').find('img').length == 0){
                        $('#product_thumbnail_wrapper').append('<img id="product_thumbnail_preview" src="">');
                        $('#product_thumbnail_wrapper').after('<a href="javascript:void(0);" class="btn btn-danger text-capitalize mt-3" id="remove_product_thumbnail">remove thumbnail</a>');
                    }

                    addPreviewOverlay('#product_thumbnail_wrapper','#product_thumbnail_label');


               }

            });
            
            
            $(document).on('click','#remove_product_thumbnail', function(event){
                event.preventDefault();
                removeInputPhoto('#product_thumbnail','#product_thumbnail_wrapper','#remove_product_thumbnail','#product_thumbnail_label');
            });


            $(function() {
                let imagesPreview = function(input, placeToInsertImagePreview){
                    if (input.files){
                        let filesAmount = input.files.length;
                        for (i = 0; i < filesAmount; i++){
                            let reader = new FileReader();
                            reader.onload = function(event){
                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                            }
                            reader.readAsDataURL(input.files[i]);
                        }
                    }
                };

                $('#product_multiple_photo').on('change', function() {
                    imagesPreview(this, 'div.multiple_img_preview');

                    if(this.files.length > 0 && $('.product_multiple_photo_wrapper').next('a').length < 1){ 
                        $('.product_multiple_photo_wrapper').after('<a href="javascript:void(0);" id="remove_multiple_photo" class="btn btn-danger text-capitalize mt-3">remove photos</a>');
                    }

                    addPreviewOverlay('.product_multiple_photo_wrapper','#product_multiple_photo_label');

                });
            });


            $(document).on('click','#remove_multiple_photo', function(event){
                event.preventDefault();
                removeInputPhoto('#product_multiple_photo','.multiple_img_preview','#remove_multiple_photo','#product_multiple_photo_label');
            });


            function removeInputPhoto(input,preview_wrapper,remove_btn,remove_overlay){
                $(input).val('');
                $(preview_wrapper).find('img').remove();
                $(remove_overlay).removeClass('has_preview');
                $(remove_overlay).find('.preview_overlay').remove();
                $(remove_btn).remove();
            }


            function addPreviewOverlay(preview_wrapper,input_label){
                if($(preview_wrapper).children('.has_preview').length == 0){
                    $(input_label).addClass('has_preview');
                    $(preview_wrapper).find('.has_preview').prepend('<span class="preview_overlay"></span>');
                }
            }



        });
    </script>
    
@endsection