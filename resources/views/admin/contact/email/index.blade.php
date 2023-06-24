@extends('layouts.dashboard')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Email</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Contact</a></li>
                            <li class="breadcrumb-item active">Email</li>
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
                                <div class="alert alert-success contact_email_alert" style="display: none" role="alert">
                                
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @can('create', \App\Models\ContactEmail::class)
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="text-center text-sm-start text-md-start text-lg-start text-xl-start">
                                        <a href="javascript:void(0);" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target="#addContactEmail" >
                                            <i class="mdi mdi-plus me-1"></i> Add New Email
                                        </a>
                                    </div>
                                </div><!-- end col-->
                            </div>
                        @endcan
                        

                        <div class="table-responsive" id="contact_email_table_wrapper">
                            <table id="contact_email_table" class="table align-middle table-nowrap table-check" >
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">SL NO.</th>
                                        <th class="align-middle">Email</th>
                                        <th class="align-middle">Primary Status</th>
                                        <th class="align-middle">Status</th>                                        

                                        @if (auth()->user()->hasAnyPermission(['update-contact','delete-contact']) || auth()->user()->isSuperAdmin())
                                            <th class="align-middle">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('admin.contact.email.query_data')
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
     || auth()->user()->isSuperAdmin()<!-- add Email modal -->
    <div class="modal fade" id="addContactEmail" tabindex="-1" aria-labelledby="addContactEmailLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContactEmailLabel">Add Email</h5>
                    <button type="button" class="btn-close close_contact_email_form" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="contact_email_form_wrapper" id="addContactEmailForm_wrapper">
                    <form id="addContactEmailForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="contact_email" class="col-form-label">Email:</label>
                                <input type="email" class="form-control contact_email" id="contact_email" name="contact_email">
                                <small class="text-danger" id="contact_email_error"></small>
                            </div>
                        </div>
                        <div class="modal-footer faq_modal_footer">
                            <button type="button" class="btn btn-secondary close_contact_email_form" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="addContactEmailBtn">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endif


@if (auth()->user()->hasPermissionTo('update-contact') || auth()->user()->isSuperAdmin())
    <!-- edit Email modal -->
    <div class="modal fade" id="editContactEmail" tabindex="-1" aria-labelledby="editContactEmailLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContactEmailLabel">Edit Email</h5>
                    <button type="button" class="btn-close close_contact_email_edit_form" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="contact_email_form_wrapper" id="editContactEmailForm_wrapper">
                    <form id="editContactEmailForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_contact_email" class="col-form-label">Email:</label>
                                <input type="email" class="form-control contact_email" name="contact_email" id="edit_contact_email">
                                <small class="text-danger" id="edit_contact_email_error"></small>
                            </div>
                        </div>
                        <div class="modal-footer faq_modal_footer">
                            <button type="button" class="btn btn-secondary close_contact_email_edit_form" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="editContactEmailBtn" data-id="">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endif



