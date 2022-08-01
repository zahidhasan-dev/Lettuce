@foreach ($trashed_products as $index => $product)
<tr class="product_row" id="product_row_{{ $product->id }}">
    <td>
        <div class="form-check font-size-16">
            <input class="form-check-input product_check" type="checkbox" id="product_check_{{ $product->id }}" value="{{ $product->id }}">
            <label class="form-check-label" for="product_check_{{ $product->id }}"></label>
        </div>
    </td>
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
        <div class="d-flex gap-3">
            <form action="{{ route('product.forcedelete',$product->id) }}" method="post" id="product_force_delete_form_{{ $product->id }}">
                @csrf
                @method('DELETE')
                <a href="javascript:void(0);" class="text-danger product_force_delete" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#forceDeleteProduct"><i class="fas fa-trash font-size-18"></i></a>
            </form>
            <a href="javascript:void(0);" class="text-success product_restore" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#restoreProduct"><i class="fas fa-trash-restore font-size-18"></i></a>
        </div>
    </td>
</tr>
@endforeach