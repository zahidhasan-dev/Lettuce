@forelse($emails as $key => $email)
    <tr>
        <td>{{ $emails->firstitem()+$key }}</td>
        <td>{{ $email->contact_email }}</td>
       
        <td>
            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                <input class="form-check-input switchEmailPrimaryStatus" type="checkbox" data-id="{{ $email->id }}" id="switchEmailPrimaryStatus_{{ $email->id }}" {{ ($email->is_primary == 1) ? 'checked' : ''}}>
            </div>
        </td>
       
        <td>
            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                <input class="form-check-input switchEmailStatus" type="checkbox" data-id="{{ $email->id }}" id="switchEmailStatus_{{ $email->id }}" {{ ($email->is_active == 1) ? 'checked' : ''}}>
            </div>
        </td>
        @canany(['update','delete'], $email)    
            <td>
                <div class="d-flex gap-3">
                    @can('update', $email)
                        <a href="javascript:void(0);" class="text-success contact_email_edit" data-id="{{ $email->id }}" data-bs-toggle="modal" data-bs-target="#editContactEmail" >
                            <i class="mdi mdi-pencil font-size-18"></i>
                        </a>
                    @endcan
                    @can('delete', $email)
                        <a href="javascript:void(0);" class="text-danger contact_email_delete" data-id="{{ $email->id }}" data-bs-toggle="modal" data-bs-target="#deleteContactEmail">
                            <i class="mdi mdi-delete font-size-18"></i>
                        </a>
                    @endcan
                </div>
            </td>
        @endcanany
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center">No data found!</td>
    </tr>
@endforelse
    <tr>
        <td colspan="5" class="text-center">{{ $emails->links() }}</td>
    </tr>