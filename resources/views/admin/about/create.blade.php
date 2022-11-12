@extends('layouts.dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">About</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('about.index') }}">About</a></li>
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

                            <h4 class="mb-4">Create About</h4>

                            <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <div class="mb-3">
                                            <label for="aboutSubTitle">Sub-title:</label>
                                            <input id="aboutSubTitle" name="about_sub_title" type="text" class="form-control" placeholder="Sub-title" value="{{ old('about_sub_title') }}">
                                            @error('about_sub_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="aboutTitle">Title:</label>
                                            <input id="aboutTitle" name="about_title" type="text" class="form-control" placeholder="Title" value="{{ old('about_title') }}">
                                            @error('about_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="aboutDesc_1">Description_1:</label>
                                            <textarea id="aboutDesc_1" name="about_desc_1" type="text" class="form-control" placeholder="Description" cols="30" rows="10">{{ old('about_desc_1') }}</textarea>
                                            @error('about_desc_1')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="aboutDesc_2">Description_2:</label>
                                            <textarea id="aboutDesc_2" name="about_desc_2" type="text" class="form-control" placeholder="Description" cols="30" rows="10">{{ old('about_desc_2') }}</textarea>
                                            @error('about_desc_2')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="aboutAuthorName">Author name:</label>
                                            <input id="aboutAuthorName" name="about_author_name" type="text" class="form-control" placeholder="Author name" value="{{ old('about_author_name') }}">
                                            @error('about_author_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="aboutAuthorTitle">Author Title:</label>
                                            <input id="aboutAuthorTitle" name="about_author_title" type="text" class="form-control" placeholder="Author Title" value="{{ old('about_author_title') }}">
                                            @error('about_author_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-4">
                                            <h6>About Image:</h6>
                                            <div id="about_image_wrapper">
                                                <label for="about_image" id="about_image_label">
                                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                    <h5>click to upload</h5>
                                                </label>
                                                <input name="about_image" type="file" id="about_image" hidden/>
                                            </div>
                                            @error('about_image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="add_about_btn">Create About</button>
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


    

            $(document).on('change','#about_image', function(event){
               let file = event.target.files[0];

               if(file){
                    let reader = new FileReader();

                    reader.onload = function(e){
                        $('#about_image_preview').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(file);

                    if($('#about_image_wrapper').next('a').length < 1  && $('#about_image_wrapper').find('img').length == 0){
                        $('#about_image_wrapper').append('<img id="about_image_preview" src="">');
                        $('#about_image_wrapper').after('<a href="javascript:void(0);" class="btn btn-danger text-capitalize mt-3" id="remove_about_image">remove image</a>');
                    }

                    addPreviewOverlay('#about_image_wrapper','#about_image_label');

               }

            });


            
            $(document).on('click','#remove_about_image', function(event){
                event.preventDefault();
                removeInputPhoto('#about_image','#about_image_wrapper','#remove_about_image','#about_image_label');
            });



        });


    </script>
    
@endsection