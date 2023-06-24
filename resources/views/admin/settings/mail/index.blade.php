@extends('layouts.dashboard')



@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Settings</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
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
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h3 class="mb-4">Mail Settings</h3>

                        <form action="{{ auth()->user()->can('create-or-update', \App\Models\MailSetting::class) ? route('admin.settings.mail.update') : '' }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="">Mail Transport:</label>
                                        <input id="mail_transport" name="mail_transport" type="text" class="form-control" placeholder="Transport" value="{{ old('mail_transport', $mail_settings->mail_transport ?? '') }}">
                                        @error('mail_transport')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Mail Host:</label>
                                        <input id="mail_host" name="mail_host" type="text" class="form-control" placeholder="Host" value="{{ old('mail_host', $mail_settings->mail_host ?? '') }}">
                                        @error('mail_host')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Mail Port:</label>
                                        <input id="mail_port" name="mail_port" type="text" class="form-control" placeholder="Port" value="{{ old('mail_port', $mail_settings->mail_port ?? '') }}">
                                        @error('mail_port')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Mail Encryption:</label>
                                        <input id="mail_encryption" name="mail_encryption" type="text" class="form-control" placeholder="Encryption" value="{{ old('mail_encryption', $mail_settings->mail_encryption ?? '') }}">
                                        @error('mail_encryption')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Mail Username:</label>
                                        <input id="mail_username" name="mail_username" type="text" class="form-control" placeholder="Username" value="{{ old('mail_username', $mail_settings->mail_username ?? '') }}">
                                        @error('mail_username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Mail Password:</label>
                                        <input id="mail_password" name="mail_password" type="text" class="form-control" placeholder="Password" value="{{ old('mail_password', $mail_settings->mail_password ?? '') }}">
                                        @error('mail_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Mail From Address:</label>
                                        <input id="mail_from_address" name="mail_from_address" type="text" class="form-control" placeholder="Email Address" value="{{ old('mail_from_address', $mail_settings->mail_from_address ?? '') }}">
                                        @error('mail_from_address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Mail From Name:</label>
                                        <input id="mail_from_name" name="mail_from_name" type="text" class="form-control" placeholder="From Name" value="{{ old('mail_from_name', $mail_settings->mail_from_name ?? '') }}">
                                        @error('mail_from_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @can('create-or-update', \App\Models\MailSetting::class)
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="update_mail_settings_btn">Update</button>
                                </div>
                            @endcan
                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
    
@endsection