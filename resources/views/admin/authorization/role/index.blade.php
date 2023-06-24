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
                                <li class="breadcrumb-item active">Role</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="{{ auth()->user()->can('create', \App\Models\Role::class) ? 'col-md-8' : 'col-md-12' }} order-md-1 order-sm-2 col-12">
                    <div class="card">
                        <div class="alert alert-success role_alert" style="display: none" role="alert">
                                    
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-4">Roles</h4>
                            <table id="roles_table" class="table nowrap w-100">
                                <thead>
                                <tr>
                                    <th>#Id</th>
                                    <th>Name</th>
                                    <th>Permission</th>
                                    @if (auth()->user()->hasAnyPermission(['update-role','delete-role']) || auth()->user()->isSuperAdmin())
                                        <th>Action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td class="text-capitalize">{{ $role->name }}</td>
                                        <td>
                                            @forelse ($role->permissions as $permission)
                                                <span class="badge bg-primary">{{ $permission->name }}</span>
                                            @empty
                                                N/A
                                            @endforelse
                                        </td>
                                        @canany(['update','delete'], $role)
                                            <td>
                                                <div class="d-flex gap-3">
                                                    @can('update', $role)                                                        
                                                        <a href="javascript:void(0);" class="text-success edit_role" data-id="{{ $role->id }}" data-bs-toggle="modal" data-bs-target="#editRole">
                                                            <i class="mdi mdi-pencil font-size-18"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete', $role)                                                        
                                                        <a href="javascript:void(0);" class="text-danger role_delete" data-id="{{ $role->id }}" data-bs-toggle="modal" data-bs-target="#deleteRole">
                                                            <i class="mdi mdi-delete font-size-18"></i>
                                                        </a>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
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

                @can('create', \App\Models\Role::class)
                    <div class="col-md-4 order-md-2 order-sm-1 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">Create Role</h4>
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
                                    <form action="{{ route('admin.role.store') }}" method="POST" id="create_role_form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mt-4">
                                                    <label for="role_name" class="form-label">Role Name :</label>
                                                    <input type="text" class="form-control role_input" id="role_name" name="role_name" placeholder="Enter Role Name" value="">
                                                    <small class="role_name_error role_error_msg text-danger"></small>
                                                </div>
                                                <div class="mt-4">
                                                    <label class="form-label">Permissions : </label>
                                                    @if ($permissions->count() > 0)
                                                        <input class="form-check-input" type="checkbox" id="checkAllPermission">
                                                    @endif
                                                    <div class="role_permission_input_wrapper d-flex flex-wrap">
                                                        @forelse ($permissions as $permission)
                                                            <label for="role_permission_{{ $permission->id }}" style="margin-right:10px;cursor:pointer;">
                                                                <input type="checkbox" class="form-check-input role_input role_permission" id="role_permission_{{ $permission->id }}" name="role_permission[]" value="{{ $permission->id }}">
                                                                <span>{{ $permission->name }}</span>
                                                            </label>
                                                        @empty
                                                            <span class="d-block">N/A</span>                                               
                                                        @endforelse
                                                    </div>
                                                    <small class="role_permission_error role_error_msg text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button type="button" class="btn btn-primary w-md" id="create_role_form_btn" onclick="$('#create_role_form').submit()">Create</button>
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


    @if (auth()->user()->hasPermissionTo('update-role') || auth()->user()->isSuperAdmin())
        <!-- edit Role modal -->
        <div class="modal fade" id="editRole" tabindex="-1" aria-labelledby="editRoleLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal_preloader">
                        <h4 class="text-center m-0">loading...</h4>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoleLabel">Edit Role</h5>
                        <button type="button" class="btn-close close_role_form" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="role_edit_form_wrapper">
                        <form id="role_edit_form" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="col-form-label modal_input_label">Role Name:</label>
                                    <input type="text" class="form-control role_name" name="role_name" value="">
                                    <small class="role_name_error role_error_msg text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label modal_input_label">Permissions : </label>
                                    @if ($permissions->count() > 0)
                                        <input type="checkbox" class="form-check-input" id="modal_checkAllPermission">
                                    @endif
                                    <div class="role_permission_input_wrapper d-flex flex-wrap" id="edit_role_permission_input_wrapper">
                                        @forelse ($permissions as $permission)
                                            <label for="edit_role_permission_{{ $permission->id }}" style="margin-right:10px;cursor:pointer;">
                                                <input type="checkbox" class="form-check-input role_input edit_role_permission" id="edit_role_permission_{{ $permission->id }}" name="role_permission[]" value="{{ $permission->id }}">
                                                <span>{{ $permission->name }}</span>
                                            </label>
                                        @empty
                                            <span class="d-block">N/A</span>                                               
                                        @endforelse
                                    </div>
                                    <small class="role_permission_error role_error_msg text-danger"></small>
                                </div>
                            </div>
                            <div class="modal-footer role_modal_footer">
                                <button type="button" class="btn btn-secondary close_role_form" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" data-id="" id="editRolePost">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if (auth()->user()->hasPermissionTo('delete-role') || auth()->user()->isSuperAdmin())
        <!-- delete Role modal -->
        <div class="modal fade" id="deleteRole" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteRoleLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="deleteRoleLabel">Delete Role</h3>
                        <button type="button" class="btn-close close_role_delete_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light close_role_delete_modal" data-bs-dismiss="modal">Cancel</button>
                        <form id="role_delete_form" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger role_delete_modal" data-id="">Delete</button>
                        </form>
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // reset modal form on close

            resetModalForm('#editRole');



            // select all input

            checkAllInput('#checkAllPermission','.role_permission');

            checkAllInput('#modal_checkAllPermission','.edit_role_permission');



            $(document).on('submit','#create_role_form', function(e){
                e.preventDefault();

                $('#create_role_form_btn').attr('disabled',true);
                $('#create_role_form').find('.role_error_msg').text('');
                $('#create_role_form').find('.role_input').removeClass('border-danger');

                let formData = $(this).serializeArray();
                let url = "{{ route('admin.role.store') }}";

                $.ajax({
                    type:'POST',
                    url:url,
                    data:formData,
                    success:function(response){
                        if(response.status === 'success'){
                            $('#checkAllPermission').prop('checked',false);
                            $('.role_permission').prop('checked',false);
                            $('#create_role_form_btn').attr('disabled',false);
                            $('.role_alert').text('Created successfully!').fadeIn().delay(1000).fadeOut();
                            $('#roles_table').load(' #roles_table>* ');
                            $('#create_role_form').find('#role_name').val('');

                            setTimeout(() => {
                                $('.role_alert').text('');
                            }, 1500);
                        }
                    },
                    error:function(response){
                        $('#create_role_form_btn').attr('disabled',false);

                        if(response.status === 422){
                            let errors = response.responseJSON.errors;

                            $.each(errors, function(key,error){
                                $('#create_role_form').find("."+key+"_error").text(error).addClass('border-danger');
                                $('#create_role_form').find('#'+key).addClass('border-danger');
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


            $(document).on('click','.edit_role', function(e){

                e.preventDefault();

                let id =  $(this).data('id');
                let url = "{{ route('admin.role.edit',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#editRole').addClass('role_edit_loading');
                        $('.close_role_form').attr('disabled',true);
                        $('#editRolePost').attr('disabled',true);
                    },
                    success:function(response){
                        if(response.status === 'success'){
                            $('#modal_checkAllPermission').prop('checked',response.data.is_checked);
                            $('#role_edit_form').find('.role_name').val(response.data.role.name);
                            $('#editRolePost').data('id',response.data.role.id);
                            $('#edit_role_permission_input_wrapper').html(response.data.permissions);

                            setTimeout(() => {
                                $('#editRole').removeClass('role_edit_loading');
                                $('.close_role_form').attr('disabled',false);
                                $('#editRolePost').attr('disabled',false);
                            }, 150);
                        }
                    },
                    error:function(){
                        $('#editRole').removeClass('role_edit_loading');
                        $('#editRole').modal('hide');

                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }

                });

            });


            $(document).on('click','#editRolePost', function(e){
                e.preventDefault();
                $('#role_edit_form').submit();
            });


            $(document).on('submit','#role_edit_form', function(e){

                e.preventDefault();

                $('#editRolePost').attr('disabled',true);
                $('#role_edit_form').find('.role_error_msg').text('');
                $('#role_edit_form').find('.role_input').removeClass('border-danger');

                let formData = $(this).serializeArray();
                let id = $('#editRolePost').data('id');
                let url = "{{ route('admin.role.update', ':id') }}";
                    url =url.replace(':id',id);
                
                $.ajax({
                    type:'PUT',
                    url:url,
                    data:formData,
                    success:function(response){
                        if(response.status === 'success'){
                            $('#editRole').modal('hide');
                            $('#roles_table').load(' #roles_table > *');
                            $('.role_alert').text('Updated successfully!').fadeIn().delay(1000).fadeOut();

                            setTimeout(() => {
                                $('.role_alert').text('');
                            }, 1500);
                        }
                    },
                    error:function(response){
                        $('#editRolePost').attr('disabled',false);
                        if(response.status === 422){
                            let errors = response.responseJSON.errors;
                            $.each(errors, function(key,error){
                                $('#role_edit_form').find("."+key+"_error").text(error).addClass('border-danger');
                                $('#role_edit_form').find('#'+key).addClass('border-danger');
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



            $('#deleteRole').on('hide.bs.modal', function(){
                $('.role_delete_modal').data('id','');
            });


            $(document).on('click','.role_delete', function(){
                let id = $(this).data('id');
                $('.role_delete_modal').data('id',id);
            });


            $('.role_delete_modal').on('click', function(){   

                $('.role_delete_modal').attr('disabled',true);

                let id = $(this).data('id');
                let url = "{{ route('admin.role.destroy', ':id') }}";
                    url = url.replace(':id', id);

                $.ajax({
                    type:"DELETE",
                    url:url,
                    success:function(response){
                        if(response.status === 'success'){

                            $('.role_delete_modal').attr('disabled',false);

                            $('#deleteRole').modal('hide');
                            $('#roles_table').load(' #roles_table > *');

                            $('.role_alert').text("Deleted successfully.").fadeIn().delay(1000).fadeOut();

                            setTimeout(() => {
                                $('.role_alert').text('');
                            }, 1500);
                        }
                    },
                    error:function(response){
                        $('.role_delete_modal').attr('disabled',false);

                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
                    
            })

        });

    </script>
    
@endsection