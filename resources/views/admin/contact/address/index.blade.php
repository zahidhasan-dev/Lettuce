@extends('layouts.dashboard')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Address</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Contact</a></li>
                            <li class="breadcrumb-item active">Address</li>
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
                                <div class="alert alert-success contact_address_alert" style="display: none" role="alert">
                                
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @can('create', \App\Models\ContactAddress::class)
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="text-center text-sm-start text-md-start text-lg-start text-xl-start">
                                        <a href="javascript:void(0);" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target="#addContactAddress" >
                                            <i class="mdi mdi-plus me-1"></i> Add New Address
                                        </a>
                                    </div>
                                </div><!-- end col-->
                            </div>
                        @endcan

                        <div class="table-responsive" id="contact_address_table_wrapper">
                            <table id="contact_address_table" class="table align-middle table-nowrap table-check" >
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">SL NO.</th>
                                        <th class="align-middle">Address</th>
                                        <th class="align-middle">Status</th>
                                        @if (auth()->user()->hasAnyPermission(['update-contact','delete-contact']) || auth()->user()->isSuperAdmin())
                                            <th class="align-middle">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('admin.contact.address.query_data')
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

@if (auth()->user()->hasPermissionTo('create-contact') || auth()->user()->isSuperAdmin())
    <!-- add Address modal -->
    <div class="modal fade" id="addContactAddress" tabindex="-1" aria-labelledby="addContactAddressLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContactAddressLabel">Add Address</h5>
                    <button type="button" class="btn-close close_contact_address_form" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="contact_address_form_wrapper" id="addContactAddressForm_wrapper">
                    <form id="addContactAddressForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="contact_address" class="col-form-label">Address:</label>
                                <input type="text" class="form-control contact_address" id="contact_address" name="contact_address">
                                <small class="text-danger" id="contact_address_error"></small>
                            </div>
                        </div>
                        <div class="modal-footer faq_modal_footer">
                            <button type="button" class="btn btn-secondary close_contact_address_form" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="addContactAddressBtn">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@if (auth()->user()->hasPermissionTo('update-contact') || auth()->user()->isSuperAdmin())
    <!-- edit Address modal -->
    <div class="modal fade" id="editContactAddress" tabindex="-1" aria-labelledby="editContactAddressLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContactAddressLabel">Edit Address</h5>
                    <button type="button" class="btn-close close_contact_address_edit_form" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="contact_address_form_wrapper" id="editContactAddressForm_wrapper">
                    <form id="editContactAddressForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_contact_address" class="col-form-label">Address:</label>
                                <input type="text" class="form-control contact_address" name="contact_address" id="edit_contact_address">
                                <small class="text-danger" id="edit_contact_address_error"></small>
                            </div>
                        </div>
                        <div class="modal-footer faq_modal_footer">
                            <button type="button" class="btn btn-secondary close_contact_address_edit_form" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="editContactAddressBtn" data-id="">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@if (auth()->user()->hasPermissionTo('delete-contact') || auth()->user()->isSuperAdmin())    
    <!-- delete faq modal -->
    <div class="modal fade" id="deleteContactAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteContactAddressLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteContactAddressLabel">Delete Address</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger contact_address_delete_modal" data-id="">Delete</button>
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
                    'X-CSRF-TOKEN':$('meta[name=csrf-token]').attr('content')
                }
            });


            resetModalForm(['#addContactAddress','#editContactAddress']);


            $(document).on('click','#addContactAddressBtn', function(e){
                e.preventDefault();
                $('#addContactAddressForm').submit();
                $('#addContactAddressBtn').attr('disabled',true);
            });

            $(document).on('submit','#addContactAddressForm', function(e){
                e.preventDefault();

                let formData = $(this).serializeArray();

                $.ajax({
                    type:'POST',
                    url:"{{ route('address.store') }}",
                    data:formData,
                    success:function(data){
                        if(data.status === 'success'){
                            $('#addContactAddressBtn').attr('disabled',false);
                            $('#addContactAddress').modal('hide');
                            $('.contact_address_alert').text('Added successfully!').fadeIn().delay(1500).fadeOut();
                            $('#contact_address_table_wrapper').load(' #contact_address_table_wrapper>* ');
                        }
                    },
                    error:function(error){
                        $('#addContactAddressBtn').attr('disabled',false);
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

            $(document).on('click', '.contact_address_edit', function(e){
                e.preventDefault();
                let id = $(this).data('id');
                let url = "{{ route('address.edit',':address') }}";
                    url = url.replace(':address',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#editContactAddress').addClass('edit_contact_address_loading');
                    },
                    success:function(data){
                        if(data.status === 'success'){
                            setTimeout(() => {
                                $('#edit_contact_address').val(data.address.contact_address);
                                $('#editContactAddress').removeClass('edit_contact_address_loading');
                            }, 100);
                            
                            $('#editContactAddressBtn').data('id',data.address.id);
                        }
                    },
                    error:function(error){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        };
                    }
                });
            });


            $(document).on('click','#editContactAddressBtn', function(e){
                e.preventDefault();
                $('#editContactAddressForm').submit();
                $('#editContactAddressBtn').attr('disabled',true);
            });


            $(document).on('submit','#editContactAddressForm', function(e){
                e.preventDefault();

                let formData = $(this).serializeArray();
                let id = $(this).find('#editContactAddressBtn').data('id');
                let url = "{{ route('address.update',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'PUT',
                    url:url,
                    data:formData,
                    success:function(data){
                        if(data.status === 'success'){
                            $('#editContactAddressBtn').attr('disabled',false);
                            $('#editContactAddress').modal('hide');
                            $('.contact_address_alert').text('Updated successfully!').fadeIn().delay(1500).fadeOut();
                            $('#contact_address_table_wrapper').load(' #contact_address_table_wrapper>* ');
                        }
                    },
                    error:function(error){
                        $('#editContactAddressBtn').attr('disabled',false);
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


            $(document).on('click','.contact_address_delete', function (event){
                event.preventDefault();
                $('.contact_address_delete_modal').data('id',$(this).data('id'));
            });


            $(document).on('click','.contact_address_delete_modal', function(event){
                event.preventDefault();

                $('.contact_address_delete_modal').attr('disabled',true);

                let id = $(this).data('id');
                let url = "{{ route('address.destroy',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'DELETE',
                    url:url,
                    success:function(data){
                        if(data.status === 'success'){
                            $('.contact_address_delete_modal').attr('disabled',false);
                            $('#deleteContactAddress').modal('hide');
                            $('.contact_address_alert').text('Deleted successfully!');
                            $('#contact_address_table').load(' #contact_address_table >* ');
                            setTimeout(() => {
                                $('.contact_address_alert').fadeIn().delay(800).fadeOut();
                            }, 400);
                        }
                    },
                    error:function(){
                        $('.contact_address_delete_modal').attr('disabled',false);
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
            });


            $(document).on('click','.switchAddressStatus', function(event){
                event.preventDefault();

                let id = $(this).data('id');
                let url = "{{ route('address.status.update',':id') }}";
                    url = url.replace(':id',id);
                
                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){

                        $('.switchAddressStatus').prop('checked',false);

                        if(data.address_status == 1){
                            $('#switchAddressStatus_'+id).prop('checked',true);
                        }
                        else{
                            $('#switchAddressStatus_'+id).prop('checked',false);
                        }

                        $('.contact_address_alert').text(data.success);

                        setTimeout(() => {
                            $('.contact_address_alert').fadeIn().delay(800).fadeOut();
                        }, 200);

                    },
                    error:function(response){
                        if(response.status === 403){
                            alert(response.responseJSON.message);

                            return;
                        }

                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });

        });



    </script>
@endsection





