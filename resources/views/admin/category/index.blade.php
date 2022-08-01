@extends('layouts.dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                                <li class="breadcrumb-item active">category</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-9 order-xl-1 order-2 col-12">
                    <div class="card">
                        <div class="alert alert-success category_alert" style="display: none" role="alert">
                                    
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8">
                                    <h4 class="card-title mb-4">Categories</h4>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <label class="d-block mb-4"><input type="search" class="form-control form-control-sm" id="category_search" name="category_search" placeholder="Search"></label>
                                </div>
                            </div>
                            <div class="table-responsive" id="categories_table_wrapper">
                                <table id="categorys_table" class="table nowrap w-100">
                                    <thead>
                                    <tr class="align-top">
                                        <th>SL NO.</th>
                                        <th>Name</th>
                                        <th>Main Category</th>
                                        <th>Slug</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @include('admin.category.query_data')
                                    </tbody>
                                </table>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-xl-3 order-xl-2 order-1 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">Add Category</h4>
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
                            @if (session('extnsn_err'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('extnsn_err') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="info_form" id="add_category_form">
                                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <label for="category-parent-input" class="form-label">Parent Category :</label>
                                                <select class="form-control text-capitalize" id="category-parent-input" name="parent_category" >
                                                    <option value="" selected>-- Select Category --</option>
                                                    @forelse ($parent_categories as $parent_category)
                                                        <option value="{{ $parent_category->id }}">{{ $parent_category->category_name }}</option>
                                                        {{-- @if($parent_category->sub_category->count() > 0)
                                                            @foreach ($parent_category->sub_category as $sub_category)
                                                                <option value="{{ $sub_category->id }}">-- {{ $sub_category->category_name }}</option>
                                                            @endforeach
                                                        @endif --}}
                                                    @empty
                                                        <option value="" disabled>Not Available</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            @error('parent_category')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <label for="category-name-input" class="form-label">Category Name :</label>
                                                <input type="text" class="form-control" id="category-name-input" name="category_name" placeholder="Enter category Name" value="{{ old('category_name') }}">
                                            </div>
                                            @error('category_name')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <label for="category-photo-input" class="form-label">Category Photo :</label>
                                                <input type="file" class="form-control" id="category-photo-input" name="category_photo" value="{{ old('category_photo') }}">
                                            </div>
                                            @error('category_photo')
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


    <!-- edit category modal -->
    <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="editCategoryLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">Edit category</h5>
                    <button type="button" class="btn-close close_category_form" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="javascript:void(0);" method="POST" enctype="multipart/form-data" class="category_edit_form" id="category_edit_form">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" class="modal_category_id" name="category_id" value="">
                            <label for="recipient-name" class="col-form-label">Parent Category:</label>
                            <select class="form-control text-capitalize parent_category_input" id="category-parent-input" name="parent_category" >
                                <option value=""selected>-- Select Category --</option>
                                @forelse ($parent_categories as $parent_category)
                                    <option value="{{ $parent_category->id }}">{{ $parent_category->category_name }}</option>
                                    {{-- @if($parent_category->sub_category->count() > 0)
                                        @foreach ($parent_category->sub_category as $sub_category)
                                            <option value="{{ $sub_category->id }}">-- {{ $sub_category->category_name }}</option>
                                        @endforeach
                                    @endif --}}
                                @empty
                                    <option value="" disabled>Not Available</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="category-name" class="col-form-label">Category Name:</label>
                            <input type="text" class="form-control category_name" name="category_name">
                        </div>
                        <div class="mb-3 category_modal_photo_input_wrapper">
                            <label for="category-modal-photo-input" class="form-label">Category Photo :</label>
                            <input type="file" class="form-control category_modal_photo" id="category-modal-photo-input" name="category_photo" value="">
                            <img width="80" src="" class="mt-2" id="category_image">
                        </div>
                    </div>
                    <div class="modal-footer category_modal_footer">
                        <button type="button" class="btn btn-secondary close_category_form" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary category_update_btn" data-id="" id="editCategoryPost">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- delete category modal -->

    <div class="modal fade" id="deleteCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCategoryLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteCategoryLabel">Delete category</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger category_delete_modal" data-id="">Delete</button>
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


            $('#category_search').on('search', function(){
                $('#categories_table_wrapper').load(' #categories_table_wrapper >* ');
                // let category_query = $(this).val().trim();
                // let url = "{{ route('category.search') }}";
                // let page = $('#hidden_page').val();
                
                // categoryQuery(category_query,url,page);
            });



            function categoryQuery(category_query = '',url,page=''){

                $.ajax({
                    type:'POST',
                    url:url,
                    data:{category_query:category_query,page:page},
                    success:function(data){
                        $('#categories_table_wrapper').find('tbody').html(data);
                    },
                    error:function(){
                        alert('Something went wrong');
                    }
                });

            }

            $(document).on('keyup','#category_search', function(){
                let category_query = $(this).val().trim();
                let url = "{{ route('category.search') }}";

                if(category_query != ''){
                    categoryQuery(category_query,url);
                }
                else{
                    $('#categories_table_wrapper').load(' #categories_table_wrapper >* ');
                }

            });

            $(document).on('click','.pagination a', function(event){
                if($('#category_search').val().trim() != ''){
                    
                    event.preventDefault();
    
                    let category_query = $('#category_search').val().trim();
                    let page = $(this).attr('href').split('page=')[1];
                    $('#hidden_page').val(page);
                    $('li').removeClass('active');
                    $(this).parent().addClass('active');
                    let url = "{{ route('category.search') }}";

                    if(category_query != ''){
                        categoryQuery(category_query,url,page);
                    }
                    else{
                        $('#categories_table_wrapper').load(' #categories_table_wrapper >* ');
                    }

                }
            });

            




            $(document).on('click','.switchCategoriestatus', function(){
                let id = $(this).data('id');
                let url = "{{ route('category.status.update',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({

                    type:'POST',
                    url:url,
                    success:function(data){

                        if(data.success){
                            $('.category_alert').text(data.success);
                            $('.category_alert').delay(200).fadeIn(200);
                            $('.category_alert').delay(1000).fadeOut(200);
                        }
                        else if(data.error){
                            alert(data.error);
                        }

                    },
                    error:function(){
                        alert("Something went wrong!");
                    }
                });
            });



            $(document).on('change','#category-modal-photo-input',function(event){

                $('.category_modal_photo_input_wrapper').find('button').remove();
                $('.category_modal_photo_input_wrapper').find('#category_input_image').remove();
                $('#category_image').hide();

                let files = event.target.files;
                let file = files[0];

                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#category_input_image').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(file);
                    $('.category_modal_photo_input_wrapper').append("<img width='80' src='' class='mt-2' id='category_input_image'><button class='btn btn-danger d-block mt-3' id='cancel_category_photo'>Cancel</button>");
                }

            });


            function resetCategoryImageInput()
            {
                $('.category_modal_photo').val('');
                $('.category_modal_photo_input_wrapper').find('button').remove();
                $('.category_modal_photo_input_wrapper').find('#category_input_image').remove();
                $('.category_modal_photo_input_wrapper').find('small').remove();
                $('#category_image').fadeIn();
                
                
                
            }

            $(document).on('click','#cancel_category_photo', function(event){
                event.preventDefault();
                resetCategoryImageInput()
                if($('#category_image').attr('src') == ''){
                    $('#category_image').hide();
                }
            });


            $(document).on('click','.edit_category', function(event)
            {
                event.preventDefault();

                let id =  $(this).data('id');
                let url = "{{ route('category.edit',':id') }}";
                    url = url.replace(':id',id);

                $.ajax({
                    type:'GET',
                    url:url,
                    beforeSend:function(){
                        $('#editCategory').addClass('category_edit_loading');
                    },
                    success:function(data){

                        setTimeout(() => {

                            $('.parent_category_input option').each(function(key,elem){

                                let parent_id = elem.value;

                                if(data.parent_category != null && parent_id == data.parent_category){
                                    $(this).prop('selected',true);
                                }

                            });

                            let base_url = window.location.origin;

                            $('#editCategory').removeClass('category_edit_loading');
                            $('.category_edit_form').find('.category_name').val(data.category_name);
                            if(data.category_photo != null){
                                $('.category_edit_form').find('#category_image').attr('src',base_url+'/uploads/category/'+data.category_photo).show();
                            }
                            else{
                                $('.category_edit_form').find('#category_image').hide()
                            }
                            $('#editCategory').find('.modal_category_id').val(data.id);
                            
                        }, 150);

                    },
                    error:function(){
                        alert("Something went wrong!");
                    }

                });
            });


            function categoryEditFormValidation()
            {

                let categoryName = $('#editCategory').find('.category_name');

                if(categoryName.val() == ''){
                    categoryName.parent().append("<small class='text-danger'>This is a required field!</small>");
                    categoryName.css('border-color','red');
                    return false;
                }
                else{
                    return true;
                }

            }


            function resetEditForm()
            {
                $('#editCategory').find('small').remove();
                $.each(['category_name'], function(key,elem){
                    $('#editCategory').find('.'+elem).css('border-color','#ced4da');
                });

                $('#editCategory').load(' #editCategory >* ');
            }

            
            $('.close_category_form').on('click',function()
            {
                resetEditForm()

                $.each(['category_name'], function(key,elem){
                    $('#editCategory').find('.'+elem).val('');
                });
                resetCategoryImageInput()
                $('#category_image').attr('src','');

            });


            $('.modal').on('show.bs.modal', function () 
            {
                resetEditForm()

                $.each(['category_name'], function(key,elem){
                    $('#editCategory').find('.'+elem).val('');
                });

                resetCategoryImageInput()
                $('#category_image').attr('src','');

            });


            $(document).on('submit','#category_edit_form', function(event){

                event.preventDefault();
                resetEditForm();
                $category_edit_form_validated = categoryEditFormValidation();

                if($category_edit_form_validated == true){
                
                    let formData = new FormData($(this)[0]);
                    let id = $(this).find('.modal_category_id').val();
                    let url = "{{ route('category.update',':id') }}";
                        url = url.replace(':id',id);

                    $.ajax({
                        type:'POST',
                        url:url,
                        data:formData,
                        processData: false,
                        contentType: false,
                        success:function(data){
                            if(data.success){
                                $('#editCategory').modal('hide');
                                $('#categories_table_wrapper').load(' #categories_table_wrapper > *');
                                $('.category_alert').text(data.success);
                                $('.category_alert').delay(500).fadeIn(300);
                                $('.category_alert').delay(1500).fadeOut(300);
                                $('#editCategory').load(' #editCategory >* ');
                            }
                            else if(data.cat_exists){
                                $('#editCategory').find('.category_name').after("<small class='text-danger'>"+data.cat_exists+"</small>");
                                $('#editCategory').find('.category_name').css('border-color','red');
                            }
                            else if(data.extnsn_error){
                                $('.category_modal_photo_input_wrapper').append("<small class='text-danger'>"+data.extnsn_error+"</small>");
                            }
                        },
                        error:function(){
                            alert("Something went wrong!");
                        }
                    });

                }

            });


            $(document).on('click','.category_delete', function()
            {

                let id = $(this).data('id');
                $('.category_delete_modal').data('id',id);

            });

            $('.category_delete_modal').on('click', function()
            {   
                let id = $(this).data('id');
                let url = "{{ route('category.destroy', ':id') }}";
                    url = url.replace(':id', id);
                let category_query = $('#category_search').val().trim();

                $.ajax({
                    type:"DELETE",
                    url:url,
                    data:{category_query:category_query},
                    success:function(data){
                        if(data.error){
                            alert(data.error);
                        }
                        else{
                            $('#deleteCategory').modal('hide');
                            $('#add_category_form').load(' #add_category_form >* ');

                            $('.category_alert').text("Category deleted.");
                            $('.category_alert').delay(500).fadeIn(300);
                            $('.category_alert').delay(1500).fadeOut(300);
                            $('#categories_table_wrapper').find('tbody').html(data);

                        }

                    },
                    error:function(){
                        alert('Something went wrong!');
                    }
                });
                    
            });

        });
    </script>
    
@endsection