@php
    $newsletter = $newsletter ?? null;
@endphp

@if ($newsletter != null)
    <div class="row">
        <div class="col-12">
            <div class="newsletter_tab_btn_wrapper mb-3">
                <span class="newsletter_tab_btn btn btn-primary active" id="newsletter_form_tab_btn" data-target="newsletter_details_code_wrapper"><i class="mdi mdi-code-tags"></i> HTML</span>
                <span class="newsletter_tab_btn btn btn-primary" id="newsletter_preview_tab_btn" data-target="newsletter_preview_wrapper" style="margin:5px"><i class="mdi mdi-eye"></i> Preview</span>
            </div>
        </div>
        <div class="col-12">
            <div class="newsletter_tab_wrapper active" id="newsletter_details_code_wrapper">
                <div id="newsletter_details_code">{{ $newsletter->newsletter_code }}</div>
            </div>
            <div class="newsletter_tab_wrapper" id="newsletter_preview_wrapper">
                <div id="newsletter_preview">
                    <iframe src="{{ route('newsletter.preview') }}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endif