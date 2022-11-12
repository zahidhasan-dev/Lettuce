@forelse ($orders as $order)
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
    <tr>
        <td><a href="javascript: void(0);" class="text-body fw-bold">#{{ $order->id }}</a> </td>
        <td>{{ $order->billing_name }}</td>
        <td>{{ $order->billing_email }}</td>
        <td>{{ number_format(($order->order_total/100),2) }}</td>
        <td>
            @if ($order->payment_status == 'paid')
                <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
            @else
                <span class="badge badge-pill badge-soft-danger font-size-12">Due</span>
            @endif
        </td>
        <td>
            @if ($order->payment_method == 'cod')
                <i class="fas fa-money-bill-alt me-1"></i> COD
            @else
                <i class="fab fa-cc-stripe me-1"></i> Card
            @endif
        </td>
        <td>
            <span class="badge badge-pill {{ $status_class }} font-size-12 text-capitalize">{{ $order->order_status }}</span>
        </td>
        <td>
            <!-- Button trigger modal -->
            <button type="button" id="view_order_details_btn" class="btn btn-primary btn-sm btn-rounded" data-id="{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#viewOrderItem">
                View Details
            </button>
        </td>
        <td>
            <div class="d-flex gap-3">

                <a href="{{ route('admin.order.invoice', $order->id) }}" target="_blank" class="btn btn-info btn-sm" style="min-width:80px;">Invoice</a>

                @if ($order->order_status == 'completed')
                    <a href="javascript:void(0);" data-id="{{ $order->id }}" id="order_delete_btn" class="btn btn-danger btn-sm" style="min-width:80px;" data-bs-toggle="modal" data-bs-target="#deleteOrder">Delete</a>
                @else
                    <a href="javascript:void(0);" data-id="{{ $order->id }}" id="order_status_btn" class="btn btn-success btn-sm" style="min-width:80px;" data-bs-toggle="modal" data-bs-target="#updateOrderStatus">
                        @if ($order->order_status == 'pending')
                        Process
                        @elseif ($order->order_status == 'processing')
                        Deliver
                        @elseif ($order->order_status == 'delivering')
                        Complete
                        @endif
                    </a>
                @endif

            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="9" class="text-center">No data found!</td>
    </tr>
@endforelse
    <tr>
        <td colspan="9" align="center">{{ $orders->links() }}</td>
    </tr>

