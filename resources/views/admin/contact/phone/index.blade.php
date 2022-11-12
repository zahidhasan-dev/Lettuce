@extends('layouts.dashboard')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Phone</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Contact</a></li>
                            <li class="breadcrumb-item active">Phone</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-6 col-lg-5">
                                <div class="alert alert-success contact_phone_alert" style="display: none" role="alert">
                                
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="text-center text-sm-start text-md-start text-lg-start text-xl-start">
                                    <a href="javascript:void(0);" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target="#addContactPhone" >
                                        <i class="mdi mdi-plus me-1"></i> Add New Phone
                                    </a>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive" id="contact_phone_table_wrapper">
                            <table id="contact_phone_table" class="table align-middle table-nowrap table-check" >
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">SL NO.</th>
                                        <th class="align-middle">Phone</th>
                                        <th class="align-middle">Primary Status</th>
                                        <th class="align-middle">Status</th>
                                        <th class="align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('admin.contact.phone.query_data')
                                </tbody>
                            </table>
                            <div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->



<!-- Modal -->

<!-- add Phone modal -->
<div class="modal fade" id="addContactPhone" tabindex="-1" aria-labelledby="addContactPhoneLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addContactPhoneLabel">Add Phone</h5>
                <button type="button" class="btn-close close_contact_phone_form" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="contact_phone_form_wrapper" id="addContactPhoneForm_wrapper">
                <form id="addContactPhoneForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="contact_phone" class="col-form-label">Phone:</label>
                            <input type="number" class="form-control contact_phone" id="contact_phone" name="contact_phone">
                            <small class="text-danger" id="contact_phone_error"></small>
                        </div>
                    </div>
                    <div class="modal-footer faq_modal_footer">
                        <button type="button" class="btn btn-secondary close_contact_phone_form" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="addContactPhoneBtn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- edit Phone modal -->
<div class="modal fade" id="editContactPhone" tabindex="-1" aria-labelledby="editContactPhoneLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContactPhoneLabel">Edit Phone</h5>
                <button type="button" class="btn-close close_contact_phone_edit_form" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="contact_phone_form_wrapper" id="editContactPhoneForm_wrapper">
                <form id="editContactPhoneForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_contact_phone" class="col-form-label">Phone:</label>
                            <input type="number" class="form-control contact_phone" name="contact_phone" id="edit_contact_phone">
                            <small class="text-danger" id="edit_contact_phone_error"></small>
                        </div>
                    </div>
                    <div class="modal-footer faq_modal_footer">
                        <button type="button" class="btn btn-secondary close_contact_phone_edit_form" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="editContactPhoneBtn" data-id="">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- delete faq modal -->

<div class="modal fade" id="deleteContactPhone" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteContactPhoneLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteContactPhoneLabel">Delete Phone</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are you sure?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger contact_phone_delete_modal" data-id="">Delete</button>
            </div>
        </div>
    </div>
</div>


@endsection




