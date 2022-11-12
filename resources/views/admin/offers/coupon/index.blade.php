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
                                <li class="breadcrumb-item active">Coupon</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-9 order-xl-1 order-2 col-12">
                    <div class="card">
                        <div class="alert alert-success coupon_alert" style="display: none" role="alert">
                                    
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8">
                                    <h4 class="card-title mb-4">Coupons</h4>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <label class="d-block mb-4"><input type="search" class="form-control form-control-sm" id="coupon_search" name="coupon_search" placeholder="Search"></label>
                                </div>
                            </div>
                            <div class="table-responsive" id="coupons_table_wrapper">
                                <table id="coupons_table" class="table nowrap w-100">
                                    <thead>
                                    <tr class="align-top">
                                        <th>SL NO.</th>
                                        <th>Code</th>
                                        <th>Value</th>
                                        <th>Type</th>
                                        <th>Validity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @include('admin.offers.coupon.query_data')
                                    </tbody>
                                </table>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-xl-3 order-xl-2 order-1 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">Add Coupon</h4>
                           
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
                                <form action="{{ route('coupon.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <label for="coupon-type-input" class="form-label">Coupon Type :</label>
                                                <select class="form-control" id="coupon-type-input" name="coupon_type" >
                                                    <option value=""selected disabled>-- Select Type --</option>
                                                    <option value="fixed">Fixed</option>
                                                    <option value="percent">Percent</option>
                                                </select>
                                            </div>
                                            @error('coupon_type')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <label for="coupon-code-input" class="form-label">Coupon Code :</label>
                                                <input type="text" class="form-control" id="coupon-code-input" name="coupon_code" placeholder="Enter Coupon Code" value="{{ old('coupon_code') }}">
                                            </div>
                                            @error('coupon_code')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <label for="coupon-value-input" class="form-label">Coupon Value :</label>
                                                <input type="number" class="form-control" id="coupon-value-input" name="coupon_value" placeholder="Enter Coupon Value" value="{{ old('coupon_value') }}">
                                            </div>
                                            @error('coupon_value')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <label for="coupon-validity-input" class="form-label">Coupon Validity :</label>
                                                <input type="datetime-local" class="form-control" id="coupon-validity-input" name="coupon_validity" value="{{ old('coupon_validity') }}">
                                            </div>
                                            @error('coupon_validity')
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
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <!-- edit coupon modal -->
    <div class="modal fade" id="editCoupon" tabindex="-1" aria-labelledby="editCouponLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCouponLabel">Edit Coupon</h5>
                    <button type="button" class="btn-close close_coupon_form" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="coupon_edit_form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Coupon Type:</label>
                            <select class="form-control coupon_type" id="coupon-type-input" name="coupon_type" >
                                
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Coupon Code:</label>
                            <input type="text" class="form-control coupon_code" name="coupon_code">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Coupon Value:</label>
                            <input type="number" class="form-control coupon_value" name="coupon_value">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Coupon Validity:</label>
                            <input type="datetime-local" class="form-control coupon_validity" name="coupon_validity">
                        </div>
                    </div>
                    <div class="modal-footer coupon_modal_footer">
                        <button type="button" class="btn btn-secondary close_coupon_form" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary coupon_update_btn" data-id="" id="editCouponPost">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- delete coupon modal -->

    <div class="modal fade" id="deleteCoupon" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCouponLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteCouponLabel">Delete Coupon</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger coupon_delete_modal" data-id="">Delete</button>
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



            function couponValidityDate(){

                let elements = $('.coupon_row');
                let currentTime = new Date().getTime();

                elements.each(function() {

                    let validityDateTime = $(this).find('.coupon_validity_date').data('time');
                    let offset = new Date().getTimezoneOffset();
                    let validityDate = new Date(validityDateTime).getTime() - (offset * 60 * 1000);

                    let validityTime = validityDate - currentTime;

                    if(validityTime > 0){
                    
                        let days = Math.floor(validityTime / (1000 * 60 * 60 * 24));
                        let hours = Math.floor((validityTime % (1000 * 60 * 60* 24)) / (1000 * 60 * 60));
                        let minutes = Math.floor((validityTime % (1000 * 60 * 60)) / (1000 * 60));
                        let seconds = Math.floor((validityTime % (1000 * 60 )) / 1000);

                        $(this).find('.coupon_validity_date').html('<span class="badge bg-success" style="padding:5px;min-width:95px">'+days+"d "+hours+"h "+minutes+"m "+seconds+"s "+'</span>')

                    }
                    else{
                        $(this).find('.coupon_validity_date').html('<span class="badge bg-danger" style="padding:5px;min-width:95px">expired</span>');
                    }

                });

            }

            setInterval(() => {
                couponValidityDate();
            }, 1000);

        


            document.getElementById("coupon_search").addEventListener("search", function(event) {
                $('#coupons_table_wrapper').load(' #coupons_table_wrapper >* ');
            });


            $(document).on('keyup','#coupon_search', function()
            {   
                let coupon_query = $(this).val().trim();
                let page = $('#hidden_page').val();
                let url = "{{ route('coupon.search') }}";

                if(coupon_query != ''){
                   
                    $.ajax({
                        type:'GET',
                        url:url,
                        data:{coupon_query:coupon_query,page:page},
                        success:function(data){
                            if(data.error){
                                alert(data.error);
                            }else{
                                $('#coupons_table_wrapper').find('tbody').html(data);
                            }
                        },
                        error:function(){

                            alert("Something went wrong!");

                        }
                    });

                }
                else{

                    $('#coupons_table_wrapper').load(' #coupons_table_wrapper >* ');

                }
                
            });


            $(document).on('click','.pagination a', function(event){
                
                let coupon_query = $('#coupon_search').val().trim();
                
                if(coupon_query != ''){
                    event.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    $('#hidden_page').val(page);
                    $('li').removeClass('active');
                    $(this).parent().addClass('active');
                    let url = "{{ route('coupon.search') }}";
                   
                    $.ajax({
                        type:'GET',
                        url:url,
                        data:{coupon_query:coupon_query,page:page},
                        success:function(data){

                            if(data.error){
                                alert(data.error);
                            }else{
                                $('#coupons_table_wrapper').find('tbody').html(data);
                            }

                        },
                        error:function(){

                            alert("Something went wrong!");

                        }
                    });

                }
                else{

                    $('#coupons_table_wrapper').load(' #coupons_table_wrapper >* ');

                }

            });



            $(document).on('click','.switchCouponStatus', function(){
                let id = $(this).data('id');
                let url = "{{ route('coupon.status.update',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({

                    type:'POST',
                    url:url,
                    success:function(data){
                        if(data.success){
                            $('.coupon_alert').text(data.success);
                            $('.coupon_alert').delay(200).fadeIn(200);
                            $('.coupon_alert').delay(1000).fadeOut(200);
                        }
                        else if(data.error){
                            alert(data.error);
                        }
                    },
                    error:function(){
                        alert("Something went wrong!");
                    }
                });
            });


            $(document).on('click','.edit_coupon', function(event)
            {
                event.preventDefault();

                let id =  $(this).data('id');
                let url = "{{ route('coupon.edit',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#editCoupon').addClass('coupon_edit_loading');
                    },
                    success:function(data){

                        let offset = new Date().getTimezoneOffset();
                        let validity_time = Date.parse(data.coupon_validity) - (offset * 60 * 1000);
                        let validity_date = new Date(validity_time).toISOString().substring(0, 16);


                        let coupon_value = 0;

                        if(data.coupon.coupon_type === 'fixed'){
                            coupon_value = roundNumber(data.coupon.coupon_value / 100);
                        }
                        else {
                            coupon_value = data.coupon.coupon_value;
                        }

                        setTimeout(() => {

                            $('#editCoupon').removeClass('coupon_edit_loading');
                            $('.coupon_edit_form').find('.coupon_type').html(data.coupon_type);
                            $('.coupon_edit_form').find('.coupon_code').val(data.coupon.coupon_code);
                            $('.coupon_edit_form').find('.coupon_value').val(coupon_value);
                            $('.coupon_edit_form').find('.coupon_validity').val(validity_date);
                            $('#editCouponPost').data('id',data.coupon.id);
                            
                        }, 150);
                    },
                    error:function(){
                        alert("Something went wrong!");
                    }

                });
            });


            function couponEditFormValidation()
            {

                let couponType = $('#editCoupon').find('.coupon_type');
                let couponCode = $('#editCoupon').find('.coupon_code');
                let couponValue = $('#editCoupon').find('.coupon_value');
                let couponValidity = $('#editCoupon').find('.coupon_validity');


                if(couponType.val() == null){

                    couponType.parent().append("<small class='text-danger'>This is a required field!</small>");
                    couponType.css('border-color','red');

                }

                if(couponCode.val() == ''){

                    couponCode.parent().append("<small class='text-danger'>This is a required field!</small>");
                    couponCode.css('border-color','red');

                }

                if(couponValue.val() == ''){

                    couponValue.parent().append("<small class='text-danger'>This is a required field!</small>");
                    couponValue.css('border-color','red');

                }

                if(couponValidity.val() == ''){

                    couponValidity.parent().append("<small class='text-danger'>This is a required field!</small>");
                    couponValidity.css('border-color','red');

                }


                if((couponType.val() == null) || (couponCode.val() == '') ||  (couponValue.val() == '') || (couponValidity.val() == '') ){

                    return false;

                }
                else{

                    return true;

                }

            }


            function resetEditForm()
            {

                $('#editCoupon').find('small').remove();
                $.each(['coupon_type','coupon_code','coupon_value','coupon_validity'], function(key,elem){
                    $('#editCoupon').find('.'+elem).css('border-color','#ced4da');
                });
                
            }

            
            $('.close_coupon_form').on('click',function()
            {
                resetEditForm()
                $.each(['coupon_type','coupon_code','coupon_value','coupon_validity'], function(key,elem){
                    $('#editCoupon').find('.'+elem).val('');
                });

            });


            $('.modal').on('show.bs.modal', function () 
            {
                resetEditForm()
                $.each(['coupon_type','coupon_code','coupon_value','coupon_validity'], function(key,elem){
                    $('#editCoupon').find('.'+elem).val('');
                });

            });


            $('#editCouponPost').on('click',function(){

                resetEditForm();

                $coupon_edit_form_validated = couponEditFormValidation();

                if($coupon_edit_form_validated == true){

                    let id = $(this).data('id');
                    let coupon_type = $('.coupon_edit_form').find('.coupon_type').val();
                    let coupon_code = $('.coupon_edit_form').find('.coupon_code').val();
                    let coupon_value = $('.coupon_edit_form').find('.coupon_value').val();
                    let coupon_validity = $('.coupon_edit_form').find('.coupon_validity').val();

                    let url = "{{ route('coupon.update', ':id') }}";
                        url =url.replace(':id',id);
                
                    $.ajax({

                        type:'PUT',
                        url:url,
                        data:{coupon_type:coupon_type,coupon_code:coupon_code,coupon_value:coupon_value,coupon_validity:coupon_validity},
                        success:function(data){

                            if(data.success){
                                $('#editCoupon').modal('hide');
                                $('#coupons_table_wrapper').load(' #coupons_table_wrapper > *');
                                $('.coupon_alert').text(data.success);
                                $('.coupon_alert').delay(1000).fadeIn(200);
                                $('.coupon_alert').delay(2000).fadeOut(200);
                            }
                            else{
                                
                                $('.coupon_code').parent().append("<small class='text-danger'>"+data.coupon_exists+"</small>");
                                $('.coupon_edit_form').find('.coupon_code').css('border-color','red');

                            }

                        }

                    });

                }
                
                

            });


            $(document).on('click','.coupon_delete', function()
            {
                let id = $(this).data('id');
                $('.coupon_delete_modal').data('id',id);
            });

            $('.coupon_delete_modal').on('click', function()
            {   
                let id = $(this).data('id');
                let url = "{{ route('coupon.destroy', ':id') }}";
                    url = url.replace(':id', id);

                $.ajax({
                    type:"DELETE",
                    url:url,
                    success:function(data){
                        if(data.success){

                            $('#deleteCoupon').modal('hide');
                            $('#coupons_table_wrapper').load(' #coupons_table_wrapper > *');

                            $('.coupon_alert').text(data.success);
                            $('.coupon_alert').delay(500).fadeIn(300);
                            $('.coupon_alert').delay(1500).fadeOut(300);

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