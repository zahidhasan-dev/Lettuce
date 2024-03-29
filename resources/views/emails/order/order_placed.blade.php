
@php
    $order = \App\Models\Order::find(94);
@endphp

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="overflow-x: visible !important;">
    <head>
        <meta http-equiv="Content-Security-Policy" content="script-src 'none'; connect-src 'none'; object-src 'none'; form-action 'none';">
        <meta charset="UTF-8"><meta content="width=device-width, initial-scale=1" name="viewport">
        <meta name="x-apple-disable-message-reformatting">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="telephone=no" name="format-detection">
        <title></title>

        <style type="text/css">
            #outlook a {	padding:0;}

            .es-button {	mso-style-priority:100!important;	text-decoration:none!important;}
            
            a[x-apple-data-detectors] {	color:inherit!important;	text-decoration:none!important;	font-size:inherit!important;	font-family:inherit!important;	font-weight:inherit!important;	line-height:inherit!important;}
            
            .es-desk-hidden {	display:none;	float:left;	overflow:hidden;	width:0;	max-height:0;	line-height:0;	mso-hide:all;}
            
            [data-ogsb] .es-button {	border-width:0!important;	padding:10px 20px 10px 20px!important;}
            
            @media only screen and (max-width:600px) {
                p, ul li, ol li, a { line-height:150%!important }
            
                h1, h2, h3, h1 a, h2 a, h3 a { line-height:120% }
                
                h1 { font-size:30px!important; text-align:center }
            
                h2 { font-size:26px!important; text-align:center }
            
                h3 { font-size:20px!important; text-align:center }
            
                .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:30px!important }
            
                .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:26px!important }
            
                .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important }
            
                .es-menu td a { font-size:12px!important }
            
                .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:14px!important }
            
                .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:14px!important }
            
                .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:14px!important }
            
                .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important }
            
                *[class="gmail-fix"] { display:none!important }
            
                .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important }
            
                .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important }
            
                .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important }
            
                .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important }
            
                .es-button-border { display:block!important }
            
                a.es-button, button.es-button { font-size:20px!important; display:block!important; border-left-width:0px!important; border-right-width:0px!important }
            
                .es-adaptive table, .es-left, .es-right { width:100%!important }
            
                .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important }
            
                .es-adapt-td { display:block!important; width:100%!important }
            
                .adapt-img { width:100%!important; height:auto!important }
            
                .es-m-p0 { padding:0!important }
            
                .es-m-p0r { padding-right:0!important }
            
                .es-m-p0l { padding-left:0!important }
            
                .es-m-p0t { padding-top:0!important }
            
                .es-m-p0b { padding-bottom:0!important }
            
                .es-m-p20b { padding-bottom:20px!important }
            
                .es-mobile-hidden, .es-hidden { display:none!important }
            
                tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important }
            
                tr.es-desk-hidden { display:table-row!important }
            
                table.es-desk-hidden { display:table!important }
            
                td.es-desk-menu-hidden { display:table-cell!important }
            
                .es-menu td { width:1%!important }
            
                table.es-table-not-adapt, .esd-block-html table { width:auto!important }
            
                table.es-social { display:inline-block!important }
            
                table.es-social td { display:inline-block!important }
            
                .es-m-p5 { padding:5px!important }
            
                .es-m-p5t { padding-top:5px!important }
            
                .es-m-p5b { padding-bottom:5px!important }
            
                .es-m-p5r { padding-right:5px!important }
            
                .es-m-p5l { padding-left:5px!important }
            
                .es-m-p10 { padding:10px!important }
            
                .es-m-p10t { padding-top:10px!important }
            
                .es-m-p10b { padding-bottom:10px!important }
            
                .es-m-p10r { padding-right:10px!important }
            
                .es-m-p10l { padding-left:10px!important }
            
                .es-m-p15 { padding:15px!important }
            
                .es-m-p15t { padding-top:15px!important }
            
                .es-m-p15b { padding-bottom:15px!important }
            
                .es-m-p15r { padding-right:15px!important }
            
                .es-m-p15l { padding-left:15px!important }
            
                .es-m-p20 { padding:20px!important }
            
                .es-m-p20t { padding-top:20px!important }
            
                .es-m-p20r { padding-right:20px!important }
            
                .es-m-p20l { padding-left:20px!important }
            
                .es-m-p25 { padding:25px!important }
            
                .es-m-p25t { padding-top:25px!important }
            
                .es-m-p25b { padding-bottom:25px!important }
            
                .es-m-p25r { padding-right:25px!important }
            
                .es-m-p25l { padding-left:25px!important }
            
                .es-m-p30 { padding:30px!important }
            
                .es-m-p30t { padding-top:30px!important }
            
                .es-m-p30b { padding-bottom:30px!important }
            
                .es-m-p30r { padding-right:30px!important }
            
                .es-m-p30l { padding-left:30px!important }
            
                .es-m-p35 { padding:35px!important }
            
                .es-m-p35t { padding-top:35px!important }
            
                .es-m-p35b { padding-bottom:35px!important }
            
                .es-m-p35r { padding-right:35px!important }
            
                .es-m-p35l { padding-left:35px!important }
            
                .es-m-p40 { padding:40px!important }
            
                .es-m-p40t { padding-top:40px!important }
            
                .es-m-p40b { padding-bottom:40px!important }
            
                .es-m-p40r { padding-right:40px!important }
            
                .es-m-p40l { padding-left:40px!important }
            
                .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; max-height:inherit!important }
            
            }
            
        </style>
        <link href="assets/css/dev-custom-scroll.css" rel="stylesheet" type="text/css">
        <base target="_blank">
    </head>
    <body style="width: 100%; font-family: arial, &quot;helvetica neue&quot;, helvetica, sans-serif; text-size-adjust: 100%; padding: 0px; margin: 0px; overflow-y: scroll !important; visibility: visible !important;" data-new-gr-c-s-check-loaded="14.1080.0" data-gr-ext-installed="">
        <div class="es-wrapper-color" style="background-color:#FFFFFF">
            <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FFFFFF">
                <tbody>
                    <tr>
                        <td valign="top" style="padding:0;Margin:0">
                            <table cellpadding="0" cellspacing="0" class="es-header" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                                <tbody>
                                    <tr>
                                        <td align="center" style="padding:0;Margin:0">
                                            <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                                <tbody>
                                                    <tr>
                                                        <td class="esdev-adapt-off" align="left" style="padding:20px;Margin:0">
                                                            <table cellpadding="0" cellspacing="0" class="esdev-mso-table" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="es-m-p0r" valign="top" align="center" style="padding:0;Margin:0;width:415px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="left" style="padding:0;Margin:0;font-size:0px">
                                                                                                            <a target="_blank" href="{{ route('index') }}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:14px">
                                                                                                                <img src="{{ asset('frontend_assets/img/logo.png') }}" alt="Logo" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="120" title="Logo">
                                                                                                            </a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td style="padding:0;Margin:0;width:20px"></td>
                                                                        <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                                            <table cellpadding="0" cellspacing="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0;width:125px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td style="padding:0;Margin:0">
                                                                                                            <table cellpadding="0" cellspacing="0" width="100%" class="es-menu" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                                <tbody>
                                                                                                                    <tr class="images">
                                                                                                                        <td align="center" valign="top" width="33.33%" id="esd-menu-id-0" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0">
                                                                                                                            <a target="_blank" href="{{ route('customer.account') }}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#926B4A;font-size:14px">
                                                                                                                                <img src="https://tlr.stripocdn.email/content/guids/CABINET_455a2507bd277c27cf7436f66c6b427c/images/95531620294283439.png" width="20" style="display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;vertical-align:middle">
                                                                                                                            </a>
                                                                                                                        </td>
                                                                                                                        <td align="center" valign="top" width="33.33%" id="esd-menu-id-1" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0">
                                                                                                                            <a target="_blank" href="{{ url('wishlist') }}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#926B4A;font-size:14px">
                                                                                                                                <img src="https://tlr.stripocdn.email/content/guids/CABINET_455a2507bd277c27cf7436f66c6b427c/images/86381620294283248.png" width="20" style="display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;vertical-align:middle">
                                                                                                                            </a>
                                                                                                                        </td>
                                                                                                                        <td align="center" valign="top" width="33.33%" id="esd-menu-id-2" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0">
                                                                                                                            <a target="_blank" href="{{ url('cart') }}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#926B4A;font-size:14px">
                                                                                                                                <img src="https://tlr.stripocdn.email/content/guids/CABINET_455a2507bd277c27cf7436f66c6b427c/images/29961620294283034.png" width="20" style="display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;vertical-align:middle">
                                                                                                                            </a>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                                            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" style="padding:0;Margin:0">
                                                                                            <h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#333333">Thank you for your order!</h1>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px">
                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#666666;font-size:14px">Your order is confirmed!&nbsp;Review your order information below.<br>We'll drop you another email when your order ships.</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tbody>
                                    <tr>
                                        <td align="center" style="padding:0;Margin:0">
                                            <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                                            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" style="padding:0;Margin:0">
                                                                                            <h2 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#333333">ORDER # {{ $order->id }}</h2>
                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#666666;font-size:14px">{{ $order->created_at->format('d M, Y') }}</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:20px">
                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#a0937d;font-size:14px">ITEMS ORDERED</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0">
                                                                                            <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td style="padding:0;Margin:0;border-bottom:1px solid #a0937d;background:none;height:1px;width:100%;margin:0px"></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                    @foreach ($order->order_items as $order_item)
                                                    <tr>
                                                        <td class="esdev-adapt-off" align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                                            <table cellpadding="0" cellspacing="0" class="esdev-mso-table" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0;width:125px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center" style="padding:0;Margin:0;font-size:0px">
                                                                                                            <a target="_blank" href="{{ route('product.details', $order_item->orders_product->slug) }}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:14px">
                                                                                                                <img class="adapt-img" src="{{ asset('uploads/product/'.$order_item->orders_product->thumbnail) }}" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="125">
                                                                                                            </a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td style="padding:0;Margin:0;width:20px"></td>
                                                                        <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0;width:125px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="left" class="es-m-p0t es-m-p0b es-m-txt-l" style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px">
                                                                                                            <h3 style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:20px;font-style:normal;font-weight:bold;color:#333333"><strong>{{ $order_item->orders_product->product_name.' ('.productSize($order_item->orders_product->id).')' }}</strong></h3>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td style="padding:0;Margin:0;width:20px"></td>
                                                                        <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0;width:176px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="right" class="es-m-p0t es-m-p0b" style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px">
                                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#666666;font-size:14px">x{{ $order_item->quantity }}</p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td style="padding:0;Margin:0;width:20px"></td>
                                                                        <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                                            <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0;width:74px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="right" class="es-m-p0t es-m-p0b" style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px">
                                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#666666;font-size:14px">${{number_format(($order_item->price / 100), 2) }}</p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
                                                            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0">
                                                                                            <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td style="padding:0;Margin:0;border-bottom:1px solid #a0937d;background:none;height:1px;width:100%;margin:0px">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="esdev-adapt-off" align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
                                                            <table cellpadding="0" cellspacing="0" class="esdev-mso-table" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0;width:466px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="right" style="padding:0;Margin:0">
                                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#666666;font-size:14px">{!! $order->coupon == true ? 'Coupon ( '.$order->coupon_code.' - '.$order->coupon_value.' ) <br>' : '' !!}Subtotal<br>Vat{{ ' ('.($order->order_vat).'%)' }}<br>Shipping<br><b>Total ({{ $order->order_items->count() }} item)</b></p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td style="padding:0;Margin:0;width:20px"></td>
                                                                        <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                                            <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0;width:74px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="right" style="padding:0;Margin:0">
                                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#666666;font-size:14px">{!! $order->coupon == true ? '- $'. number_format(($order->coupon_amount / 100), 2).'<br>' : '' !!}${{ number_format(($order->order_subtotal / 100), 2) }}<br>${{ number_format(($order->vat_value / 100), 2) }}<br>{{ $order->order_shipping <= 0 ? 'Free' : '$'.number_format(($order->order_shipping / 100), 2) }}<br><strong>${{ number_format(($order->order_total / 100), 2) }}</strong></p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                                            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:20px">
                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#a0937d;font-size:14px">PAYMENT INFO</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0">
                                                                                            <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td style="padding:0;Margin:0;border-bottom:1px solid #a0937d;background:none;height:1px;width:100%;margin:0px"></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="esdev-adapt-off" align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
                                                            <table cellpadding="0" cellspacing="0" class="esdev-mso-table" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0;width:466px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="left" style="padding:0;Margin:0">
                                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#666666;font-size:14px">{{ $order->payment_method == 'cod' ? 'COD' : 'Card (Stripe)' }}</p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td style="padding:0;Margin:0;width:20px"></td>
                                                                        <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0">
                                                                            <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0;width:74px">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="right" style="padding:0;Margin:0">
                                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#666666;font-size:14px">${{ number_format(($order->order_total / 100), 2) }}</p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                                            <table cellpadding="0" cellspacing="0" align="left" class="es-left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="es-m-p20b" align="center" valign="top" style="padding:0;Margin:0;width:270px">
                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:20px">
                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#a0937d;font-size:14px">BILLING INFO</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0">
                                                                                            <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td style="padding:0;Margin:0;border-bottom:1px solid #a0937d;background:none;height:1px;width:100%;margin:0px"></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0">
                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#666666;font-size:14px">{{ $order->billing_name }}<br>{{ $order->billing_address }}<br>{{ get_city_name($order->billing_city) }}<br>{{ $order->billing_zipcode }}<br>{{ get_country_name($order->billing_country) }}<br>
                                                                                                <a target="_blank" href="mailto:jayden_miller@email.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:14px">{{ $order->billing_email }}</a>
                                                                                            </p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;width:270px">
                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:20px">
                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#a0937d;font-size:14px">SHIPPING ADDRESS</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px;font-size:0">
                                                                                            <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td style="padding:0;Margin:0;border-bottom:1px solid #a0937d;background:none;height:1px;width:100%;margin:0px"></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" style="padding:0;Margin:0">
                                                                                            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#666666;font-size:14px">
                                                                                                <span>{{ $order->billing_name }}</span><br>{{ $order->billing_address }}<br>{{ get_city_name($order->billing_city) }}<br>{{ $order->billing_zipcode }}<br>{{ get_country_name($order->billing_country) }}<br>{{ $order->billing_phone }}<br>
                                                                                            </p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="padding:20px;Margin:0"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                <tbody>
                                    <tr>
                                        <td align="center" bgcolor="#fef8ed" style="padding:0;Margin:0;background-color:#fef8ed">
                                            <table bgcolor="#fef8ed" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#fef8ed;width:600px">
                                                <tbody>
                                                    <tr>
                                                        <td class="es-m-p10r es-m-p10l" align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:20px;padding-right:20px">
                                                            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style="padding:0;Margin:0">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" class="es-menu" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr class="links-images-left">
                                                                                                        <td align="center" valign="top" width="33.33%" id="esd-menu-id-0" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0">
                                                                                                            <span style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#a0937d;font-size:14px">
                                                                                                                <img src="https://tlr.stripocdn.email/content/guids/CABINET_455a2507bd277c27cf7436f66c6b427c/images/58991620296762845.png" alt="FREE DELIVERY" title="FREE DELIVERY" align="absmiddle" width="25" style="display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;padding-right:15px;vertical-align:middle">FREE DELIVERY
                                                                                                            </span>
                                                                                                        </td>
                                                                                                        <td align="center" valign="top" width="33.33%" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0;border-left:1px solid #a0937d" id="esd-menu-id-1">
                                                                                                            <span style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#a0937d;font-size:14px">
                                                                                                                <img src="https://tlr.stripocdn.email/content/guids/CABINET_455a2507bd277c27cf7436f66c6b427c/images/55781620296763104.png" alt="HIGH QUALITY" title="HIGH QUALITY" align="absmiddle" width="25" style="display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;padding-right:15px;vertical-align:middle">HIGH QUALITY
                                                                                                            </span>
                                                                                                        </td>
                                                                                                        <td align="center" valign="top" width="33.33%" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0;border-left:1px solid #a0937d" id="esd-menu-id-2">
                                                                                                            <span style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#a0937d;font-size:14px">
                                                                                                                <img src="https://tlr.stripocdn.email/content/guids/CABINET_455a2507bd277c27cf7436f66c6b427c/images/88291620296763036.png" alt="BEST CHOICE" title="BEST CHOICE" align="absmiddle" width="25" style="display:inline-block !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;padding-right:15px;vertical-align:middle">BEST CHOICE
                                                                                                            </span>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:#E3CDC1;background-repeat:repeat;background-position:center top">
                                <tbody>
                                    <tr>
                                        <td align="center" bgcolor="#ffffff" style="padding:0;Margin:0;background-color:#ffffff">
                                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px">
                                                            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="left" style="padding:0;Margin:0;width:560px">
                                                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style="padding:0;Margin:0">
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" class="es-menu" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr class="links">
                                                                                                        <td align="center" valign="top" width="25%" id="esd-menu-id-0" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0">
                                                                                                            <a target="_blank" href="{{ url('about') }}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#666666;font-size:14px">About us</a>
                                                                                                        </td>
                                                                                                        <td align="center" valign="top" width="25%" id="esd-menu-id-1" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0">
                                                                                                            <a target="_blank" href="{{ url('faq') }}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#666666;font-size:14px">FAQ</a>
                                                                                                        </td>
                                                                                                        <td align="center" valign="top" width="25%" id="esd-menu-id-2" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0">
                                                                                                            <a target="_blank" href="{{ url('contact') }}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#666666;font-size:14px">Contact</a>
                                                                                                        </td>
                                                                                                        <td align="center" valign="top" width="25%" id="esd-menu-id-2" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0">
                                                                                                            <a target="_blank" href="{{ route('shop') }}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#666666;font-size:14px">Shop</a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;font-size:0">
                                                                                            <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px">
                                                                                                            <a target="_blank" href="https://facebook.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:14px">
                                                                                                                <img title="Facebook" src="https://tlr.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png" alt="Fb" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                                                                                                            </a>
                                                                                                        </td>
                                                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px">
                                                                                                            <a target="_blank" href="https://twitter.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:14px">
                                                                                                                <img title="Twitter" src="https://tlr.stripocdn.email/content/assets/img/social-icons/logo-black/twitter-logo-black.png" alt="Tw" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                                                                                                            </a>
                                                                                                        </td>
                                                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px">
                                                                                                            <a target="_blank" href="https://instagram.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#926B4A;font-size:14px">
                                                                                                                <img title="Instagram" src="https://tlr.stripocdn.email/content/assets/img/social-icons/logo-black/instagram-logo-black.png" alt="Inst" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                                                                                                            </a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>  
</html>