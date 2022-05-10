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
                                <div class="uk-width-medium-1-5">
                                    <div class="md-input-wrapper md-input-filled">
                                        <select id="filter-user" class="md-input" name="user">
                                            <option disabled="" selected="" value="">User Loket</option>
                                            @foreach( $user_loket as $item )
                                                <option value="{{$item['id']}}">{{$item['username']}}</option>
                                            @endforeach
                                        </select>
                                        <span class="md-input-bar "></span>
                                    </div>
                                    <span class="uk-form-help-block">User</span>
                                </div>
                                <div id="options-content" class="uk-width-medium-1-6">
                                    <select id="filter-ticket_active" class="md-input" name="ticket_active">
                                        <option value="0" selected>ALL</option>
                                        <option value="yes">YES</option>
                                        <option value="no">NO</option>
                                    </select>
                                    <span class="uk-form-help-block">Used</span>
                                </div>
                          {{--       <div id="options-content" class="uk-width-medium-1-6">
                                    <select id="filter-transaction_vendor" class="md-input" name="transaction_vendor">
                                        <option disabled="" selected="" value="">Vendor</option>
                                        @foreach( $vendors as $item )
                                            <option value="{{$item['vendor_slug']}}">{{$item['vendor_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="uk-form-help-block">Vendor</span>
                                </div> --}}
                                <div class="uk-width-medium-1-6">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="filter-date" name="date" value="{{date('Y-m-d')}}" type="text" required/>
                                        <span class="md-input-bar"></span>
                                    </div>
                                    <span class="uk-form-help-block">Date</span>
                                </div>
                                <div id="options-content" class="uk-width-medium-1-2">
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
                <div class="md-card-toolbar"> <h3 class="md-card-toolbar-heading-text"> List {{ $subject }}</h3> </div>
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap table_check uk-table-striped" style="margin-bottom: 68px;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Used</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="(i,t) in data">
                                <td>@{{i+1}}</td>
                                <td>@{{t.product_title}}</td>
                                <td>@{{t.ticket_count | number}}</td>
                                <td ng-if="t.ticket_active==1"><span class="uk-badge uk-badge-danger">Yes</span></td>
                                <td ng-if="t.ticket_active!=1"><span class="uk-badge uk-badge-success">No</span></td>
                                <td>@{{t.ticket_date | moment: 'format': 'LL'}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Total</td>
                                <td>@{{ total_qty }}</td>
                                <td colspan="2"></td>
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
        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        $("#filter-date").kendoDatePicker({
            format: "yyyy-MM-dd",
            max: new Date()
        });

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
            $scope.total_qty = 0;

            $scope.readData = function() {
                $scope.spinner = false;
                $scope.filter.ticket_active         = $("#filter-ticket_active").val();
                $scope.filter.transaction_uniq      = $("#filter-transaction_uniq").val();
                $scope.filter.ticket_date           = $("#filter-date").val();
                $scope.filter.transaction_vendor    = $("#filter-transaction_vendor").val();
                $scope.filter.user                  = $("#filter-user").val();
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/get?"+params
                }).then(function successCallback(response) {
                    $scope.total_qty = 0;
                    $scope.data = response.data;
                    angular.forEach($scope.data, function (v,i) {
                        $scope.total_qty += parseInt(v.ticket_count);
                    });
                    $scope.spinner = true;
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.exportData = function()
            {
                $scope.filter.ticket_active         = $("#filter-ticket_active").val();
                $scope.filter.transaction_uniq      = $("#filter-transaction_uniq").val();
                $scope.filter.ticket_date           = $("#filter-date").val();
                $scope.filter.transaction_vendor    = $("#filter-transaction_vendor").val();
                $scope.filter.user                  = $("#filter-user").val();
                var params = $.param( $scope.filter );
                window.location.href = cms_url+"/export?"+params;
            };

            $scope.readData();
            showBox();
        });
    </script>
@endsection