@section('footer_script')
    <script>

        $(document).ready(function(){

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name=csrf-token]').attr('content')
                }
            });


            resetModalForm(['#addContactPhone','#editContactPhone']);


            $(document).on('click','#addContactPhoneBtn', function(e){
                e.preventDefault();
                $('#addContactPhoneForm').submit();
                $('#addContactPhoneBtn').attr('disabled',true);
            });

            $(document).on('submit','#addContactPhoneForm', function(e){
                e.preventDefault();

                let formData = $(this).serializeArray();

                $.ajax({
                    type:'POST',
                    url:"{{ route('phone.store') }}",
                    data:formData,
                    success:function(data){
                        if(data.status === 'success'){
                            $('#addContactPhoneBtn').attr('disabled',false);
                            $('#addContactPhone').modal('hide');
                            $('.contact_phone_alert').text('Added successfully!').fadeIn().delay(1500).fadeOut();
                            $('#contact_phone_table_wrapper').load(' #contact_phone_table_wrapper>* ');
                        }
                    },
                    error:function(error){
                        $('#addContactPhoneBtn').attr('disabled',false);
                        if(error.status === 422){
                            let errors = error.responseJSON.errors;
                            $.each(errors,function(key,value){
                                $('#'+key).addClass('is-invalid');
                                $('#'+key+'_error').text(value);
                            });
                        }
                        else{
                            if(confirm('Something went wrong! Try reloading the page.')){
                                window.location.reload();
                            }
                        }
                    }
                });

            });


            $(document).on('click', '.contact_phone_edit', function(e){
                e.preventDefault();
                let id = $(this).data('id');
                let url = "{{ route('phone.edit',':phone') }}";
                    url = url.replace(':phone',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#editContactPhone').addClass('edit_contact_phone_loading');
                    },
                    success:function(data){
                        if(data.status === 'success'){
                            setTimeout(() => {
                                $('#edit_contact_phone').val(data.phone.contact_phone);
                                $('#editContactPhone').removeClass('edit_contact_phone_loading');
                            }, 100);
                            
                            $('#editContactPhoneBtn').data('id',data.phone.id);
                        }
                    },
                    error:function(error){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        };
                    }
                });
            });


            $(document).on('click','#editContactPhoneBtn', function(e){
                e.preventDefault();
                $('#editContactPhoneForm').submit();
                $('#editContactPhoneBtn').attr('disabled',true);
            });


            $(document).on('submit','#editContactPhoneForm', function(e){
                e.preventDefault();

                let formData = $(this).serializeArray();
                let id = $(this).find('#editContactPhoneBtn').data('id');
                let url = "{{ route('phone.update',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'PUT',
                    url:url,
                    data:formData,
                    success:function(data){
                        if(data.status === 'success'){
                            $('#editContactPhoneBtn').attr('disabled',false);
                            $('#editContactPhone').modal('hide');
                            $('.contact_phone_alert').text('Updated successfully!').fadeIn().delay(1500).fadeOut();
                            $('#contact_phone_table_wrapper').load(' #contact_phone_table_wrapper>* ');
                        }
                    },
                    error:function(error){
                        $('#editContactPhoneBtn').attr('disabled',false);
                        if(error.status === 422){
                            let errors = error.responseJSON.errors;
                            $.each(errors,function(key,value){
                                $('#edit_'+key).addClass('is-invalid');
                                $('#edit_'+key+'_error').text(value);
                            });
                        }
                        else{
                            if(confirm('Something went wrong! Try reloading the page.')){
                                window.location.reload();
                            };
                        }
                    }
                });
            });


            $(document).on('click','.contact_phone_delete', function (event){
                event.preventDefault();
                $('.contact_phone_delete_modal').data('id',$(this).data('id'));
            });


            $(document).on('click','.contact_phone_delete_modal', function(event){
                event.preventDefault();

                $('.contact_phone_delete_modal').attr('disabled',true);

                let id = $(this).data('id');
                let url = "{{ route('phone.destroy',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'DELETE',
                    url:url,
                    success:function(data){
                        if(data.status === 'success'){
                            $('.contact_phone_delete_modal').attr('disabled',false);
                            $('#deleteContactPhone').modal('hide');
                            $('.contact_phone_alert').text('Deleted successfully!');
                            $('#contact_phone_table').load(' #contact_phone_table >* ');
                            setTimeout(() => {
                                $('.contact_phone_alert').fadeIn().delay(800).fadeOut();
                            }, 400);
                        }
                    },
                    error:function(){
                        $('.contact_phone_delete_modal').attr('disabled',false);
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
            });


            $(document).on('click','.switchPhoneStatus', function(event){
                event.preventDefault();

                let id = $(this).data('id');
                let url = "{{ route('phone.status.update',':id') }}";
                    url = url.replace(':id',id);
                
                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){

                        if(data.phone_status == 1){
                            $('#switchPhoneStatus_'+id).prop('checked',true);
                        }
                        else{
                            $('#switchPhoneStatus_'+id).prop('checked',false);
                        }

                        $('.contact_phone_alert').text(data.success);

                        setTimeout(() => {
                            $('.contact_phone_alert').fadeIn().delay(800).fadeOut();
                        }, 200);

                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });


            $(document).on('click','.switchPhonePrimaryStatus', function(event){
                event.preventDefault();

                let id = $(this).data('id');
                let url = "{{ route('phone.primary.status.update',':id') }}";
                    url = url.replace(':id',id);
                
                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){

                        $('.switchPhonePrimaryStatus').prop('checked',false);

                        if(data.phone_primary_status == 1){
                            $('#switchPhonePrimaryStatus_'+id).prop('checked',true);
                        }
                        else{
                            $('#switchPhonePrimaryStatus_'+id).prop('checked',false);
                        }

                        $('.contact_phone_alert').text(data.success);

                        setTimeout(() => {
                            $('.contact_phone_alert').fadeIn().delay(800).fadeOut();
                        }, 200);

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





