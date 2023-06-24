@forelse ($categories as $index => $category)
    <tr class="category_row" id="category_row_{{ $category->id }}">
        <td>{{ $categories->firstitem()+$index }}</td>
        <td class="text-capitalize">{{ $category->category_name }}</td>
        <td class="text-capitalize">
            @if($category->main_category != null)
                {{ $category->main_category->category_name }}
            @else
                root
            @endif
        </td>
        <td>{{ $category->category_slug }}</td>
        <td>
            @if($category->category_photo != null)
            <img width="50" src="{{ asset('uploads/category/'.$category->category_photo) }}" alt="category-img">
            @else
            N/A
            @endif
        </td>
        <td>
            <div class="form-check form-switch form-switch-sm mb-3" dir="ltr">
                <input class="form-check-input switchCategoriestatus" type="checkbox" data-id="{{ $category->id }}" id="switchCategoriesStatus_{{ $category->id }}" {{ ($category->status == 1)?'checked':'' }}>
            </div>
        </td>
        @canany(['update','delete'], $category)
            <td>
                <div class="d-flex gap-3">
                    @can('update', $category)
                        <a href="javascript:void(0);" class="text-success edit_category" data-id="{{ $category->id }}" data-bs-toggle="modal" data-bs-target="#editCategory">
                            <i class="mdi mdi-pencil font-size-18"></i>
                        </a>
                    @endcan
                        
                    @can('delete', $category)
                        <a href="javascript:void(0);" class="text-danger category_delete" data-id="{{ $category->id }}" data-bs-toggle="modal" data-bs-target="#deleteCategory">
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
    <td colspan="7" align="center">{{ $categories->links() }}</td>
</tr>