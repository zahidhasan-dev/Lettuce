@extends('layouts.dashboard')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Register User</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                            <li class="breadcrumb-item active">Register</li>
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
                        <form method="POST" action="{{ route('admin.user.create') }}" class="ltn__form-box contact-form-box">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12 m-auto">

                                    @if(session('user_success'))
                                    <div class="alert alert-success">
                                        {{ session('user_success') }}
                                    </div>
                                    @elseif (session('user_error'))
                                    <div class="alert alert-danger">
                                        {{ session('user_error') }}
                                    </div>
                                    @endif


                                    <div class="mb-4 text-uppercase">
                                        <h4>Add User</h4>
                                    </div>
                                    <div class="mb-4">
                                        <label for="">Name :</label>
                                        <input id="name" type="text" placeholder="Full Name*" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
            
                                    <div class="mb-4">
                                        <label for="">Email :</label>
                                        <input id="email" type="email" placeholder="Email*" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
            
                                    <div class="mb-4">
                                        <label for="">Password :</label>
                                        <input id="password" type="password" placeholder="Password*" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
            
                                    <div class="mb-4">
                                        <label for="">Password Confirm :</label>
                                        <input id="password-confirm" type="password" placeholder="Confirm Password*" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="mb-4">
                                        <label for="">Role :</label>
                                        <select name="user_role" class="form-control  @error('user_role') is-invalid @enderror" id="user_role" required>
                                            <option value="" selected disabled>--Select Role--</option>
                                            <option value="1">Admin</option>
                                            <option value="0">Customer</option>
                                        </select>
                                        @error('user_role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
            
                                    <div class="btn-wrapper mb-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('CREATE USER') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
    
@endsection