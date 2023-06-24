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
                                <li class="breadcrumb-item active">Subscribers</li>
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
                                <div class="col-xs-12 col-sm-8">
                                    <h4 class="card-title mb-4">Subscribers</h4>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <label class="d-block mb-4"><input type="search" class="form-control form-control-sm" id="subscriber_search" name="subscriber_search" placeholder="Search"></label>
                                </div>
                            </div>
                            <div class="table-responsive" id="subscribers_table_wrapper">
                                <table id="subscribers_table" class="table nowrap w-100">
                                    <thead>
                                        <tr class="align-top">
                                            <th>SL NO.</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            @if (auth()->user()->hasAnyPermission(['view-subscriber','delete-subscriber']) || auth()->user()->isSuperAdmin())
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('admin.newsletter.subscriber.query_data')
                                    </tbody>
                                </table>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                <input type="hidden" name="current_page" id="current_page" value="{{ $subscribers->currentPage() }}" />
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @if (auth()->user()->hasPermissionTo('view-subscriber') || auth()->user()->isSuperAdmin())
        <!-- view subscriber modal-->
        <div class="modal fade" id="viewSubscriber" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewSubscriberLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="viewSubscriberLabel">Subscriber Details</h3>
                        <button type="button" class="btn-close close_subscriber_view" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('admin.newsletter.subscriber.subscriber_details')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close_subscriber_view" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasPermissionTo('delete-subscriber') || auth()->user()->isSuperAdmin())
        <!-- delete subscriber modal-->
        <div class="modal fade" id="deleteSubscriber" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteSubscriberLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="deleteSubscriberLabel">Delete Subscriber</h3>
                        <button type="button" class="btn-close close_subscriber_delete" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Are you sure?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete_subscriber" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary close_subscriber_delete" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection


@section('footer_script')
    

    <script>

        $(document).ready(function(){

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).on('click','#subscriber_show_btn', function(e){

                e.preventDefault();

                let subscriber_id = $(this).data('id');
                let url = "{{ route('newsletter.subscriber.show',':subscriber_id') }}";
                    url = url.replace(':subscriber_id',subscriber_id);

                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){
                        $('#viewSubscriber').find('.modal-body').html(data);
                        $('#viewSubscriber').modal('show');
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });


            $(document).on('click','.close_subscriber_view', function(){
                $('#viewSubscriber').find('.modal-body').html('');
            });


            $('#viewSubscriber').on('hide.bs.modal', function () {
                $('#viewSubscriber').find('.modal-body').html('');
            });


            $(document).on('click','.delete_subscriber_btn', function(e){
                e.preventDefault();
                $('#deleteSubscriber').find('.delete_subscriber').data('id',$(this).data('id'));
            });


            $(document).on('click', '.delete_subscriber', function(e){

                e.preventDefault();

                $('#deleteSubscriber').modal('hide');
                
                let subscriber_id = $(this).data('id');
                let url = "{{ route('newsletter.subscriber.delete', ':subscriber_id') }}";
                    url = url.replace(':subscriber_id',subscriber_id);

                $.ajax({
                    type:'DELETE',
                    url:url,
                    success:function(data){

                        if(data.success){
                            
                            let subscriber_query = $('#subscriber_search').val().trim();
                            let page = $('#subscribers_table_wrapper').find('#current_page').val();
                            $('#hidden_page').val(page);
                            let url = "{{ route('subscriber.search') }}";
                            
                            subscriberQuery(subscriber_query,url,page);

                            $('.subscriber_alert').text(data.success).fadeIn().delay(1500).fadeOut();
                            
                            setTimeout(() => {
                                $('.subscriber_alert').text('');
                            }, 2000);

                        }


                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
                
            });


            $(document).on('keyup','#subscriber_search', function(){

                let subscriber_query = $(this).val().trim();
                let url = "{{ route('subscriber.search') }}";
                $('#current_page').val(1);
                 
                subscriberQuery(subscriber_query,url);

            });

            
            $(document).on('click','.pagination a', function(event){
                
                event.preventDefault();
                
                let subscriber_query = $('#subscriber_search').val().trim();
                let page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                $('#current_page').val(page);
                let url = "{{ route('subscriber.search') }}";
                
                subscriberQuery(subscriber_query,url,page);
                
            });


            $(document).on('search','#subscriber_search', function(){
                
                $('#subscribers_table_wrapper').load(' #subscribers_table_wrapper>* ');
                
            });

            
            function subscriberQuery(subscriber_query='',url,page=''){
                $.ajax({
                    type:'POST',
                    url:url,
                    data:{subscriber_query:subscriber_query,page:page},
                    success:function(data){
                        $('#subscribers_table').find('tbody').html(data);
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
            }


        });

    </script>


@endsection