@extends('layouts.dashboard')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Admin</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                <li class="breadcrumb-item active">Admin</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card" id="user_table_main">
                        <div class="alert alert-success user_edit_alert user_delete_success" style="display:none">

                        </div>
                        <div class="card-body">
                            <table id="admin_table" class="table dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>                                      
                                    <th>View Details</th>
                                    @if (auth()->user()->hasAnyPermission(['update-user','delete-user']) || auth()->user()->isSuperAdmin())                                        
                                        <th>Action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($admins as $admin)
                                    <tr id="user_row_{{ $admin->id }}">
                                        <td>
                                            <div>
                                                @if( $admin->userDetails->avatar != null )
                                                <img class="rounded-circle avatar-xs" src="{{ asset('uploads/users') }}/{{ $admin->userDetails->avatar }}" alt="">
                                                @else
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16 text-uppercase" style="width:32px;height:32px;">
                                                    {{ substr($admin->name,0,1) }}
                                                </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            @if($admin->userDetails->phone != null)
                                                {{ $admin->userDetails->phone }}
                                            @else 
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @forelse ($admin->roles as $role)
                                                <span class="badge bg-success">{{ $role->name }}</span>
                                            @empty
                                                N/A
                                            @endforelse
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm btn-rounded view_user_details" data-id="{{ $admin->id }}" data-bs-toggle="modal" data-bs-target="#viewUserDetails">
                                                View Details
                                            </button>
                                        </td>
                                        @canany(['update','delete'], $admin)
                                            <td>
                                                <div class="d-flex gap-3">
                                                    @can('update', $admin)                                                        
                                                        <a href="javascript:void(0);" class="text-success edit_user_details_btn" data-id="{{ $admin->id }}" data-bs-toggle="modal" data-bs-target="#editUserDetails">
                                                            <i class="mdi mdi-pencil font-size-18"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete', $admin)                                                        
                                                        <a href="javascript:void(0);" class="text-danger user_delete" data-id="{{ $admin->id }}" data-bs-toggle="modal" data-bs-target="#deleteUser">
                                                            <i class="mdi mdi-delete font-size-18"></i>
                                                        </a>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



    <!-- view user details modal -->
    <div class="modal fade" id="viewUserDetails" tabindex="-1" role="dialog" aria-labelledby="viewUserDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="viewUserDetailsLabel">User Details
                        @if (auth()->user()->hasPermissionTo('update-user') || auth()->user()->isSuperAdmin())
                            <button type="button" class="btn btn-primary edit_user_details_btn mx-2" data-id="{{ $admin->id }}" data-bs-toggle="modal" data-bs-target="#editUserDetails">Edit</button>
                        @endif
                    </h4>
                    <button type="button" class="btn-close close_user_view" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="card-title mb-3">Profile Photo :</h5>
                    <div class="profile_avatar mb-5" style="width:120px;height:120px;">
                        
                    </div>
                    <h4 class="card-title mb-4">Personal Information</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless user_details_table mb-0">
                            <tbody>
                                <tr class="user_details_name">
                                    <th scope="row">Name :</th>
                                    <td></td>
                                </tr>
                                <tr class="user_details_email">
                                    <th scope="row">E-mail :</th>
                                    <td></td>
                                </tr>
                                <tr class="user_details_phone">
                                    <th scope="row">Phone :</th>
                                    <td></td>
                                </tr>
                                <tr class="user_details_role">
                                    <th scope="row">Role :</th>
                                    <td></td>
                                </tr>
                                <tr class="user_details_permission">
                                    <th scope="row">Permissions :</th>
                                    <td></td>
                                </tr>
                                <tr class="user_details_location">
                                    <th scope="row">Location :</th>
                                    <td></td>
                                </tr>
                                <tr class="user_details_joined">
                                    <th scope="row">Joined :</th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_user_view" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->hasPermissionTo('update-user') || auth()->user()->isSuperAdmin())
        <!-- edit user details modal -->
        <div class="modal fade" id="editUserDetails" tabindex="-1" role="dialog" aria-labelledby="editUserDetailsLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal_preloader">
                        <h4 class="text-center m-0">loading...</h4>
                    </div>
                    <div class="modal-header">
                        <h4 class="modal-title" id="editUserDetailsLabel">Edit User Details
                        </h4>
                        <button type="button" class="btn-close close_edit_user_details_form" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="edit_user_details_form_wrapper">
                        <form id="edit_user_details_form" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="col-form-label modal_input_label">Role :</label>
                                    <select name="user_role" class="form-control text-capitalize edit_user_input" id="user_role">
                                    </select>
                                    <small class="user_role_error user_error_msg text-danger"></small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label modal_input_label">Permissions : </label>
                                    @if ($permissions->count() > 0)
                                        <input type="checkbox" class="form-check-input" id="modal_checkAllPermission">
                                    @endif
                                    <div class="edit_user_permission_input_wrapper d-flex flex-wrap" id="edit_user_permission_input_wrapper">
                                        
                                    </div>
                                    <small class="user_permission_error user_error_msg text-danger"></small>
                                </div>
                                <div class="mt-4">
                                    <h4>Change Password</h4>
                                    <div class="mb-3">
                                        <label for="">New Password :</label>
                                        <input id="password" type="password" placeholder="Password" class="form-control edit_user_input" name="password">
                                        <small class="password_error user_error_msg text-danger"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Confirm Password :</label>
                                        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control edit_user_input" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer edit_user_details_modal_footer">
                                <button type="button" class="btn btn-secondary close_edit_user_details_form" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" data-id="" id="editUserDetailsPost">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasPermissionTo('delete-user') || auth()->user()->isSuperAdmin())
        <!-- delete user modal -->
        <div class="modal fade" id="deleteUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteUserLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="deleteUserLabel">Delete User</h3>
                        <button type="button" class="btn-close close_user_delete_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light close_user_delete_modal" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger user_delete_modal" data-id="">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection



