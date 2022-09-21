@php
    $subscriber = $subscriber ?? null;
@endphp

@if ($subscriber != null)
    <div class="table-responsive">
        <table class="table table-borderless subscriber_details_table table-nowrap mb-0">
            <tbody>
                <tr class="subscriber_details_id">
                    <th scope="row">Id :</th>
                    <td>{{ $subscriber->subscriber_id }}</td>
                </tr>
                <tr class="subscriber_details_email">
                    <th scope="row">E-mail :</th>
                    <td>{{ $subscriber->subscriber_email }}</td>
                </tr>
                <tr class="subscriber_details_joined">
                    <th scope="row">Joined :</th>
                    <td>{{ $subscriber->created_at->format('d F, Y') }}</td>
                </tr>
                <tr class="subscriber_details_status">
                    <th scope="row">Status :</th>
                    <td>
                        @if ($subscriber->subscribed)
                            <span class="badge bg-success">subscribed</span>
                        @else
                            <span class="badge bg-danger">unsubscribed</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endif