@forelse ($products as $index => $product)
<tr class="product_row" id="product_row_{{ $product->id }}">
    <td>
        <img width="80px" src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="">
    </td>
    <td class="text-capitalize">{{ $product->product_name }}</td>
    <td class="text-capitalize">
        @foreach ($product->categories as $category)
            @if($category->main_category != null)
                {{ $category->main_category->category_name.' / ' }}
            @endif
            {{ $category->category_name }}
        @endforeach
    </td>
    <td>{{ $product->slug }}</td>
    <td>
        @foreach ($product->size as $size)
            {{ $size->pivot->size_value.' '.$size->scale_name }}
        @endforeach
    </td>
    <td>{{ $product->price / 100 }}</td>
    <td>
        @if($product->in_stock == 0)
            <span class="badge bg-danger">out of stock</span>
        @elseif($product->in_stock <= 20)
            <span class="d-block text-center">{{ $product->in_stock }}</span>
            <span class="badge bg-warning">low in stock</span>
        @else
            {{ $product->in_stock }}
        @endif
    </td>
    <td>{{ $product->has_discount }}</td>
    <td>
        <div class="form-check form-switch form-switch-sm mb-3" dir="ltr">
            <input class="form-check-input productFeaturedUpdate" type="checkbox" data-id="{{ $product->id }}" {{ ($product->is_featured == 1)?'checked':'' }}>
        </div>
    </td>
    
    <td>
        <div class="form-check form-switch form-switch-sm mb-3" dir="ltr">
            <input class="form-check-input switchProductstatus" type="checkbox" data-id="{{ $product->id }}" {{ ($product->status == 1)?'checked':'' }}>
        </div>
    </td>
    <td>
        <div class="d-flex gap-3">
            <a href="{{ route('product.show',$product->id) }}" class="text-primary edit_product"><i class="mdi mdi-eye font-size-18"></i></a>
            <a href="{{ route('product.edit',$product->id) }}" class="text-success edit_product" ><i class="mdi mdi-pencil font-size-18"></i></a>
            <a href="javascript:void(0);" class="text-danger product_delete" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#deleteProduct"><i class="mdi mdi-delete font-size-18"></i></a>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="9" class="text-center">No data found!</td>
</tr>
@endforelse