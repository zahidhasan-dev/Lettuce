@extends('layouts.dashboard')

@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Account</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-8 col-12 m-auto">
                    <div class="card">
                        <div class="card-body">
                            @if (session('updatesuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('updatesuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="profile_edit_btn mb-4">
                                <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                            </div>
                            <div class="profile_avatar mb-5" style="width:150px;height:150px;">
                                <h5 class="card-title mb-3">Profile Photo :</h5>
                                @if(auth()->user()->userDetails->avatar != null)
                                <img class="rounded-circle" id="profile_img" width="100%" height="100%" src="{{ asset('uploads/users') }}/{{ auth()->user()->userDetails->avatar }}" alt="">
                                @else 
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary text-uppercase" style="font-size:40px;">
                                    {{ substr(auth()->user()->name,0,1) }}
                                </span>
                                @endif
                            </div>
                            <h4 class="card-title mb-4">Personal Information</h4>
                            <div class="table-responsive">
                                <table class="table nowrap mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Name :</th>
                                            <td>{{ auth()->user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">E-mail :</th>
                                            <td>{{ auth()->user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone :</th>
                                            <td>
                                                @if( auth()->user()->userDetails->phone != null )
                                                    {{ auth()->user()->userDetails->phone }}
                                                @else 
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Role :</th>
                                            <td>
                                                @forelse (auth()->user()->getAllRoles() as $role)
                                                    <span class="badge bg-success">{{ $role->name }}</span>
                                                @empty
                                                    N/A
                                                @endforelse
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Permissions :</th>
                                            <td>
                                                @forelse (auth()->user()->getDirectPermissions() as $permission)
                                                    <span class="badge bg-primary">{{ $permission->name }}</span>
                                                @empty
                                                    N/A
                                                @endforelse
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Location :</th>
                                            
                                            <td>
                                                @if(auth()->user()->userDetails->city != null && auth()->user()->userDetails->country != null)
                                                    {{ auth()->user()->userDetails->getcity->city_name }}, {{ auth()->user()->userDetails->getcity->country->country_name }}
                                                @else
                                                    N/A 
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="account_password mt-5">
                                <h5>Change Password</h5>
                                @if (session('passupdated'))
                                    <div class="alert alert-success col-6" role="alert">
                                        {{ session('passupdated') }}
                                    </div>
                                @elseif (session('passerror'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('passerror') }}
                                    </div>
                                            @endif
                                <div class="change_password_form mt-1">
                                    <form action="{{ route('admin.password.update') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-7 col-sm-8 col-12">
                                                <div class="mt-4">
                                                    <label for="formrow-password-input" class="form-label">Current Password :</label>
                                                    <input type="password" class="form-control" id="formrow-password-input" name="old_password" placeholder="Enter Your Password">
                                                </div>
                                            </div>
                                            @error('old_password')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                            <div class="col-md-7 col-sm-8 col-12">
                                                <div class="mt-4">
                                                    <label for="formrow-new-password-input" class="form-label">New Password :</label>
                                                    <input type="password" class="form-control" id="formrow-new-password-input" name="password" placeholder="Enter New Password">
                                                </div>
                                            </div>
                                            @error('password')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                            <div class="col-md-7 col-sm-8 col-12">
                                                <div class="mt-4">
                                                    <label for="formrow-confirm-password-input" class="form-label">Confirm Password :</label>
                                                    <input type="password" class="form-control" id="formrow-confirm-password-input" name="password_confirmation" placeholder="Confirm Your Password">
                                                </div>
                                            </div>
                                            @error('password_confirmation')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror

                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary w-md">Save Password</button>
                                            </div>

                                            
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    
@endsection