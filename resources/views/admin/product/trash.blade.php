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
                                <li class="breadcrumb-item active">Trash</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class=" col-12">
                    <div class="card">
                        <div class="alert alert-success product_alert" style="display: none" role="alert">
                                    
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-xs-12 col-sm-6">
                                    <h4 class="card-title mb-4">Trash</h4>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="product_table_btn_wrapper">
                                        @can('product-force-delete-all', \App\Models\Product::class)                                            
                                            <button type="button" class="btn btn-danger waves-effect waves-light me-2 product_force_delete_all" >Delete All</button>
                                        @endcan
                                        @can('product-restore-all', \App\Models\Product::class)                                            
                                            <button type="button" class="btn btn-success waves-effect waves-light me-2 product_restore_all" >Restore All</button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" id="products_table_wrapper">
                                <table id="products_trash_table" class="table nowrap w-100">
                                    <thead>
                                        <tr class="align-top">
                                            @canany(['product-force-delete-all','product-restore-all'], \App\Models\Product::class)
                                                <th>
                                                    <div class="form-check font-size-16">
                                                        <input class="form-check-input" type="checkbox" id="checkAllProduct">
                                                        <label class="form-check-label" for="checkAllProduct"></label>
                                                    </div>
                                                </th>
                                            @endcanany
                                            <th>Thumbnail</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Slug</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>In Stock</th>
                                            <th>Discount</th>
                                            @if (auth()->user()->hasAnyPermission('delete-product')  || auth()->user()->isSuperAdmin())
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('admin.product.trashed_data')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @if(auth()->user()->hasPermissionTo('delete-product') || auth()->user()->isSuperAdmin())
        <!-- delete product modal -->
        <div class="modal fade" id="forceDeleteProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forceDeleteProductLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="forceDeleteProductLabel">Delete Product</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">ifcel</button>
                        <button type="button" class="btn btn-danger product_force_delete_modal" data-id="">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @can('product-force-delete-all', \App\Models\Product::class)
        <!-- delete all product modal-->
        <div class="modal fade" id="forceDeleteAllProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteProductLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="deleteProductLabel">Delete Product</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger product_force_delete_all_modal" data-id="">Delete All</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @if(auth()->user()->hasPermissionTo('delete-product') || auth()->user()->isSuperAdmin())
        <!--  product restore modal -->
        <div class="modal fade" id="restoreProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="restoreProductLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="restoreProductLabel">Restore Product</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success product_restore_modal" data-id="">Restore</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    @can('product-restore-all', \App\Models\Product::class)
        <!-- restore all product modal-->
        <div class="modal fade" id="restoreAllProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="restoreAllProductLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="restoreAllProductLabel">Restore All Product</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success product_restore_all_modal" data-id="">Restore</button>
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

            $("#products_trash_table").DataTable({
                @if (auth()->user()->hasPermissionTo('delete-product')  || auth()->user()->isSuperAdmin())
                    columnDefs: [
                        { orderable: false, targets: [0,1,4,5,7,8,9] }
                    ],
                    order: [[2, 'asc']]
                @else
                    columnDefs: [
                        { orderable: false, targets: [0,3,4,6,7] }
                    ],
                    order: [[1, 'asc']]
                @endif
            });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).on('click','.product_force_delete', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                $('.product_force_delete_modal').data('id',id);
            });

            $(document).on('click','.product_force_delete_modal', function(){
                let id = $(this).data('id');
                $('#product_force_delete_form_'+id).submit();
            });



            $(document).on('click','#checkAllProduct', function(){
                $('.product_check').not(this).prop('checked',this.checked);
            });

            $(document).on('click','.product_check', function(){
                if($(this).prop('checked') === false){
                    $('#checkAllProduct').prop('checked',false);
                }
            });


            $(document).on('click','.product_force_delete_all', function(event){
                event.preventDefault();
                let all_products = [];

                $('.product_check:checked').each(function(){
                    all_products.push($(this).val());
                });

                if(all_products.length > 0){
                    $('#forceDeleteAllProduct').modal('show');
                    $('.product_force_delete_all_modal').data('id',all_products);
                }
                else{
                    alert('Please select a row!');
                }
            });


            $(document).on('click','.product_force_delete_all_modal', function(){
                let ids = $(this).data('id');
                let url = "{{ route('product.forcedeleteall') }}";

                $.ajax({
                    type:'POST',
                    url:url,
                    data:{ids:ids},
                    success:function(){
                        location.reload();
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });



            $(document).on('click','.product_restore', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                $('.product_restore_modal').data('id',id);
            });

            $(document).on('click','.product_restore_modal', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                let url = "{{ route('product.restore',':id') }}";
                    url = url.replace(':id',id);
                
                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(){
                        window.location.reload();
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
            });


            $(document).on('click','.product_restore_all', function(event){
                event.preventDefault();
                let all_products = [];
                $('.product_check:checked').each(function(){
                    all_products.push($(this).val());
                });


                if(all_products.length > 0){
                    $('#restoreAllProduct').modal('show');
                    $('.product_restore_all_modal').data('id',all_products);
                }
                else{
                    alert('Please select a row!')
                }
            });

            $(document).on('click','.product_restore_all_modal', function(event){
                event.preventDefault();
                let ids  = $(this).data('id');
                let url = "{{ route('product.restoreall') }}";
                
                $.ajax({
                    type:'POST',
                    url:url,
                    data:{ids:ids},
                    success:function(data){
                        location.reload();
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