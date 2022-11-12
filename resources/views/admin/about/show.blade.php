@extends('layouts.dashboard')

@section('about_parent_active')
mm-active
@endsection

@section('about_active')
active
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">About</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('about.index') }}">About</a></li>
                                <li class="breadcrumb-item active">View About</li>
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
                                        <a href="{{ route('about.index') }}" class="btn btn-dark"><i class="bx bx-arrow-back"></i> Back</a>
                                        <a href="{{ route('about.edit',$about->id) }}" class="btn btn-primary" style="margin-left:15px;">Edit About</a>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="about-img">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="dash_about_img_container">
                                                    <img src="{{ asset('uploads/about/'.$about->about_image) }}" alt="" class="img-fluid mx-auto d-block">
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
                                                <th>Sub-title</th>
                                                <td>{{ $about->about_sub_title }}</td>
                                            </tr>
                                            <tr>
                                                <th>Title</th>
                                                <td>{{ $about->about_title }}</td>
                                            </tr>
                                            <tr>
                                                <th>Description_1</th>
                                                <td>
                                                    @if ($about->about_desc_1 != null)
                                                        {{ $about->about_desc_1 }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Description_2</th>
                                                <td>
                                                    @if ($about->about_desc_2 != null)
                                                        {{ $about->about_desc_2 }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Author Name</th>
                                                <td>
                                                    @if ($about->about_author_name != null)
                                                        {{ $about->about_author_name }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Author Title</th>
                                                <td>
                                                    @if ($about->about_author_title != null)
                                                        {{ $about->about_author_title }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    @if ($about->is_active)
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