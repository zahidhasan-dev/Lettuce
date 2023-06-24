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
                                <li class="breadcrumb-item active">City</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="{{ auth()->user()->can('create', \App\Models\City::class) ? 'col-md-8' : 'col-md-12' }} order-md-1 order-sm-2 col-12">
                    <div class="card">
                        <div class="alert alert-success city_alert" style="display: none" role="alert">
                                    
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-4">Cities</h4>
                            <table id="cities_table" class="table nowrap w-100">
                                <thead>
                                <tr>
                                    <th>SL NO.</th>
                                    <th>City Name</th>
                                    <th>Country Name</th>
                                    @if (auth()->user()->hasAnyPermission(['update-city','delete-city']) || auth()->user()->isSuperAdmin())
                                        <th>Action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cities as $index => $city)
                                    <tr>
                                        <td>{{ $cities->firstitem()+$index }}</td>
                                        <td>{{ $city->city_name }}</td>
                                        <td>{{ $city->country->country_name }}</td>
                                        @canany(['update','delete'], $city)
                                            <td>
                                                <div class="d-flex gap-3">
                                                    @can('update', $city)
                                                        <a href="javascript:void(0);" class="text-success edit_city" data-id="{{ $city->id }}" data-bs-toggle="modal" data-bs-target="#editCity">
                                                            <i class="mdi mdi-pencil font-size-18"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete', $city)
                                                        <a href="javascript:void(0);" class="text-danger city_delete" data-id="{{ $city->id }}" data-bs-toggle="modal" data-bs-target="#deleteCity">
                                                            <i class="mdi mdi-delete font-size-18"></i>
                                                        </a>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No data found!</td>
                                        </tr>
                                    @endforelse
                                
                                </tbody>
                            </table>
                            {{ $cities->links() }}
                        </div>
                    </div>
                </div> <!-- end col -->
                @can('create', \App\Models\City::class)
                    <div class="col-md-4 order-md-2 order-sm-1 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">Add City</h4>
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
                                    <form action="{{ route('city.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mt-4">
                                                    <label for="" class="form-label">Country :</label>
                                                    <select name="country_id" class="form-control">
                                                        <option disabled selected value="">--Select Country--</option>
                                                        @foreach ($countries as $country)
                                                            <option  value="{{ $country->id }}">{{ $country->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('country_id')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                                <div class="mt-4">
                                                    <label for="city-name-input" class="form-label">City Name :</label>
                                                    <input type="text" class="form-control" id="city-name-input" name="city_name" placeholder="Enter City Name" value="{{ old('city_name') }}">
                                                </div>
                                                @error('city_name')
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
                @endcan

            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @if (auth()->user()->hasPermissionTo('update-city') || auth()->user()->isSuperAdmin())
        <!-- edit city modal -->
        <div class="modal fade" id="editCity" tabindex="-1" aria-labelledby="editCityLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCityLabel">Edit city</h5>
                        <button type="button" class="btn-close close_city_form" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="city_edit_form">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Country :</label>
                                <select name="country_id" class="form-control select_country">
                                    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">city Name:</label>
                                <input type="text" class="form-control city_name" name="city_name" >
                            </div>
                        </div>
                        <div class="modal-footer city_modal_footer">
                            <button type="button" class="btn btn-secondary close_city_form" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" data-id="" id="editCityPost">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif



    @if (auth()->user()->hasPermissionTo('delete-city') || auth()->user()->isSuperAdmin())
        <!-- delete city modal -->
        <div class="modal fade" id="deleteCity" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCityLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="deleteCityLabel">Delete city</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger city_delete_modal" data-id="">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

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



            $(document).on('click','.edit_city', function(event)
            {
                event.preventDefault();

                let id =  $(this).data('id');
                let url = "{{ route('city.edit',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#editCity').addClass('city_edit_loading');
                    },
                    success:function(data){
                        setTimeout(() => {
                            $('#editCity').removeClass('city_edit_loading');
                            $('.city_edit_form').find('.select_country').html("<option disabled selected value=''>--Select Country--</option>"+data.country_result);
                            $('.city_edit_form').find('.city_name').val(data.city.city_name);
                            $('#editCityPost').data('id',data.city.id);

                        }, 150);
                    },
                    error:function(){
                        alert("Something went wrong!");
                    }

                });
            });


            $('#editCityPost').on('click',function(event){

                event.preventDefault();
                
                let id = $(this).data('id');
                let city_name = $('.city_edit_form').find('.city_name').val();
                let country_id = $('.city_edit_form').find('.select_country').val();
                let url = "{{ route('city.update', ':id') }}";
                    url =url.replace(':id',id);
                
                $.ajax({
                    type:'PUT',
                    url:url,
                    data:{city_name:city_name,country_id:country_id},
                    success:function(data){
                        if(data.success){
                            $('#editCity').modal('hide');
                            $('#cities_table').load(' #cities_table > *');
                            $('.city_alert').text(data.success);
                            $('.city_alert').delay(1000).fadeIn(200);
                            $('.city_alert').delay(2000).fadeOut(200);
                            $('.city_edit_form').find('.city_name').val('');
                        }
                        else{
                            
                            if($('.city_name').parent().find("small")){
                                $('small').remove('');
                                $('.city_name').parent().append("<small class='text-danger'>"+data.city_exists+"</small>");
                            }
                            else{
                                $('.city_name').parent().append("<small class='text-danger'>"+data.city_exists+"</small>");
                            }
                            $('.city_edit_form').find('.city_name').css('border-color','red');

                        }
                    }
                });

            });


            $('.close_city_form').on('click',function()
            {

                $('small').remove('');
                $('.city_edit_form').find('.city_name').css('border-color','#ced4da');
                $('.city_edit_form').find('.city_name').val('');

            });


            $('.modal').on('show.bs.modal', function () 
            {

                $('small').remove('');
                $('.city_edit_form').find('.city_name').css('border-color','#ced4da');
                $('.city_edit_form').find('.city_name').val('');

            });






            $(document).on('click','.city_delete', function(event)
            {
                event.preventDefault();
                let id = $(this).data('id');
                $('.city_delete_modal').data('id',id);
            });

            $('.city_delete_modal').on('click', function(event)
            {   
                event.preventDefault();
                let id = $(this).data('id');
                let url = "{{ route('city.destroy', ':id') }}";
                    url = url.replace(':id', id);

                $.ajax({
                    type:"DELETE",
                    url:url,
                    success:function(data){
                        if(data.success){

                            $('#deleteCity').modal('hide');
                            $('#cities_table').load(' #cities_table > *');

                            $('.city_alert').text(data.success);
                            $('.city_alert').delay(500).fadeIn(300);
                            $('.city_alert').delay(1500).fadeOut(300);

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