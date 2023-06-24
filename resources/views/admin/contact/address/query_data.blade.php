@forelse($addresses as $key => $address)
    <tr>
        <td>{{ $addresses->firstitem()+$key }}</td>
        <td>{{ $address->contact_address }}</td>
        <td>
            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                <input class="form-check-input switchAddressStatus" type="checkbox" data-id="{{ $address->id }}" id="switchAddressStatus_{{ $address->id }}" {{ ($address->is_active == 1) ? 'checked' : ''}}>
            </div>
        </td>
        @canany(['update','delete'], $address)
            <td>
                <div class="d-flex gap-3">
                    @can('update', $address)
                        <a href="javascript:void(0);" class="text-success contact_address_edit" data-id="{{ $address->id }}" data-bs-toggle="modal" data-bs-target="#editContactAddress" >
                            <i class="mdi mdi-pencil font-size-18"></i>
                        </a>
                    @endcan
                    @can('delete', $address)
                        <a href="javascript:void(0);" class="text-danger contact_address_delete" data-id="{{ $address->id }}" data-bs-toggle="modal" data-bs-target="#deleteContactAddress"> 
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
        <td colspan="5" class="text-center">{{ $addresses->links() }}</td>
    </tr>