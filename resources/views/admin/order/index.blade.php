@extends('layouts.dashboard')


@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Order</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Order</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 order-xl-1 order-2 col-12">
                    <div class="card">
                        <div class="alert alert-success order_alert" style="display: none" role="alert">
                                    
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8">
                                    <h4 class="card-title mb-4">Orders</h4>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <label class="d-block mb-4"><input type="search" class="form-control form-control-sm" id="order_search" name="order_search" placeholder="Search"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="order_sort_btn_wrapper mb-3">
                                        <button id="order_sort_default_btn" class="order_sort_btn btn btn-dark active" data-value="default">All Orders <span class="order_sort_btn_count font-size-12">{{ '('.total_orders_count().')' }}</span></button>
                                        <button id="order_sort_pending_btn" class="order_sort_btn btn btn-warning" data-value="pending">Pending <span class="order_sort_btn_count font-size-12">{{ '('.pending_orders_count().')' }}</span></button>
                                        <button id="order_sort_processing_btn" class="order_sort_btn btn btn-primary" data-value="processing">Processing <span class="order_sort_btn_count font-size-12">{{ '('.processing_orders_count().')' }}</span></button>
                                        <button id="order_sort_delivering_btn" class="order_sort_btn btn btn-info" data-value="delivering">Delivering <span class="order_sort_btn_count font-size-12">{{ '('.delivering_orders_count().')' }}</span></button>
                                        <button id="order_sort_completed_btn" class="order_sort_btn btn btn-success" data-value="completed">Completed <span class="order_sort_btn_count font-size-12">{{ '('.completed_orders_count().')' }}</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" id="orders_table_wrapper">
                                <table id="orders_table" class="table align-middle table-nowrap table-check">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle">Order ID</th>
                                            <th class="align-middle">Billing Name</th>
                                            <th class="align-middle">Billing Email</th>
                                            <th class="align-middle">Total</th>
                                            <th class="align-middle">Payment Status</th>
                                            <th class="align-middle">Payment Method</th>
                                            <th class="align-middle">Order Status</th>
                                            @if (auth()->user()->hasPermissionTo('view-order') || auth()->user()->isSuperAdmin())
                                                <th class="align-middle">View Details</th>
                                            @endif
                                            @if (auth()->user()->hasAnyPermission(['update-order','delete-order','view-order']) || auth()->user()->isSuperAdmin())
                                                <th class="align-middle">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('admin.order.query_data')
                                    </tbody>
                                </table>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                <input type="hidden" name="current_page" id="current_page" value="{{ $orders->currentPage() }}" />
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



    @if (auth()->user()->hasPermissionTo('view-order') || auth()->user()->isSuperAdmin())
        <!-- view order item modal-->
        <div class="modal fade" id="viewOrderItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewOrderItemLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="viewOrderItemLabel">Order Details</h3>
                        <button type="button" class="btn-close close_order_item_view" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('admin.order.order_details')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close_order_item_view" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasPermissionTo('update-order') || auth()->user()->isSuperAdmin())
        <!-- update order modal-->
        <div class="modal fade" id="updateOrderStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateOrderStatusLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="updateOrderStatusLabel">Order Status</h3>
                        <button type="button" class="btn-close close_order_status_update" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Are you sure?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="update_order_status_btn" data-id="">Confirm</button>
                        <button type="button" class="btn btn-secondary close_order_status_update" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasPermissionTo('delete-order') || auth()->user()->isSuperAdmin())
        <!-- delete order modal-->
        <div class="modal fade" id="deleteOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteOrderLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="deleteOrderLabel">Delete Order</h3>
                        <button type="button" class="btn-close close_order_delete" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Are you sure?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete_order" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary close_order_delete" data-bs-dismiss="modal">Cancel</button>
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


            $(document).on('click','.view_order_details_btn', function(e){

                e.preventDefault();

                let order_id = $(this).data('id');
                let url = "{{ route('order.show',':order') }}";
                    url = url.replace(':order',order_id);

                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){
                        $('#viewOrderItem').find('.modal-body').html(data);
                        $('#viewOrderItem').modal('show');
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });


            $('#viewOrderItem').on('hide.bs.modal', function () {
                $('#viewOrderItem').find('.modal-body').html('');
            });


            $(document).on('click','#order_status_btn', function(e){
                e.preventDefault();
                $('#update_order_status_btn').data('id',$(this).data('id'));
            });

            $(document).on('click','#update_order_status_btn', function(e){
                e.preventDefault();

                $('#updateOrderStatus').modal('hide');

                let order_id = $(this).data('id');
                let url = "{{ route('order.status.update',':order') }}";
                    url = url.replace(':order',order_id);

                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#lettuce_dashboard_preloader').removeClass('hide');
                    },
                    success:function(data){
                        if(data.status == 'success'){

                            $('#lettuce_dashboard_preloader').addClass('hide');

                            let order_sort_by = $('.order_sort_btn.active').data('value');
                            let order_query = $('#order_search').val().trim();
                            let page = $('#orders_table_wrapper').find('#current_page').val();
                            $('#hidden_page').val(page);
                            let url = "{{ route('order.search') }}";

                            orderQuery(order_sort_by,order_query,url,page);

                            $.each(data.order_sort_btn_data, function(key,value){
                                $('#'+key).find('.order_sort_btn_count').html(value);
                            });

                            $('#dash_menu_order_btn').load(' #dash_menu_order_btn>* ');
                        }
                    },
                    error:function(){
                        $('#lettuce_dashboard_preloader').addClass('hide');

                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });


            });


            $(document).on('click','.close_order_delete', function(){
                $('#viewOrderItem').find('.modal-body').html('');
            });


            $(document).on('click','#order_delete_btn', function(e){
                e.preventDefault();
                $('#deleteOrder').find('.delete_order').data('id',$(this).data('id'));
            });


            $(document).on('click', '.delete_order', function(e){

                e.preventDefault();

                $('#deleteOrder').modal('hide');
                
                let order_id = $(this).data('id');
                let url = "{{ route('order.destroy', ':order') }}";
                    url = url.replace(':order',order_id);

                $.ajax({
                    type:'DELETE',
                    url:url,
                    success:function(data){

                        if(data.success){

                            let order_sort_by = $('.order_sort_btn.active').data('value');
                            let order_query = $('#order_search').val().trim();
                            let page = $('#orders_table_wrapper').find('#current_page').val();
                            $('#hidden_page').val(page);
                            let url = "{{ route('order.search') }}";
                            
                            orderQuery(order_sort_by,order_query,url,page);

                            $.each(data.order_sort_btn_data, function(key,value){
                                $('#'+key).find('.order_sort_btn_count').html(value);
                            });

                            $('.order_alert').text(data.success).fadeIn().delay(1500).fadeOut();
                            
                            setTimeout(() => {
                                $('.order_alert').text('');
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


            $(document).on('click', '.order_sort_btn', function(e){

                e.preventDefault();

                $('.order_sort_btn').removeClass('active');
                $(this).addClass('active');

                let order_sort_by = $(this).data('value');
                let order_query = $('#order_search').val().trim();
                $('#current_page').val(1);
                let url = "{{ route('order.search') }}";
                
                orderQuery(order_sort_by,order_query,url);
                
            });
            
            
            $(document).on('keyup','#order_search', function(){
                
                let order_sort_by = $('.order_sort_btn.active').data('value');
                let order_query = $(this).val().trim();
                let url = "{{ route('order.search') }}";
                $('#current_page').val(1);
                 
                orderQuery(order_sort_by,order_query,url);

            });

            
            $(document).on('click','.pagination a', function(event){
                
                event.preventDefault();
                
                let order_sort_by = $('.order_sort_btn.active').data('value');
                let order_query = $('#order_search').val().trim();
                let page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                $('#current_page').val(page);
                let url = "{{ route('order.search') }}";
                
                orderQuery(order_sort_by,order_query,url,page);
                
            });


            $(document).on('search','#order_search', function(){
                $('#orders_table_wrapper').load(' #orders_table_wrapper>* ');
            });

            
            function orderQuery(order_sort_by='',order_query='',url,page=''){
                $.ajax({
                    type:'POST',
                    url:url,
                    data:{order_sort_by:order_sort_by,order_query:order_query,page:page},
                    success:function(data){
                        $('#orders_table').find('tbody').html(data);
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