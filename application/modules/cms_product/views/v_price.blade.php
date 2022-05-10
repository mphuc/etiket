@extends('app')
@section('body')
    <div id="page_content" ng-controller="promoController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_heading">
            <h1>Promo <a href="cms/{{ $module }}" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
            </h1> <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">{{$row['product_title']}}</span>
        </div>
        <div id="page_content_inner" style="display: none;">
                <div class="uk-grid uk-grid-medium ">
                    <div class="uk-width-xLarge-8-10 uk-width-large-7-10">
                        <div ng-click="hideAlert()" ng-class="alertClass" ng-show="alertBox" class="uk-alert" data-uk-alert>
                            <div ng-bind-html="alertMessage"></div>
                        </div>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Select Vendor</h3>
                            </div>
                            <form id="form-vendor" method="get">
                            <div class="md-card-content">
                                <div class="uk-grid" data-uk-grid-margin="">
                                    @foreach($vendors as $k => $v)
                                        <div id="options-content" class="uk-width-medium-1-5">
                                            <a href="{{base_url("cms/$module/price?product_id=".$product_id."&vendor=".$v['vendor_slug'])}}" class="md-btn @if($vendor['vendor_slug']==$v['vendor_slug']) md-btn-success @endif"> {{$v['vendor_name']}}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Default Price ({{$row['product_title']}}) - <span class="uk-text-bold uk-text-danger">{{$vendor['vendor_name']}}</span></h3>
                            </div>
                            <div class="md-card-content">
                                <h1>Rp {{my_number($row['product_price'])}}</h1>
                            </div>
                        </div>
                        <div class="md-card uk-margin-medium-bottom">
                            <div class="md-card-toolbar"> <h3 class="md-card-toolbar-heading-text"> List data Price ({{$row['product_title']}}) - <span class="uk-text-bold uk-text-danger">{{$vendor['vendor_name']}}</span></h3> </div>
                            <div class="md-card-content">
                                <div class="uk-overflow-container">
                                    <table class="uk-table uk-table-nowrap table_check" style="margin-bottom: 68px;">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="t in data">
                                            <td>@{{t.product_title}}</td>
                                            <td>@{{t.price | number}}</td>
                                            <td>@{{t.price_date | moment: 'format': 'LL'}}</td>
                                            <td><button ng-click="deleteClick(t.price_id)" title="delete" class="md-btn mdn-btn-small"><i class="material-icons">delete_forever</i></button></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <form id="form-dt" action="" method="post" class="form-div uk-form-stacked" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Add Price by date ({{$row['product_title']}}) - <span class="uk-text-bold uk-text-danger">{{$vendor['vendor_name']}}</span></h3>
                            </div>
                            <div class="md-card-content">
                                <input type="hidden" name="product_id" value="{{$product_id}}" required>
                                <input type="hidden" name="vendor" value="{{$vendor['vendor_slug']}}" required>
                                <div class="uk-form-row">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="price-date" name="date" value="{{date('Y-m-d')}}" type="text" required/>
                                        <span class="md-input-bar "></span>
                                    </div>
                                    <span class="uk-form-help-block">Select Date</span>
                                </div>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-price">Price</label>
                                    <input class="md-input numeric" id="field-price" name="price" type="text" value="{{$row['product_price']}}" maxlength="255" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                                <button type="button" class="md-btn md-btn-primary mdn-btn-small submit-form" ng-click="mySaveDate()">Add</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="uk-width-xLarge-2-10 uk-width-large-3-10 uk-sortable sortable-handler" data-uk-grid-margin data-uk-sortable>
                        <form id="form-day" action="" method="post" class="form-div uk-form-stacked" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
                            <div class="md-card">
                                <div class="md-card-toolbar">
                                    <h3 class="md-card-toolbar-heading-text"> Set price by day - <span class="uk-text-bold uk-text-danger">{{$vendor['vendor_name']}}</span></h3>
                                </div>
                                <div class="md-card-content large-padding">
                                    <input type="hidden" name="product_id" value="{{$product_id}}" required>
                                    <input type="hidden" name="vendor" value="{{$vendor['vendor_slug']}}" required>
                                    <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                        <div class="uk-width-large-1">
                                            @foreach( getDays() as $day )
                                                <div class="uk-form-row">
                                                    <label class="uk-form-label" for="field-{{$day}}">{{ucfirst($day)}}</label>
                                                    <input class="md-input numeric" id="field-{{$day}}" name="{{$day}}" type="text" value="{{$price_day[$day]}}" maxlength="255" autocomplete="off"/>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="md-card-toolbar">
                                    <div class="uk-grid" data-uk-grid-margin="">
                                        <div id="options-content" class="uk-width-medium-1">
                                            <button type="submit" class="md-btn md-btn-primary mdn-btn-small submit-form" ng-click="mySaveDay()">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        $("#price-date").kendoDatePicker({
            format: "yyyy-MM-dd",
            min: new Date()
        });

        var app = angular.module('{{$module}}', ['ngSanitize']);
        app.controller('promoController', function ($scope, $http) {
            $scope.alertBox = false;
            $scope.spinner = true;
            $scope.data = [];
            $scope.columns = [];
            $scope.module = "{{$module}}";

            $scope.perPage = 20;
            $scope.totalRows = 0;
            $scope.pageStart = 1;
            $scope.pageEnd = 0;
            $scope.maxPage = 0;
            $scope.is_search = false;
            $scope.selected = [];
            $scope.alertBox = false;
            $scope.filter = {};
            $scope.year = '2018';

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.mySaveDay = function () {
                var formDataArray = $('#form-day').serializeArray();
                var formData = {};
                formDataArray.forEach(function (entry) {
                    formData[entry.name] = entry.value;
                });
                $scope.spinner = false;
                $http({
                    url: cms_url + "/update_day",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: formData
                }).then(function successCallback(response) {
                    $scope.readData();
                    $scope.spinner = true;
                    if (response.status === 200) {
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'uk-alert-success';
                        $scope.alertBox = true;
                    } else {
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'uk-alert-danger';
                        $scope.alertBox = true;
                    }
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    $scope.alertMessage = response.data.toString();
                    $scope.alertClass = 'uk-alert-danger';
                    $scope.alertBox = true;
                    console.log(response);
                });
            };

            $scope.mySaveDate = function () {
                var formDataArray = $('#form-dt').serializeArray();
                var formData = {};
                formDataArray.forEach(function (entry) {
                    formData[entry.name] = entry.value;
                });
                $scope.spinner = false;
                $http({
                    url: cms_url + "/update_date",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: formData
                }).then(function successCallback(response) {
                    $scope.readData();
                    $scope.spinner = true;
                    if (response.status === 200) {
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'uk-alert-success';
                        $scope.alertBox = true;
                    } else {
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'uk-alert-danger';
                        $scope.alertBox = true;
                    }
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    $scope.alertMessage = response.data.toString();
                    $scope.alertClass = 'uk-alert-danger';
                    $scope.alertBox = true;
                    console.log(response);
                });
            };

            $scope.readData = function() {
                $scope.spinner = false;
                if($scope.is_search){
                    $scope.filter.col    = $scope.selectedOption;
                    $scope.filter.q      = $scope.q;
                }
                $scope.filter.product_id    = '{{$product_id}}';
                $scope.filter.vendor        = '{{$vendor['vendor_slug']}}';
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/get_price?"+params
                }).then(function successCallback(response) {
                    $scope.data = response.data;
                    $scope.spinner = true;
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            $scope.deleteClick = function(id_to_delete) {
                UIkit.modal.confirm('Are you sure that you want to delete this record?', function(){
                    $scope.spinner = false;
                    $http({
                        method: 'DELETE',
                        url: cms_url+"/delete_price/"+id_to_delete
                    }).then(function successCallback(response) {
                        $scope.spinner = true;
                        if( response.status === 200 ){
                            $scope.alertMessage = response.data;
                            $scope.alertClass = 'uk-alert-success';
                            $scope.alertBox = true;
                            $scope.readData();
                        }else{
                            $scope.alertMessage = response.data;
                            $scope.alertClass = 'uk-alert-danger';
                            $scope.alertBox = true;
                        }
                    }, function errorCallback(response) {
                        $scope.spinner = true;
                        console.log(response);
                    });
                });
            };

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.readData();

            showBox();
        });

    </script>
@endsection
