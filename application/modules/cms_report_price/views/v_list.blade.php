@extends('app')
@section('body')
    <div id="page_content" ng-controller="listController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_content_inner" style="display: none;">
            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-1">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text"> Actions </h3>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-grid" data-uk-grid-margin="">
                                <div id="options-content" class="uk-width-medium-1-6">
                                    <select id="vendor" class="md-input" name="transaction_vendor">
                                        <option disabled="" selected="" value="">Vendor</option>
                                        @foreach( $vendors as $item )
                                            <option value="{{$item['vendor_slug']}}">{{$item['vendor_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="uk-form-help-block">Vendor</span>
                                </div>
                                <div class="uk-width-medium-1-10">
                                    <select id="gate" class="md-input">
                                        <option disabled="" selected="" value="">Gate</option>
                                        @foreach( $gate as $item )
                                            <option value="{{$item['gate_name']}}">{{$item['gate_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="uk-form-help-block">Gate</span>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="from" value="{{date('Y-m-d')}}" type="text" required/>
                                        <span class="md-input-bar"></span>
                                    </div>
                                    <span class="uk-form-help-block">Date (From)</span>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="to" value="{{date('Y-m-d', strtotime('+7 day'))}}" type="text" required/>
                                        <span class="md-input-bar"></span>
                                    </div>
                                    <span class="uk-form-help-block">Date (To)</span>
                                </div>
                                <div id="options-content-filter" class="uk-width-medium-1-2">
                                    <button ng-click="readData()" class="md-btn md-btn-primary">Filter</button>
                                    <a href="{{ base_url("cms/$module") }}" class="md-btn">Reset</a>
                                    <button ng-click="exportData()" class="md-btn">Export</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div ng-click="hideAlert()" ng-class="alertClass" ng-show="alertBox" class="uk-alert" data-uk-alert>
                <div ng-bind-html="alertMessage"></div>
            </div>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text"> Price (Day)</h3>
                </div>
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap table_check uk-table-striped" style="margin-bottom: 68px;">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Price Day</th>
                                <th>Vendor</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="(i,t) in data_day">
                                <td>@{{i+1}}</td>
                                <td>@{{t.product_title}}</td>
                                <td>@{{t.price | number}}</td>
                                <td>@{{t.price_day}}</td>
                                <td>@{{t.vendor_name}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text"> Price (Date)</h3>
                </div>
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap table_check uk-table-striped" style="margin-bottom: 68px;">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Price Date</th>
                                <th>Vendor</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="(i,t) in data">
                                <td>@{{i+1}}</td>
                                <td>@{{t.product_title}}</td>
                                <td>@{{t.price | number}}</td>
                                <td>@{{t.price_date | moment: 'format': 'LL'}}</td>
                                <td>@{{t.vendor_name}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

        $("#from").kendoDatePicker({
            format: "yyyy-MM-dd"
        });

        $("#to").kendoDatePicker({
            format: "yyyy-MM-dd"
        });

        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        var app = angular.module( '{{ $module }}', ['ngSanitize']);
        app.controller('listController',function($scope, $http)
        {
            $scope.spinner      = true;
            $scope.perPage      = 20;
            $scope.totalRows    = 0;
            $scope.pageStart    = 1;
            $scope.pageEnd      = 0;
            $scope.data         = [];
            $scope.data_day     = [];
            $scope.columns      = [];
            $scope.maxPage      = 0;
            $scope.is_search    = false;
            $scope.selected     = [];
            $scope.alertBox     = false;
            $scope.filter       = {};

            $scope.readData = function() {
                $scope.spinner = false;
                $scope.filter.from   = $("#from").val();
                $scope.filter.to     = $("#to").val();
                $scope.filter.vendor = $("#vendor").val();
                $scope.filter.gate   = $("#gate").val();
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/get?"+params
                }).then(function successCallback(response) {
                    $scope.data = response.data;
                    $scope.readDataDay();
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            $scope.readDataDay = function() {
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/get_day?"+params
                }).then(function successCallback(response) {
                    $scope.data_day = response.data;
                    $scope.spinner = true;
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            $scope.exportData = function()
            {
                $scope.filter.from   = $("#from").val();
                $scope.filter.to     = $("#to").val();
                $scope.filter.vendor = $("#vendor").val();
                $scope.filter.gate   = $("#gate").val();
                var params = $.param( $scope.filter );
                window.location.href = cms_url+"/export?"+params;
            };

            function showAlert(val) {
                UIkit.modal.alert( val );
            }

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.readData();
            showBox();
        });
    </script>
@endsection
