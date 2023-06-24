@forelse($banners as $key => $banner)
    <tr>
        <td>{{ $banners->firstitem()+$key }}</td>
        <td><img width="100" src="{{ asset('uploads/banner/'.$banner->banner_image) }}" alt=""></td>
        <td>{{ $banner->banner_type }}</td>
        <td>
            @if (!is_null($banner->banner_title))
                @if(strlen($banner->banner_title)>20)
                    {{ substr($banner->banner_title,0,20).'...more' }}
                @else
                    {{ $banner->banner_title }}
                @endif
                
            @else
                N/A
            @endif
        </td>
        <td>
            @if ($banner->category_id != null)
                {{ $banner->category->category_name }}
            @else
                N/A
            @endif
        </td>
        <td>
            @if ($banner->discount_id != null)
                {{ $banner->discount->discount_name.' ('.discountValueType($banner->discount->id).')' }}
            @else
                N/A
            @endif
        </td>
        <td>
            @if ($banner->banner_slug != null)
                {{ $banner->banner_slug }}
            @else
                N/A
            @endif
        </td>
        <td>
            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                <input class="form-check-input switchBannerStatus" type="checkbox" data-id="{{ $banner->id }}" id="switchBannerStatus_{{ $banner->id }}" {{ ($banner->status == 1) ? 'checked' : ''}}>
            </div>
        </td>

        @can('view', $banner)
            <td>
                <a href="{{ route('banner.show',$banner->id) }}" class="btn btn-primary btn-sm btn-rounded">View Details</a>
            </td>
        @endcan
        @canany(['update','delete'], $banner)
            <td>
                <div class="d-flex gap-3">
                    @can('update', $banner)
                        <a href="{{ route('banner.edit',$banner->id) }}" class="text-success" ><i class="mdi mdi-pencil font-size-18"></i></a>
                    @endcan
                    @can('delete', $banner)
                        <a href="javascript:void(0);" class="text-danger banner_delete" data-id="{{ $banner->id }}" data-bs-toggle="modal" data-bs-target="#deleteBanner"><i class="mdi mdi-delete font-size-18"></i></a>
                    @endcan
                </div>
            </td>    
        @endcanany
    </tr>
@empty
    <tr>
        <td colspan="11" class="text-center">No data found!</td>
    </tr>
@endforelse
    <tr>
        <td colspan="11" class="text-center">{{ $banners->links() }}</td>
    </tr>