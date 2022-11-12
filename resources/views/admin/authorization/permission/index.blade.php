@extends('layouts.dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">User Management</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Permission</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-8 order-md-1 order-sm-2 col-12">
                    <div class="card">
                        <div class="alert alert-success permission_alert" style="display: none" role="alert">
                                    
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-4">Permissions</h4>
                            <table id="permissions_table" class="table nowrap w-100">
                                <thead>
                                <tr>
                                    <th>#Id</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            @forelse ($permission->roles as $role)
                                                <span class="badge bg-primary">{{ $role->name }}</span>
                                            @empty
                                                N/A
                                            @endforelse
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="javascript:void(0);" class="text-success edit_permission" data-id="{{ $permission->id }}" data-bs-toggle="modal" data-bs-target="#editPermission"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                <a href="javascript:void(0);" class="text-danger permission_delete" data-id="{{ $permission->id }}" data-bs-toggle="modal" data-bs-target="#deletePermission"><i class="mdi mdi-delete font-size-18"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No data found!</td>
                                        </tr>
                                    @endforelse
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-md-4 order-md-2 order-sm-1 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">Create Permission</h4>
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
                            <div id="create_permission_form_wrapper">
                                <form action="{{ route('admin.permission.store') }}" method="POST" id="create_permission_form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <label for="permission_name" class="form-label">Permission Name :</label>
                                                <input type="text" class="form-control permission_input" id="permission_name" name="permission_name" placeholder="Enter Permission Name" value="">
                                                <small class="permission_name_error permission_error_msg text-danger"></small>
                                            </div>
                                            <div class="mt-4">
                                                <label class="form-label">Assign Roles : </label>
                                                @if ($roles->count() > 0)
                                                    <input class="form-check-input" type="checkbox" id="checkAllRole">
                                                @endif
                                                <div class="permission_role_input_wrapper d-flex flex-wrap">
                                                    @forelse ($roles as $role)
                                                        <label for="permission_role_{{ $role->id }}" style="margin-right:10px;cursor:pointer;">
                                                            <input type="checkbox" class="form-check-input permission_input permission_role" id="permission_role_{{ $role->id }}" name="permission_role[]" value="{{ $role->id }}">
                                                            <span>{{ $role->name }}</span>
                                                        </label>
                                                    @empty
                                                        <span class="d-block">N/A</span>                                               
                                                    @endforelse
                                                </div>
                                                <small class="permission_role_error permission_error_msg text-danger"></small>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button type="button" class="btn btn-primary w-md" id="create_permission_form_btn" onclick="$('#create_permission_form').submit()">Create</button>
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


    <!-- edit Permission modal -->
    <div class="modal fade" id="editPermission" tabindex="-1" aria-labelledby="editPermissionLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal_preloader">
                    <h4 class="text-center m-0">loading...</h4>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="addPermissionLabel">Edit Permission</h5>
                    <button type="button" class="btn-close close_permission_form" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="permission_edit_form_wrapper">
                    <form id="permission_edit_form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="col-form-label modal_input_label">Permission Name:</label>
                                <input type="text" class="form-control permission_name" name="permission_name" value="">
                                <small class="permission_name_error permission_error_msg text-danger"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label modal_input_label">Assign Roles : </label>
                                @if ($roles->count() > 0)
                                    <input type="checkbox" class="form-check-input" id="modal_checkAllRole">
                                @endif
                                <div class="permission_role_input_wrapper d-flex flex-wrap" id="edit_permission_role_input_wrapper">
                                    @forelse ($roles as $role)
                                        <label for="edit_permission_role_{{ $role->id }}" style="margin-right:10px;cursor:pointer;">
                                            <input type="checkbox" class="form-check-input permission_input edit_permission_role" id="edit_permission_role_{{ $role->id }}" name="permission_role[]" value="{{ $role->id }}">
                                            <span>{{ $role->name }}</span>
                                        </label>
                                    @empty
                                        <span class="d-block">N/A</span>                                               
                                    @endforelse
                                </div>
                                <small class="permission_role_error permission_error_msg text-danger"></small>
                            </div>
                        </div>
                        <div class="modal-footer permission_modal_footer">
                            <button type="button" class="btn btn-secondary close_permission_form" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" data-id="" id="editPermissionPost">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- delete Permission modal -->
    <div class="modal fade" id="deletePermission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deletePermissionLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deletePermissionLabel">Delete Permission</h3>
                    <button type="button" class="btn-close close_permission_delete_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light close_permission_delete_modal" data-bs-dismiss="modal">Cancel</button>
                    <form id="permission_delete_form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger permission_delete_modal" data-id="">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('footer_script')
 
    <script>

        $(document).ready(function(){   

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // reset modal form on close
            resetModalForm('#editRole');


            // select all input
            checkAllInput('#checkAllRole','.permission_role');

            checkAllInput('#modal_checkAllRole','.edit_permission_role');


            //create permission
            $(document).on('submit','#create_permission_form', function(e){
                e.preventDefault();

                $('#create_permission_form_btn').attr('disabled',true);
                $('#create_permission_form').find('.permission_error_msg').text('');
                $('#create_permission_form').find('.permission_input').removeClass('border-danger');

                let formData = $(this).serializeArray();
                let url = "{{ route('admin.permission.store') }}";

                $.ajax({
                    type:'POST',
                    url:url,
                    data:formData,
                    success:function(response){
                        if(response.status === 'success'){
                            $('#checkAllRole').prop('checked',false);
                            $('.permission_role').prop('checked',false);
                            $('#create_permission_form_btn').attr('disabled',false);
                            $('.permission_alert').text('Created successfully!').fadeIn().delay(1000).fadeOut();
                            $('#permissions_table').load(' #permissions_table>* ');
                            $('#create_permission_form').find('#permission_name').val('');

                            setTimeout(() => {
                                $('.permission_alert').text('');
                            }, 1500);
                        }
                    },
                    error:function(response){
                        $('#create_permission_form_btn').attr('disabled',false);

                        if(response.status === 422){
                            let errors = response.responseJSON.errors;

                            $.each(errors, function(key,error){
                                $('#create_permission_form').find("."+key+"_error").text(error).addClass('border-danger');
                                $('#create_permission_form').find('#'+key).addClass('border-danger');
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

            //update permission
            $(document).on('click','.edit_permission', function(e){

                e.preventDefault();

                let id =  $(this).data('id');
                let url = "{{ route('admin.permission.edit',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#editPermission').addClass('permission_edit_loading');
                        $('.close_permission_form').attr('disabled',true);
                        $('#editPermissionPost').attr('disabled',true);
                    },
                    success:function(response){
                        if(response.status === 'success'){
                            $('#modal_checkAllRole').prop('checked',response.data.is_checked);
                            $('#permission_edit_form').find('.permission_name').val(response.data.permission.name);
                            $('#editPermissionPost').data('id',response.data.permission.id);
                            $('#edit_permission_role_input_wrapper').html(response.data.roles);

                            setTimeout(() => {
                                $('#editPermission').removeClass('permission_edit_loading');
                                $('.close_permission_form').attr('disabled',false);
                                $('#editPermissionPost').attr('disabled',false);
                            }, 150);
                        }
                    },
                    error:function(){
                        $('#editPermission').removeClass('permission_edit_loading');
                        $('#editPermission').modal('hide');

                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }

                });

            });


            $(document).on('click','#editPermissionPost', function(e){
                e.preventDefault();
                $('#permission_edit_form').submit();
            });


            $(document).on('submit','#permission_edit_form', function(e){

                e.preventDefault();

                $('#editPermissionPost').attr('disabled',true);
                $('#permission_edit_form').find('.permission_error_msg').text('');
                $('#permission_edit_form').find('.permission_input').removeClass('border-danger');

                let formData = $(this).serializeArray();
                let id = $('#editPermissionPost').data('id');
                let url = "{{ route('admin.permission.update', ':id') }}";
                    url = url.replace(':id',id);
                
                $.ajax({
                    type:'PUT',
                    url:url,
                    data:formData,
                    success:function(response){
                        if(response.status === 'success'){
                            $('#editPermission').modal('hide');
                            $('#permissions_table').load(' #permissions_table > *');
                            $('.permission_alert').text('Updated successfully!').fadeIn().delay(1000).fadeOut();

                            setTimeout(() => {
                                $('.permission_alert').text('');
                            }, 1500);
                        }
                    },
                    error:function(response){
                        $('#editPermissionPost').attr('disabled',false);
                        if(response.status === 422){
                            let errors = response.responseJSON.errors;
                            $.each(errors, function(key,error){
                                $('#permission_edit_form').find("."+key+"_error").text(error).addClass('border-danger');
                                $('#permission_edit_form').find('#'+key).addClass('border-danger');
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


            //delete permission
            $('#deletePermission').on('hide.bs.modal', function(){
                $('.permission_delete_modal').data('id','');
            });


            $(document).on('click','.permission_delete', function(){
                let id = $(this).data('id');
                $('.permission_delete_modal').data('id',id);
            });


            $('.permission_delete_modal').on('click', function(){   

                $('.permission_delete_modal').attr('disabled',true);

                let id = $(this).data('id');
                let url = "{{ route('admin.permission.destroy', ':id') }}";
                    url = url.replace(':id', id);

                $.ajax({
                    type:"DELETE",
                    url:url,
                    success:function(response){
                        if(response.status === 'success'){

                            $('.permission_delete_modal').attr('disabled',false);

                            $('#deletePermission').modal('hide');
                            $('#permissions_table').load(' #permissions_table > *');

                            $('.permission_alert').text("Deleted successfully.").fadeIn().delay(1000).fadeOut();

                            setTimeout(() => {
                                $('.permission_alert').text('');
                            }, 1500);
                        }
                    },
                    error:function(response){
                        $('.permission_delete_modal').attr('disabled',false);

                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
                    
            })

        });

    </script>
    
@endsection