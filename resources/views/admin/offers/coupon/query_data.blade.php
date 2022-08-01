    @forelse ($coupons as $index => $coupon)
        <tr class="coupon_row" id="coupon_row_{{ $coupon->id }}">
            <td>{{ $coupons->firstitem()+$index }}</td>
            <td>{{ $coupon->coupon_code }}</td>
            <td>{{ couponValue($coupon->id) }}</td>
            <td>{{ $coupon->coupon_type }}</td>
            <td data-time="{{ $coupon->coupon_validity }}" data-id="{{ $coupon->id }}" class="coupon_validity_date"><span class="badge {{ (couponExpiryDate($coupon->id)['status'] === 'active')?'bg-success':'bg-danger' }}" style="padding:5px;min-width:95px">{{ couponExpiryDate($coupon->id)['result'] }}</span></td>
            <td>
                <div class="form-check form-switch form-switch-sm mb-3" dir="ltr">
                    <input class="form-check-input switchCouponStatus" type="checkbox" data-id="{{ $coupon->id }}" id="switchCouponStatus" {{ ($coupon->status == 1)?'checked':'' }}>
                </div>
            </td>
            <td>
                <div class="d-flex gap-3">
                    <a href="javascript:void(0);" class="text-success edit_coupon" data-id="{{ $coupon->id }}" data-bs-toggle="modal" data-bs-target="#editCoupon"><i class="mdi mdi-pencil font-size-18"></i></a>
                    <a href="javascript:void(0);" class="text-danger coupon_delete" data-id="{{ $coupon->id }}" data-bs-toggle="modal" data-bs-target="#deleteCoupon"><i class="mdi mdi-delete font-size-18"></i></a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">No data found!</td>
        </tr>
    @endforelse
    <tr>
        <td colspan="7" align="center">{{ $coupons->links() }}</td>
    </tr>