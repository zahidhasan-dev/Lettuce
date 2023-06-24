@extends('layouts.dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Offer</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Offer</a></li>
                                <li class="breadcrumb-item active">Discount</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="{{ auth()->user()->can('create', \App\Models\Discount::class) ? 'col-xxl-9' : 'col-xxl-12' }} order-xxl-1 order-2 col-12">
                    <div class="card">
                        <div class="alert alert-success discount_alert" style="display: none" role="alert">
                                    
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8">
                                    <h4 class="card-title mb-4">Discounts</h4>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <label class="d-block mb-4"><input type="search" class="form-control form-control-sm" id="discount_search" name="discount_search" placeholder="Search"></label>
                                </div>
                            </div>
                            <div class="table-responsive" id="discounts_table_wrapper">
                                <table id="discounts_table" class="table nowrap w-100">
                                    <thead>
                                    <tr class="align-top">
                                        <th>SL NO.</th>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Type</th>
                                        <th>Slug</th>
                                        <th>Validity</th>
                                        <th>Status</th>
                                        @if (auth()->user()->hasAnyPermission(['update-discount','delete-discount']) || auth()->user()->isSuperAdmin())
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @include('admin.offers.discount.query_data')
                                    </tbody>
                                </table>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
                @can('create', \App\Models\Discount::class)
                    <div class="col-xxl-3 order-xxl-2 order-1 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">Add discount</h4>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="info_form">
                                    <form action="{{ route('discount.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mt-4">
                                                    <label for="discount-type-input" class="form-label">Discount Type :</label>
                                                    <select class="form-control" id="discount-type-input" name="discount_type" >
                                                        <option value=""selected disabled>-- Select Type --</option>
                                                        <option value="fixed">Fixed</option>
                                                        <option value="percent">Percent</option>
                                                    </select>
                                                </div>
                                                @error('discount_type')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="mt-4">
                                                    <label for="discount-name-input" class="form-label">Discount Name :</label>
                                                    <input type="text" class="form-control" id="discount-name-input" name="discount_name" placeholder="Enter Discount Name" value="{{ old('discount_name') }}">
                                                </div>
                                                @error('discount_name')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="mt-4">
                                                    <label for="discount-slug-input" class="form-label">Discount Slug :</label>
                                                    <input type="text" class="form-control" id="discount-slug-input" name="discount_slug" placeholder="Enter Discount Slug" value="{{ old('discount_slug') }}">
                                                </div>
                                                @error('discount_slug')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="mt-4">
                                                    <label for="discount-value-input" class="form-label">Discount Value :</label>
                                                    <input type="number" class="form-control" id="discount-value-input" name="discount_value" placeholder="Enter Discount Value" value="{{ old('discount_value') }}">
                                                </div>
                                                @error('discount_value')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="mt-4">
                                                    <label for="discount-validity-input" class="form-label">Discount Validity :</label>
                                                    <input type="datetime-local" class="form-control" id="discount-validity-input" name="discount_validity" value="{{ old('discount_validity') }}">
                                                </div>
                                                @error('discount_validity')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

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
                    

            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @if (auth()->user()->hasPermissionTo('update-discount') || auth()->user()->isSuperAdmin())
        <!-- edit discount modal -->
        <div class="modal fade" id="editDiscount" tabindex="-1" aria-labelledby="editDiscountLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDiscountLabel">Edit Discount</h5>
                        <button type="button" class="btn-close close_discount_form" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="discount_edit_form">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id="discount-type-input" class="col-form-label">Discount Type:</label>
                                <select class="form-control discount_type" id="discount-type-input" name="discount_type" >
                                    <option selected disabled value="">-- Select Type --</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="col-form-label">Discount Name:</label>
                                <input type="text" class="form-control discount_name" id="discount_name" name="discount_name" placeholder="Discount Name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="col-form-label">Discount Slug:</label>
                                <input type="text" class="form-control discount_slug" id="discount_slug" name="discount_slug" placeholder="Discount Slug">
                            </div>
                            <div class="mb-3">
                                <label for="" class="col-form-label">Discount Value:</label>
                                <input type="number" class="form-control discount_value" name="discount_value" placeholder="Discount Value">
                            </div>
                            <div class="mb-3">
                                <label for="" class="col-form-label">Discount Validity:</label>
                                <input type="datetime-local" class="form-control discount_validity" name="discount_validity">
                            </div>
                        </div>
                        <div class="modal-footer discount_modal_footer">
                            <button type="button" class="btn btn-secondary close_discount_form" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary discount_update_btn" data-id="" id="editDiscountPost">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif


    @if (auth()->user()->hasPermissionTo('delete-discount') || auth()->user()->isSuperAdmin())
        <!-- delete discount modal -->
        <div class="modal fade" id="deleteDiscount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteDiscountLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="deleteDiscountLabel">Delete discount</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger discount_delete_modal" data-id="">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

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



            function discountValidityDate(){
                let elements = $('.discount_row');
                let currentTime = new Date().getTime();

                elements.each(function() {

                    let validityDateTime = $(this).find('.discount_validity_date').data('time');

                    let offset = new Date().getTimezoneOffset();
                    let validityDate = new Date(validityDateTime).getTime() - (offset * 60 * 1000);

                    let validityTime = validityDate - currentTime;
                    
                    if(validityTime > 0){
                    
                        let days = Math.floor(validityTime / (1000 * 60 * 60 * 24));
                        let hours = Math.floor((validityTime % (1000 * 60 * 60* 24)) / (1000 * 60 * 60));
                        let minutes = Math.floor((validityTime % (1000 * 60 * 60)) / (1000 * 60));
                        let seconds = Math.floor((validityTime % (1000 * 60 )) / 1000);

                        $(this).find('.discount_validity_date').html('<span class="badge bg-success" style="padding:5px;min-width:95px">'+days+"d "+hours+"h "+minutes+"m "+seconds+"s "+'</span>');

                    }
                    else{
                        $(this).find('.discount_validity_date').html('<span class="badge bg-danger" style="padding:5px;min-width:95px">expired</span>');
                        $(this).find('.switchDiscountStatus').prop('checked', false);
                    }

                });
            }

            setInterval(() => {
                discountValidityDate();
            }, 1000);


            function createDiscountSlug(discount_name_input,discount_slug_input){
                $(document).on('input',discount_name_input, function(){

                    let value = $(this).val().trim();
                        value = value.split(' ').filter(s => s).join('-')
                        // value = value.replace(/\s+/g, ' ');
                        // value = value.split(' ');
                        // value = value.join('-');

                    $(discount_slug_input).val(value);

                });
            }

            createDiscountSlug('#discount-name-input','#discount-slug-input');
            createDiscountSlug('#discount_name','#discount_slug');
            

            document.getElementById("discount_search").addEventListener("search", function(event) {
                $('#discounts_table_wrapper').load(' #discounts_table_wrapper >* ');
            });


            $(document).on('keyup','#discount_search', function()
            {   
                let discount_query = $(this).val().trim();
                let page = $('#hidden_page').val();
                let url = "{{ route('discount.search') }}";

                if(discount_query != ''){
                   
                    $.ajax({
                        type:'GET',
                        url:url,
                        data:{discount_query:discount_query,page:page},
                        success:function(data){
                            if(data.error){
                                alert(data.error);
                            }else{
                                $('#discounts_table_wrapper').find('tbody').html(data);
                            }
                        },
                        error:function(){

                            alert("Something went wrong!");

                        }
                    });

                }
                else{

                    $('#discounts_table_wrapper').load(' #discounts_table_wrapper >* ');

                }
                
            });



            $(document).on('click','.pagination a', function(event){
                
                let discount_query = $('#discount_search').val().trim();
                
                if(discount_query != ''){
                    event.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    $('#hidden_page').val(page);
                    $('li').removeClass('active');
                    $(this).parent().addClass('active');
                    let url = "{{ route('discount.search') }}";
                   
                    $.ajax({
                        type:'GET',
                        url:url,
                        data:{discount_query:discount_query,page:page},
                        success:function(data){

                            if(data.error){
                                alert(data.error);
                            }else{
                                $('#discounts_table_wrapper').find('tbody').html(data);
                            }

                        },
                        error:function(){

                            alert("Something went wrong!");

                        }
                    });

                }
                else{

                    $('#discounts_table_wrapper').load(' #discounts_table_wrapper >* ');

                }

            });




            $(document).on('click','.switchDiscountStatus', function(){
                let id = $(this).data('id');
                let url = "{{ route('discount.status.update',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){
                        if(data.success){
                            $('.discount_alert').text(data.success);
                            $('.discount_alert').delay(200).fadeIn(200);
                            $('.discount_alert').delay(1000).fadeOut(200);
                        }
                        else if(data.error){
                            alert(data.error);
                        }
                    },
                    error:function(response){

                        if($('#switchDiscountStatus_'+id).prop('checked') === true){
                            $('#switchDiscountStatus_'+id).prop('checked', false);
                        }
                        else{
                            $('#switchDiscountStatus_'+id).prop('checked', true);
                        }

                        if(response.status === 403){
                            alert(response.responseJSON.message);

                            return;
                        }

                        if(confirm("Something went wrong! Try reloading the page.")){
                            window.location.reload();
                        }
                    }
                });
            });



            $(document).on('click','.edit_discount', function(event)
            {
                event.preventDefault();

                let id =  $(this).data('id');
                let url = "{{ route('discount.edit',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#editDiscount').addClass('discount_edit_loading');  
                    },
                    success:function(data){

                        let offset = new Date().getTimezoneOffset() * 60 * 1000;
                        let discount_validity_time = new Date(data.discount_validity).getTime();
                        let validity_time = discount_validity_time - offset;
                        let validity_date = new Date(validity_time).toISOString().substring(0, 16);

                        setTimeout(() => {

                            let discount_value = 0;

                            if(data.discount.discount_type == 'fixed'){
                                discount_value = roundNumber(data.discount.discount_value / 100);
                            }
                            else {
                                discount_value = data.discount.discount_value;
                            }


                            $('#editDiscount').removeClass('discount_edit_loading');
                            $('.discount_edit_form').find('.discount_type').html(data.discount_type);
                            $('.discount_edit_form').find('.discount_name').val(data.discount.discount_name);
                            $('.discount_edit_form').find('.discount_slug').val(data.discount.discount_slug);
                            $('.discount_edit_form').find('.discount_value').val(discount_value);
                            $('.discount_edit_form').find('.discount_validity').val(validity_date);
                            $('#editDiscountPost').data('id',data.discount.id);
                            
                        }, 150);
                    },
                    error:function(){
                        alert("Something went wrong!");
                    }

                });
            });


            function discountEditFormValidation()
            {

                let discountType = $('#editDiscount').find('.discount_type');
                let discountName = $('#editDiscount').find('.discount_name');
                let discountSlug = $('#editDiscount').find('.discount_slug');
                let discountValue = $('#editDiscount').find('.discount_value');
                let discountValidity = $('#editDiscount').find('.discount_validity');


                if(discountType.val() == null){

                    discountType.parent().append("<small class='text-danger'>This is a required field!</small>");
                    discountType.css('border-color','red');

                }

                if(discountName.val() == ''){

                    discountName.parent().append("<small class='text-danger'>This is a required field!</small>");
                    discountName.css('border-color','red');

                }
                
                if(discountSlug.val() == ''){

                    discountSlug.parent().append("<small class='text-danger'>This is a required field!</small>");
                    discountSluge.css('border-color','red');

                }

                if(discountValue.val() == ''){

                    discountValue.parent().append("<small class='text-danger'>This is a required field!</small>");
                    discountValue.css('border-color','red');

                }

                if(discountValidity.val() == ''){

                    discountValidity.parent().append("<small class='text-danger'>This is a required field!</small>");
                    discountValidity.css('border-color','red');

                }


                if((discountType.val() == null) || (discountName.val() == '') || (discountSlug.val() == '') ||  (discountValue.val() == '') || (discountValidity.val() == '') ){

                    return false;

                }
                else{

                    return true;

                }

            }


            function resetEditForm()
            {

                $('#editDiscount').find('small').remove();
                $.each(['discount_type','discount_name','discount_slug','discount_value','discount_validity'], function(key,elem){
                    $('#editDiscount').find('.'+elem).css('border-color','#ced4da');
                });
                
            }

            
            $('.close_discount_form').on('click',function()
            {
                resetEditForm()
                $.each(['discount_type','discount_name','discount_slug','discount_value','discount_validity'], function(key,elem){
                    $('#editDiscount').find('.'+elem).val('');
                });

            });


            $('.modal').on('show.bs.modal', function () 
            {
                resetEditForm()
                $.each(['discount_type','discount_name','discount_slug','discount_value','discount_validity'], function(key,elem){
                    $('#editDiscount').find('.'+elem).val('');
                });

            });


            $('#editDiscountPost').on('click',function(){

                resetEditForm();

                $discount_edit_form_validated = discountEditFormValidation();

                if($discount_edit_form_validated == true){

                    let id = $(this).data('id');
                    let discount_type = $('.discount_edit_form').find('.discount_type').val();
                    let discount_name = $('.discount_edit_form').find('.discount_name').val();
                    let discount_slug = $('.discount_edit_form').find('.discount_slug').val();
                    let discount_value = $('.discount_edit_form').find('.discount_value').val();
                    let discount_validity = $('.discount_edit_form').find('.discount_validity').val();

                    let url = "{{ route('discount.update', ':id') }}";
                        url =url.replace(':id',id);
                
                    $.ajax({

                        type:'PUT',
                        url:url,
                        data:{discount_type:discount_type,discount_name:discount_name,discount_slug:discount_slug,discount_value:discount_value,discount_validity:discount_validity},
                        success:function(data){

                            if(data.success){
                                $('#editDiscount').modal('hide');
                                $('#discounts_table_wrapper').load(' #discounts_table_wrapper > *');
                                $('.discount_alert').text(data.success);
                                $('.discount_alert').delay(1000).fadeIn(200);
                                $('.discount_alert').delay(2000).fadeOut(200);
                            }
                            else{
                                
                                $('.discount_code').parent().append("<small class='text-danger'>"+data.discount_exists+"</small>");
                                $('.discount_edit_form').find('.discount_code').css('border-color','red');

                            }

                        }

                    });

                }
                
                

            });


            $(document).on('click','.discount_delete', function()
            {
                let id = $(this).data('id');
                $('.discount_delete_modal').data('id',id);
            });

            $('.discount_delete_modal').on('click', function()
            {   
                let id = $(this).data('id');
                let url = "{{ route('discount.destroy', ':id') }}";
                    url = url.replace(':id', id);

                $.ajax({
                    type:"DELETE",
                    url:url,
                    success:function(data){
                        if(data.success){

                            $('#deleteDiscount').modal('hide');
                            $('#discounts_table_wrapper').load(' #discounts_table_wrapper > *');

                            $('.discount_alert').text(data.success);
                            $('.discount_alert').delay(500).fadeIn(300);
                            $('.discount_alert').delay(1500).fadeOut(300);

                        }
                        else{
                            alert(data.error);
                        }
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
                    
            })

        });
    </script>
    
@endsection