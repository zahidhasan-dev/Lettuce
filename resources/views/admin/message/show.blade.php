@extends('layouts.dashboard')

@section('message_parent_active')
mm-active
@endsection

@section('message_inbox_active')
active
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Message</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 order-xl-1 order-2 col-12">
                    <div class="card">
                        <div class="alert alert-success contact_alert" style="display: none" role="alert"></div>
                        <div class="card-body">
                            <div id="messages_wrapper">
                                <div class="message_container mb-5">
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0 me-3">
                                            <img class="border rounded-circle avatar-sm" src="{{ asset('dashboard_assets/images/users/avatar-default.png') }}">
                                        </div>
                                        <div class="flex-grow-1">
                                            {{-- <h5 class="font-size-14 mt-1">{{ $message->name }}</h5>
                                            <small class="text-muted">{{ $message->email }}</small> --}}
                                            <h5 class="font-size-14 mt-1">{{ $message->name }}<small class="text-muted"> ({{ $message->email }})</small></h5>
                                            <h6 calss="m-0"><i class="mdi mdi-reply" style="font-size:16px"></i> to me</small></h6>
                                        </div>
                                    </div>
                                    <p style="white-space:break-spaces;" class="mb-5">{{ $message->message }}</p>
                                    <hr>
                                </div>
                                @if($message->replies->count() > 0)
                                    @foreach ($message->replies as $reply)
                                        <div class="message_container mb-5">    
                                            <div class="d-flex mb-4">
                                                <div class="flex-shrink-0 me-3">
                                                    <img class="border rounded-circle avatar-sm" src="{{ asset('dashboard_assets/images/logo-sm.png') }}">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="font-size-14 mt-1">{{ $reply->name }}<small class="text-muted"> ({{ $reply->email }})</small></h5>
                                                    <h6 calss="m-0"><i class="mdi mdi-reply" style="font-size:16px"></i> {{ $message->name }}<small class="text-muted m-0"> ({{ $message->email }})</small></h6>
                                                </div>
                                            </div>
                                            <p style="white-space:break-spaces;" class="mb-5">{{  $reply->message  }}</p>
                                            <hr>
                                        </div>
                                    @endforeach
                                @endif

                                @can('reply-message', $message)    
                                    <a href="javascript: void(0);" class="btn btn-secondary waves-effect" id="message_reply_btn"><i class="mdi mdi-reply"></i> Reply</a>

                                    <div id="reply_message_form_wrapper" class="mt-5">
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0 me-3">
                                                <img class="border rounded-circle avatar-sm" src="{{ asset('dashboard_assets/images/logo-sm.png') }}" alt="Generic placeholder image">
                                            </div>
                                            <div class="flex-grow-1" id="reply_message_form_container">
                                                <h6 calss="m-0"><i class="mdi mdi-reply" style="font-size:16px"></i> {{ $message->name }}<small class="text-muted m-0"> ({{ $message->email }})</small></h6>
                                                <form action="{{ route('admin.message.reply') }}" method="POST" id="reply_message_form">
                                                    @csrf
                                                    <input type="hidden" name="message_id" value="{{ $message->id }}" id="reply_message_id">
                                                    <div class="mb-4">
                                                        <textarea name="reply_message" class="form-control" id="reply_message" cols="30" rows="10"></textarea>
                                                    </div>
                                                    <a href="javascript:void(0);" class="btn btn-secondary reply_message_form_btn reply_message_cancel_btn" id="reply_message_cancel_btn">Cancel</a>
                                                    <button type="submit" class="btn btn-success reply_message_form_btn" id="reply_message_send_btn">Send</button>
                                                    <small class="reply_message_error reply_message_form_error text-danger font-size-12 d-block" style="margin-top:10px"></small>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endcan

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

        $(document).ready(function()
        {   

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).on('click','#message_reply_btn', function(){
                $(this).addClass('hide');
                $('#reply_message_form_wrapper').addClass('show');
            });


            $(document).on('click','#reply_message_cancel_btn', function(){
                $('#message_reply_btn').removeClass('hide');
                $('#reply_message_form_wrapper').removeClass('show');
                $('.reply_message_form_error').html('');
                $('#reply_message').val('');
            });


            $(document).on('submit','#reply_message_form', function(event){

                event.preventDefault();

                $('.reply_message_cancel_btn').attr('id','');
                $('.reply_message_cancel_btn').addClass('disabled');
                $('#reply_message_send_btn').attr('disabled',true);
                $('.reply_message_form_error').html('');

                let formData = $(this).serialize();
                let url = "{{ route('admin.message.reply') }}";

                $.ajax({
                    type:'POST',
                    url:url,
                    data:formData,
                    success:function(data){
                        if(data.status == 'success'){
                            $('#messages_wrapper').load(' #messages_wrapper>* ');
                        }
                    },
                    error:function(error){
                        $('.reply_message_cancel_btn').attr('id','reply_message_cancel_btn');
                        $('.reply_message_cancel_btn').removeClass('disabled');
                        $('#reply_message_send_btn').attr('disabled',false);
                        
                        if(error.status == 422){
                            $.each(error.responseJSON.errors,function(key,value){
                                $('.'+key+'_error').html(value);
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


            
        });
    </script>
    
@endsection




