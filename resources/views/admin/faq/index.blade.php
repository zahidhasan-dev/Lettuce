@extends('layouts.dashboard')


@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">FAQ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                            <li class="breadcrumb-item active">FAQ</li>
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
                                  <div class="alert alert-success faq_add_alert" style="display: none" role="alert">
                                    
                                  </div>
                            </div>
                            <div class="col-sm-12 text-right">
                                <div class="text-sm-start float-start">
                                    <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light mb-2 me-2 faq_delete_all" >Delete All</button>
                                </div>
                                <div class="text-sm-end">
                                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target="#addFaq"><i class="mdi mdi-plus me-1"></i> Add New FAQ</button>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive" id="faq_table">
                            <table class="table align-middle table-nowrap table-check" >
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20px;" class="align-middle">
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" id="faqCheckAll">
                                                <label class="form-check-label" for="faqCheckAll"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle">SL NO.</th>
                                        <th class="align-middle">Faq Question</th>
                                        <th class="align-middle">Faq Answer</th>
                                        <th class="align-middle">Status</th>
                                        <th class="align-middle">View Details</th>
                                        <th class="align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ( $faqs as $index => $faq )
                                        
                                    
                                    <tr id="faq_row_{{ $faq->id }}">
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input faqCheck" type="checkbox" id="faqCheck" name="faqCheck[]" data-id="{{ $faq->id }}">
                                                <label class="form-check-label" for="orderidcheck01"></label>
                                            </div>
                                        </td>
                                        <td>{{ $faqs->firstitem()+$index }}</td>
                                        <td>
                                            @if(strlen($faq->faq_ques) > 30)
                                                {{ substr($faq->faq_ques, 0, 30) }} ...more
                                            @else 
                                                {{ $faq->faq_ques }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(strlen($faq->faq_ans) > 30)
                                                {{ substr($faq->faq_ans, 0, 30) }} ...more
                                            @else 
                                                {{ $faq->faq_ans }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                <input class="form-check-input SwitchFaqStatus" type="checkbox" data-id="{{ $faq->id }}" id="SwitchFaqStatus" {{ ($faq->is_active == 1)?'checked':'' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-sm btn-rounded view_faq" data-id="{{ $faq->id }}" data-bs-toggle="modal" data-bs-target="#viewFaq">
                                                View Details
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="javascript:void(0);" class="text-success edit_faq" data-id="{{ $faq->id }}" data-bs-toggle="modal" data-bs-target="#editFaq"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                <a href="javascript:void(0);" class="text-danger faq_delete" data-id="{{ $faq->id }}" data-bs-toggle="modal" data-bs-target="#deleteFaq"><i class="mdi mdi-delete font-size-18"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr><td colspan="7"><h4 class="text-center">No data found!</h4></td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                               
                                {{-- <h6>showing {{$faqs->firstitem()}} to {{  ($faqs->currentpage()-1) * $faqs->perpage() + $faqs->count()}} of {{ $faqs->total() }} results</h6> --}}

                                {{ $faqs->onEachSide(2)->links() }}
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


<!-- add faq modal -->
<div class="modal fade" id="addFaq" tabindex="-1" aria-labelledby="addFaqLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFaqLabel">Add Faq</h5>
                <button type="button" class="btn-close close_faq_form" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="faq_form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Faq Question:</label>
                        <input type="text" class="form-control faq_ques" name="faq_ques">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Faq Answer:</label>
                        <textarea class="form-control faq_ans" name="faq_ans"></textarea>
                    </div>
                </div>
                <div class="modal-footer faq_modal_footer">
                    <button type="button" class="btn btn-secondary close_faq_form" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="addFaqBtn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit faq modal -->
<div class="modal fade" id="editFaq" tabindex="-1" aria-labelledby="editFaqLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFaqLabel">Edit Faq</h5>
                <button type="button" class="btn-close close_faq_form" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="faq_edit_form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Faq Question:</label>
                        <input type="text" class="form-control faq_ques" name="faq_ques" >
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Faq Answer:</label>
                        <textarea class="form-control faq_ans" name="faq_ans" ></textarea>
                    </div>
                </div>
                <div class="modal-footer faq_modal_footer">
                    <button type="button" class="btn btn-secondary close_faq_form" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" data-id="" id="editFaqPost">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- delete faq modal -->

<div class="modal fade" id="deleteFaq" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteFaqLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteFaqLabel">Delete FAQ</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are you sure?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger faq_delete_modal" data-id="">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- delete all faq modal -->

<div class="modal fade" id="deleteAllFaq" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteFaqLabel" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteFaqLabel">Delete FAQ</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are you sure?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger faq_delete_all_modal" data-id="">Delete All</button>
            </div>
        </div>
    </div>
</div>



<!-- view faq modal -->
<div class="modal fade" id="viewFaq" tabindex="-1" role="dialog" aria-labelledby=viewFaqLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id=viewFaqLabel">Faq Details</h4>
                <button type="button" class="btn-close close_faq_view" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="faq_ques_view">
                    <h5>Faq Question:</h5>
                    <p></p>
                </div>
                <div class="faq_ans_view">
                    <h5>Faq Answer:</h5>
                    <p></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_faq_view" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
@endsection




@section('faq_script')
    <script>
        $(document).ready(function()
        {   

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            function validateFaqForm(validate_form)
            {  
                
                var faq_ques =$(validate_form).find('.faq_ques');
                var faq_ans = $(validate_form).find('.faq_ans');

                if(faq_ques.val() == "" && faq_ans.val() == "")
                {
                    faq_ques.parent().append("<small class='text-danger'>required</small>");
                    faq_ans.parent().append("<small class='text-danger'>required</small>");

                    $('.faq_ques').css('border-color','red');
                    $('.faq_ans').css('border-color','red');

                    return false;
                }

                if(faq_ques.val() == "")
                {
                    faq_ques.parent().append("<small class='text-danger'>required</small>");

                    $('.faq_ques').css('border-color','red');

                    return false;
                }

                if(faq_ans.val() == "")
                {
                    faq_ans.parent().append("<small class='text-danger'>required</small>");
                    
                    $('.faq_ans').css('border-color','red');

                    return false;
                }
            }


            $('.close_faq_form').on('click',function()
            {
                $('small').remove('');

                $('.faq_ques').css('border-color','#ced4da');
                $('.faq_ans').css('border-color','#ced4da');

                $('.faq_ques').val("");
                $('.faq_ans').val("");

            });


            $('.modal').on('show.bs.modal', function () 
            {
                $('small').remove('');

                $('.faq_ques').css('border-color','#ced4da');
                $('.faq_ans').css('border-color','#ced4da');

                $('.faq_ques').val("");
                $('.faq_ans').val("");
            });


            $('#addFaqBtn').on('click', function(event)
            {
                event.preventDefault();

                $('small').remove('');

                $('.faq_ques').css('border-color','#ced4da');
                $('.faq_ans').css('border-color','#ced4da');

                var checkvalidate = validateFaqForm('.faq_form');


                if(checkvalidate != false )
                {
                    var faq_ques_val = $('.faq_ques').val();
                    var faq_ans_val = $('.faq_ans').val();
                   $.ajax({
                        type:'POST',
                        url:"{{ route('faq.store') }}",
                        dataType: 'json',
                        data:{faq_ques:faq_ques_val,faq_ans:faq_ans_val},
                        success:function(data){
                            if(data.success)
                            {
                                $('#addFaq').modal('hide');
                                
                                $("#faq_table").load(" #faq_table  > *");
                                
                                $('.faq_add_alert').text(data.success);
                                $('.faq_add_alert').delay(1000).fadeIn(300);
                                $('.faq_add_alert').delay(2000).fadeOut(300);
                                
                                $('.faq_ques').val("");
                                $('.faq_ans').val("");
                            }
                            else{
                                alert(data.error);
                            }
                            
                        }

                   });
                }

            });


            $(document).on('click','.view_faq', function()
            {
                let id = $(this).data('id');
                let url = "{{ route('faq.show', ':id') }}";
                    url = url.replace(":id", id);

                $.ajax({
                    type:'GET',
                    url:url,
                    data:{},
                    beforeSend:function(){
                        $('#viewFaq').addClass('faq_view_loading');
                    },
                    success:function(data)
                    {   
                        setTimeout(() => {
                            $('#viewFaq').removeClass('faq_view_loading');
                            $('.faq_ques_view p').text(data.faq_ques);
                            $('.faq_ans_view p').text(data.faq_ans);
                        }, 200);
                    },
                    error:function(){
                        alert("Something went wrong!");
                    }
                });
            });

            
            $('.close_faq_view').on('click',function()
            {
                $('.faq_ques_view p').text('');
                $('.faq_ans_view p').text('');

            });


            $(document).on('click','.edit_faq', function(event)
            {
                event.preventDefault();

                let id = $(this).data('id');
                let url = "{{ route('faq.edit', ':id') }}";
                    url = url.replace(":id", id);

                $.ajax({
                    type:'GET',
                    url:url,
                    data:{},
                    beforeSend:function(){
                        $('#editFaq').addClass('faq_edit_loading');
                    },
                    success:function(data)
                    {   
                        setTimeout(() => {
                            $('#editFaq').removeClass('faq_edit_loading');
                            $('.faq_edit_form').find('.faq_ques').val(data.faq_ques);
                            $('.faq_edit_form').find('.faq_ans').val(data.faq_ans);
                        }, 200);
                        
                        $('#editFaqPost').data('id',data.id);
                    },
                    error:function(){
                        alert("Something went wrong!");
                    }
                });

            });


            $('#editFaqPost').on('click', function(event)
            {
                event.preventDefault();

                $('small').remove('');

                $('.faq_ques').css('border-color','#ced4da');
                $('.faq_ans').css('border-color','#ced4da');

                 let editFaqValidate = validateFaqForm('.faq_edit_form');

                if(editFaqValidate != false)
                {
                    let id = $(this).data('id');
                    let url = "{{ route('faq.update', ':id') }}";
                        url = url.replace(":id", id);

                    let faq_ques_val = $('.faq_edit_form').find('.faq_ques').val();
                    let faq_ans_val = $('.faq_edit_form').find('.faq_ans').val();

                   $.ajax({
                        type:'PUT',
                        url:url,
                        data:{faq_ques:faq_ques_val,faq_ans:faq_ans_val},
                        success:function(data){

                            if(data.success)
                            {
                                $('#editFaq').modal('hide');
                                
                                $("#faq_table").load(" #faq_table  > *");
                                
                                $('.faq_add_alert').text(data.success);
                                $('.faq_add_alert').delay(1000).fadeIn(300);
                                $('.faq_add_alert').delay(2000).fadeOut(300);
                                
                                $('.faq_edit_form').find('.faq_ques').val("");
                                $('.faq_edit_form').find('.faq_ans').val("");
                            }
                            else{
                                alert(data.error);
                            }
                        },
                        error:function()
                        {
                            alert("Something went wrong!");
                        }

                   });

                }

            });


            $(document).on('click','.SwitchFaqStatus', function()
            {
                let id = $(this).data('id');
                let url = "{{ route('faq.updatestatus', ':id') }}";
                    url = url.replace(":id", id);

                $.ajax({
                    type:'POST',
                    url:url,
                    data:{},
                    success:function(data)
                    {   
                        if(data.success)
                        {
                            $("#faq_table").load(" #faq_table  > *");
                        }
                        else{
                            alert(data.error);
                        }
                    },
                    error:function(){
                        alert("Something went wrong!");
                    }
                });
            });


            // select all faq
            $(document).on('click','#faqCheckAll', function()
            {
                $('.faqCheck').not(this).prop('checked',this.checked);
            });


            // delete single faq item
            $(document).on('click','.faq_delete', function()
            {   
                let id = $(this).data('id');
                $('.faq_delete_modal').data('id',id);
            });


            $('.faq_delete_modal').on('click', function()
            {   
                let id = $(this).data('id');
                let url = "{{ route('faq.destroy', ':id') }}";
                    url = url.replace(":id", id);

                $.ajax({
                    type:'DELETE',
                    url:url,
                    data:{},
                    success:function(data)
                    {
                        if(data.success)
                        {   
                            $('#deleteFaq').modal('hide');

                            $("#faq_table").load(" #faq_table  > *");

                            $('.faq_add_alert').text(data.success);
                            $('.faq_add_alert').delay(500).fadeIn(300);
                            $('.faq_add_alert').delay(1500).fadeOut(300);
                        }
                        else{
                            alert(data.error);
                        }
                    },
                    error:function()
                    {
                        alert("Something went wrong!");
                    }
                });
            });



            // delete all faq
            $(document).on('click','.faq_delete_all', function()
            {   
                let all_vals = [];

                $('.faqCheck:checked').each(function()
                {
                    all_vals.push($(this).data('id'));
                });

                if(all_vals != 0)
                {
                    $('#deleteAllFaq').modal('show');
                    $('.faq_delete_all_modal').data('id',all_vals);  
                }
                else{
                    alert('Please select a row!');
                }

            });


            $('.faq_delete_all_modal').on('click', function()
            {   
                let ids = $(this).data('id');
                let url = "{{ route('faq.deleteall', ':ids') }}";
                    url = url.replace(":ids",ids);

                if(ids != 0)
                {
                    $.ajax({
                        type:'DELETE',
                        url:url,
                        data:{ids:ids},
                        success:function(data)
                        {
                            if(data.success)
                            {   
                                $('#deleteAllFaq').modal('hide');

                                $("#faq_table").load(" #faq_table  > *");

                                $('.faq_add_alert').text(data.success);
                                $('.faq_add_alert').delay(500).fadeIn(300);
                                $('.faq_add_alert').delay(1500).fadeOut(300);

                            }
                            else{
                                alert(data.error);
                            }

                        },
                        error:function()
                        {
                            alert("Something went wrong!");
                        }
                    });

                }
                else{
                    alert('Please select a row!');
                }

            });

        });
    </script>
@endsection

