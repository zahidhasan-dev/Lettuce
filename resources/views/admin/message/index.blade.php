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
                                <li class="breadcrumb-item active">Inbox</li>
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
                                    <h4 class="card-title mb-4">Messages</h4>
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
                                        @can('mass-destroy', \App\Models\Message::class)
                                            <button id="delete_all_message_btn" class="delete_all_message_btn btn btn-danger">Delete All</button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" id="messages_table_wrapper">
                                <table id="messages_table" class="table nowrap w-100">
                                    <thead>
                                    <tr class="align-top">
                                        @can('mass-destroy', \App\Models\Message::class)
                                            <th style="width: 20px;" class="align-middle">
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="checkAllMessage">
                                                </div>
                                            </th>
                                        @endcan
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        @if (auth()->user()->hasAnyPermission(['view-message','delete-message']) || auth()->user()->isSuperAdmin())
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @include('admin.message.query_data')
                                    </tbody>
                                </table>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                <input type="hidden" name="current_page" id="current_page" value="{{ $messages->currentPage() }}" />
                                <input type="hidden" name="message_status" id="message_status" value="inbox">
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



    @if (auth()->user()->hasPermissionTo('delete-message') || auth()->user()->isSuperAdmin())
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
    @endif

    @can('mass-destroy', \App\Models\Message::class)
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
    @endcan

    
    
    

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


            $(document).on('click','.message_delete', function(e){
                e.preventDefault();
                $('.modal_delete_message_btn').data('id',$(this).data('id'));
            });
            

            $(document).on('click','.modal_delete_message_btn', function(e){
                e.preventDefault();

                $('#deleteMessage').modal('hide');

                let message_id = $(this).data('id');
                let url = "{{ route('admin.message.destroy',':message') }}";
                url = url.replace(':message',message_id);

                deleteMessage(url);

                $('#dash_menu_inbox_btn').load(' #dash_menu_inbox_btn>* ');
            });
            

            $(document).on('click','.modal_message_delete_all', function(e){

                e.preventDefault();

                $('#deleteAllMessage').modal('hide');

                let ids = $(this).data('id');
                let url = "{{ route('admin.message.destroy.mass') }}";

                massDeleteMessage(url,ids);

                $('#dash_menu_inbox_btn').load(' #dash_menu_inbox_btn>* ');

            });

            
        });
    </script>
    
@endsection