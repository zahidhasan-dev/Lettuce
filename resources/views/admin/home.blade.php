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
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Top Selling product</h4>

                            <div class="table-responsive mt-4">
                                <table class="table align-middle mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h5 class="font-size-14 mb-1">Product A</h5>
                                                <p class="text-muted mb-0">Neque quis est</p>
                                            </td>

                                            <td style="position: relative;">
                                                <div id="radialchart-1" class="apex-charts" style="min-height: 61px;"><div id="apexchartsp6e7unjc" class="apexcharts-canvas apexchartsp6e7unjc apexcharts-theme-light" style="width: 60px; height: 61px;"><svg id="SvgjsSvg2424" width="60" height="61" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG2426" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs2425"><clipPath id="gridRectMaskp6e7unjc"><rect id="SvgjsRect2428" width="66" height="62" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskp6e7unjc"><rect id="SvgjsRect2429" width="64" height="64" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG2430" class="apexcharts-radialbar"><g id="SvgjsG2431"><g id="SvgjsG2432" class="apexcharts-tracks"><g id="SvgjsG2433" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 1 1 29.99642420350187 9.512195433998325" fill="none" fill-opacity="1" stroke="rgba(242,242,242,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="5.678048780487805" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 1 1 29.99642420350187 9.512195433998325"></path></g></g><g id="SvgjsG2435"><g id="SvgjsG2437" class="apexcharts-series apexcharts-radial-series" seriesName="seriesx1" rel="1" data:realIndex="0"><path id="SvgjsPath2438" d="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 0 1 44.98383193561228 43.972649328109725" fill="none" fill-opacity="0.85" stroke="rgba(85,110,230,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="5.853658536585366" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="133" data:value="37" index="0" j="0" data:pathOrig="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 0 1 44.98383193561228 43.972649328109725"></path></g><circle id="SvgjsCircle2436" r="17.64878048780488" cx="30" cy="30" class="apexcharts-radialbar-hollow" fill="transparent"></circle></g></g></g><line id="SvgjsLine2439" x1="0" y1="0" x2="60" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2440" x1="0" y1="0" x2="60" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG2427" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
                                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 87px; height: 86px;"></div></div><div class="contract-trigger"></div></div></td>
                                            <td>
                                                <p class="text-muted mb-1">Sales</p>
                                                <h5 class="mb-0">37 %</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="font-size-14 mb-1">Product B</h5>
                                                <p class="text-muted mb-0">Quis autem iure</p>
                                            </td>

                                            <td style="position: relative;">
                                                <div id="radialchart-2" class="apex-charts" style="min-height: 61px;"><div id="apexchartspvpa8bc7" class="apexcharts-canvas apexchartspvpa8bc7 apexcharts-theme-light" style="width: 60px; height: 61px;"><svg id="SvgjsSvg2441" width="60" height="61" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG2443" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs2442"><clipPath id="gridRectMaskpvpa8bc7"><rect id="SvgjsRect2445" width="66" height="62" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskpvpa8bc7"><rect id="SvgjsRect2446" width="64" height="64" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG2447" class="apexcharts-radialbar"><g id="SvgjsG2448"><g id="SvgjsG2449" class="apexcharts-tracks"><g id="SvgjsG2450" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 1 1 29.99642420350187 9.512195433998325" fill="none" fill-opacity="1" stroke="rgba(242,242,242,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="5.678048780487805" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 1 1 29.99642420350187 9.512195433998325"></path></g></g><g id="SvgjsG2452"><g id="SvgjsG2454" class="apexcharts-series apexcharts-radial-series" seriesName="seriesx1" rel="1" data:realIndex="0"><path id="SvgjsPath2455" d="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 1 1 9.888613802535662 33.90925746625116" fill="none" fill-opacity="0.85" stroke="rgba(52,195,143,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="5.853658536585366" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="259" data:value="72" index="0" j="0" data:pathOrig="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 1 1 9.888613802535662 33.90925746625116"></path></g><circle id="SvgjsCircle2453" r="17.64878048780488" cx="30" cy="30" class="apexcharts-radialbar-hollow" fill="transparent"></circle></g></g></g><line id="SvgjsLine2456" x1="0" y1="0" x2="60" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2457" x1="0" y1="0" x2="60" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG2444" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
                                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 87px; height: 86px;"></div></div><div class="contract-trigger"></div></div></td>
                                            <td>
                                                <p class="text-muted mb-1">Sales</p>
                                                <h5 class="mb-0">72 %</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="font-size-14 mb-1">Product C</h5>
                                                <p class="text-muted mb-0">Sed aliquam mauris.</p>
                                            </td>

                                            <td style="position: relative;">
                                                <div id="radialchart-3" class="apex-charts" style="min-height: 61px;"><div id="apexchartsmdznhq26" class="apexcharts-canvas apexchartsmdznhq26 apexcharts-theme-light" style="width: 60px; height: 61px;"><svg id="SvgjsSvg2458" width="60" height="61" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG2460" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs2459"><clipPath id="gridRectMaskmdznhq26"><rect id="SvgjsRect2462" width="66" height="62" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskmdznhq26"><rect id="SvgjsRect2463" width="64" height="64" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG2464" class="apexcharts-radialbar"><g id="SvgjsG2465"><g id="SvgjsG2466" class="apexcharts-tracks"><g id="SvgjsG2467" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 1 1 29.99642420350187 9.512195433998325" fill="none" fill-opacity="1" stroke="rgba(242,242,242,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="5.678048780487805" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 1 1 29.99642420350187 9.512195433998325"></path></g></g><g id="SvgjsG2469"><g id="SvgjsG2471" class="apexcharts-series apexcharts-radial-series" seriesName="seriesx1" rel="1" data:realIndex="0"><path id="SvgjsPath2472" d="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 1 1 25.043551407226317 49.87922951394725" fill="none" fill-opacity="0.85" stroke="rgba(244,106,106,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="5.853658536585366" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="194" data:value="54" index="0" j="0" data:pathOrig="M 30 9.512195121951216 A 20.487804878048784 20.487804878048784 0 1 1 25.043551407226317 49.87922951394725"></path></g><circle id="SvgjsCircle2470" r="17.64878048780488" cx="30" cy="30" class="apexcharts-radialbar-hollow" fill="transparent"></circle></g></g></g><line id="SvgjsLine2473" x1="0" y1="0" x2="60" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2474" x1="0" y1="0" x2="60" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG2461" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
                                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 87px; height: 86px;"></div></div><div class="contract-trigger"></div></div></td>
                                            <td>
                                                <p class="text-muted mb-1">Sales</p>
                                                <h5 class="mb-0">54 %</h5>
                                            </td>
                                        </tr>
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