@forelse ($subscribers as $index => $subscriber)
    <tr>
        <td>{{ $subscribers->firstitem()+$index }}</td>
        <td>{{ $subscriber->subscriber_email }}</td>
        <td>
            @if ($subscriber->subscribed)
                <span class="badge bg-success">subscribed</span>
            @else
                <span class="badge bg-danger">unsubscribed</span>
            @endif
        </td>
        @canany(['view', 'delete'], $subscriber)
            <td>
                @can('view', $subscriber)
                    <a href="javascript:void(0);" id="subscriber_show_btn" data-id="{{ $subscriber->subscriber_id }}"  style="margin-right:5px;">
                        <i class="mdi mdi-eye font-size-18"></i>
                    </a>
                @endcan
                @can('delete', $subscriber)
                    <a href="javascript:void();" data-id="{{ $subscriber->subscriber_id }}" data-bs-toggle="modal" data-bs-target="#deleteSubscriber" class="text-danger delete_subscriber_btn">
                        <i class="mdi mdi-delete font-size-18"></i>
                    </a>
                @endcan
            </td>
        @endcanany
    </tr>
@empty
    <tr>
        <td colspan="4" class="text-center">No data found!</td>
    </tr>
@endforelse
    <tr>
        <td colspan="4" align="center">{{ $subscribers->links() }}</td>
    </tr>