@php

    $order = $order ?? null;
    
@endphp

@if ($order != null)

    @php

        $status_class = 'badge-soft-warning';

        if($order->order_status == 'processing'){
            $status_class = 'badge-soft-primary';
        }
        elseif ($order->order_status == 'delivering') {
            $status_class = 'badge-soft-info';
        }
        elseif ($order->order_status == 'completed') {
            $status_class = 'badge-soft-success';
        }

    @endphp

    <a href="{{ route('admin.order.invoice',$order->id) }}" target="_blank" class="btn text-white mb-4" style="background-color:#80B500;padding: 10px 30px;">Invoice</a>
    <p class="mb-2">Date: <span class="">{{ $order->created_at->format('d M, Y h:i:s A') }}</span></p>
    <p class="mb-2">Order Id: <span class="text-primary">#{{ $order->id }}</span></p>
    <p class="mb-2">Billing Name: <span class="text-primary">{{ $order->billing_name }}</span></p>
    <p class="mb-2">Billing Email: <span class="text-primary">{{ $order->billing_email }}</span></p>
    <p class="mb-2">Billing Phone: <span class="text-primary">{{ $order->billing_phone }}</span></p>
    <p class="mb-2">Billing Address: <span class="text-primary">{{ $order->billing_address.', '.get_city_name($order->billing_city).', '.get_country_name($order->billing_country) }}</span></p>
    <p class="mb-2">Payment Method: 
        <span class=" text-capitalize">
            @if ($order->payment_method == 'cod')
                <i class="fas fa-money-bill-alt me-1"></i> COD
            @else
                <i class="fab fa-cc-stripe me-1"></i> Card
            @endif
        </span>
    </p>
    <p class="mb-2">Payment Status: <span class="badge badge-pill font-size-12 {{ $order->payment_status === 'paid' ? 'badge-soft-success' : 'badge-soft-danger' }}" style="border-radius: 5px;padding:2px 4px;font-size:14px;font-weight:500;">{{ $order->payment_status }}</span></p>
    <p class="mb-4">Order Status: <span class="badge badge-pill font-size-12 {{ $status_class }}" style="border-radius: 5px;padding:2px 4px;font-size:14px;font-weight:500;">{{ $order->order_status }}</span></p>


    <div class="table-responsive">
        <table class="table align-middle table-nowrap">
            <thead>
                <tr>
                <th scope="col">Product</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->order_items as $order_item)
                    <tr>
                        <th scope="row">
                            <div>
                                <img width="80" src="{{ asset('/uploads/product/'.$order_item->orders_product->thumbnail) }}" alt="" class="avatar-sm">
                            </div>
                        </th>
                        <td>
                            <div>
                                <h5 class="text-truncate font-size-14">{{ $order_item->orders_product->product_name.' ('.productSize($order_item->orders_product->id).')' }}</h5>
                                <p class="text-muted mb-0">${{number_format(($order_item->price / 100), 2) }} x {{ $order_item->quantity }}</p>
                            </div>
                        </td>
                        <td>${{number_format((($order_item->price * $order_item->quantity) / 100), 2) }}</td>
                    </tr>
                @endforeach
                @if ($order->coupon)
                    <tr>
                        <td colspan="2">
                            <h6 class="m-0 text-right">Coupon{{ ' ( '.$order->coupon_code.' - '.$order->coupon_value.' )' }}:</h6>
                        </td>
                        <td>
                            - ${{ number_format(($order->coupon_amount / 100), 2) }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <td colspan="2">
                        <h6 class="m-0 text-right">Sub Total:</h6>
                    </td>
                    <td>
                        ${{ number_format(($order->order_subtotal / 100), 2) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6 class="m-0 text-right">Shipping:</h6>
                    </td>
                    <td>
                        @if ($order->order_shipping <= 0)
                            Free
                        @else
                            ${{ number_format(($order->order_shipping / 100), 2) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6 class="m-0 text-right">Vat{{ ' ('.($order->order_vat).'%)' }}:</h6>
                    </td>
                    <td>
                        ${{ number_format(($order->vat_value / 100), 2) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h6 class="m-0 text-right">Total:</h6>
                    </td>
                    <td>
                        ${{ number_format(($order->order_total / 100), 2) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endif