@extends('layouts.dashboard')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Admins</h4>

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
                        <div class="alert alert-success user_delete_success" style="display:none">

                        </div>
                        <div class="card-body">
                            <table id="admin_table" class="table dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>View Details</th>
                                    <th>Action</th>
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
                                            <button type="button" class="btn btn-primary btn-sm btn-rounded view_user_details" data-id="{{ $admin->id }}" data-bs-toggle="modal" data-bs-target="#viewUserDetails">
                                                View Details
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="javascript:void(0);" class="text-danger user_delete" data-id="{{ $admin->id }}" data-bs-toggle="modal" data-bs-target="#deleteUser"><i class="mdi mdi-delete font-size-18"></i></a>
                                            </div>
                                        </td>
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
    <div class="modal fade" id="viewUserDetails" tabindex="-1" role="dialog" aria-labelledby=viewUserDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id=viewUserDetailsLabel">User Details</h4>
                    <button type="button" class="btn-close close_user_view" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="card-title mb-3">Profile Photo :</h5>
                    <div class="profile_avatar mb-5" style="width:120px;height:120px;">
                        
                    </div>
                    <h4 class="card-title mb-4">Personal Information</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless user_details_table table-nowrap mb-0">
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
    <!-- end modal -->


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

                            $('.user_details_table').find('.user_details_name td').text(data.user.name);
                            $('.user_details_table').find('.user_details_email td').text(data.user.email);

                            if(data.user.user_details.phone != null){
                                $('.user_details_table').find('.user_details_phone td').text(data.user.user_details.phone);
                            }
                            else{
                                $('.user_details_table').find('.user_details_phone td').text("N/A");
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

                    alert("Something went wrong!");
                    
                }
            });
            
        });


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
                    alert("Something went wrong!");
                }
            });

        });


        $(document).on('click','.close_user_delete_modal', function(){

            $('#deleteUser').load(' #deleteUser >* ');

        });



    });
</script>

@endsection