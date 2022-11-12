@extends('layouts.dashboard')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Subscribers</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Newsletter</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12 order-xl-1 order-2 col-12">
                <div class="card">
                    <div class="alert alert-success subscriber_alert" style="display: none" role="alert">
                                
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <h4 class="card-title mb-4">Create  Newsletter</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="newsletter_tab_btn_wrapper mb-3">
                                    <span class="newsletter_tab_btn btn btn-primary active" id="newsletter_form_tab_btn" data-target="newsletter_form_wrapper"><i class="mdi mdi-code-tags"></i> HTML</span>
                                    <span class="newsletter_tab_btn btn btn-primary" id="newsletter_preview_tab_btn" data-target="newsletter_preview_wrapper" style="margin:5px"><i class="mdi mdi-eye"></i> Preview</span>
                                    <span class="btn btn-success" id="newsletter_code_run_btn"><i class="mdi mdi-play"></i> Run</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="newsletter_tab_wrapper active" id="newsletter_form_wrapper">
                                    <form id="newsletter_form" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <textarea name="newsletter_code" class="form-control" id="newsletter_code_input" cols="30" rows="30" placeholder="HTML Code"></textarea>
                                            <small class="newsletter_form_error newsletter_code_error text-danger"></small>
                                        </div>
                                        <div class="mb-4">
                                            <label for="">Subject: </label>
                                            <input type="text" id="newsletter_subject" class="form-control" name="newsletter_subject">
                                            <small class="newsletter_form_error newsletter_subject_error text-danger"></small>    
                                        </div>
                                        <div class="mb-4">
                                            <a href="javascript:void(0)" id="newsletter_form_btn" class="btn btn-success newsletter_form_btn_cls">Save and Publish</a>
                                        </div>
                                        <small class="mt-4 newsletter_form_error newsletter_no_subscriber_error text-danger"></small>
                                        <small class="mt-4 newsletter_success_status text-success d-block" style="font-size:14px;"></small>
                                    </form>
                                </div>
                                <div class="newsletter_tab_wrapper" id="newsletter_preview_wrapper">
                                    <div id="newsletter_preview">
                                        <iframe src="{{ route('newsletter.preview') }}" frameborder="0"></iframe>
                                    </div>
                                    <div id="newsletter_preview_preloader">
                                        <h5>Loading...</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->


@endsection


@section('footer_script')


<script>
    
    $(document).ready(function(){
        
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        removeNewsletterPreview();

        function removeNewsletterPreview(){

            let url = "{{ route('newsletter.preview.remove') }}";

            $.ajax({
                type:'POST',
                url:url,
                beforeSend:function(){
                    $('#newsletter_preview_preloader').addClass('active');
                },
                success:function(data){
                    if(data.status == 'success'){

                        setTimeout(() => {
                            $('#newsletter_preview_preloader').removeClass('active');
                        }, 200);

                        $('#newsletter_preview').load(' #newsletter_preview>* ');

                    }
                }
            });

        }


        $(document).on('click','.newsletter_tab_btn', function(e){
            e.preventDefault();
            $('.newsletter_tab_btn').removeClass('active');
            $('.newsletter_tab_wrapper').removeClass('active');
            $(this).addClass('active');
            $('#'+$(this).data('target')).addClass('active');
        });


        $(document).on('click','#newsletter_form_btn', function(e){
            e.preventDefault();
            $('#newsletter_form').submit();
        });


        $(document).on('submit','#newsletter_form',function(e){

            e.preventDefault();

            let formData = $(this).serialize();
            let url = "{{ route('newsletter.send') }}";

            $.ajax({
                type:'POST',
                url:url,
                data:formData,
                beforeSend:function(){
                    $('.newsletter_form_error').html('');
                    $('.newsletter_form_btn_cls').css({'cursor':'not-allowed'});
                    $('#newsletter_form_btn').attr('id','');
                },
                success:function(data){
                    if(data.status == 'validation_error'){
                        $.each(data.errors,function(key,error){
                            $('.'+key+'_error').html(error);
                        });
                    }
                    else if(data.status == 'no_subscriber'){
                        $('.newsletter_no_subscriber_error').html('Subscriber not found!'); 

                        setTimeout(() => {
                            $('.newsletter_no_subscriber_error').html('');                            
                        }, 1500);
                    }
                    else if(data.status == 'success'){
                        $('#newsletter_code_input').val('');
                        $('#newsletter_subject').val('');
                        $('.newsletter_success_status').html('Saved and published successfully!'); 
                        $('#newsletter_preview').load(' #newsletter_preview>* ');
    
                        setTimeout(() => {
                            $('.newsletter_success_status').html('');                            
                        }, 1500);
                    }

                    setTimeout(() => {
                        $('.newsletter_form_btn_cls').attr('id','newsletter_form_btn');
                        $('.newsletter_form_btn_cls').css({'cursor':'pointer'});
                    }, 500);
                },
                error:function(){
                    $('.newsletter_form_btn_cls').attr('id','newsletter_form_btn');
                    $('.newsletter_form_btn_cls').css({'cursor':'pointer'});
                    
                    if(confirm('Something went wrong! Try reloading the page.')){
                        window.location.reload();
                    }
                }
            });

        });


        $(document).on('click','#newsletter_code_run_btn', function(){

            let newsletter_code_input = $('#newsletter_code_input').val();
            let url = "{{ route('newsletter.preview.write') }}";

            $.ajax({
                type:'POST',
                url:url,
                data:{newsletter_code:newsletter_code_input},
                beforeSend:function(){
                    $('#newsletter_preview_preloader').addClass('active');
                },
                success:function(data){
                    if(data.status == 'success'){

                        setTimeout(() => {
                            $('#newsletter_preview_preloader').removeClass('active');
                        }, 200);

                        $('#newsletter_preview').load(' #newsletter_preview>* ');

                    }
                },
                error:function(){
                    if(confirm('Something went wrong! Try reloading the page.')){
                        window.location.reload();
                    }
                }
            });
        });

    });

</script>



@endsection