@if (auth()->user()->hasPermissionTo('delete-contact') || auth()->user()->isSuperAdmin())
    <!-- delete faq modal -->
    <div class="modal fade" id="deleteContactEmail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteContactEmailLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteContactEmailLabel">Delete Email</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger contact_email_delete_modal" data-id="">Delete</button>
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


            resetModalForm(['#addContactEmail','#editContactEmail']);


            $(document).on('click','#addContactEmailBtn', function(e){
                e.preventDefault();
                $('#addContactEmailForm').submit();
                $('#addContactEmailBtn').attr('disabled',true);
            });

            $(document).on('submit','#addContactEmailForm', function(e){
                e.preventDefault();

                let formData = $(this).serializeArray();

                $.ajax({
                    type:'POST',
                    url:"{{ route('email.store') }}",
                    data:formData,
                    success:function(data){
                        if(data.status === 'success'){
                            $('#addContactEmailBtn').attr('disabled',false);
                            $('#addContactEmail').modal('hide');
                            $('.contact_email_alert').text('Added successfully!').fadeIn().delay(1500).fadeOut();
                            $('#contact_email_table_wrapper').load(' #contact_email_table_wrapper>* ');
                        }
                    },
                    error:function(error){
                        $('#addContactEmailBtn').attr('disabled',false);
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


            $(document).on('click', '.contact_email_edit', function(e){
                e.preventDefault();
                let id = $(this).data('id');
                let url = "{{ route('email.edit',':email') }}";
                    url = url.replace(':email',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#editContactEmail').addClass('edit_contact_email_loading');
                    },
                    success:function(data){
                        if(data.status === 'success'){
                            setTimeout(() => {
                                $('#edit_contact_email').val(data.email.contact_email);
                                $('#editContactEmail').removeClass('edit_contact_email_loading');
                            }, 100);
                            
                            $('#editContactEmailBtn').data('id',data.email.id);
                        }
                    },
                    error:function(error){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        };
                    }
                });
            });


            $(document).on('click','#editContactEmailBtn', function(e){
                e.preventDefault();
                $('#editContactEmailForm').submit();
                $('#editContactEmailBtn').attr('disabled',true);
            });


            $(document).on('submit','#editContactEmailForm', function(e){
                e.preventDefault();

                let formData = $(this).serializeArray();
                let id = $(this).find('#editContactEmailBtn').data('id');
                let url = "{{ route('email.update',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'PUT',
                    url:url,
                    data:formData,
                    success:function(data){
                        if(data.status === 'success'){
                            $('#editContactEmailBtn').attr('disabled',false);
                            $('#editContactEmail').modal('hide');
                            $('.contact_email_alert').text('Updated successfully!').fadeIn().delay(1500).fadeOut();
                            $('#contact_email_table_wrapper').load(' #contact_email_table_wrapper>* ');
                        }
                    },
                    error:function(error){
                        $('#editContactEmailBtn').attr('disabled',false);
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


            $(document).on('click','.contact_email_delete', function (event){
                event.preventDefault();
                $('.contact_email_delete_modal').data('id',$(this).data('id'));
            });


            $(document).on('click','.contact_email_delete_modal', function(event){
                event.preventDefault();

                $('.contact_email_delete_modal').attr('disabled',true);

                let id = $(this).data('id');
                let url = "{{ route('email.destroy',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'DELETE',
                    url:url,
                    success:function(data){
                        if(data.status === 'success'){
                            $('.contact_email_delete_modal').attr('disabled',false);
                            $('#deleteContactEmail').modal('hide');
                            $('.contact_email_alert').text('Deleted successfully!');
                            setTimeout(() => {
                                $('#contact_email_table').load(' #contact_email_table >* ');
                                $('.contact_email_alert').fadeIn().delay(800).fadeOut();
                            }, 400);
                        }
                    },
                    error:function(){
                        $('.contact_email_delete_modal').attr('disabled',false);
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
            });


            $(document).on('click','.switchEmailStatus', function(event){
                event.preventDefault();

                let id = $(this).data('id');
                let url = "{{ route('email.status.update',':id') }}";
                    url = url.replace(':id',id);
                
                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){

                        if(data.email_status == 1){
                            $('#switchEmailStatus_'+id).prop('checked',true);
                        }
                        else{
                            $('#switchEmailStatus_'+id).prop('checked',false);
                        }

                        $('.contact_email_alert').text(data.success);

                        setTimeout(() => {
                            $('.contact_email_alert').fadeIn().delay(800).fadeOut();
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


            $(document).on('click','.switchEmailPrimaryStatus', function(event){
                event.preventDefault();

                let id = $(this).data('id');
                let url = "{{ route('email.primary.status.update',':id') }}";
                    url = url.replace(':id',id);
                
                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){

                        $('.switchEmailPrimaryStatus').prop('checked',false);

                        if(data.email_primary_status == 1){
                            $('#switchEmailPrimaryStatus_'+id).prop('checked',true);
                        }
                        else{
                            $('#switchEmailPrimaryStatus_'+id).prop('checked',false);
                        }

                        $('.contact_email_alert').text(data.success);

                        setTimeout(() => {
                            $('.contact_email_alert').fadeIn().delay(800).fadeOut();
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





