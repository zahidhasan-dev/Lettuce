@forelse($phones as $key => $phone)
    <tr>
        <td>{{ $phones->firstitem()+$key }}</td>
        <td>{{ $phone->contact_phone }}</td>
        <td>
            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                <input class="form-check-input switchPhonePrimaryStatus" type="checkbox" data-id="{{ $phone->id }}" id="switchPhonePrimaryStatus_{{ $phone->id }}" {{ ($phone->is_primary == 1) ? 'checked' : ''}}>
            </div>
        </td>
        <td>
            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                <input class="form-check-input switchPhoneStatus" type="checkbox" data-id="{{ $phone->id }}" id="switchPhoneStatus_{{ $phone->id }}" {{ ($phone->is_active == 1) ? 'checked' : ''}}>
            </div>
        </td>
        <td>
            <div class="d-flex gap-3">
                <a href="javascript:void(0);" class="text-success contact_phone_edit" data-id="{{ $phone->id }}" data-bs-toggle="modal" data-bs-target="#editContactPhone" ><i class="mdi mdi-pencil font-size-18"></i></a>
                <a href="javascript:void(0);" class="text-danger contact_phone_delete" data-id="{{ $phone->id }}" data-bs-toggle="modal" data-bs-target="#deleteContactPhone"><i class="mdi mdi-delete font-size-18"></i></a>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center">No data found!</td>
    </tr>
@endforelse
    <tr>
        <td colspan="5" class="text-center">{{ $phones->links() }}</td>
    </tr>