<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <style>
        body{
            margin-top:20px;
            color: #000;
        }
        .text-secondary-d1 {
            color: #728299!important;
        }
        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }
        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
        }
        .brc-default-l1 {
            border-color: #dce9f0!important;
        }

        .ml-n1, .mx-n1 {
            margin-left: -.25rem!important;
        }
        .mr-n1, .mx-n1 {
            margin-right: -.25rem!important;
        }
        .mb-4, .my-4 {
            margin-bottom: 1.5rem!important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0,0,0,.1);
        }

        .text-grey-m2 {
            color: #888a8d!important;
        }

        .text-success-m2 {
            color: #86bd68!important;
        }

        .font-bolder, .text-600 {
            font-weight: 600!important;
        }

        .text-110 {
            font-size: 110%!important;
        }
        .text-blue {
            color: #478fcc!important;
        }
        .pb-25, .py-25 {
            padding-bottom: .75rem!important;
        }

        .pt-25, .py-25 {
            padding-top: .75rem!important;
        }
        .bgc-default-tp1 {
            background-color: #80B500 !important;
        }
        .bgc-default-l4, .bgc-h-default-l4:hover {
            background-color: #f3f8fa!important;
        }
        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }
        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120%!important;
        }
        .text-primary-m1 {
            color: #4087d4!important;
        }

        .text-danger-m1 {
            color: #dd4949!important;
        }
        .text-blue-m2 {
            color: #68a3d5!important;
        }
        .text-150 {
            font-size: 150%!important;
        }
        .text-60 {
            font-size: 60%!important;
        }
        .text-grey-m1 {
            color: #7b7d81!important;
        }
        .align-bottom {
            vertical-align: bottom!important;
        }
        img{
            vertical-align: middle;
        }

        .order_item_table tr th,
        .order_item_table tr td{
            padding:10px;
            vertical-align: middle;
        }

        .customer_signature{
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <div id="invoice_wrapper">
        <div class="container-fluid">
            <div class="flex-container page_header clearfix">
                <div class="float-start flex-item-6 d-inline-block">
                    <div class="text-150">
                        <img src="{{ public_path('frontend_assets/img/logo.png') }}" alt="Logo">
                    </div>
                </div>
                {{-- <div class="float-end flex-item-6 d-inline-block">
                    <h1 class="page-title text-secondary-d1">
                        Order <small class="page-info">Id: #111-222</small>
                    </h1>
                </div> --}}
            </div>

            <div class="flex-container my-5 clearfix">
                <div class="flex-item-6 float-start d-inline-block">
                    <div>
                        <span class="text-sm text-grey-m2 align-middle text-120">To:</span>
                        <span class="text-600 text-110 align-middle" style="color:#86bd68">{{ $order->billing_name }}</span>
                    </div>
                    <div class="text-grey-m2">
                        <div class="my-1">
                            {{ $order->billing_email }}
                        </div>
                        <div class="my-1">
                           {{ $order->billing_address }}
                        </div>
                        <div class="my-1">
                            {{ get_city_name($order->billing_city).', '.get_country_name($order->billing_country) }}
                        </div>
                        <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{ $order->billing_phone }}</b></div>
                    </div>
                </div>
                <!-- /.col -->

                <div class="text-95 flex-item-6 float-end d-inline-block">
                    <div class="text-grey-m2">
                        <div class="mt-1 mb-2 text-secondary-m1 text-600 text-120">
                            Invoice
                        </div>
                        
                        <div class="my-2">
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Order Id:</span> #{{ $order->id }}
                        </div>
                        
                        <div class="my-2">
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{ $order->created_at->format('M d, Y') }}
                        </div>

                        <div class="my-2">
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Payment Method:</span> <span class="text-capitalize">{{ $order->payment_method }}</span>
                        </div>

                        <div class="my-2">
                            <i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Payment Status:</span> <span class="text-white {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-danger' }}" style="border-radius: 5px;padding:2px 4px;font-size:14px;font-weight:500;">{{ $order->payment_status }}</span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>

            <div class="flex-container mt-4">
                <div class="col-12 col-lg-12">
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <div class="row d-flex">
                    </div>
                    <!-- or use a table instead -->
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1 order_item_table">
                            <thead class="bg-none bgc-default-tp1">
                                <tr class="text-white">
                                    <th class="opacity-2">#</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th width="140">Total</th>
                                </tr>
                            </thead>
                            <tbody class="text-95 text-secondary-d3">
                                @foreach ($order->order_items as $order_item)
                                <tr style="border-bottom:1px solid #f2f2f2">
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>
                                        <img width="50" src="{{ public_path('uploads/product/'.$order_item->orders_product->thumbnail) }}" alt="">
                                    </td>
                                    <td>
                                        <span>{{ $order_item->orders_product->product_name.' ('.productSize($order_item->orders_product->id).')' }}</span>
                                    </td>
                                    <td>{{ $order_item->quantity }}</td>
                                    <td class="text-95">${{ number_format(($order_item->price / 100),2) }}</td>
                                    <td class="text-secondary-d2">${{ number_format((($order_item->price / 100) * $order_item->quantity), 2) }}</td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr />
                    <div class="mt-3 clearfix">
                        <div class="col-sm-7 text-grey-d2 text-95mt-lg-0 float-start d-inline-block">
                            Extra note such as company or payment information...
                            <p>
                                <span style="font-weight: 600;font-size:16px;">Note: </span>
                                {{ $order->order_note }}
                            </p>
                        </div>

                        <div class="col-sm-5 text-grey text-90 order-first order-sm-last float-end d-inline-block">
                            <table class="table">
                                <tbody class="text-95 text-secondary-d3">
                                    @if ($order->coupon)    
                                        <tr>
                                            <td class="text-end">Coupon{{ ' ( '.$order->coupon_code.' - '.$order->coupon_value.' )' }}:</td>
                                            <td class="text-end">
                                                <span class="text-120 text-secondary-d1">- ${{ number_format(($order->coupon_amount / 100), 2) }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="text-end">SubTotal:</td>
                                        <td class="text-end">
                                            <span class="text-110 text-secondary-d1">${{ number_format(($order->order_subtotal / 100),2) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">Shipping:</td>
                                        <td class="text-end">
                                            <span class="text-110 text-secondary-d1">
                                                @if ($order->order_shipping <= 0)
                                                    Free
                                                @else
                                                    ${{ number_format(($order->order_shipping / 100), 2) }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">Vat {{ ' ('.($order->order_vat).'%)' }}:</td>
                                        <td class="text-end">
                                            <span class="text-110 text-secondary-d1">${{ number_format(($order->vat_value / 100), 2) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">Total Amount:</td>
                                        <td class="text-end">
                                            <span class="text-120 text-success-d3 opacity-2">${{ number_format(($order->order_total / 100),2) }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr />
                    <div class="clearfix">
                        <span class="text-secondary-d1 text-105 d-inline-block float-start">Thank you for shopping with us.</span>
                        <span class="customer_signature d-inline-block float-end">Signature</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>