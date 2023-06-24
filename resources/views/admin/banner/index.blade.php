@extends('layouts.dashboard')

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                            <li class="breadcrumb-item active">Banner</li>
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
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-6 col-lg-5">
                                <div class="alert alert-success banner_alert" style="display: none" role="alert">
                                
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            @can('create', \App\Models\Banner::class)
                                <div class="col-sm-6 col-md-7 col-lg-8">
                                    <div class="text-center text-sm-start text-md-start text-lg-start text-xl-start">
                                        <a href="{{ route('banner.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                            <i class="mdi mdi-plus me-1"></i> Add New Banner
                                        </a>
                                    </div>
                                </div><!-- end col-->
                            @endcan
                            <div class="col-sm-6 col-md-5 col-lg-4">
                                <div class="text-center text-sm-end text-md-end text-lg-end text-xl-end">
                                    <label class="d-block mb-4 text-center text-sm-end text-md-end text-lg-end text-xl-end">
                                        <input type="search" class="form-control form-control-sm" id="banner_search" name="banner_search" placeholder="Search">
                                    </label>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive" id="banner_table_wrapper">
                            <table id="banner_table" class="table align-middle table-nowrap table-check" >
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">SL NO.</th>
                                        <th class="align-middle">Banner Image</th>
                                        <th class="align-middle">Banner Type</th>
                                        <th class="align-middle">Banner Title</th>
                                        <th class="align-middle">Category</th>
                                        <th class="align-middle">Discount</th>
                                        <th class="align-middle">Banner Slug</th>
                                        <th class="align-middle">Status</th>
                                            
                                        @if (auth()->user()->hasPermissionTo('view-banner') || auth()->user()->isSuperAdmin())
                                            <th class="align-middle">View Details</th>
                                        @endif
                                        
                                        @if (auth()->user()->hasAnyPermission(['update-banner','delete-banner']) || auth()->user()->isSuperAdmin())
                                            <th class="align-middle">Action</th>
                                        @endif
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('admin.banner.banner_data')
                                </tbody>
                            </table>
                            <input type="hidden" name="hidden_page" id="hidden_page_value" value="1">
                            <div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->



<!-- Modal -->

@if(auth()->user()->hasPermissionTo('delete-banner') || auth()->user()->isSuperAdmin())
    <!-- delete faq modal -->
    <div class="modal fade" id="deleteBanner" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteBannerLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteBannerLabel">Delete Banner</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger banner_delete_modal" data-id="">Delete</button>
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
                headers:{
                    'X-CSRF-TOKEN':$('meta[name=csrf-token]').attr('content')
                }
            });



            $(document).on('click','.banner_delete', function (event){
                event.preventDefault();
                $('.banner_delete_modal').data('id',$(this).data('id'));
            });

            $(document).on('click','.banner_delete_modal', function(event){
                let id = $(this).data('id');
                let url = "{{ route('banner.destroy',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'DELETE',
                    url:url,
                    success:function(data){
                        $('#deleteBanner').modal('hide');
                        $('.banner_alert').text(data.success);
                        setTimeout(() => {
                            $('#banner_table').load(' #banner_table >* ');
                            $('.banner_alert').fadeIn().delay(800).fadeOut();
                        }, 400);
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
            });


            $(document).on('click','.switchBannerStatus', function(event){
                event.preventDefault();

                let id = $(this).data('id');
                let url = "{{ route('banner.status.update',':id') }}";
                    url = url.replace(':id',id);
                
                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){

                        if(data.banner_status == 1){
                            $('#switchBannerStatus_'+id).prop('checked',true);
                        }
                        else{
                            $('#switchBannerStatus_'+id).prop('checked',false);
                        }

                        $('.banner_alert').text(data.success);
                        setTimeout(() => {
                            $('.banner_alert').fadeIn().delay(800).fadeOut();
                        }, 200);

                    },
                    error:function(response){
                        if(response.status === 403){
                            alert(response.responseJSON.message);

                            return;
                        }
                        
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });


            $(document).on('search','#banner_search', function(){
                $('#banner_table').load(' #banner_table >* ');
            });



            $(document).on('keyup','#banner_search', function(){

                let banner_query = $(this).val();
                    banner_query = $.trim(banner_query);
                let url = "{{ route('banner.search') }}";

                queryBanner(banner_query,url);

            });



            $(document).on('click','.pagination a', function(event){
                event.preventDefault();
               
                $('li').removeClass('active');
                $(this).parent().addClass('active');
                
                let banner_query = $('#banner_search').val();
                    banner_query = $.trim(banner_query);
                let url = "{{ route('banner.search') }}";
                let page = $(this).attr('href').split('page=')[1];

                $('#hidden_page_value').val(page); 

                queryBanner(banner_query,url,page);

            });



            function queryBanner(banner_query='',url,page=''){
        
                $.ajax({
                    type:'GET',
                    url:url,
                    data:{banner_query:banner_query,page:page},
                    success:function(data){
                        $('#banner_table').find('tbody').html(data);
                    },
                    error:function(){
                        console.log("Something went wrong!");
                    }
                });

            }


        });



    </script>
@endsection





