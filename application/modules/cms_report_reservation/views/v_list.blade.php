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
                                <div class="uk-width-medium-1-6">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="filter-from" name="from" value="{{date('Y-m-d')}}" type="text" required/>
                                        <span class="md-input-bar"></span>
                                    </div>
                                    <span class="uk-form-help-block">Date (From)</span>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="filter-to" name="to" value="{{date('Y-m-d')}}" type="text" required/>
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

            <div class="uk-modal" id="modal-detail" aria-hidden="true">
                <div class="uk-modal-dialog" style="top: -15.5px;">
                    <div class="uk-modal-header">
                        <div class="uk-clearfix">
                            <div class="uk-float-left">
                                <h3 class="uk-modal-title">Detail Transaction - @{{ transaction.transaction_uniq }}</h3>
                            </div>
                            <div class="uk-float-right">
                                <a class="md-btn md-btn-flat md-btn-wave waves-effect waves-button uk-modal-close" href="javascript:void(0)"><i class="material-icons">close</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-medium-1">
                        <table ng-if="transaction.transaction_discount>0" class="uk-table uk-table-nowrap table_check">
                            <thead>
                            <tr>
                                <th>Discount</th>
                                <th>Disc. Type</th>
                                <th>Card</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>@{{ transaction.transaction_discount | number }}</td>
                                <td>@{{ transaction.transaction_discount_type }}</td>
                                <td>@{{ transaction.transaction_member_card }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table ng-if="transaction.transaction_type=='edc'" class="uk-table uk-table-nowrap table_check">
                            <thead>
                            <tr>
                                <th>Approval Code</th>
                                <th>Card Type</th>
                                <th>Card Number</th>
                                <th>Bank</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>@{{ transaction.transaction_approval_code }}</td>
                                <td>@{{ transaction.transaction_card_type }}</td>
                                <td>@{{ transaction.transaction_card_number }}</td>
                                <td>@{{ transaction.transaction_bank }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="uk-table uk-table-nowrap table_check">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Discount</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in details">
                                <td title="@{{ t.transaction_detail_id }}">
                                    @{{ t.product_title }}
                                    <br>
                                    <span ng-if="t.transaction_detail_discount>0">
                                        <b ng-repeat="d in t.discount">
                                            @{{ d.dd_type }} @{{ d.dd_percent_discount }}% @{{ d.dd_discount | number }}<br>
                                        </b>
                                    </span>
                                </td>
                                <td>@{{ t.transaction_detail_price | number}}</td>
                                <td>@{{ t.transaction_detail_qty }}</td>
                                <td>@{{ t.transaction_detail_discount | number }}</td>
                                <td>@{{ t.transaction_detail_subtotal | number}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table ng-if="transaction.transaction_user_name" class="uk-table uk-table-nowrap table_check">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>@{{ transaction.transaction_user_name }}</td>
                                <td>@{{ transaction.transaction_user_email }}</td>
                                <td>@{{ transaction.transaction_user_phone }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>

            <div ng-click="hideAlert()" ng-class="alertClass" ng-show="alertBox" class="uk-alert" data-uk-alert>
                <div ng-bind-html="alertMessage"></div>
            </div>

            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-toolbar"> <h3 class="md-card-toolbar-heading-text"> List {{ $subject }}</h3> </div>
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap table_check uk-table-striped" style="margin-bottom: 68px;">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Customer</th>
                                <th>Tanggal</th>
                                <th>Jam Kunjungan</th>
                                <th>Jam Acara</th>
                                <th>Jam Makan</th>
                                <th>Tempat</th>
                                <th>Total Person</th>
                                <th>Total Box</th>
                                <th>Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="(i,t) in data">
                                <td>@{{ i+1 }}</td>
                                <td>@{{t.res_customer}}</td>
                                <td>@{{t.transaction_date_used | moment: 'format': 'LL'}}</td>
                                <td>@{{t.res_jam_kunjungan}}</td>
                                <td>@{{t.res_jam_acara}}</td>
                                <td>@{{t.res_jam_makan}}</td>
                                <td>@{{t.res_tempat}}</td>
                                <td>@{{t.res_total_person | number}}</td>
                                <td>@{{t.res_total_box | number}}</td>
                                <td>
                                    <p ng-if="t.res_note_operasional">Operasional : @{{t.res_note_operasional}}</p>
                                    <p ng-if="t.res_note_teknik">Teknik : @{{t.res_note_teknik}}</p>
                                    <p ng-if="t.res_note_bus">Bus : @{{t.res_note_bus}}</p>
                                    <p ng-if="t.res_note_tambahan">Tambahan : @{{t.res_note_tambahan}}</p>
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
@section('script')
    <script type="text/javascript">

        $("#filter-from").kendoDatePicker({
            format: "yyyy-MM-dd"
        });

        $("#filter-to").kendoDatePicker({
            format: "yyyy-MM-dd"
        });

        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        var app = angular.module( '{{ $module }}', ['ngSanitize']);
        app.controller('listController',function($scope, $http)
        {
            $scope.spinner = true;
            $scope.perPage = 20;
            $scope.totalRows = 0;
            $scope.pageStart = 1;
            $scope.pageEnd = 0;
            $scope.data = [];
            $scope.columns = [];
            $scope.maxPage = 0;
            $scope.is_search = false;
            $scope.selected = [];
            $scope.alertBox = false;
            $scope.filter = {};

            $scope.details = [];
            $scope.transaction = {};
            $scope.readDetails = function (id) {
                angular.forEach($scope.data, function(value, key) {
                    if( id === value.transaction_id ) $scope.transaction = value;
                });
                $http({
                    method: 'GET',
                    url: cms_url+"/detail?id="+id
                }).then(function successCallback(response) {
                    $scope.details = response.data;
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    UIkit.modal.alert('error '+JSON.parse(response));
                });
            };

            $scope.readData = function() {
                $scope.spinner = false;
                $scope.filter.user_id           = $("#filter-user").val();
                $scope.filter.transaction_uniq  = $("#filter-transaction_uniq").val();
                $scope.filter.from              = $("#filter-from").val();
                $scope.filter.to                = $("#filter-to").val();
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/get?"+params
                }).then(function successCallback(response) {
                    $scope.data = response.data;
                    $scope.spinner = true;
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            $scope.exportData = function()
            {
                $scope.filter.user_id           = $("#filter-user").val();
                $scope.filter.transaction_uniq  = $("#filter-transaction_uniq").val();
                $scope.filter.from              = $("#filter-from").val();
                $scope.filter.to                = $("#filter-to").val();
                var params = $.param( $scope.filter );
                window.location.href = cms_url+"/export?"+params;
            };

            function showAlert(val) {
                UIkit.modal.alert(val);
            }

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.readData();
            showBox();
        });
    </script>
@endsection
