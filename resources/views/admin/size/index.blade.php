@extends('layouts.dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Size</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Size</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-8 order-md-1 order-2 col-12">
                    <div class="card">
                        <div class="alert alert-success size_alert" style="display: none" role="alert">
                                    
                        </div>
                        @if (session('delete_success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('delete_success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8">
                                    <h4 class="card-title mb-4">Scales</h4>
                                </div>
                            </div>
                            <div class="table-responsive" id="sizes_table_wrapper">
                                <table id="sizes_table" class="table nowrap w-100">
                                    <thead>
                                    <tr class="align-top">
                                        <th>SL NO.</th>
                                        <th>Scale Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sizes as $size)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $size->scale_name }}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-success edit_size" data-id="{{ $size->id }}" data-bs-toggle="modal" data-bs-target="#editSize"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                <a href="javascript:void(0);" class="text-danger size_delete" data-id="{{ $size->id }}" data-bs-toggle="modal" data-bs-target="#deleteSize"><i class="mdi mdi-delete font-size-18"></i></a>   
                                                <form action="{{ route('size.destroy',$size->id) }}" method="post" id="size_delete_form_{{ $size->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No Data Found!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-md-4 order-md-2 order-1 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">Add Scale</h4>
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
                            <div class="info_form">
                                <form action="{{ route('size.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <label for="scale-name-input" class="form-label">Scale Name :</label>
                                                <input type="text" class="form-control" id="scale-name-input" name="scale_name" placeholder="Enter Scale Name" value="{{ old('scale_name') }}">
                                            </div>
                                            @error('scale_name')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-md">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <!-- edit size modal -->
    <div class="modal fade" id="editSize" tabindex="-1" aria-labelledby="editSizeLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSizeLabel">Edit Scale</h5>
                    <button type="button" class="btn-close close_size_form" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="size_edit_form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Scale Name:</label>
                            <input type="text" class="form-control scale_name" name="scale_name">
                        </div>
                    </div>
                    <div class="modal-footer size_modal_footer">
                        <button type="button" class="btn btn-secondary close_size_form" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary size_update_btn" data-id="" id="editSizePost">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- delete size modal -->

    <div class="modal fade" id="deleteSize" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteSizeLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteSizeLabel">Delete Scale</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger size_delete_modal" id="deleteSizePost" data-id="">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('footer_script')
 
    <script>
        $(document).ready(function()
        {   

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });




            $(document).on('click','.edit_size', function(event)
            {
                event.preventDefault();

                let id =  $(this).data('id');
                let url = "{{ route('size.edit',':id') }}";
                    url = url.replace(':id',id);
                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#editSize').addClass('size_edit_loading');
                    },
                    success:function(data){
                        setTimeout(() => {

                            $('#editSize').removeClass('size_edit_loading');
                            $('.size_edit_form').find('.scale_name').val(data.scale_name);
                            $('#editSizePost').data('id',data.id);
                            
                        }, 150);
                    },
                    error:function(){
                        alert("Something went wrong!");
                    }

                });
            });


            function sizeEditFormValidation()
            {

                let scaleName = $('#editSize').find('.scale_name');


                if(scaleName.val() == ''){
                    scaleName.parent().append("<small class='text-danger'>This is a required field!</small>");
                    scaleName.css('border-color','red');
                    return false;
                }
                else if(scaleName.val().length > 10){
                    scaleName.parent().append("<small class='text-danger'>Must not be greater than 10 characters!</small>");
                    scaleName.css('border-color','red');
                    return false;
                }
                else{
                    return true;
                }

            }


            function resetEditForm()
            {
                $('#editSize').find('small').remove();
                $('#editSize').find('.scale_name').css('border-color','#ced4da');
            }

            
            $('.close_size_form').on('click',function()
            {
                resetEditForm()
                $('#editSize').find('.scale_name').val('');
            });


            $('.modal').on('show.bs.modal', function () 
            {
                resetEditForm()
                $('#editSize').find('.scale_name').val('');
            });


            $('#editSizePost').on('click',function(){

                resetEditForm();

                $size_edit_form_validated = sizeEditFormValidation();

                if($size_edit_form_validated == true){

                    let id = $(this).data('id');
                    let scale_name = $('.size_edit_form').find('.scale_name').val();

                    let url = "{{ route('size.update', ':id') }}";
                        url =url.replace(':id',id);
                
                    $.ajax({

                        type:'PUT',
                        url:url,
                        data:{scale_name:scale_name},
                        success:function(data){

                            if(data.success){
                                $('#editSize').modal('hide');
                                $('#sizes_table_wrapper').load(' #sizes_table_wrapper >* ');
                                $('.size_alert').text(data.success);
                                $('.size_alert').delay(1000).fadeIn(200);
                                $('.size_alert').delay(2000).fadeOut(200);
                            }
                            else{
                                
                                $('.scale_name').parent().append("<small class='text-danger'>"+data.scale_exists+"</small>");
                                $('.size_edit_form').find('.scale_name').css('border-color','red');

                            }

                        },
                        error:function(){
                            alert("Something went wrong!")
                        }

                    });

                }
                
                

            });



            $(document).on('click','.size_delete',function(event){
                
                event.preventDefault();

                let id = $(this).data('id');

                $('#deleteSizePost').data('id',id);

            });


            $(document).on('click','#deleteSizePost', function(){

                let id = $(this).data('id');
                $('#size_delete_form_'+id).submit();

            });

            



        });
    </script>
    
@endsection