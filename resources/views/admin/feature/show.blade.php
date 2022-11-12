@extends('layouts.dashboard')

@section('feature_parent_active')
mm-active
@endsection

@section('feature_active')
active
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Feature</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('feature.index') }}">Feature</a></li>
                                <li class="breadcrumb-item active">View Feature</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <a href="{{ route('feature.index') }}" class="btn btn-dark"><i class="bx bx-arrow-back"></i> Back</a>
                                        <a href="{{ route('feature.edit',$feature->id) }}" class="btn btn-primary" style="margin-left:15px;">Edit Feature</a>
                                    </div>
                                </div>
                                <div class="col-xl-6 mt-3">
                                    <div class="feature-img">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="mb-3">Image :</h5>
                                                <div class="dash_feature_img_container">
                                                    <img src="{{ asset('uploads/feature/'.$feature->feature_image) }}" alt="" class="img-fluid d-block">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="mt-5">
                                <h5 class="mb-3">Details :</h5>

                                <div class="table-responsive">
                                    <table class="table mb-0 table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Title</th>
                                                <td>{{ $feature->feature_title }}</td>
                                            </tr>
                                            <tr>
                                                <th>Description_1</th>
                                                <td>{{ $feature->feature_desc }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    @if ($feature->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end Specifications -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

@endsection