@extends('layouts.dashboard')


@section('content')
    

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Customers</p>
                                    <h4 class="mb-0">{{ $total_customer }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-user font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Products</p>
                                    <h4 class="mb-0">{{ $total_product }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bxl-product-hunt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Orders</p>
                                    <h4 class="mb-0">{{ $count_total_order->orders_count }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Revenue</p>
                                    <h4 class="mb-0">${{ number_format(($count_total_order->revenue/100),2) }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center ">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-archive-in font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body" style="padding:17px">
                            <h4 class="card-title mb-2">Daily</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-muted">Today</p>
                                    <p class="text-muted" style="margin-bottom:10px">Orders:</p>
                                    <h3>{{ $growth_data['today']['orders_count'] }}</h3>
                                    <p class="text-muted" style="margin-bottom:10px">Revenue:</p>
                                    <h3>${{ number_format(($growth_data['today']['revenue']/100),2) }}</h3>
                                    <p class="text-muted">
                                        <span class="text-{{ get_revenue_growth_rate($growth_data['today']['revenue'] ?? 0,$growth_data['yesterday']['revenue'] ?? 0) < 0 ? 'danger' : 'success' }} me-2">
                                             {{ get_revenue_growth_rate($growth_data['today']['revenue'] ?? 0,$growth_data['yesterday']['revenue'] ?? 0) }}% 
                                             <i class="mdi mdi-arrow-{{ get_revenue_growth_rate($growth_data['today']['revenue'] ?? 0,$growth_data['yesterday']['revenue'] ?? 0) < 0 ? 'down' : 'up' }}"></i> 
                                        </span> From previous period
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body" style="padding:17px">
                            <h4 class="card-title mb-2">Weekly</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-muted">This week</p>
                                    <p class="text-muted" style="margin-bottom:10px">Orders:</p>
                                    <h3>{{ $growth_data['current_week']['orders_count'] }}</h3>
                                    <p class="text-muted" style="margin-bottom:10px">Revenue:</p>
                                    <h3>${{ number_format(($growth_data['current_week']['revenue']/100),2) }}</h3>
                                    <p class="text-muted">
                                        <span class="text-{{ get_revenue_growth_rate($growth_data['current_week']['revenue'] ?? 0,$growth_data['last_week']['revenue'] ?? 0) < 0 ? 'danger' : 'success' }} me-2">
                                             {{ get_revenue_growth_rate($growth_data['current_week']['revenue'] ?? 0,$growth_data['last_week']['revenue'] ?? 0) }}% 
                                             <i class="mdi mdi-arrow-{{ get_revenue_growth_rate($growth_data['current_week']['revenue'] ?? 0,$growth_data['last_week']['revenue'] ?? 0) < 0 ? 'down' : 'up' }}"></i> 
                                        </span> From previous period
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body" style="padding:17px">
                            <h4 class="card-title mb-2">Monthly</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-muted">This month</p>
                                    <p class="text-muted" style="margin-bottom:10px">Orders:</p>
                                    <h3>{{ $growth_data['current_month']['orders_count'] }}</h3>
                                    <p class="text-muted" style="margin-bottom:10px">Revenue:</p>
                                    <h3>${{ number_format(($growth_data['current_month']['revenue']/100),2) }}</h3>
                                    <p class="text-muted">
                                        <span class="text-{{ get_revenue_growth_rate($growth_data['current_month']['revenue'] ?? 0,$growth_data['last_month']['revenue'] ?? 0) < 0 ? 'danger' : 'success' }} me-2">
                                             {{ get_revenue_growth_rate($growth_data['current_month']['revenue'] ?? 0,$growth_data['last_month']['revenue'] ?? 0) }}% 
                                             <i class="mdi mdi-arrow-{{ get_revenue_growth_rate($growth_data['current_month']['revenue'] ?? 0,$growth_data['last_month']['revenue'] ?? 0) < 0 ? 'down' : 'up' }}"></i> 
                                        </span> From previous period
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body" style="padding:17px">
                            <h4 class="card-title mb-2">Yearly</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-muted">This year</p>
                                    <p class="text-muted" style="margin-bottom:10px">Orders:</p>
                                    <h3>{{ $growth_data['current_year']['orders_count'] }}</h3>
                                    <p class="text-muted" style="margin-bottom:10px">Revenue:</p>
                                    <h3>${{ number_format(($growth_data['current_year']['revenue']/100),2) }}</h3>
                                    <p class="text-muted">
                                        <span class="text-{{ get_revenue_growth_rate($growth_data['current_year']['revenue'] ?? 0,$growth_data['last_year']['revenue'] ?? 0) < 0 ? 'danger' : 'success' }} me-2">
                                             {{ get_revenue_growth_rate($growth_data['current_year']['revenue'] ?? 0,$growth_data['last_year']['revenue'] ?? 0) }}% 
                                             <i class="mdi mdi-arrow-{{ get_revenue_growth_rate($growth_data['current_year']['revenue'] ?? 0,$growth_data['last_year']['revenue'] ?? 0) < 0 ? 'down' : 'up' }}"></i> 
                                        </span> From previous period
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card chart_card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Overview</h4>
                            <div>
                                <div id="overview-chart" class="apex-charts" dir="ltr" style="position: relative;">
                                    <div class="toolbar d-flex flex-wrap gap-2 justify-content-center">
                                        <button type="button" class="btn btn-light btn-sm" id="one_month">
                                            1M
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm" id="six_months">
                                            6M
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm active" id="one_year">
                                            1Y
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm" id="all">
                                            ALL
                                        </button>
                                    </div>
                                    <div id="overview-chart-timeline" style="min-height: 255px;"></div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 264px; height: 283px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card city_card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Top Cities Selling Product</h4>

                            <div class="text-center">
                                <div class="mb-4">
                                    <i class="bx bx-map-pin text-primary display-4"></i>
                                </div>
                                <h3>{{ $top_cities_by_order[0]['orders_count'] }}</h3>
                                <p>{{ $top_cities_by_order[0]['city_name'] }}</p>
                            </div>

                            <div class="table-responsive mt-4">
                                <table class="table align-middle table-nowrap">
                                    <tbody>
                                        @forelse ($top_cities_by_order as $index => $top_city)
                                            <tr>
                                                <td style="width: 30%">
                                                    <p class="mb-0">{{ $top_city->city_name }}</p>
                                                </td>
                                                <td style="width: 25%">
                                                    <h5 class="mb-0">{{ $top_city->orders_count }}</h5>
                                                </td>
                                                <td>
                                                    <div class="progress bg-transparent progress-sm">
                                                        <div class="progress-bar {{ ($index == 0 ? 'bg-success' : ($index == 1 ? 'bg-primary' : 'bg-warning')) }} rounded" role="progressbar" style="width: {{ ($top_city->orders_count/$count_total_order->orders_count)*100 }}%" aria-valuenow="{{ ($top_city->orders_count/$count_total_order->orders_count)*100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No data available!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Latest Order</h4>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle">Order ID</th>
                                            <th class="align-middle">Billing Name</th>
                                            <th class="align-middle">Date</th>
                                            <th class="align-middle">Total</th>
                                            <th class="align-middle">Payment Status</th>
                                            <th class="align-middle">Payment Method</th>
                                            <th class="align-middle">Order Status</th>
                                            @if(auth()->user()->hasPermissionTo('view-order') || auth()->user()->isSuperAdmin())
                                                <th class="align-middle">View Details</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($latest_orders as $order)
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#{{ $order->id }}</a> </td>
                                            <td>{{ $order->billing_name }}</td>
                                            <td>
                                                {{ $order->created_at->format('d M, Y') }}
                                            </td>
                                            <td>${{ number_format(($order->order_total/100),2) }}</td>
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
                                                <span class="badge badge-pill {{ $status_class }} font-size-12 text-capitalize">
                                                    {{ $order->order_status }}
                                                </span>
                                            </td>
                                            @can('view', $order)
                                                <td>
                                                    <button type="button" class="latest_order_detail_btn btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-id="{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#latestOrderDetailModal">
                                                        View Details
                                                    </button>
                                                </td>
                                            @endcan
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6"  class="text-center">
                                                    No data available!
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>



    @if (auth()->user()->hasPermissionTo('view-order') || auth()->user()->isSuperAdmin())
        <!-- view order detail modal-->
        <div class="modal fade" id="latestOrderDetailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="latestOrderDetailModalLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="latestOrderDetailModalLabel">Order Details</h3>
                        <button type="button" class="btn-close close_order_item_view" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('admin.order.order_details')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close_order_item_view" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection



@section('footer_script')
    

    <script>
        
        $(document).ready(function(){

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).on('click','.latest_order_detail_btn', function(e){

                e.preventDefault();

                let order_id = $(this).data('id');
                let url = "{{ route('order.show',':order') }}";
                    url = url.replace(':order',order_id);

                $.ajax({
                    type:'GET',
                    url:url,
                    success:function(data){
                        $('#latestOrderDetailModal').find('.modal-body').html(data);
                        $('#latestOrderDetailModal').modal('show');
                    },
                    error:function(){
                        if(confirm('Something went wrong! Try reloading the page.')){
                            window.location.reload();
                        }
                    }
                });

            });


            $('#latestOrderDetailModal').on('hide.bs.modal', function () {
                $('#latestOrderDetailModal').find('.modal-body').html('');
            });


            (function(){
                options = {
                        series: [
                            {
                                name: "Order",
                                data: [
                                    @foreach ($chart_data as $d)
                                        [ {{ \Carbon\Carbon::parse($d['date'])->timestamp*1000 }} , {{ $d['order'] }} , {{ number_format(($d['revenue']/100),2) }} ],
                                    @endforeach
                                ],
                            },
                        ],
                        chart: { type: "area", height: 240, toolbar: "false" },
                        dataLabels: { enabled: !1 },
                        stroke: { curve: "smooth", width: 2 },
                        markers: { size: 0, style: "hollow" },
                        // xaxis: { type: "datetime", min: new Date("{{ now()->subMonths()->format('Y M d') }}").getTime(), tickAmount: 6 },
                        xaxis: { 
                            type: "datetime", 
                            min: {{ \Carbon\Carbon::parse(now()->subMonths())->timestamp*1000 }} ,
                            tickAmount: 6 
                        },
                        yaxis: { 
                            title:{ text:'Orders'},
                        },
                        tooltip: { 
                            theme: "dark",
                            x: { format: "dd MMM yyyy" },
                            z: {title: "Revenue: $"}, 
                        },
                        colors: ["#556ee6"],
                        fill: { type: "gradient", gradient: { shadeIntensity: 1, opacityFrom: 0.6, opacityTo: 0.05, stops: [42, 100, 100, 100] } },
                    };
                (chart = new ApexCharts(document.querySelector("#overview-chart-timeline"), options)).render();

                var resetCssClasses = function (e) {
                    var t = document.querySelectorAll("button");
                    Array.prototype.forEach.call(t, function (e) {
                        e.classList.remove("active");
                    }),
                        e.target.classList.add("active");
                };
                document.querySelector("#one_month").addEventListener("click", function (e) {
                    resetCssClasses(e), 
                    chart.updateOptions({
                        xaxis: {
                            min: {{ \Carbon\Carbon::parse(now()->subMonths())->timestamp*1000 }}, 
                            // max: new Date("{{ now()->format('Y M d') }}").getTime() 
                        } 
                    });
                }),
                document.querySelector("#six_months").addEventListener("click", function (e) {
                    resetCssClasses(e), 
                    chart.updateOptions({
                         xaxis: {
                            min: {{ \Carbon\Carbon::parse(now()->subMonths(6))->timestamp*1000 }}, 
                            // max: new Date("{{ now()->format('Y M d') }}").getTime() 
                        } 
                    });
                }),
                document.querySelector("#one_year").addEventListener("click", function (e) {
                    resetCssClasses(e), 
                    chart.updateOptions({
                         xaxis: {
                            min: {{ \Carbon\Carbon::parse(now()->subYears())->timestamp*1000 }}, 
                            // max: new Date("{{ now()->format('Y M d') }}").getTime() 
                        } 
                    });
                }),
                document.querySelector("#all").addEventListener("click", function (e) {
                    resetCssClasses(e), 
                    chart.updateOptions({
                        xaxis: {
                            min: void 0,
                            max: void 0 
                        } 
                    });
                });
            })();


            (function(){
                let chartElem = document.querySelector(".chart_card");
                let cityElem = document.querySelector(".city_card");

                let chartHeight = chartElem.offsetHeight;
                let cityHeight = cityElem.offsetHeight;

                if(chartHeight > cityHeight){
                     cityElem.style.height = chartHeight+"px";
                }
                else{ 
                    chartElem.style.height = cityHeight+"px";
                }
            })();

        });

    </script>


@endsection