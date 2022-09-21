@extends('layouts.dashboard')


@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Subscribers</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Newsletter</a></li>
                                <li class="breadcrumb-item active">Subscribers</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 order-xl-1 order-2 col-12">
                    <div class="card">
                        <div class="alert alert-success newsletter_alert" style="display: none" role="alert">
                                    
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8">
                                    <h4 class="card-title mb-4">Newsletters</h4>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <label class="d-block mb-4"><input type="search" class="form-control form-control-sm" id="newsletter_search" name="newsletter_search" placeholder="Search"></label>
                                </div>
                            </div>
                            <div class="table-responsive" id="newsletters_table_wrapper">
                                <table id="newsletters_table" class="table nowrap w-100">
                                    <thead>
                                        <tr class="align-top">
                                            <th>SL NO.</th>
                                            <th>Subject</th>
                                            <th>Created_at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('admin.newsletter.query_data')
                                    </tbody>
                                </table>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                <input type="hidden" name="current_page" id="current_page" value="{{ $newsletters->currentPage() }}" />
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



    <div class="modal fade" id="viewNewsletter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewNewsletterLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="viewNewsletterLabel">Newsletter Details</h3>
                    <button type="button" class="btn-close close_newsletter_view" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('admin.newsletter.newsletter_details')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_newsletter_view" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteNewsletter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteNewsletterLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteNewsletterLabel">Delete Newsletter</h3>
                    <button type="button" class="btn-close close_newsletter_delete" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Are you sure?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete_newsletter" data-id="">Delete</button>
                    <button type="button" class="btn btn-secondary close_newsletter_delete" data-bs-dismiss="modal">Cancel</button>
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
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click','.newsletter_tab_btn', function(e){
                e.preventDefault();
                $('.newsletter_tab_btn').removeClass('active');
                $('.newsletter_tab_wrapper').removeClass('active');
                $(this).addClass('active');
                $('#'+$(this).data('target')).addClass('active');
            });


            $(document).on('click','#newsletter_show_btn', function(e){

                e.preventDefault();

                let newsletter_id = $(this).data('id');
                let url = "{{ route('newsletter.show',':newsletter') }}";
                    url = url.replace(':newsletter',newsletter_id);

                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){
                        $('#viewNewsletter').find('.modal-body').html(data);
                        $('#viewNewsletter').modal('show');
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });


            $(document).on('click','.close_newsletter_view', function(){
                $('#viewNewsletter').find('.modal-body').html('');
            });


            $('#viewNewsletter').on('hide.bs.modal', function () {
                $('#viewNewsletter').find('.modal-body').html('');
            });


            $(document).on('click','.delete_newsletter_btn', function(e){
                e.preventDefault();
                $('#deleteNewsletter').find('.delete_newsletter').data('id',$(this).data('id'));
            });


            $(document).on('click', '.delete_newsletter', function(e){

                e.preventDefault();

                $('#deleteNewsletter').modal('hide');
                
                let newsletter_id = $(this).data('id');
                let url = "{{ route('newsletter.delete', ':newsletter') }}";
                    url = url.replace(':newsletter',newsletter_id);

                $.ajax({
                    type:'DELETE',
                    url:url,
                    success:function(data){

                        if(data.success){
                            
                            let newsletter_query = $('#newsletter_search').val().trim();
                            let page = $('#newsletters_table_wrapper').find('#current_page').val();
                            $('#hidden_page').val(page);
                            let url = "{{ route('newsletter.search') }}";
                            
                            newsletterQuery(newsletter_query,url,page);

                            $('.newsletter_alert').text(data.success).fadeIn().delay(1500).fadeOut();
                            
                            setTimeout(() => {
                                $('.newsletter_alert').text('');
                            }, 2000);

                        }

                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
                
            });


            $(document).on('keyup','#newsletter_search', function(){

                let newsletter_query = $(this).val().trim();
                let url = "{{ route('newsletter.search') }}";
                $('#current_page').val(1);
                 
                newsletterQuery(newsletter_query,url);

            });

            
            $(document).on('click','.pagination a', function(event){
                
                event.preventDefault();
                
                let newsletter_query = $('#newsletter_search').val().trim();
                let page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                $('#current_page').val(page);
                let url = "{{ route('newsletter.search') }}";
                
                newsletterQuery(newsletter_query,url,page);
                
            });


            $(document).on('search','#newsletter_search', function(){
                
                $('#newsletters_table_wrapper').load(' #newsletters_table_wrapper>* ');
                
            });

            
            function newsletterQuery(newsletter_query='',url,page=''){
                $.ajax({
                    type:'POST',
                    url:url,
                    data:{newsletter_query:newsletter_query,page:page},
                    success:function(data){
                        $('#newsletters_table').find('tbody').html(data);
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });
            }


        });

    </script>


@endsection