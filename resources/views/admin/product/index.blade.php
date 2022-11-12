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
                                <li class="breadcrumb-item active">Product</li>
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
                                    <h4 class="card-title mb-4">Products</h4>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="product_table_btn_wrapper">
                                        <button type="button" class="btn btn-danger waves-effect waves-light me-2 product_delete_all" >Delete All</button>
                                        <a href="{{ route('product.create') }}" class="btn btn-primary">Add New Product</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" id="products_table_wrapper">
                                <table id="products_table" class="table nowrap w-100">
                                    <thead>
                                        <tr class="align-top">
                                            <th>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="checkAllProduct">
                                                    <label class="form-check-label" for="checkAllProduct"></label>
                                                </div>
                                            </th>
                                            <th>Thumbnail</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Slug</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>In Stock</th>
                                            <th>Discount</th>
                                            <th>Featured</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('admin.product.query_data')
                                    </tbody>
                                </table>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <!-- delete category modal -->

    <div class="modal fade" id="deleteProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteProductLabel" aria-modal="true" role="dialog">
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
                    <button type="button" class="btn btn-danger product_delete_modal" data-id="">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAllProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteProductLabel" aria-modal="true" role="dialog">
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
                    <button type="button" class="btn btn-danger product_delete_all_modal" data-id="">Delete All</button>
                </div>
            </div>
        </div>
    </div>

    

@endsection

 

@section('footer_script')
 
    <script>

        $(document).ready(function()
        {   

            $("#products_table").DataTable({
                columnDefs: [
                    { orderable: false, targets: [0,1,4,5,7,8,9,10,11] }
                ],
                order: [[2, 'asc']]
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            $(document).on('click','.productFeaturedUpdate', function(){

                let id = $(this).data('id');
                let url = "{{ route('product.feature.update',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){
                        $('.product_alert').text(data.success);
                        $('.product_alert').delay(100).fadeIn();
                        $('.product_alert').delay(800).fadeOut();
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });


            $(document).on('click','.switchProductstatus', function(){

                let id = $(this).data('id');
                let url = "{{ route('product.status.update',':id') }}";
                    url = url.replace(':id',id);
                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){
                        $('.product_alert').text(data.success);
                        $('.product_alert').delay(100).fadeIn();
                        $('.product_alert').delay(800).fadeOut();
                    },
                    error:function(){
                        alert("Something went wrong!");
                    }
                });

            });



            $(document).on('click','.product_delete', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                $('.product_delete_modal').data('id',id);
            });

            $(document).on('click','.product_delete_modal', function(){
                let id = $(this).data('id');
                $('#product_delete_form_'+id).submit();
            });



            $(document).on('click','#checkAllProduct', function(){
                $('.product_check').not(this).prop('checked',this.checked);
            });


            $(document).on('click','.product_check', function(){
                if($(this).prop('checked') === false){
                    $('#checkAllProduct').prop('checked',false);
                }
            });


            $(document).on('click','.product_delete_all', function(event){
                event.preventDefault();
                let all_products = [];

                $('.product_check:checked').each(function(){
                    all_products.push($(this).val());
                });

                if(all_products.length != 0){
                    $('#deleteAllProduct').modal('show');
                    $('.product_delete_all_modal').data('id',all_products);
                }
                else{
                    alert('Please select a row!');
                }
            });


            $(document).on('click','.product_delete_all_modal', function(){
                let ids = $(this).data('id');
                let url = "{{ route('product.deleteall') }}";

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


        });
    </script>
    
@endsection