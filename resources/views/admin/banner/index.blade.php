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
                                    <tr id="">
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input faqCheck" type="checkbox" id="faqCheck" name="faqCheck[]" data-id="">
                                                <label class="form-check-label" for="orderidcheck01"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                <input class="form-check-input SwitchFaqStatus" type="checkbox" data-id="" id="SwitchFaqStatus">
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-sm btn-rounded view_faq" data-id="" data-bs-toggle="modal" data-bs-target="#viewFaq">
                                                View Details
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="javascript:void(0);" class="text-success edit_faq" data-id="" data-bs-toggle="modal" data-bs-target="#editFaq"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                <a href="javascript:void(0);" class="text-danger faq_delete" data-id="" data-bs-toggle="modal" data-bs-target="#deleteFaq"><i class="mdi mdi-delete font-size-18"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                        <tr><td colspan="7"><h4 class="text-center">No data found!</h4></td></tr>
                                    
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


@endsection





