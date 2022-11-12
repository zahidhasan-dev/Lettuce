@extends('layouts.dashboard')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Account</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-8 col-12 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="profile_avatar mb-5" id="profile_avatar">
                            <div class="alert alert-success avatar_success" style="display:none">

                            </div>
                            <div class="profile_edit_btn mb-4">
                                <a href="{{ route('admin.profile') }}" class="btn btn-dark">Back</a>
                            </div>
                            <h5 class="mb-3 card-title">Profile Photo :</h5>
                            <div class="avatar_container rounded-circle" id="avatar_container" style="width:150px;height:150px;">
                                
                                <img class="rounded-circle {{ (auth()->user()->userDetails->avatar == null)?'hide':'' }}" id="profile_img" width="100%" height="100%" src="{{ asset('uploads/users') }}/{{ auth()->user()->userDetails->avatar }}" alt="">
                                
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary text-uppercase {{ (auth()->user()->userDetails->avatar != null)?'hide':'' }}" style="font-size:40px;">
                                    {{ substr(auth()->user()->name,0,1) }}
                                </span>
                            </div>
                            <div class="mt-3">
                                <form action="javascript:void(0);" method="POST" enctype="multipart/form-data" id="change_avatar_form">
                                    @csrf
                                    <input type="file" name="avatar" id="avatar" hidden>
                                    <button type="submit" class="btn btn-primary py-1 w-xs save_avatar" id="save_avatar" style="margin-right:5px;" >Save</button>
                                    <a href="javascript:void(0);" class="btn btn-primary py-1 w-xs avatar_change" id="avatar_change" style="margin-right:5px;" >Change</a>
                                    <a href="javascript:void(0);" class="btn btn-danger py-1 w-xs avatar_remove {{ (auth()->user()->userDetails->avatar == null)?'hide':'' }}" id="avatar_remove">Remove</a>
                                </form>
                            </div>
                        </div>
                        <h4 class="card-title mb-4">Personal Information</h4>
                        <div class="info_form">
                            <form action="{{ route('admin.profile.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-7 col-sm-8 col-12">
                                        <div class="mt-4">
                                            <label for="name-input" class="form-label">Name :</label>
                                            <input type="text" class="form-control" id="name-input" name="user_name" placeholder="Enter Your Name" value="{{ auth()->user()->name }}">
                                        </div>
                                    </div>
                                    @error('user_name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror

                                    <div class="col-md-7 col-sm-8 col-12">
                                        <div class="mt-4">
                                            <label for="phone-input" class="form-label">Phone :</label>
                                            <input type="number" class="form-control" id="phone-input" name="phone" placeholder="Enter Your Phone" value="{{ auth()->user()->userDetails->phone }}">
                                        </div>
                                    </div>
                                    @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror

                                    <div class="col-md-7 col-sm-8 col-12">
                                        <div class="mt-4">
                                            <label for="" class="form-label">Country :</label>
                                            <select name="country" class="form-control change_country">
                                                <option disabled selected value="">--Select Country--</option>
                                                 @foreach (countries() as $country)
                                                 <option value="{{ $country->id }}" @if(auth()->user()->userDetails->country != null) {{ ( auth()->user()->userDetails->getcity->country->id == $country->id )?'selected':'' }} @endif>{{ $country->country_name }}</option>
                                                 @endforeach 
                                            </select>
                                        </div>
                                    </div>
                                    @error('country')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror

                                    <div class="col-md-7 col-sm-8 col-12">
                                        <div class="mt-4">
                                            <label for="" class="form-label">City :</label>
                                            <select name="city"  class="form-control profile_city_list">
                                                <option disabled selected value="">--Select City--</option>
                                                @foreach (cityByCountry(auth()->user()->userDetails->country) as $city)
                                                <option value="{{ $city->id }}" @if(auth()->user()->userDetails->country != null) {{ ( auth()->user()->userDetails->city == $city->id )?'selected':'' }} @endif>{{ $city->city_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('country')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary w-md">Update</button>
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
@endsection


@section('footer_script')

    <script>
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.change_country').on('change', function(){

                let country_id = $(this).val();
                let url =  "{{ route('admin.profile.citybycountry', ':country_id') }}";
                    url =  url.replace(':country_id',country_id);

                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){
                        if(data.success){
                            $('.profile_city_list').html("<option disabled selected value=''>--Select City--</option>"+data.city_list);
                        }
                        else{
                            if(confirm('Something went wrong! Try reloading the page.')){
                                window.location.reload();
                            }
                        }
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });


            $(document).on('click','#avatar_change', function()
            {
                $('#avatar').click();
            });



            $(document).change('#avatar', function(event) {

                let files = event.target.files;
                let file = files[0];

                if (file) {

                    let reader = new FileReader();

                    reader.onload = function(e) {
                        document.getElementById('profile_img').src = e.target.result;
                    };

                    reader.readAsDataURL(file);


                    $('#save_avatar').addClass('show');
                    $('#avatar_change').addClass('hide');

             
                    $('#avatar_remove').addClass('cancel_avatar');
                    $('#avatar_remove').removeClass('avatar_remove');
                    $('#avatar_remove').removeClass('hide');
                    $('#avatar_remove').text('Cancel');

                    $('#profile_img').removeClass('hide');
                    $('#avatar_container .avatar-title').addClass('hide');
                    
                }
                
            });

            


            $(document).on('click','#save_avatar', function(){
                
                let img = $('#avatar').val();
                let url = "{{ route('admin.profile.avatar.update') }}";


                $('#change_avatar_form').on('submit', function(event){
                    event.preventDefault();
                    let formData = new FormData($('#change_avatar_form')[0]);
                    
                    $.ajax({
                        type:'POST',
                        url:url,
                        data:formData,
                        processData: false,
                        contentType: false,
                        success:function(data){
                    
                            if(data.success){

                                $('#avatar_container').load(' #avatar_container >* ');
                                $('#page-header-user-dropdown').load(' #page-header-user-dropdown >* ');
                                
                                $('#save_avatar').removeClass('show');
                                $('#avatar_change').removeClass('hide');
                                $('#avatar_remove').removeClass('cancel_avatar');
                                $('#avatar_remove').addClass('avatar_remove');
                                $('#avatar_remove').removeClass('hide');
                                $('#avatar_remove').text('Remove');
                                
                                $('.avatar_success').text(data.success);
                                $('.avatar_success').delay(1000).fadeIn(200);
                                
                                
                            }
                            else if(data.extnsn_err){

                                alert(data.extnsn_err);

                            }
                            else if(data.error){
                                
                                alert(data.error);

                            }

                        },
                        complete:function(){

                            setTimeout(() => {
                                $('.avatar_success').delay(1000).fadeOut(200);
                            }, 1000);

                        },
                        error:function(){
                            alert("Something went wrong!");
                        }
                    });

                });
                    

            });

            $(document).on('click','#avatar_remove', function(){
                if($('#avatar_remove').hasClass('cancel_avatar')){
                    
                    $('#avatar_container').load(' #avatar_container >* ');
                    $('#change_avatar_form').load(' #change_avatar_form >* ');

                    $('#save_avatar').removeClass('show');
                    $('#avatar_change').removeClass('hide');

                    $('#avatar_remove').removeClass('cancel_avatar');
                    $('#avatar_remove').addClass('avatar_remove');
                    $('#avatar_remove').text('Remove');

                }
                else{
                    let url = "{{ route('admin.profile.avatar.remove') }}";

                    $.ajax({
                        type:'DELETE',
                        url:url,
                        success:function(data){
                            if(data.success){

                                $('#page-header-user-dropdown').load(' #page-header-user-dropdown >* ');
                                $('#avatar_container').load(' #avatar_container >* ');
                                $('#avatar_remove').addClass('hide');
                                $('.avatar_success').text(data.success);
                                $('.avatar_success').delay(1000).fadeIn(200);

                            }
                            else if(data.error){

                                alert(data.error);

                            }
                        },
                        complete:function(){

                            setTimeout(() => {
                                $('.avatar_success').delay(1000).fadeOut(200);
                            }, 1000);

                        },
                        error:function(){
                            alert("Something went wrong!");
                        }
                    });
                }
            });


        });




    </script>

@endsection



