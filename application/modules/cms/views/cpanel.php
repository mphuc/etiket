    <!-- additional styles for plugins -->
    <!-- weather icons -->
    <link rel="stylesheet" href="<?php echo assets_back()?>bower_components/weather-icons/css/weather-icons.min.css" media="all">
    <script src="<?php echo assets_back()?>highcharts/highcharts.js"></script>
    <script src="<?php echo assets_back()?>highcharts/highcharts-3d.js"></script>
    <script src="<?php echo assets_back()?>highcharts/modules/exporting.js"></script>
    <script src="<?php echo assets_back()?>highcharts/modules/export-data.js"></script>
    <div id="page_content">
        <div id="page_content_inner">
            <h3 class="heading_b uk-margin-bottom">{_nav_menu_dashboard}</h3>
            <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_visitors peity_data">5,3,9,6,5,9,7</span></div>
                            <span class="uk-text-muted uk-text-small"><?php echo $label;?> Transactions Today</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">{total_transaction}</span></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span></div>
                            <span class="uk-text-muted uk-text-small"><?php echo $label;?> Tickets Today</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">{total_ticket}</span></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">64/100</span></div>
                            <span class="uk-text-muted uk-text-small">Product</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">{total_product}</span></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_live peity_data">5,3,9,6,5,9,7,3,5,2,5,3,9,6,5,9,7,3,5,2</span></div>
                            <span class="uk-text-muted uk-text-small">Member</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe">{totaluser}</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($is_admin):?>
            <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1">
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div id="container-transaction-daily" style="width: 100%"></div>
                        </div>
                    </div>
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
                <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1">
                    <div>
                        <div class="md-card">
                            <div class="md-card-content">
                                <div id="container-best-seller" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1">
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div id="container-city" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1">
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div id="container-gender" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1">
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div id="container-age" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>

    <script type="text/javascript">
        $.getJSON( '<?php echo base_url("api/chart/transaction_daily")?>', function (data) {
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

        $.getJSON( '<?php echo base_url("api/chart/transaction_monthly")?>', function (data) {
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

        $.getJSON( '<?php echo base_url("api/chart/user_city")?>', function( data ) {
            Highcharts.chart('container-city', {
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
                    text: 'Visitor By City'
                },
                subtitle: {
                    text: 'All Time'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total'
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Total Visitor: <b>{point.y:.0f} users</b>'
                },
                series: [{
                    name: 'Population',
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

        $.getJSON( '<?php echo base_url("api/chart/best_seller")?>', function (data) {
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
                    pointFormat: '{series.name}: {point.y:.0f} <b>({point.percentage:.1f} %)</b>'
                },
                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45
                    }
                },
                series: [{
                    name: 'Sales',
                    data: data
                }]
            });
        });

        $.getJSON( '<?php echo base_url("api/chart/user_gender")?>', function (data) {
            Highcharts.chart('container-gender', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45
                    }
                },
                title: {
                    text: 'User by Gender'
                },
                subtitle: {
                    text: 'All Time'
                },
                tooltip: {
                    headerFormat: '{point.key}<br/>',
                    pointFormat: '{series.name}: {point.y:.0f} <b>({point.percentage:.1f} %)</b>'
                },
                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45
                    }
                },
                series: [{
                    name: 'Total',
                    data: data
                }]
            });
        });

        $.getJSON( '<?php echo base_url("api/chart/user_age")?>', function (data) {
            Highcharts.chart('container-age', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45
                    }
                },
                title: {
                    text: 'User by Age'
                },
                subtitle: {
                    text: 'All Time'
                },
                tooltip: {
                    headerFormat: '{point.key} Years Old<br/>',
                    pointFormat: '{series.name}: {point.y:.0f} <b>({point.percentage:.1f} %)</b>'
                },
                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45
                    }
                },
                series: [{
                    name: 'Total',
                    data: data
                }]
            });
        });

    </script>
  