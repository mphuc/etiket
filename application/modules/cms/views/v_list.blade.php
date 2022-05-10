@extends('app')
@section('body')
    <!-- additional styles for plugins -->
    <!-- weather icons -->
    <link rel="stylesheet" href="{{ assets_back() }}bower_components/weather-icons/css/weather-icons.min.css" media="all">
    <script src="{{assets_back()}}highcharts/highcharts.js"></script>
    <script src="{{assets_back()}}highcharts/highcharts-3d.js"></script>
    <script src="{{assets_back()}}highcharts/modules/exporting.js"></script>
    <script src="{{assets_back()}}highcharts/modules/export-data.js"></script>

    <div id="page_content">
        <div id="page_content_inner">
            <h3 class="heading_b uk-margin-bottom">Dashboard</h3>
            <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_visitors peity_data">5,3,9,6,5,9,7</span></div>
                            <span class="uk-text-muted uk-text-small">{{$label}} Transactions Today</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">{{$total_transaction}}</span></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span></div>
                            <span class="uk-text-muted uk-text-small">{{$label}} Tickets Today</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">{{$total_ticket}}</span></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">64/100</span></div>
                            <span class="uk-text-muted uk-text-small">Product</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">{{$total_product}}</span></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_live peity_data">5,3,9,6,5,9,7,3,5,2,5,3,9,6,5,9,7,3,5,2</span></div>
                            <span class="uk-text-muted uk-text-small">Member</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">{{$totaluser}}</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            @if( $chart_daily_sales )
                <div class="md-card">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text"> Filter Daily Sales </h3>
                    </div>
                    <div class="md-card-content">
                        <form action="" method="get">
                            <div class="uk-grid" data-uk-grid-margin="">
                                <div class="uk-width-medium-1-5">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="filter-from" name="from" value="@if( $filter_from ){{$filter_from}}@endif" type="text" required/>
                                        <span class="md-input-bar "></span>
                                    </div>
                                    <span class="uk-form-help-block">Date From</span>
                                </div>

                                <div class="uk-width-medium-1-5">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="filter-to" name="to" value="@if( $filter_to ){{$filter_to}}@endif" type="text" required/>
                                        <span class="md-input-bar "></span>
                                    </div>
                                    <span class="uk-form-help-block">Date To</span>
                                </div>

                                <div class="uk-width-medium-1-4 width-100 text-right">
                                <span class="uk-input-group-addon width-0">
                                <input type="submit" class="md-btn" value="Filter">
                                </span>
                                    <span class="uk-input-group-addon  width-0">
                                        <a href="{{base_url('cms')}}" class="md-btn">Reset</a>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1">
                    <div>
                        <div class="md-card">
                            <div class="md-card-content">
                                <div id="container-transaction-daily" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if( $chart_monthly_sales )
                <div class="md-card">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text"> Filter Monthly Sales </h3>
                    </div>
                    <div class="md-card-content">
                        <form action="" method="get">
                            <div class="uk-grid" data-uk-grid-margin="">
                                <div class="uk-width-medium-1-5">
                                    <div class="md-input-wrapper md-input-filled">
                                        <select id="filter_year" name="filter_year" class="md-input" data-md-selectize>
                                            @for($year=date('Y');$year>=2015;$year--)
                                                <option value="{{$year}}"
                                                        @if($filter_year == $year )
                                                        selected
                                                        @elseif( $year == date('Y') )
                                                        selected
                                                        @endif
                                                > {{$year}}</option>
                                            @endfor
                                        </select>
                                        <span class="md-input-bar "></span>
                                    </div>
                                    <span class="uk-form-help-block">Year</span>
                                </div>

                                <div class="uk-width-medium-1-4 width-100 text-right">
                                <span class="uk-input-group-addon width-0">
                                <input type="submit" class="md-btn" value="Filter">
                                </span>
                                    <span class="uk-input-group-addon  width-0">
                                        <a href="{{base_url('cms')}}" class="md-btn">Reset</a>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1">
                    <div>
                        <div class="md-card">
                            <div class="md-card-content">
                                <div id="container-transaction-monthly" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if( $chart_best_seller )
                <div class="md-card">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text"> Filter Best Seller </h3>
                    </div>
                    <div class="md-card-content">
                        <form action="" method="get">
                            <div class="uk-grid" data-uk-grid-margin="">
                                <div class="uk-width-medium-1-5">
                                    <div class="md-input-wrapper md-input-filled">
                                        <select class="multi-s" id="wahana-multiple" name="filter_wahana[]" multiple>
                                            @foreach( $all_wahana as $item )
                                                <option value="{{$item['product_id']}}" @if( in_array($item['product_id'], $filter_wahana) ) selected @endif>{{$item['product_title']}}</option>
                                            @endforeach
                                        </select>
                                        <span class="md-input-bar "></span>
                                    </div>
                                    <span class="uk-form-help-block">Pilih Wahana</span>
                                </div>
                                <div class="uk-width-medium-1-4 width-100 text-right">
                                <span class="uk-input-group-addon width-0">
                                <input type="submit" class="md-btn" value="Filter">
                                </span>
                                    <span class="uk-input-group-addon  width-0">
                                        <a href="{{base_url('cms')}}" class="md-btn">Reset</a>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1">
                    <div>
                        <div class="md-card">
                            <div class="md-card-content">
                                <div id="container-best-seller" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @endsection
    @section('script')
    <script type="text/javascript">

        $("#filter-from").kendoDatePicker({
            format: "yyyy-MM-dd",
            max: new Date()
        });
        $("#filter-to").kendoDatePicker({
            format: "yyyy-MM-dd",
            max: new Date()
        });
        @if($chart_daily_sales)
        $.getJSON( '{!! base_url("api/chart/transaction_daily?from=$filter_from&to=$filter_to") !!}', function (data) {
            Highcharts.chart('container-transaction-daily', {
                chart: {
                    zoomType: 'x'
                },
                title: {
                    text: 'Daily Sales'
                },
                subtitle: {
                    text: 'This Month'
                },
                xAxis: {
                    categories: data.categories
                },
                yAxis: {
                    title: {
                        text: 'Total (Rp)'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        marker: {
                            radius: 2
                        },
                        lineWidth: 1,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        threshold: null
                    }
                },

                series: [{
                    type: 'area',
                    name: 'Transaction',
                    data: data.data
                }]
            });
        });
        @endif
        @if($chart_monthly_sales)
        $.getJSON( '{!! base_url("api/chart/transaction_monthly?year=$filter_year") !!}', function (data) {
            Highcharts.chart('container-transaction-monthly', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 10,
                        beta: 25,
                        depth: 70
                    }
                },
                title: {
                    text: 'Monthly Sales'
                },
                subtitle: {
                    text: 'This Year'
                },
                plotOptions: {
                    column: {
                        depth: 25
                    }
                },
                xAxis: {
                    categories: Highcharts.getOptions().lang.shortMonths,
                    labels: {
                        skew3d: true,
                        style: {
                            fontSize: '16px'
                        }
                    }
                },
                yAxis: {
                    title: {
                        text: null
                    }
                },
                series: [{
                    name: 'Sales',
                    data: data,
                    dataLabels: {
                        /*enabled: true,*/
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.0f}',
                        y: 10,
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
            });
        });
        @endif
        @if($chart_best_seller)
        $.getJSON( '{!! base_url("api/chart/best_seller?wahana=").implode('-',$filter_wahana) !!}', function (data) {
            Highcharts.chart('container-best-seller', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45
                    }
                },
                title: {
                    text: 'Best Seller'
                },
                subtitle: {
                    text: 'All Time'
                },
                tooltip: {
                    headerFormat: '{point.key}<br/>',
                    pointFormat: '<b>{series.name}: {point.y:,.0f} ({point.percentage:.1f} %)</b>'
                },
                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45
                    }
                },
                series: [{
                    name: 'Sales (Rp)',
                    data: data
                }]
            });
        });
        @endif

        var app = angular.module( '{{$module}}');
    </script>
    @endsection