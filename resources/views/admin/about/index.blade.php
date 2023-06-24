@extends('layouts.dashboard')

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                            <li class="breadcrumb-item active">About</li>
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
                                <div class="alert alert-success about_alert" style="display: none" role="alert">
                                
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @can('create', \App\Models\About::class)
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="text-center text-sm-start text-md-start text-lg-start text-xl-start">
                                        <a href="{{ route('about.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Add New About</a>
                                    </div>
                                </div><!-- end col-->
                            </div>
                        @endcan

                        <div class="table-responsive" id="about_table_wrapper">
                            <table id="about_table" class="table align-middle table-nowrap table-check" >
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">SL NO.</th>
                                        <th class="align-middle">Image</th>
                                        <th class="align-middle">Sub-title</th>
                                        <th class="align-middle">Title</th>
                                        <th class="align-middle">Status</th>
                                        @if (auth()->user()->hasPermissionTo('view-about') || auth()->user()->isSuperAdmin())
                                            <th class="align-middle">View Details</th>
                                        @endif
                                        @if (auth()->user()->hasAnyPermission(['update-about','delete-about']) || auth()->user()->isSuperAdmin())
                                            <th class="align-middle">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('admin.about.about_data')
                                </tbody>
                            </table>
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


@if (auth()->user()->hasPermissionTo('delete-about') || auth()->user()->isSuperAdmin())
    <!-- delete faq modal -->
    <div class="modal fade" id="deleteAbout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteAboutLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteAboutLabel">Delete About</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger about_delete_modal" data-id="">Delete</button>
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



            $(document).on('click','.about_delete', function (event){
                event.preventDefault();
                $('.about_delete_modal').data('id',$(this).data('id'));
            });

            $(document).on('click','.about_delete_modal', function(event){
                event.preventDefault();
                
                let id = $(this).data('id');
                let url = "{{ route('about.destroy',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'DELETE',
                    url:url,
                    success:function(data){
                        $('#deleteAbout').modal('hide');
                        $('.about_alert').text(data.success);
                        setTimeout(() => {
                            $('#about_table').load(' #about_table >* ');
                            $('.about_alert').fadeIn().delay(800).fadeOut();
                        }, 400);
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
            });


            $(document).on('click','.switchAboutStatus', function(event){
                event.preventDefault();

                let id = $(this).data('id');
                let url = "{{ route('about.status.update',':id') }}";
                    url = url.replace(':id',id);
                
                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){

                        $('.switchAboutStatus').prop('checked',false);

                        if(data.about_status == 1){
                            $('#switchAboutStatus_'+id).prop('checked',true);
                        }
                        else{
                            $('#switchAboutStatus_'+id).prop('checked',false);
                        }

                        $('.about_alert').text(data.success);
                        setTimeout(() => {
                            $('.about_alert').fadeIn().delay(800).fadeOut();
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


        });



    </script>
@endsection