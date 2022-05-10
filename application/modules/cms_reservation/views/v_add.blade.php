@extends('app')
@section('body')
    <div id="page_content" ng-controller="addController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_heading">
            <h1>Add <a href="cms/{{ $module }}" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
            </h1> <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">You can add new data in this form</span>
        </div>
        <div id="page_content_inner" style="display: none;">
            <form id="form" action="" method="post" class="form-div uk-form-stacked" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
                <div class="uk-grid uk-grid-medium ">
                    <div class="uk-width-xLarge-4-10 uk-width-large-4-10" >
                        <div ng-click="hideAlert()" ng-class="alertClass" ng-show="alertBox" class="uk-alert" data-uk-alert>
                            <div ng-bind-html="alertMessage"></div>
                        </div>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Form Reservation </h3>
                            </div>
                            <div class="md-card-content large-padding">
                                <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                    <div class="uk-width-large-1">
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_customer">Customer</label>
                                            <select style="width: 100%" id="field-res_customer" name="res_customer" class="uk-width-1-1" data-md-select2 data-allow-clear="true" data-placeholder="Customer..."></select>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-clock-o"></i></span>
                                                <label for="field-res_jam_kunjungan">Jam Kunjungan</label>
                                                <input class="md-input" type="text" name="res_jam_kunjungan" id="field-res_jam_kunjungan" data-uk-timepicker>
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-clock-o"></i></span>
                                                <label for="field-res_jam_acara">Jam Acara</label>
                                                <input class="md-input" type="text" name="res_jam_acara" id="field-res_jam_acara" data-uk-timepicker>
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_tempat">Tempat</label>
                                            <select style="width: 100%" id="field-res_tempat" name="res_tempat" class="uk-width-1-1" data-md-select2 data-allow-clear="true" data-placeholder="Tempat..."></select>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_souvenir_tour">Souvenir Tour</label>
                                            <input class="md-input" id="field-res_souvenir_tour" name="res_souvenir_tour" type="text" value="" maxlength="100" />
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_souvenir_panggung">Souvenir Panggung</label>
                                            <input class="md-input" id="field-res_souvenir_panggung" name="res_souvenir_panggung" type="text" value="" maxlength="100" />
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-clock-o"></i></span>
                                                <label for="field-res_jam_makan">Jam Makan</label>
                                                <input class="md-input" type="text" name="res_jam_makan" id="field-res_jam_makan" data-uk-timepicker>
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-bus_1">Bus 1</label>
                                            <select style="width: 100%" id="field-bus_1" name="bus_1" class="uk-width-1-1" data-md-select2 data-allow-clear="true" data-placeholder="Bus..."></select>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-bus_2">Bus 2</label>
                                            <select style="width: 100%" id="field-bus_2" name="bus_2" class="uk-width-1-1" data-md-select2 data-allow-clear="true" data-placeholder="Bus..."></select>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_bus_price">Harga Satuan Bus</label>
                                            <input class="md-input" id="field-res_bus_price" name="res_bus_price" type="number" value="0" maxlength="11" min="0"/>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_driver_price">Fee Driver</label>
                                            <input class="md-input" id="field-res_driver_price" name="res_driver_price" type="number" value="0" maxlength="11" min="0"/>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_total_person">Jumlah Orang</label>
                                            <input class="md-input" id="field-res_total_person" name="res_total_person" type="number" value="0" maxlength="11" min="0"/>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_total_box">Jumlah Box Makanan</label>
                                            <input class="md-input" id="field-res_total_box" name="res_total_box" type="number" value="0" maxlength="11" min="0"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Form Keterangan </h3>
                            </div>
                            <div class="md-card-content large-padding">
                                <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                    <div class="uk-width-large-1">
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_biro">Tour and Travel</label>
                                            <textarea class="md-input" id="field-res_biro" name="res_biro"></textarea>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="res_note_operasional">Keterangan Operasional</label>
                                            <textarea class="md-input" id="res_note_operasional" name="res_note_operasional" ></textarea>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="res_note_teknik">Keterangan Teknik</label>
                                            <textarea class="md-input" id="res_note_teknik" name="res_note_teknik" ></textarea>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="res_note_tambahan">Keterangan Tambahan</label>
                                            <textarea class="md-input" id="res_note_tambahan" name="res_note_tambahan" ></textarea>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="res_note_bus">Keterangan Bus</label>
                                            <textarea class="md-input" id="res_note_bus" name="res_note_bus" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-xLarge-6-10 uk-width-large-6-10 uk-sortable sortable-handler" data-uk-grid-margin data-uk-sortable>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Items </h3>
                                <div class="md-card-toolbar-actions">
                                    <h3 style="color: blue">Total : Rp. @{{ total_all | number }}</h3>
                                </div>
                            </div>
                            <div class="md-card-content">
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="transaction_date_used">Date Used</label>
                                    <input id="transaction_date_used" name="transaction_date_used" type="text" value="{{date('Y-m-d')}}" />
                                </div>
                                <div class="uk-form-row">
                                    <button class="md-btn md-btn-success" ng-click="readProduct()" data-uk-modal="{target:'#modal-product'}">+</button>
                                </div>
                                <br>
                                <div class="uk-overflow-container">
                                <table class="uk-table table_check uk-table-striped">
                                    <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Product</th>
                                        <th style="text-align: right">Price</th>
                                        <th style="text-align: center">Qty</th>
                                        <th style="text-align: right">Discount</th>
                                        <th style="text-align: right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="(i,t) in list_product">
                                        <td>
                                            <button ng-click="removeProduct(t)" class="md-btn md-btn-mini md-btn-danger md-btn-wave waves-effect waves-button"><i class="material-icons">clear</i></button>
                                        </td>
                                        <td>@{{ t.product_title }}</td>
                                        <td style="text-align: right">@{{ t.product_price | number }}</td>
                                        <td style="text-align: center">
                                            <input type="text" ng-keyup="updateQty(i,$event.target.value)" value="1" minlength="1" maxlength="100">
                                        </td>
                                        <td style="text-align: right">@{{ t.discount | number }}</td>
                                        <td style="text-align: right">
                                            <span ng-if="t.discount>0"><s>@{{ t.product_price * t.qty | number }}</s></span>
                                            <span ng-if="t.discount==0">@{{ t.product_price * t.qty | number }}</span>
                                            <br><span ng-if="t.discount>0">@{{ (t.product_price * t.qty)-t.discount | number }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Total</td>
                                        <td style="text-align: right; color: red;">@{{ total_discount | number }}</td>
                                        <td style="text-align: right">
                                            <span ng-if="total!=total_all"><s>@{{ total | number }}</s></span>
                                            <span style="color: blue">@{{ total_all | number }}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Discount </h3>
                                <div class="md-card-toolbar-actions">
                                    <h3 style="color: red">Total : Rp. @{{ total_discount | number }}</h3>
                                </div>
                            </div>
                            <div class="md-card-content">
                                <div class="uk-form-row">
                                    <button class="md-btn md-btn-success" ng-click="readDiscount()" data-uk-modal="{target:'#modal-discount'}">+</button>
                                </div>
                                <br>
                                <div class="uk-overflow-container">
                                <table class="uk-table table_check">
                                    <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Discount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="t in list_discount">
                                        <td>
                                            <button ng-click="removeDiscount(t)" class="md-btn md-btn-mini md-btn-danger md-btn-wave waves-effect waves-button"><i class="material-icons">clear</i></button>
                                        </td>
                                        <td>@{{ t.dp_name }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> DP </h3>
                            </div>
                            <div class="md-card-content">
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-res_dp">Dp Nominal</label>
                                    <input class="md-input numeric" id="field-res_dp" name="res_dp" type="text" value="0"/>
                                </div>

                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-res_dp_type">Type</label >
                                    <p id="field-res_dp_type">
                                        <input type="radio" name="res_dp_type" value="cash" id="field-res_dp_type-1" data-md-icheck checked/>
                                        <label for="field-res_dp_type-1" class="inline-label">Cash</label>&nbsp;&nbsp;
                                        <input type="radio" name="res_dp_type" value="transfer" id="field-res_dp_type-2" data-md-icheck />
                                        <label for="field-res_dp_type-2" class="inline-label">Transfer</label>
                                    </p>
                                </div>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="res_dp_bank">DP Bank</label >
                                    <p id="res_dp_bank">
                                        @foreach($banks as $k => $v)
                                            <input type="radio" name="res_dp_bank" value="{{$v['bank_name']}}" id="res_dp_bank-{{$k}}" data-md-icheck/>
                                            <label for="res_dp_bank-{{$k}}" class="inline-label">{{$v['bank_name']}}</label>&nbsp;&nbsp;<br>
                                        @endforeach
                                    </p>
                                </div>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="res_dp_date">Date</label>
                                    <input id="res_dp_date" name="res_dp_date" type="text" value="{{date('Y-m-d')}}" maxlength="" />
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Pelunasan </h3>
                            </div>
                            <div class="md-card-content">
                                <div class="uk-form-row">
                                    <p>
                                        <input type="checkbox" name="transaction_paid" value="1" id="transaction_paid" data-md-icheck/>
                                        <label for="transaction_paid" class="inline-label">Lunas</label>
                                    </p>
                                </div>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="res_pelunasan_type">Type</label >
                                    <p id="res_pelunasan_type">
                                        <input type="radio" name="res_pelunasan_type" value="cash" id="res_pelunasan_type-1" data-md-icheck checked/>
                                        <label for="res_pelunasan_type-1" class="inline-label">Cash</label>&nbsp;&nbsp;
                                        <input type="radio" name="res_pelunasan_type" value="transfer" id="res_pelunasan_type-2" data-md-icheck />
                                        <label for="res_pelunasan_type-2" class="inline-label">Transfer</label>
                                    </p>
                                </div>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="res_pelunasan_bank">Pelunasan Bank</label >
                                    <p id="res_pelunasan_bank">
                                        @foreach($banks as $k => $v)
                                            <input type="radio" name="res_pelunasan_bank" value="{{$v['bank_name']}}" id="res_pelunasan_bank-{{$k}}" data-md-icheck/>
                                            <label for="res_pelunasan_bank-{{$k}}" class="inline-label">{{$v['bank_name']}}</label>&nbsp;&nbsp;<br>
                                        @endforeach
                                    </p>
                                </div>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="res_pelunasan_date">Date</label>
                                    <input id="res_pelunasan_date" name="res_pelunasan_date" type="text" value="{{date('Y-m-d')}}" maxlength="" />
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Actions </h3>
                            </div>
                            <div class="md-card-content">
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div id="options-content" class="uk-width-medium-1">
                                        <button type="submit" class="md-btn md-btn-primary mdn-btn-small submit-form" ng-click="mySave()">Save</button>
                                        <button type="submit" class="md-btn mdn-btn-small md-btn-success save-and-go-back-button" ng-click="mySave(true)">Save & Back</button>
                                        <a href="cms/{{ $module }}" class="md-btn mdn-btn-small return-to-list">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="uk-modal" id="modal-discount" aria-hidden="true">
                <div class="uk-modal-dialog" style="top: -15.5px;">
                    <div class="uk-modal-header">
                        <div class="uk-clearfix">
                            <div class="uk-float-left">
                                <h3 class="uk-modal-title">Discount</h3>
                            </div>
                            <div class="uk-float-right">
                                <a class="md-btn md-btn-flat md-btn-wave waves-effect waves-button uk-modal-close" href="javascript:void(0)"><i class="material-icons">close</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-medium-1" style="overflow-x:auto;max-height: 400px">
                        <table class="uk-table uk-table-nowrap table_check">
                            <thead>
                            <tr>
                                <th>Discount</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in data_discount">
                                <td>@{{ t.dp_name }}</td>
                                <td>@{{ t.dp_description }}</td>
                                <td>
                                    <button ng-click="addDiscount(t)" class="md-btn md-btn-success">+</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="uk-modal" id="modal-product" aria-hidden="true">
                <div class="uk-modal-dialog" style="top: -15.5px;">
                    <div class="uk-modal-header">
                        <div class="uk-clearfix">
                            <div class="uk-float-left">
                                <h3 class="uk-modal-title">Product Price (@{{ date | moment: 'format': 'dddd, Do MMMM YYYY' }})</h3>
                            </div>
                            <div class="uk-float-right">
                                <a class="md-btn md-btn-flat md-btn-wave waves-effect waves-button uk-modal-close" href="javascript:void(0)"><i class="material-icons">close</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-medium-1" style="overflow-x:auto;max-height: 400px">
                        <table class="uk-table uk-table-nowrap table_check">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th style="text-align: right">Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in data_product">
                                <td>@{{ t.product_title }}</td>
                                <td style="text-align: right">@{{ t.product_price | number }}</td>
                                <td>
                                    <button ng-click="addProduct(t)" class="md-btn md-btn-success">+</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('head')
    <link rel="stylesheet" href="{{ base_url('themes/umbrella-back/2ndmaterial/bower_components/select2/dist/css/select2.min.css') }}">
@endsection
@section('script')
    <script src="{{ base_url('themes/umbrella-back/2ndmaterial/bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('#field-res_customer').select2({
            ajax: {
                url: '{{base_url("cms/$module/master")}}',
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });
        $('#field-res_tempat').select2({
            ajax: {
                url: '{{base_url("cms/$module/tempat")}}',
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });
        $('#field-bus_1,#field-bus_2').select2({
            ajax: {
                url: '{{base_url("cms/$module/bus")}}',
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });

        $("#transaction_date_used").kendoDatePicker({
            format: "yyyy-MM-dd",
            min: new Date()
        });

        $("#res_dp_date").kendoDatePicker({
            format: "yyyy-MM-dd",
            min: new Date()
        });

        $("#res_pelunasan_date").kendoDatePicker({
            format: "yyyy-MM-dd",
            min: new Date()
        });

        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        var app = angular.module( '{{$module}}', ['ngSanitize']);
        app.controller('addController',function($scope, $http)
        {
            $scope.alertBox         = false;
            $scope.spinner          = true;
            $scope.data             = [];
            $scope.columns          = [];
            $scope.module           = "{{$module}}";
            $scope.data_discount    = [];
            $scope.data_product     = [];
            $scope.list_product     = [];
            $scope.list_discount    = [];
            $scope.total_discount   = 0;
            $scope.total_qty        = 0;
            $scope.total_all        = 0;
            $scope.total            = 0;
            $scope.date             = 0;
            $scope.filter           = {};

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.updateQty = function (index,qty) {
                var price       = parseInt($scope.list_product[index].product_price);
                $scope.list_product[index].qty = parseInt(qty);
                $scope.list_product[index].total = price*parseInt(qty);
                $scope.calculateTotalDiscount();
            };

            $scope.addDiscount = function (data) {
                var ids = [];
                angular.forEach($scope.list_discount, function(value, key) {
                    ids.push( value.dp_id );
                });
                if( !ids.includes(data.dp_id) ) $scope.list_discount.push(data);
                $scope.calculateTotalDiscount();
            };

            $scope.addProduct = function (data) {
                var ids = [];
                angular.forEach($scope.list_product, function(value, key) {
                    ids.push( value.product_id );
                });
                if( !ids.includes(data.product_id) ) {
                    var price    = parseInt(data.product_price);
                    var discount = 0;
                    var qty      = 1;
                    var product = {
                        product_id      : data.product_id,
                        product_title   : data.product_title,
                        product_price   : price,
                        qty             : qty,
                        discount        : discount,
                        total           : price*qty
                    };
                    $scope.list_product.push( product );
                }
                $scope.calculateTotalDiscount();
            };

            $scope.calculateTotalDiscount = function () {
                $scope.spinner = false;
                var discountIds = [];
                angular.forEach($scope.list_discount, function(value, key) {
                    discountIds.push( value.dp_id );
                });
                var productIds = [];
                angular.forEach($scope.list_product, function(value, key) {
                    productIds.push( value.product_id );
                });
                $scope.filter.dp_id         = discountIds.join(',');
                $scope.filter.product_id    = productIds.join(',');
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/discount_value?"+params
                }).then(function successCallback(response) {
                    $scope.spinner          = true;
                    $scope.total_all        = 0;
                    $scope.total            = 0;
                    $scope.total_discount   = 0;
                    var discountValues      = response.data;
                    angular.forEach($scope.list_product, function(value, key) {
                        var totalBeforeDiscount = value.qty*value.product_price;
                        if( discountValues.length == 0 ){
                            $scope.list_product[key].discount = 0;
                        }else{
                            var lastDiscTmp   = 0;
                            var lastTotalTmp  = 0;
                            var i = 0;
                            angular.forEach(discountValues, function(v, k) {
                                if( v.product_id == value.product_id ){
                                    if( i === 0 ){
                                        discountNominal = totalBeforeDiscount*parseInt(v.discount)/100;
                                        lastTotalTmp    = totalBeforeDiscount-discountNominal;
                                        lastDiscTmp     += discountNominal;
                                    }else{
                                        discountNominal = lastTotalTmp*parseInt(v.discount)/100;
                                        lastTotalTmp    = lastTotalTmp-discountNominal;
                                        lastDiscTmp     += discountNominal;
                                    }
                                    $scope.list_product[key].discount = lastDiscTmp;
                                    i++;
                                }
                            });
                        }
                        $scope.total            += value.total;
                        $scope.total_all        += value.total-value.discount;
                        $scope.total_discount   += value.discount;
                    });
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    UIkit.modal.alert('error '+JSON.parse(response));
                });
            };

            $scope.removeProduct = function(item) {
                var index = $scope.list_product.indexOf(item);
                $scope.list_product.splice(index, 1);
                $scope.calculateTotalDiscount();
            };

            $scope.removeDiscount = function (item) {
                var index = $scope.list_discount.indexOf(item);
                $scope.list_discount.splice(index, 1);
                $scope.calculateTotalDiscount();
            };

            $scope.readDiscount = function () {
                var ids = [];
                angular.forEach($scope.list_product, function(value, key) {
                    ids.push( value.product_id );
                });
                $http({
                    method: 'GET',
                    url: cms_url+"/discount?product_id="+ids
                }).then(function successCallback(response) {
                    $scope.data_discount = response.data;
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    UIkit.modal.alert('error '+JSON.parse(response));
                });
            };

            $scope.readProduct = function () {
                var date = $("#transaction_date_used").val();
                $scope.date = date;
                $http({
                    method: 'GET',
                    url: cms_url+"/product?date="+date
                }).then(function successCallback(response) {
                    $scope.data_product = response.data;
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    UIkit.modal.alert('error '+JSON.parse(response));
                });
            };

            $scope.mySave = function (redirect) {
                var formDataArray = $('#form').serializeArray();
                var formData = {};
                formDataArray.forEach(function(entry) {
                    formData[entry.name]=entry.value;
                });
                formData['product']=$scope.list_product;
                formData['discount']=$scope.list_discount;
                $scope.spinner = false;
                $http({
                    url: cms_url+"/add",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: formData
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    if( response.status === 200 ){
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'uk-alert-success';
                        $scope.alertBox = true;
                        /*document.getElementById("form").reset();*/
                        if(redirect) window.location = cms_url;
                    }else{
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'uk-alert-danger';
                        $scope.alertBox = true;
                    }
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            showBox();
        });

    </script>
@endsection
