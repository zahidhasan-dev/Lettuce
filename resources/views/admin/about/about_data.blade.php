@forelse($abouts as $key => $about)
    <tr>
        <td>{{ $abouts->firstitem()+$key }}</td>
        <td><img width="100" src="{{ asset('uploads/about/'.$about->about_image) }}" alt=""></td>
        <td>
            @if (!is_null($about->about_sub_title))
                @if(strlen($about->about_sub_title)>20)
                    {{ substr($about->about_sub_title,0,20).'...more' }}
                @else
                    {{ $about->about_sub_title }}
                @endif
                
            @else
                N/A
            @endif
        </td>
        <td>
            @if (!is_null($about->about_title))
                @if(strlen($about->about_title)>20)
                    {{ substr($about->about_title,0,20).'...more' }}
                @else
                    {{ $about->about_title }}
                @endif
                
            @else
                N/A
            @endif
        </td>
        <td>
            @if (!is_null($about->about_desc_1))
                @if(strlen($about->about_desc_1)>30)
                    {{ substr($about->about_desc_1,0,30).'...more' }}
                @else
                    {{ $about->about_desc_1 }}
                @endif
                
            @else
                N/A
            @endif
        </td>
        <td>
            @if (!is_null($about->about_desc_2))
                @if(strlen($about->about_desc_2)>30)
                    {{ substr($about->about_desc_2,0,30).'...more' }}
                @else
                    {{ $about->about_desc_2 }}
                @endif
                
            @else
                N/A
            @endif
        </td>
        <td>
            @if ($about->about_author_name != null)
                {{ $about->about_author_name }}
            @else
                N/A
            @endif
        </td>
        <td>
            @if ($about->about_author_title != null)
                {{ $about->about_author_title }}
            @else
                N/A
            @endif
        </td>
        <td>
            <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                <input class="form-check-input switchAboutStatus" type="checkbox" data-id="{{ $about->id }}" id="switchAboutStatus_{{ $about->id }}" {{ ($about->is_active == 1) ? 'checked' : ''}}>
            </div>
        </td>
        <td>
            <a href="{{ route('about.show',$about->id) }}" class="btn btn-primary btn-sm btn-rounded">View Details</a>
        </td>
        <td>
            <div class="d-flex gap-3">
                <a href="{{ route('about.edit',$about->id) }}" class="text-success" ><i class="mdi mdi-pencil font-size-18"></i></a>
                <a href="javascript:void(0);" class="text-danger about_delete" data-id="{{ $about->id }}" data-bs-toggle="modal" data-bs-target="#deleteAbout"><i class="mdi mdi-delete font-size-18"></i></a>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="11" class="text-center">No data found!</td>
    </tr>
@endforelse
    <tr>
        <td colspan="11" class="text-center">{{ $abouts->links() }}</td>
    </tr>