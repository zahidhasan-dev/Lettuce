@forelse ($messages as $index => $message)
    <tr class="message_row" style="{{ $message->is_read == false ? 'font-weight:700' : '' }}" id="message_row_{{ $message->id }}">
        <td>
            <div class="form-check font-size-16">
                <input class="form-check-input message_check" type="checkbox" id="messageCheck_{{ $message->id }}" value="{{ $message->id }}">
                <label class="form-check-label" for="messageCheck_{{ $message->id }}"></label>
            </div>
        </td>
        <td class="text-capitalize">{{ $message->name }}</td>
        <td>{{ $message->email }}</td>
        <td>
            @if(strlen($message->message) > 30)
                {{ substr($message->message,0,30).'...' }}
            @else 
                {{ $message->message }}
            @endif
        </td>
        <td>
            <div class="d-flex gap-3">
                @if ($message->deleted_at == null)
                    <a href="{{ route('admin.message.show', $message->id) }}" class="text-primary message_view"><i class="fas fa-eye font-size-16"></i></a>
                    <a href="javascript:void(0);" class="text-danger message_delete" data-id="{{ $message->id }}" data-bs-toggle="modal" data-bs-target="#deleteMessage"><i class="fas fa-trash font-size-16"></i></a>
                @else
                    <a href="javascript:void(0);" class="text-danger message_delete" data-id="{{ $message->id }}" data-bs-toggle="modal" data-bs-target="#deleteMessage"><i class="fas fa-trash font-size-16"></i></a>
                    <a href="javascript:void(0);" class="text-success message_restore" data-id="{{ $message->id }}" data-bs-toggle="modal" data-bs-target="#restoreMessage"><i class="fas fa-trash-restore font-size-16"></i></a>
                @endif
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center">No data found!</td>
    </tr>
@endforelse
<tr>
    <td colspan="7" align="center">{{ $messages->links() }}</td>
</tr>