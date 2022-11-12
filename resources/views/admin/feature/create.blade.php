@extends('layouts.dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Feature</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('feature.index') }}">Feature</a></li>
                                <li class="breadcrumb-item active">Create</li>
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

                            <h4 class="mb-4">Create Feature</h4>

                            <form action="{{ route('feature.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <div class="mb-3">
                                            <label for="featureTitle">Title:</label>
                                            <input id="featureTitle" name="feature_title" type="text" class="form-control" placeholder="Title" value="{{ old('feature_title') }}">
                                            @error('feature_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="featureDesc">Description:</label>
                                            <textarea id="featureDesc" name="feature_desc" type="text" class="form-control" placeholder="Description" cols="30" rows="10">{{ old('feature_desc') }}</textarea>
                                            @error('feature_desc')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-4">
                                            <h6>Feature Image:</h6>
                                            <div id="feature_image_wrapper">
                                                <label for="feature_image" id="feature_image_label">
                                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                    <h5>click to upload</h5>
                                                </label>
                                                <input name="feature_image" type="file" id="feature_image" hidden/>
                                            </div>
                                            @error('feature_image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="add_feature_btn">Create Feature</button>
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


    

            $(document).on('change','#feature_image', function(event){
               let file = event.target.files[0];

               if(file){
                    let reader = new FileReader();

                    reader.onload = function(e){
                        $('#feature_image_preview').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(file);

                    if($('#feature_image_wrapper').next('a').length < 1  && $('#feature_image_wrapper').find('img').length == 0){
                        $('#feature_image_wrapper').append('<img id="feature_image_preview" src="">');
                        $('#feature_image_wrapper').after('<a href="javascript:void(0);" class="btn btn-danger text-capitalize mt-3" id="remove_feature_image">remove image</a>');
                    }

                    addPreviewOverlay('#feature_image_wrapper','#feature_image_label');

               }

            });


            
            $(document).on('click','#remove_feature_image', function(event){
                event.preventDefault();
                removeInputPhoto('#feature_image','#feature_image_wrapper','#remove_feature_image','#feature_image_label');
            });



        });


    </script>
    
@endsection