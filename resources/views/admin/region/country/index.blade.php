@extends('layouts.dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Region</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Country</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-8 order-md-1 order-sm-2 col-12">
                    <div class="card">
                        <div class="alert alert-success country_alert" style="display: none" role="alert">
                                    
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-4">Countries</h4>
                            <table id="countries_table" class="table nowrap w-100">
                                <thead>
                                <tr>
                                    <th>SL NO.</th>
                                    <th>Country Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($countries as $index => $country)
                                    <tr>
                                        <td>{{ $countries->firstitem()+$index }}</td>
                                        <td>{{ $country->country_name }}</td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="javascript:void(0);" class="text-success edit_country" data-id="{{ $country->id }}" data-bs-toggle="modal" data-bs-target="#editCountry"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                <a href="javascript:void(0);" class="text-danger country_delete" data-id="{{ $country->id }}" data-bs-toggle="modal" data-bs-target="#deleteCountry"><i class="mdi mdi-delete font-size-18"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No data found!</td>
                                        </tr>
                                    @endforelse
                                
                                </tbody>
                            </table>
                            {{ $countries->links() }}
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-md-4 order-md-2 order-sm-1 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">Add Country</h4>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="info_form">
                                <form action="{{ route('country.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <label for="country-name-input" class="form-label">Country Name :</label>
                                                <input type="text" class="form-control" id="country-name-input" name="country_name" placeholder="Enter Country Name" value="{{ old('country_name') }}">
                                            </div>
                                        </div>
                                        @error('country_name')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror

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


    <!-- edit Country modal -->
    <div class="modal fade" id="editCountry" tabindex="-1" aria-labelledby="editCountryLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCountryLabel">Edit Country</h5>
                    <button type="button" class="btn-close close_Country_form" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="country_edit_form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Country Name:</label>
                            <input type="text" class="form-control country_name" name="country_name" >
                        </div>
                    </div>
                    <div class="modal-footer Country_modal_footer">
                        <button type="button" class="btn btn-secondary close_country_form" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-id="" id="editCountryPost">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- delete Country modal -->

    <div class="modal fade" id="deleteCountry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCountryLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteCountryLabel">Delete Country</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger country_delete_modal" data-id="">Delete</button>
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



            $(document).on('click','.edit_country', function(event)
            {
                event.preventDefault();

                let id =  $(this).data('id');
                let url = "{{ route('country.edit',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#editCountry').addClass('country_edit_loading');
                    },
                    success:function(data){
                        setTimeout(() => {

                            $('#editCountry').removeClass('country_edit_loading');
                            $('.country_edit_form').find('.country_name').val(data.country_name);
                            $('#editCountryPost').data('id',data.id);

                        }, 150);
                    },
                    error:function(){
                        alert("Something went wrong!");
                    }

                });
            });


            
            $('.close_country_form').on('click',function()
            {

                $('small').remove('');
                $('.country_edit_form').find('.country_name').css('border-color','#ced4da');
                $('.country_edit_form').find('.country_name').val('');

            });


            $('.modal').on('show.bs.modal', function () 
            {

                $('small').remove('');
                $('.country_edit_form').find('.country_name').css('border-color','#ced4da');
                $('.country_edit_form').find('.country_name').val('');

            });


            $('#editCountryPost').on('click',function(){

                let id = $(this).data('id');
                let country_name = $('.country_edit_form').find('.country_name').val();
                let url = "{{ route('country.update', ':id') }}";
                    url =url.replace(':id',id);
                
                $.ajax({
                    type:'PUT',
                    url:url,
                    data:{country_name:country_name},
                    success:function(data){

                        if(data.success){
                            $('#editCountry').modal('hide');
                            $('#countries_table').load(' #countries_table > *');
                            $('.country_alert').text(data.success);
                            $('.country_alert').delay(1000).fadeIn(200);
                            $('.country_alert').delay(2000).fadeOut(200);
                            $('.country_edit_form').find('.country_name').val('');
                        }
                        else{
                            
                            $('.country_name').parent().append("<small class='text-danger'>"+data.country_exists+"</small>");
                            $('.country_edit_form').find('.country_name').css('border-color','red');

                        }
                    }
                });

            });






            $(document).on('click','.country_delete', function()
            {
                let id = $(this).data('id');
                $('.country_delete_modal').data('id',id);
            });

            $('.country_delete_modal').on('click', function()
            {   
                let id = $(this).data('id');
                let url = "{{ route('country.destroy', ':id') }}";
                    url = url.replace(':id', id);

                $.ajax({
                    type:"DELETE",
                    url:url,
                    success:function(data){
                        if(data.success){

                            $('#deleteCountry').modal('hide');
                            $('#countries_table').load(' #countries_table > *');

                            $('.country_alert').text(data.success);
                            $('.country_alert').delay(500).fadeIn(300);
                            $('.country_alert').delay(1500).fadeOut(300);

                        }
                        else{
                            alert(data.error);
                        }
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
                    
            })

        });
    </script>
    
@endsection