@extends('layouts.dashboard')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Logo</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                            <li class="breadcrumb-item active">Logo</li>
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
                        
                        <div id="logo_success_alert" class="alert alert-success fade hide" role="alert" style="width:400px;max-width:100%;"></div>

                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-xl-6">
                                <h4 class="mb-4">Add Logo</h4>
                                <div class="row">
                                    @foreach ($logos as $logo)
                                        <div class="col-sm-6">
                                            <div class="mb-5">
                                                <div id="{{ $logo['type'] }}_logo_wrapper" class="logo_wrapper">
                                                    <h6 class="mb-3">Logo-{{ ucfirst($logo['type']) }} :</h6>
                                                    <form action="javascript:void(0);" method="POST" enctype="multipart/form-data" class="logo_image_form" id="{{ $logo['type'] }}_logo_image_form">
                                                        @csrf
                                                        <div id="{{ $logo['type'] }}_logo_image_wrapper" class="logo_image_wrapper">
                                                            <label for="{{ $logo['type'] }}_logo_image" id="{{ $logo['type'] }}_logo_image_label" class="logo_image_label {{ $logo['id'] != null ? ' has_preview' : '' }}">
                                                                @if($logo['id'] != null)
                                                                    <span class="preview_overlay"></span>
                                                                @endif
                                                                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                                                <h5>click to upload</h5>
                                                            </label>
                                                            <input name="logo_image" type="file" id="{{ $logo['type'] }}_logo_image" class="logo_image" data-type="{{ $logo['type'] }}" hidden/>
                                                            <input type="hidden" name="logo_type" value="{{ $logo['type'] }}" id="{{ $logo['type'] }}_logo_type">
                                                            @if($logo['id'] != null)
                                                                <input type="hidden" name="logo_id" value="{{ $logo['id'] }}" id="{{ $logo['type'] }}_logo_id">
                                                                <img src="{{ asset('uploads/logo/'.$logo['image']) }}" alt="" id="{{ $logo['type'] }}_logo_image_preview" class="logo_image_preview">
                                                            @endif
                                                        </div>
                                                        <small id="{{ $logo['type'] }}_logo_type_error" class="logo_error {{ $logo['type'].'_logo_error' }} text-danger"></small>
                                                        <small id="{{ $logo['type'] }}_logo_image_error" class="logo_error {{ $logo['type'].'_logo_error' }} text-danger"></small>
                                                        <div id="{{ $logo['type'] }}_logo_image_btn_wrapper" class="logo_image_btn_wrapper"></div>
                                                    </form>
                                                    
                                                    @if ($logo['id'] != null)
                                                        <form action="javascript:void(0);" method="POST" id="{{ $logo['type'] }}_logo_image_remove_form" class="logo_image_remove_form" data-id="{{ $logo['id'] }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:void(0);" class="logo_image_remove btn btn-danger text-capitalize mt-3 me-3" id="{{ $logo['type'] }}_logo_image_remove" data-type="{{ $logo['type'] }}">Remove</a>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
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
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).on('change','.logo_image', function(event){
               let file = event.target.files[0];
               let logoType = $(this).data('type');

               if(file){
                    logoPreview(`#${logoType}_logo_image_wrapper`, `#${logoType}_logo_image_preview`, `#${logoType}_logo_image_btn_wrapper`, logoType, file);
                    addPreviewOverlay(`#${logoType}_logo_image_wrapper`,`#${logoType}_logo_image_label`);
               }
            });

            
            $(document).on('click','.logo_image_cancel', function(event){
                event.preventDefault();

                let logoType = $(this).data('type');

                $(`#${logoType}_logo_wrapper`).load(` #${logoType}_logo_wrapper > * `);
            });




            $(document).on('click', '.logo_image_remove', function(event) {
                event.preventDefault();

                let logoType = $(this).data('type');

                $(`#${logoType}_logo_image_remove_form`).submit();
            });



            $(document).on('submit', '.logo_image_remove_form', function(event){
                event.preventDefault();

                let logoType = event.target.id.split('_')[0];
                let formData = $(this).serializeArray();
                let id = $(this).data('id');
                let url = "{{ route('admin.logo.destroy',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'POST',
                    url:url,
                    data:formData,
                    beforeSend:function(){
                        $(`#${logoType}_logo_image_remove`).addClass('disabled');
                        $(`#${logoType}_logo_image_remove`).prop('disabled',true);
                    },
                    success:function(response){
                        if(response.status === 'success'){
                            $(`#${logoType}_logo_wrapper`).load(` #${logoType}_logo_wrapper > * `)
                            showSuccessMessage('#logo_success_alert', response.message, 800);
                        }
                    },
                    error:function(response){
                        $(`#${logoType}_logo_image_remove`).removeClass('disabled');
                        $(`#${logoType}_logo_image_remove`).prop('disabled',false);

                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });



            $(document).on('click', '.logo_image_save', function(event) {
                event.preventDefault();

                let logoType = $(this).data('type');

                $(`#${logoType}_logo_image_form`).submit();
            });


            $(document).on('submit', '.logo_image_form', function(event){
                event.preventDefault();
                
                let logoType = event.target.id.split('_')[0];
                let formData = new FormData($(this)[0]);
                let url = "{{ url('/admin/logo/create-or-update') }}";

                $.ajax({
                    type:'POST',
                    url:url,
                    data:formData,
                    processData: false,
                    contentType: false,
                    beforeSend:function(){
                        $(`.${logoType}_logo_error`).text('');
                        $(`#${logoType}_logo_image_btn_wrapper`).find('a').addClass('disabled');
                        $(`#${logoType}_logo_image_btn_wrapper`).find('a').prop('disabled', true);
                    },
                    success:function(response){
                        if(response.status === 'success'){
                            $(`#${logoType}_logo_wrapper`).load(` #${logoType}_logo_wrapper > * `)
                            showSuccessMessage('#logo_success_alert', response.message, 800);
                        }
                    },
                    error:function(response){

                        $(`#${logoType}_logo_image_btn_wrapper`).find('a').removeClass('disabled');
                        $(`#${logoType}_logo_image_btn_wrapper`).find('a').prop('disabled', false);

                        if(response.status === 422){
                            $.each(response.responseJSON.errors, function(key,value){
                                $(`#${logoType}_${key}_error`).text(value);
                            });
                        }
                        else{
                            if(confirm('Something went wrong! Try reloading the page.')){
                                window.location.reload();
                            }
                        }

                    }
                });

            });



            function showSuccessMessage(elem, message = '', delay = 0, fadeOutDelay = 2000){
                if(delay > 0){
                    fadeOutDelay = fadeOutDelay + delay; 

                    setTimeout(() => {
                        $(elem).text(message);
                        $(elem).addClass('show');
                        $(elem).removeClass('hide');
                    }, delay);
                }
                else{
                    $(elem).text(message);
                    $(elem).addClass('show');
                    $(elem).removeClass('hide');
                }

                setTimeout(() => {
                    $(elem).text('');
                    $(elem).addClass('hide');
                    $(elem).removeClass('show');
                },fadeOutDelay);
            }




            function logoPreview(parentELem, imgElem, btnParentElem, logoType, file){
                $(`#${logoType}_logo_image_remove_form`).remove();

                if($(parentELem).find('img').length == 0){
                    $(parentELem).append('<img id="'+imgElem.substring(1)+'" class="logo_image_preview" src="">');
                }

                if($(btnParentElem).find('a').length < 1){
                    $(btnParentElem).html(
                                        `<a href="javascript:void(0);" class="logo_image_save btn btn-success text-capitalize mt-3 me-2" id="${logoType}_logo_image_save" data-type="${logoType}">Save</a>
                                        <a href="javascript:void(0);" class="logo_image_cancel btn btn-dark text-capitalize mt-3" id="${logoType}_logo_image_cancel" data-type="${logoType}">Cancel</a>`
                                    );
                }

                let reader = new FileReader();

                reader.onload = function(e){
                    $(imgElem).attr('src',e.target.result);
                }

                reader.readAsDataURL(file);
            }


        });




    </script>

@endsection



