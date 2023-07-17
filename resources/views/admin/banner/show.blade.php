@extends('layouts.dashboard')

@section('banner_parent_active')
mm-active
@endsection

@section('banner_active')
active
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Banner</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">Banner</a></li>
                                <li class="breadcrumb-item active">View Banner</li>
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
                                        <a href="{{ route('banner.index') }}" class="btn btn-dark"><i class="bx bx-arrow-back"></i> Back</a>
                                        @can('update', $banner)
                                            <a href="{{ route('banner.edit',$banner->id) }}" class="btn btn-primary" style="margin-left:15px;">Edit Banner</a>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="product-detai-imgs">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="dash_banner_img_container">
                                                    <img src="{{ asset('uploads/banner/'.$banner->banner_image) }}" alt="" class="img-fluid mx-auto d-block">
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
                                                <th scope="row" style="width: 150px;">Banner Type</th>
                                                <td>{{ $banner->banner_type }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Banner Sub-title</th>
                                                <td>
                                                    @if ($banner->banner_sub_title != null)
                                                        {{ $banner->banner_sub_title }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Banner Title</th>
                                                <td>
                                                    @if ($banner->banner_title != null)
                                                        {{ $banner->banner_title }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Banner Button</th>
                                                <td>
                                                    @if ($banner->banner_button != null)
                                                        {{ $banner->banner_button }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Category</th>
                                                <td>
                                                    @if ($banner->category_id != null)
                                                        {{ $banner->category->category_name }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Discount</th>
                                                <td>
                                                    @if ($banner->discount_id != null)
                                                        {{ $banner->discount->discount_name.' ('.discountValueType($banner->discount->id).')' }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Slug</th>
                                                <td>
                                                    @if ($banner->banner_slug != null)
                                                        {{ $banner->banner_slug }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Url</th>
                                                <td>
                                                    @if ($banner->url != null)
                                                        {{ $banner->url }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Status</th>
                                                <td>
                                                    @if($banner->status == 1)
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