@section('footer_script')
        
<script>
    $(document).ready(function(){

        $("#admin_table").DataTable({
            columnDefs: [
                { orderable: false, targets: [0,3,4,5] }
            ],
            order: [[1, 'asc']]
        });



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        resetModalForm('#editUserDetails');

        checkAllInput('#modal_checkAllPermission', '.edit_user_permission');       


        $(document).on('click','.view_user_details', function(){

            let user_id = $(this).data('id');
            let url = "{{ route('user.details',':user_id') }}";
                url = url.replace(':user_id',user_id);

            $.ajax({

                type:"GET",
                url:url,
                beforeSend:function(){
                    $('#viewUserDetails').addClass('user_details_loading');
                },
                success:function(data){
                    if(data.success){

                        let date = new Date(data.user.created_at);
                        let joined_date = date.toLocaleDateString('en-us', {year:"numeric", month:"short", day:"numeric"});
                        let base_url = "{{ asset('uploads/users/') }}";
                        let avatar_url = base_url+'/'+data.user.user_details.avatar;
                        
                        setTimeout(() => {

                            $('#viewUserDetails').removeClass('user_details_loading');

                            if(data.user.user_details.avatar != null){
                                $('.profile_avatar').append('<img class="rounded-circle" id="profile_img" width="100%" height="100%" src="'+avatar_url+'" alt="avatar">');
                            }
                            else{
                                $('.profile_avatar').append('<span class="avatar-title rounded-circle bg-primary bg-soft text-primary text-uppercase" style="font-size:40px;">'+data.user.name.charAt(0)+'</span>');
                            }

                            $('#viewUserDetails').find('.edit_user_details_btn').data('id',data.user.id);
                            $('.user_details_table').find('.user_details_name td').text(data.user.name);
                            $('.user_details_table').find('.user_details_email td').text(data.user.email);

                            if(data.user.user_details.phone != null){
                                $('.user_details_table').find('.user_details_phone td').text(data.user.user_details.phone);
                            }
                            else{
                                $('.user_details_table').find('.user_details_phone td').text("N/A");
                            }

                            if(data.user.roles.length !== 0){
                                $(data.user.roles).each(function(key,role){
                                    $('.user_details_table').find('.user_details_role td').append('<span class="badge bg-success" style="margin-right:3px">'+role.name+'</span>');
                                });
                            }
                            else{
                                $('.user_details_table').find('.user_details_role td').text("N/A");
                            }

                            if(data.user.permissions.length !== 0){
                                $(data.user.permissions).each(function(key,permission){
                                    $('.user_details_table').find('.user_details_permission td').append('<span class="badge bg-primary" style="margin-right:3px">'+permission.name+'</span>');
                                });
                            }
                            else{
                                $('.user_details_table').find('.user_details_permission td').text("N/A");
                            }

                            if(data.user.user_details.getcity != null){
                                $('.user_details_table').find('.user_details_location td').text(data.user.user_details.getcity.city_name +', '+ data.user.user_details.getcity.country.country_name);
                            }
                            else{
                                $('.user_details_table').find('.user_details_location td').text("N/A");
                            }
                           
                            $('.user_details_table').find('.user_details_joined td').text(joined_date);

                        }, 300);

                        
                    }
                    else if(data.error){

                        alert(data.error);

                    }

                },
                error:function(){
                    if(confirm('Something went wrong! Try reloading the page.')){
                        window.location.reload();
                    }
                }
            });
            
        });


        $(document).on('click','.edit_user_details_btn', function(e){
            e.preventDefault();

            let id = $(this).data('id');
            let url = "{{ route('admin.user.edit',':user') }}";
                url = url.replace(':user',id);

            $.ajax({
                type:'GET',
                url:url,
                beforeSend:function(){
                    $('#editUserDetails').addClass('edit_user_details_loading');
                    $('.close_edit_user_details_form').attr('disabled',true);
                    $('#editUserDetailsPost').attr('disabled',true);
                },
                success:function(response){
                    if(response.status === 'success'){
                        $('#editUserDetails').find('#modal_checkAllPermission').prop('checked',response.data.is_checked);
                        $('#editUserDetails').find('#user_role').html(response.data.role_elems);
                        $('#editUserDetails').find('#edit_user_permission_input_wrapper').html(response.data.permission_elems);
                        $('#editUserDetails').find('#editUserDetailsPost').data('id',response.data.user_id);

                        setTimeout(() => {
                            $('#editUserDetails').removeClass('edit_user_details_loading');
                            $('.close_edit_user_details_form').attr('disabled',false);
                            $('#editUserDetailsPost').attr('disabled',false);
                        }, 150);
                    }
                },
                error:function(){
                    $('#editUserDetails').modal('hide');

                    if(confirm('Something went wrong! Try reloading the page.')){
                        window.location.reload();
                    }
                }
            });
        });



        $(document).on('click','#editUserDetailsPost', function(e){
            e.preventDefault();
            $('#edit_user_details_form').submit();
        });

        $(document).on('submit','#edit_user_details_form', function(e){
            e.preventDefault();

            $('#edit_user_details_form').find('.user_error_msg').text('');
            $('#edit_user_details_form').find('.edit_user_input').removeClass('is-invalid');

            let formData = $(this).serializeArray();
            let id = $('#editUserDetailsPost').data('id');
            let url = "{{ route('admin.user.update', ':user') }}";
                url = url.replace(':user',id);

            $.ajax({
                type:'PUT',
                url:url,
                data:formData,
                beforeSend:function(){
                    $('.close_edit_user_details_form').attr('disabled',true);
                    $('#editUserDetailsPost').attr('disabled',true);
                },
                success:function(response){
                    if(response.status === 'success'){
                        $('#editUserDetails').modal('hide');
                        $('#user_row_'+response.data.user_id).load(' #user_row_'+response.data.user_id+' >* ');

                        $('.user_edit_alert').text('Updated successfully!').fadeIn().delay(1500).fadeOut();

                        setTimeout(() => {
                            $('.user_edit_alert').text('');
                        }, 2000);
                    }
                },
                error:function(response){
                    $('.close_edit_user_details_form').attr('disabled',false);
                    $('#editUserDetailsPost').attr('disabled',false);

                    if(response.status === 422){
                        let errors = response.responseJSON.errors;
                        $.each(errors,function(key,error){
                            $('#edit_user_details_form').find("."+key+"_error").text(error);
                            $('#edit_user_details_form').find('#'+key).addClass('is-invalid');
                        });
                    }
                    else{
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                }
            });

        })



        $(document).on('click','.close_user_view', function(){
            $('#viewUserDetails').load(' #viewUserDetails >* ');
        });

        $('#viewUserDetails').on('hide.bs.modal', function () 
        {
            $('#viewUserDetails').load(' #viewUserDetails >* ');
        });

        $(document).on('click','.user_delete', function()
        {   
            let user_id = $(this).data('id');
            $('#deleteUser').find('.user_delete_modal').data('id',user_id);

        });

        $(document).on('click','.user_delete_modal', function()
        {   

            let user_id = $(this).data('id');
            let url = "{{ route('admin.user.delete',':user_id') }}";
                url = url.replace(':user_id',user_id);
                
            
            $.ajax({
                type:'DELETE',
                url:url,
                success:function(data){

                    if(data.success){

                        $('#deleteUser').modal('hide');
                        
                        $('#user_row_'+user_id).css('display','none');
                        $('#user_row_'+user_id).remove();
                        
                        $('.user_delete_success').text(data.success);
                        $('.user_delete_success').delay(500).fadeIn(300);
                        $('.user_delete_success').delay(1500).fadeOut(300);

                    }
                    else if(data.error){
                        alert(data.error);
                    }

                },
                complete:function(){
                    setTimeout(() => {
                        alert("Please reload the page.");
                        location.reload(true);
                    }, 3000);
                },
                error:function(){
                    if(confirm('Something went wrong! Try reloading the page.')){
                        window.location.reload();
                    }
                }
            });

        });


        $(document).on('click','.close_user_delete_modal', function(){

            $('#deleteUser').load(' #deleteUser >* ');

        });



    });
</script>

@endsection