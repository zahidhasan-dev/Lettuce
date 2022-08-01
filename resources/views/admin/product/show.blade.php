@extends('layouts.dashboard')

@section('active')
active
@endsection
@section('parent_active')
mm-active
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Product</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                                <li class="breadcrumb-item active">View Product</li>
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
                                <div class="col-12">
                                    <div class="mb-5">
                                        <a href="{{ route('product.index') }}" class="btn btn-dark"><i class="bx bx-arrow-back"></i> Back</a>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="product-detai-imgs">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-3 col-4">
                                                <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link active" id="product-{{ $product->id }}-tab" data-bs-toggle="pill" href="#product-{{ $product->id }}" role="tab" aria-controls="product-{{ $product->id }}" aria-selected="true">
                                                        <img src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="" class="img-fluid mx-auto d-block rounded">
                                                    </a>
                                                    @if($product->multiple_photos->count() > 0)
                                                        @foreach ($product->multiple_photos as $photo)
                                                            <a class="nav-link" id="product-{{ $photo->id }}-tab" data-bs-toggle="pill" href="#product-{{ $photo->id }}" role="tab" aria-controls="product-{{ $photo->id }}" aria-selected="false">
                                                                <img src="{{ asset('uploads/product/'.$photo->multiple_photo) }}" alt="" class="img-fluid mx-auto d-block rounded">
                                                            </a>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    <div class="tab-pane fade show active" id="product-{{ $product->id }}" role="tabpanel" aria-labelledby="product-{{ $product->id }}-tab">
                                                        <div>
                                                            <img src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="" class="img-fluid mx-auto d-block">
                                                        </div>
                                                    </div>
                                                    @if($product->multiple_photos->count() > 0)
                                                        @foreach ($product->multiple_photos as $photo)
                                                            <div class="tab-pane fade" id="product-{{ $photo->id }}" role="tabpanel" aria-labelledby="product-{{ $photo->id }}-tab">
                                                                <div>
                                                                    <img src="{{ asset('uploads/product/'.$photo->multiple_photo) }}" alt="" class="img-fluid mx-auto d-block">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-xl-6">
                                    <div class="mt-4 mt-xl-3">
                                        <a href="javascript: void(0);" class="text-primary text-capitalize">
                                            @foreach ($product->categories as $category)
                                                {{ $category->category_name }}
                                            @endforeach
                                        </a>
                                        <h4 class="mt-1 mb-3">{{ $product->product_name }}</h4>
            
                                        <p class="text-muted float-start me-3">
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star text-warning"></span>
                                            <span class="bx bxs-star"></span>
                                        </p>
                                        <p class="text-muted mb-4">( 152 Customers Review )</p>
            
                                        @if($product->has_discount == 1 && getProductDiscount($product->id) != null)
                                            @if (validateDiscount(getProductDiscount($product->id)->id) == true)
                                                <h6 class="text-success text-uppercase">{{ discountValueType(getProductDiscount($product->id)->id) }} Off </h6>
                                            @endif
                                        @endif
                                        <h5 class="mb-4">Price : 
                                            @if($product->has_discount == 1  && getProductDiscount($product->id) != null)
                                                @if (validateDiscount(getProductDiscount($product->id)->id) == true)
                                                    <span class="text-muted me-2"><del>${{ round(($product->price / 100),2) }}</del></span> <b>${{ discountPrice($product->id) }}</b>
                                                @endif
                                            @else       
                                                <span class="text-muted me-2">${{ round(($product->price / 100),2) }}</span>
                                            @endif
                                        </h5>
                                        <p class="text-muted mb-4">{{ $product->product_desc }}</p>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div>
                                                    @if ($product->has_discount == 1 && getProductDiscount($product->id) != null)
                                                        @if(validateDiscount(getProductDiscount($product->id)->id) == true)
                                                            <p class="text-muted">
                                                                <i class="bx bxs-offer font-size-16 align-middle text-primary me-1"></i><b>Discount : </b>
                                                                {{ getProductDiscount($product->id)->discount_name.' '.'( '.discountValueType(getProductDiscount($product->id)->id).' )' }}
                                                            </p>
                                                        @endif
                                                    @endif
                                                    <p class="text-muted"><i class="fas fa-weight-hanging font-size-14 align-middle text-primary me-1"></i><b>Weight / Pieces : </b>
                                                        {{ productSize($product->id) }}
                                                    </p>
                                                    <p class="text-muted"><i class="bx bxs-hourglass font-size-16 align-middle text-primary me-1"></i> <b>In Stock :</b> {{ $product->in_stock }}</p>
                                                    <p class="text-muted"><i class="fas fa-warehouse font-size-14 align-middle text-primary me-1"></i> <b>Stock :</b> {{ $product->stock }}</p>
                                                    <p class="text-muted"><i class="bx bx-link font-size-16 align-middle text-primary me-1"></i> <b>Slug :</b> {{ $product->slug }}</p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('product.edit',$product->id) }}" class="btn btn-primary waves-effect waves-light mt-2 me-1">Edit Product</a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mt-5">
                                        <h5>Reviews :</h5>

                                        <div class="d-flex py-3 border-bottom">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="#" class="avatar-xs rounded-circle" alt="img">
                                            </div>
                                            
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1 font-size-15">Brian</h5>
                                                <p class="text-muted">If several languages coalesce, the grammar of the resulting language.</p>
                                                
                                                <div class="text-muted font-size-12"><i class="far fa-calendar-alt text-primary me-1"></i> 5 hrs ago</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>


@endsection



