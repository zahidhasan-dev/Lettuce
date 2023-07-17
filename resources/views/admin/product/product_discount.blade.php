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
                                <li class="breadcrumb-item active">Discount</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                @can('create-product-discount', \App\Models\product::class)
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">Add Discount</h4>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                           
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="info_form">
                                <form action="{{ route('product.discount.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <label class="control-label">Discount</label>
                                                <select class="form-control text-capitalize" id="product_discount" name="product_discount">
                                                    <option selected value="">Select Discount</option>
                                                    @foreach ($discounts as $discount)
                                                        <option style="font-weight:600;" {{ (old('product_discount') == $discount->id)?'selected':'' }} value="{{ $discount->id }}">{{ $discount->discount_name.' ( '.discountValueType($discount->id).' )' }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_discount')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mt-4">
                                                <label class="control-label">Product Category</label>
                                                <select class="form-control text-capitalize" id="discount_product_category" name="product_category">
                                                    <option selected value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option style="font-weight:600;" {{ (old('product_category') == $category->id)?'selected':'' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                        @if($category->sub_category->count() > 0)
                                                            @foreach ($category->sub_category as $sub_category)
                                                                <option {{ (old('product_category') == $sub_category->id)?'selected':'' }} value="{{ $sub_category->id }}">-- {{ $sub_category->category_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('product_category')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mt-4" id="product_select_wrapper">
                                                <label class="control-label">Select Product</label>
                                                <select class="select2 form-control select2-multiple select_product" name="product_id[]" multiple="multiple" data-placeholder="Choose ...">
                                                    @foreach ($products as $product)
                                                        <option {{ (in_array($product->id, old('product_id', []))) ? 'selected' : '' }} value="{{ $product->id }}" data-image="{{ asset('uploads/product/'.$product->thumbnail) }}">{{ $product->product_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        @error('country_name')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-md">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
                @endcan


                <div class="ccol-12">
                    <div class="card">
                        <div class="alert alert-success product_discount_alert" style="display: none" role="alert">
                                    
                        </div>
                        @if (session('product_discount_delete'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('product_discount_delete') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            <h4 class="card-title mb-4">Product Discount</h4>
                            <div class="table-responsive">
                                <table id="product_discounts_table" class="table nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>SL NO.</th>
                                        <th>Product</th>
                                        <th>Discount Price</th>
                                        <th>Discount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($product_discounts as $index => $product_discount)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/product/'.$product_discount->thumbnail) }}" width="50px"> 
                                                    {{ $product_discount->product_name.' '.productSize($product_discount->id).' ( '.'$'.round($product_discount->price / 100,2).' )' }}
                                                </td>
                                                <td>
                                                    {{ discountPrice($product_discount->id) }}
                                                </td>
                                                <td id="product_discount_col_{{  $product_discount->id }}" data-id="{{ $product_discount->product_discount->discount_id }}">
                                                    {{ $product_discount->product_discount->discount->discount_name.' ( '.discountValueType($product_discount->product_discount->discount_id).' )' }}
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        @can('create-product-discount', \App\Models\Product::class)
                                                        <a href="javascript:void(0);" class="text-success edit_product_discount" data-id="{{ $product_discount->id }}" >
                                                            <i class="mdi mdi-pencil font-size-20"></i>
                                                        </a>
                                                        @endcan
                                                        @can('delete-product-discount', \App\Models\Product::class)
                                                        <a href="javascript:void(0);" class="text-danger product_discount_delete" data-id="{{ $product_discount->id }}" data-bs-toggle="modal" data-bs-target="#deleteProductDiscount">
                                                            <i class="mdi mdi-delete font-size-20"></i>
                                                        </a>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="5">No data available!</td>
                                            </tr>
                                        @endforelse
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


    <!-- delete product disocunt modal -->

    <div class="modal fade" id="deleteProductDiscount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteProductDiscountLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteProductDiscountLabel">Delete Product Discount</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger product_discount_delete_modal" data-id="">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('footer_script')
 
    <script src="{{ asset('dashboard_assets/libs/select2/js/select2.min.js') }}"></script>

    <script>


        $(document).ready(function(){ 
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            @if ($product_discounts->count() > 0)
                product_discounts_datatable();
            @endif

            function product_discounts_datatable(){
                $('#product_discounts_table').DataTable({
                    columnDefs: [
                        { orderable: false, targets: [4] }
                    ],
                    order: [[0, 'asc']]
                });
            }
            
            @if(auth()->user()->isSuperAdmin() || auth()->user()->hasPermissionTo('create-product-discount'))
                $(".select_product").select2({
                    templateResult: formatState,
                    templateSelection: formatState
                });

                function formatState (opt) {

                    if (!opt.id) {
                        return opt.text;
                    } 

                    var optimage = $(opt.element).attr('data-image'); 

                    if(!optimage){
                        return opt.text;
                    } 
                    else{  
                        var $opt = $('<span><img src="' + optimage + '" width="50px" /> ' + opt.text + '</span>');
                        return $opt;
                    }

                };
                
            

                function get_products_by_category(category_id){

                    let id = category_id;
                    let url = "{{ route('category.products') }}";

                    $.ajax({
                        type:'GET',
                        url:url,
                        data:{category_id:id},
                        success:function(data)
                        {
                            if(data.null_category === 'null'){
                                $('.select_product').load(' .select_product > * ');
                            }
                            else{
                                $('.select_product').html(data);
                            }
                            
                        },
                        error:function(response){
                            if(confirm('Something went wrong! Try reloading the page.')){
                                window.location.reload();
                            }
                        }
                    });

                }


                $('#discount_product_category').on('change',function(){
                    let id = $(this).val();
                    get_products_by_category(id);
                });

            
                (function update_product_discount_inline(){

                    $(document).on('click','.edit_product_discount', function(event){
                        event.preventDefault();

                        $(this).addClass('update_product_discount').removeClass('edit_product_discount')
                        $(this).find('i').addClass('mdi-content-save').removeClass('mdi-pencil');

                        let product_id = $(this).data('id');
                        let discount_col = $('#product_discount_col_'+product_id);
                        let discount_id = discount_col.data('id');
                        let url = "{{ route('product.discount.edit',':id') }}";
                            url = url.replace(':id',discount_id);

                        $.ajax({
                            type:'GET',
                            url:url,
                            success:function(data){
                                discount_col.html('<select class="form-control text-capitalize" name="product_discount_edit">'+data+'</select>');
                            },
                            error:function(){
                                if(confirm('Something went wrong! Try reloading the page.')){
                                    window.location.reload();
                                }
                            }
                        });

                    });


                    $(document).on('click','.update_product_discount', function(event){
                        event.preventDefault();

                        $(this).addClass('edit_product_discount').removeClass('update_product_discount')
                        $(this).find('i').addClass('mdi-pencil').removeClass('content-save');

                        let product_id = $(this).data('id');
                        let discount_col = $('#product_discount_col_'+product_id);
                        let discount_id = discount_col.find('select option:selected').val();
                        let url = "{{ route('product.discount.update',':id') }}";
                            url = url.replace(':id',product_id);
                            
                        $.ajax({
                            type:'POST',
                            url:url,
                            data:{discount_id:discount_id},
                            success:function(data){

                                discount_col.html(data);
                                discount_col.data('id',discount_id);

                                $('.product_discount_alert').html('Updated!');
                                $('.product_discount_alert').fadeIn('slow').delay(500).fadeOut('slow');
                                
                            },
                            error:function(){
                                if(confirm('Something went wrong! Try reloading the page.')){
                                    window.location.reload();
                                }
                            }
                        });

                    });

                })();
            @endif

            @if(auth()->user()->isSuperAdmin() || auth()->user()->hasPermissionTo('delete-product-discount'))
                $(document).on('click','.product_discount_delete',function(event){
                    event.preventDefault();
                    $('.product_discount_delete_modal').data('id',$(this).data('id'));
                    delete_product_discount();
                });


                function delete_product_discount(){
                    $(document).on('click','.product_discount_delete_modal', function(event){
                        event.preventDefault();

                        let id = $(this).data('id');
                        let url = "{{ route('product.discount.delete',':id') }}";
                            url = url.replace(':id',id);

                        $('#deleteProductDiscount').modal('hide');
                            
                        $.ajax({
                            type:'DELETE',
                            url:url,
                            success:function(data){
                                window.location.reload();
                            },
                            error:function(){
                                if(confirm('Something went wrong! Try reloading the page.')){
                                    window.location.reload();
                                }
                            }
                        });

                    });
                };
            @endif
        

        });



    </script>
    
@endsection