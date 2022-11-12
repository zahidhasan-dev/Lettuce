@extends('layouts.dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Message</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Message</a></li>
                                <li class="breadcrumb-item active">Trash</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 order-xl-1 order-2 col-12">
                    <div class="card">
                        <div class="alert alert-success message_alert" style="display: none" role="alert">
                                    
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8">
                                    <h4 class="card-title mb-4">Trash</h4>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <label class="d-block mb-4"><input type="search" class="form-control form-control-sm" id="message_search" name="message_search" placeholder="Search"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="message_sort_btn_wrapper mb-3">
                                        <button id="message_sort_default_btn" class="message_sort_btn btn btn-dark active" data-value="">All Message</span></button>
                                        <button id="message_sort_read_message_btn" class="message_sort_btn btn btn-primary" data-value="1">Read Message</button>
                                        <button id="message_sort_unread_message_btn" class="message_sort_btn btn btn-warning" data-value="0">Unread Message</button>
                                        <button id="restore_all_message_btn" class="restore_all_message_btn btn btn-success">Restore All</button>
                                        <button id="delete_all_message_btn" class="delete_all_message_btn btn btn-danger">Delete All</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" id="messages_table_wrapper">
                                <table id="messages_table" class="table nowrap w-100">
                                    <thead>
                                    <tr class="align-top">
                                        <th style="width: 20px;" class="align-middle">
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="checkAllMessage">
                                                <label class="form-check-label" for="checkAllMessage"></label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @include('admin.message.query_data')
                                    </tbody>
                                </table>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                <input type="hidden" name="current_page" id="current_page" value="{{ $messages->currentPage() }}" />
                                <input type="hidden" name="message_status" id="message_status" value="trash">
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->




    <!-- delete message modal -->

    <div class="modal fade" id="deleteMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteMessageLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteMessageLabel">Delete Message</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger modal_delete_message_btn" data-id="">Delete</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- delete all message modal  -->

    <div class="modal fade" id="deleteAllMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteMessageLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteMessageLabel">Delete Message</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger modal_message_delete_all" data-id="">Delete All</button>
                </div>
            </div>
        </div>
    </div>

    <!-- restore message modal -->

    <div class="modal fade" id="restoreMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="restoreMessageLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="restoreMessageLabel">Restore Message</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success modal_restore_message_btn" data-id="">Restore</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- restore all message modal  -->

    <div class="modal fade" id="restoreAllMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="restoreMessageLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="restoreMessageLabel">Restore Message</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success modal_message_restore_all" data-id="">Restore All</button>
                </div>
            </div>
        </div>
    </div>

    

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


            //select all message
            
            checkAllInput('#checkAllMessage','.message_check');


            $(document).on('click', '.message_restore', function(e){
                e.preventDefault();
                $('.modal_restore_message_btn').data('id',$(this).data('id'));
            });


            $(document).on('click','.modal_restore_message_btn', function(e){
                e.preventDefault();

                $('#restoreMessage').modal('hide');

                let message_id = $(this).data('id');
                let url = "{{ route('admin.message.restore',':message') }}";
                url = url.replace(':message',message_id);

                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){
                        if(data.status == 'success'){
                            $('.modal_restore_message_btn').data('id','');

                            let url = "{{ route('admin.message.search') }}";
                            let message_status = $('#message_status').val();
                            let message_sort_by = $('.message_sort_btn.active').data('value');
                            let message_query = $('#message_search').val().trim();
                            let page = $('#messages_table_wrapper').find('#current_page').val();
                            
                            $('#hidden_page').val(page);

                            messageQuery(message_status,message_sort_by,message_query,url,page);

                            $('#dash_menu_inbox_btn').load(' #dash_menu_inbox_btn>* ');

                            $('.message_alert').text('Restored Successfully!').fadeIn().delay(1500).fadeOut();
                            
                            setTimeout(() => {
                                $('.message_alert').text('');
                            }, 2000);
                        }
                    },
                    error:function(error){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });


            $(document).on('click','.message_delete', function(e){
                e.preventDefault();
                $('.modal_delete_message_btn').data('id',$(this).data('id'));
            });


            $(document).on('click','.modal_delete_message_btn', function(e){
                e.preventDefault();

                $('#deleteMessage').modal('hide');

                let message_id = $(this).data('id');
                let url = "{{ route('admin.message.force.destroy',':message') }}";
                url = url.replace(':message',message_id);

                deleteMessage(url);
            });


            $(document).on('click','.modal_message_delete_all', function(e){

                e.preventDefault();

                $('#deleteAllMessage').modal('hide');

                let ids = $(this).data('id');
                let url = "{{ route('admin.message.force.destroy.mass') }}";

                massDeleteMessage(url,ids);

            });


            $(document).on('click','#restore_all_message_btn', function(e){

                e.preventDefault();

                let all_messages = [];

                $('.message_check:checked').each(function(){
                    all_messages.push($(this).val());
                });

                if(all_messages.length != 0){
                    $('#restoreAllMessage').modal('show');
                    $('.modal_message_restore_all').data('id',all_messages);
                }
                else{
                    alert('Please select row!');
                }
            });

            $(document).on('click','.modal_message_restore_all', function(e){
                e.preventDefault();

                $('#restoreAllMessage').modal('hide');

                let ids = $(this).data('id');
                let url = "{{ route('admin.message.restore.mass') }}";

                $.ajax({
                    type:'POST',
                    url:url,
                    data:{ids:ids},
                    success:function(data){
                        if(data.status == 'success'){

                            $('.modal_message_restore_all').data('id','');
                            $('#checkAllMessage').prop('checked',false);

                            let url = "{{ route('admin.message.search') }}";
                            let message_status = $('#message_status').val();
                            let message_sort_by = $('.message_sort_btn.active').data('value');
                            let message_query = $('#message_search').val().trim();
                            let page = $('#messages_table_wrapper').find('#current_page').val();
                            
                            $('#hidden_page').val(page);

                            messageQuery(message_status,message_sort_by,message_query,url,page);

                            $('#dash_menu_inbox_btn').load(' #dash_menu_inbox_btn>* ');

                            $('.message_alert').text('Restored Successfully!').fadeIn().delay(1500).fadeOut();
                            
                            setTimeout(() => {
                                $('.message_alert').text('');
                            }, 2000);

                        }
                    },
                    error:function(error){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
            });

            
        });
    </script>
    
@endsection