    @forelse ($discounts as $index => $discount)
        <tr class="discount_row" id="discount_row_{{ $discount->id }}">
            <td>{{ $discounts->firstitem()+$index }}</td>
            <td>{{ $discount->discount_name }}</td>
            <td>{{ discountValue($discount->id) }}</td>
            <td>{{ $discount->discount_type }}</td>
            <td>{{ $discount->discount_slug }}</td>
            <td data-time="{{ $discount->discount_validity }}" data-id="{{ $discount->id }}" class="discount_validity_date"><span class="badge {{ (discountExpiryDate($discount->id)['status'] === 'active')?'bg-success':'bg-danger' }}" style="padding:5px;min-width:95px">{{ discountExpiryDate($discount->id)['result'] }}</span></td>
            <td>
                <div class="form-check form-switch form-switch-sm mb-3" dir="ltr">
                    <input class="form-check-input switchDiscountStatus" type="checkbox" data-id="{{ $discount->id }}" id="switchDiscountStatus_{{ $discount->id }}" {{ ($discount->status == 1)?'checked':'' }}>
                </div>
            </td>
            @canany(['update', 'delete'], $discount)
                <td>
                    <div class="d-flex gap-3">
                        @can('update', $discount)
                            <a href="javascript:void(0);" class="text-success edit_discount" data-id="{{ $discount->id }}" data-bs-toggle="modal" data-bs-target="#editDiscount">
                                <i class="mdi mdi-pencil font-size-18"></i>
                            </a>                        
                        @endcan

                        @can('delete', $discount)
                            <a href="javascript:void(0);" class="text-danger discount_delete" data-id="{{ $discount->id }}" data-bs-toggle="modal" data-bs-target="#deleteDiscount">
                                <i class="mdi mdi-delete font-size-18"></i>
                            </a>                        
                        @endcan
                    </div>
                </td>
            @endcanany
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">No data found!</td>
        </tr>
    @endforelse
    <tr>
        <td colspan="7" align="center">{{ $discounts->links() }}</td>
    </tr>