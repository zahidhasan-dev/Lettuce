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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8">
                                    <h4 class="card-title mb-4">Products</h4>
                                </div>
                            </div>
                            <div class="table-responsive" id="products_table_wrapper">
                                <table id="products_table" class="table nowrap w-100">
                                    <thead>
                                        <tr class="align-top">
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

    

@endsection

 

@section('footer_script')
 
    <script>

        $(document).ready(function()
        {   

            $("#products_table").DataTable({
                columnDefs: [
                    { orderable: false, targets: [0,3,4,6,7,8,9,10] }
                ],
                order: [[1, 'asc']]
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
                    type:'POST',
                    url:url,
                    success:function(data){
                        $('.product_alert').text(data.success);
                        $('.product_alert').delay(100).fadeIn();
                        $('.product_alert').delay(800).fadeOut();
                    },
                    error:function(){
                        alert('Something went wrong!');
                    }
                });

            });


            $(document).on('click','.switchProductstatus', function(){

                let id = $(this).data('id');
                let url = "{{ route('product.status.update',':id') }}";
                    url = url.replace(':id',id);
                $.ajax({
                    type:'POST',
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



        });
    </script>
    
@endsection