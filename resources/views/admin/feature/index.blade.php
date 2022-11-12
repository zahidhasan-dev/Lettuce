@extends('layouts.dashboard')

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                            <li class="breadcrumb-item active">Feature</li>
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
                                <div class="alert alert-success feature_alert" style="display: none" role="alert">
                                
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
                            <div class="col-12">
                                <div class="text-center text-sm-start text-md-start text-lg-start text-xl-start">
                                    <a href="{{ route('feature.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Add New Feature</a>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive" id="feature_table_wrapper">
                            <table id="feature_table" class="table align-middle table-nowrap table-check" >
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">SL NO.</th>
                                        <th class="align-middle">Image</th>
                                        <th class="align-middle">Title</th>
                                        <th class="align-middle">Description</th>
                                        <th class="align-middle">Status</th>
                                        <th class="align-middle">View Details</th>
                                        <th class="align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('admin.feature.feature_data')
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

<!-- delete faq modal -->

<div class="modal fade" id="deleteFeature" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteFeatureLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteFeatureLabel">Delete Feature</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are you sure?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger feature_delete_modal" data-id="">Delete</button>
            </div>
        </div>
    </div>
</div>


@endsection




@section('footer_script')
    <script>

        $(document).ready(function(){

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name=csrf-token]').attr('content')
                }
            });



            $(document).on('click','.feature_delete', function (event){
                event.preventDefault();
                $('.feature_delete_modal').data('id',$(this).data('id'));
            });

            $(document).on('click','.feature_delete_modal', function(event){
                let id = $(this).data('id');
                let url = "{{ route('feature.destroy',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'DELETE',
                    url:url,
                    success:function(data){
                        $('#deleteFeature').modal('hide');
                        $('.feature_alert').text(data.success);
                        setTimeout(() => {
                            $('#feature_table').load(' #feature_table >* ');
                            $('.feature_alert').fadeIn().delay(800).fadeOut();
                        }, 400);
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
            });


            $(document).on('click','.switchFeatureStatus', function(event){
                event.preventDefault();

                let id = $(this).data('id');
                let url = "{{ route('feature.status.update',':id') }}";
                    url = url.replace(':id',id);
                
                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){

                        if(data.feature_status == 1){
                            $('#switchFeatureStatus_'+id).prop('checked',true);
                        }
                        else{
                            $('#switchFeatureStatus_'+id).prop('checked',false);
                        }

                        $('.feature_alert').text(data.success);
                        setTimeout(() => {
                            $('.feature_alert').fadeIn().delay(800).fadeOut();
                        }, 200);

                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });


        });



    </script>
@endsection





