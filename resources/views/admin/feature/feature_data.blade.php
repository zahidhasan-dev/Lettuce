@forelse($features as $key => $feature)
    <tr>
        <td>{{ $features->firstitem()+$key }}</td>
        <td><img width="50" src="{{ asset('uploads/feature/'.$feature->feature_image) }}" alt=""></td>
        <td>
            {{ $feature->feature_title }}
        </td>
        <td>
            @if(strlen($feature->feature_desc)>30)
                {{ substr($feature->feature_desc,0,30).'...more' }}
            @else
                {{ $feature->feature_desc }}
            @endif
        </td>
        <td>
            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                <input class="form-check-input switchFeatureStatus" type="checkbox" data-id="{{ $feature->id }}" id="switchFeatureStatus_{{ $feature->id }}" {{ ($feature->is_active == 1) ? 'checked' : ''}}>
            </div>
        </td>
        <td>
            <a href="{{ route('feature.show',$feature->id) }}" class="btn btn-primary btn-sm btn-rounded">View Details</a>
        </td>
        <td>
            <div class="d-flex gap-3">
                <a href="{{ route('feature.edit',$feature->id) }}" class="text-success" ><i class="mdi mdi-pencil font-size-18"></i></a>
                <a href="javascript:void(0);" class="text-danger feature_delete" data-id="{{ $feature->id }}" data-bs-toggle="modal" data-bs-target="#deleteFeature"><i class="mdi mdi-delete font-size-18"></i></a>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="11" class="text-center">No data found!</td>
    </tr>
@endforelse
    <tr>
        <td colspan="11" class="text-center">{{ $features->links() }}</td>
    </tr>