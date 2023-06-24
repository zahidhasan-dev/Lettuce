@foreach ($products as $index => $product)
<tr class="product_row" id="product_row_{{ $product->id }}">
    @can('product-mass-destroy', \App\Models\Product::class)
        <td>
            <div class="form-check font-size-16">
                <input class="form-check-input product_check" type="checkbox" id="product_check_{{ $product->id }}" value="{{ $product->id }}">
                <label class="form-check-label" for="product_check_{{ $product->id }}"></label>
            </div>
        </td>
    @endcan
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
    <td>{{ round(($product->price / 100),2) }}</td>
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
    <td>
        @if($product->has_discount == 1)
            {{ getProductDiscount($product->id)->discount_name.' ('.discountValueType(getProductDiscount($product->id)->id).')' }}
        @else
            N/A
        @endif
    </td>
    <td>
        <div class="form-check form-switch form-switch-sm mb-3" dir="ltr">
            <input class="form-check-input productFeaturedUpdate" id="productFeaturedUpdate_{{ $product->id }}" type="checkbox" data-id="{{ $product->id }}" {{ ($product->is_featured == 1)?'checked':'' }}>
        </div>
    </td>
    
    <td>
        <div class="form-check form-switch form-switch-sm mb-3" dir="ltr">
            <input class="form-check-input switchProductstatus" id="switchProductStatus_{{ $product->id }}" type="checkbox" data-id="{{ $product->id }}" {{ ($product->status == 1)?'checked':'' }}>
        </div>
    </td>
    @canany(['update', 'view', 'delete'], $product)
        <td>
            <div class="d-flex gap-3">
                @can('view', $product)
                    <a href="{{ route('product.show',$product->id) }}" class="text-primary view_product">
                        <i class="mdi mdi-eye font-size-18"></i>
                    </a>                    
                @endcan

                @can('update', $product)
                    <a href="{{ route('product.edit',$product->id) }}" class="text-success edit_product" >
                        <i class="mdi mdi-pencil font-size-18"></i>
                    </a>                    
                @endcan

                @can('delete', $product)
                    <form action="{{ route('product.destroy',$product->id) }}" method="post" id="product_delete_form_{{ $product->id }}">                                            
                        @csrf
                        @method('DELETE')
                        <a href="javascript:void(0);" class="text-danger product_delete" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#deleteProduct">
                            <i class="mdi mdi-delete font-size-18"></i>
                        </a>
                    </form>
                @endcan
            </div>
        </td>
    @endcanany
</tr>
@endforeach