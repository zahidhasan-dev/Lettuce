@forelse ($newsletters as $index => $newsletter)
    <tr>
        <td>{{ $newsletters->firstitem()+$index }}</td>
        <td>{{ $newsletter->newsletter_subject }}</td>
        <td>{{ $newsletter->created_at->setTimezone('Asia/Dhaka')->format('d F, Y h:i:s A')}}</td>
        <td>
            <a href="javascript:void(0);" id="newsletter_show_btn" data-id="{{ $newsletter->id }}"  style="margin-right:5px;"><i class="mdi mdi-eye font-size-18"></i></a>
            <a href="javascript:void();" data-id="{{ $newsletter->id }}" data-bs-toggle="modal" data-bs-target="#deleteNewsletter" class="text-danger delete_newsletter_btn"><i class="mdi mdi-delete font-size-18"></i></a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="text-center">No data found!</td>
    </tr>
@endforelse
    <tr>
        <td colspan="4" align="center">{{ $newsletters->links() }}</td>
    </tr>