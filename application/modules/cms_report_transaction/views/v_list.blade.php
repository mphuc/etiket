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
                                    <input class="md-input" id="filter-transaction_uniq" name="transaction_uniq" ng-keydown="$event.keyCode === 13 && readData()">
                                    <span class="uk-form-help-block">Transaction ID</span>
                                </div>
                                <div id="options-content-user" class="uk-width-medium-1-6">
                                    <select id="filter-user" class="md-input">
                                        <option disabled="" selected="" value="">User Loket</option>
                                        @foreach( $user_loket as $item )
                                            <option value="{{$item['user_id']}}">{{$item['username']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="uk-form-help-block">User Loket</span>
                                </div>
                              {{--   <div id="options-content-discount" class="uk-width-medium-1-6">
                                    <select id="filter-discount" class="multi-s" multiple>
                                        @foreach( $discount as $item )
                                            <option value="{{$item['dp_name']}}">{{$item['dp_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="uk-form-help-block">Discount</span>
                                </div> --}}
                                <div class="uk-width-medium-1-10">
                                    <select id="filter-gate" class="md-input">
                                        <option disabled="" selected="" value="">Gate</option>
                                        @foreach( $gate as $item )
                                            <option value="{{$item['gate_name']}}">{{$item['gate_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="uk-form-help-block">Gate</span>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <div class="md-input-wrapper md-input-filled">
                                        <select class="multi-s" id="bankget" class="md-input" name="bankget[]" multiple>
                                             @foreach( $bankget as $item )
                                                <option value="{{$item['bank_id']}}" @if( in_array($item['bank_id'], $filter_bankget) ) selected @endif>{{$item['bank_name']}} - {{ $item['card_type_name'] }}</option>
                                            @endforeach
                                        </select>
                                        <span class="md-input-bar "></span>
                                    </div>
                                    <span class="uk-form-help-block">Nama Bank Pengunjung</span>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="filter-from" value="{{date('Y-m-d')}}" type="text" required/>
                                        <span class="md-input-bar"></span>
                                    </div>
                                    <span class="uk-form-help-block">Date (From)</span>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="filter-to" value="{{date('Y-m-d')}}" type="text" required/>
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

            <div ng-click="hideAlert()" ng-class="alertClass" ng-show="alertBox" class="uk-alert" data-uk-alert>
                <div ng-bind-html="alertMessage"></div>
            </div>

            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text"> List {{ $subject }}</h3>
                </div>
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap table_check uk-table-striped" style="margin-bottom: 68px;">
                            <thead>
                            <tr>
                                <th>Transaction Id</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Discount</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in data">
                                 <td>
                                     #@{{t.transaction_uniq}}
                                     <br>
                                     <small ng-if="t.transaction_paid==1"><span class="uk-badge uk-badge-success">paid</span></small>
                                     <small ng-if="t.transaction_paid!=1"><span class="uk-badge uk-badge-warning">unpaid</span></small>
                                     
                                     <small ng-if="t.transaction_type=='edc'">
                                        
                                     </small>
                                        <span class="uk-badge uk-badge-notification" style="display : @{{ t.payee_name != null ? 'inline' : 'none' }}">@{{  t.payee_name }}</span>
                                    <small ng-if="t.bank_id!=0">
                                            <span class="uk-badge uk-badge-notification" style="display : @{{ t.bank_name != null ? 'inline' : 'none' }}">@{{  t.bank_name }}</span>
                                    </small>
                                    <small ng-if="t.card_type_id!= '0'">
                                            <span class="uk-badge uk-badge-notification" style="display : @{{ t.card_type_name != null ? 'inline' : 'none' }}">@{{  t.card_type_name }}</span>
                                    </small>
                                     
                                 </td>
                                <td>
                                    @{{t.product_title}}
                                    <br>
                                    <span ng-if="t.transaction_detail_discount>0">
                                        <b ng-repeat="d in t.discount">
                                            @{{ d.dd_type }} @{{ d.dd_percent_discount }}% @{{ d.dd_discount | number }}<br>
                                        </b>
                                    </span>
                                </td>
                                <td>@{{t.transaction_detail_price | number}}</td>
                                <td>@{{t.transaction_detail_qty}}</td>
                                <td>@{{t.transaction_detail_subtotal | number}}</td>
                                <td>@{{t.transaction_detail_discount | number}}</td>
                                <td>@{{t.transaction_date_used | moment: 'format': 'LL'}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text"> Total Data @{{ data.length | number }}</h3>
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

        $("#filter-from").kendoDatePicker({
            format: "yyyy-MM-dd",
            /*max: new Date()*/
        });

        $("#filter-to").kendoDatePicker({
            format: "yyyy-MM-dd",
            /*max: new Date()*/
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

            $scope.readData = function() {
                $scope.spinner = false;
                $scope.filter.user_id           = $("#filter-user").val();
                $scope.filter.transaction_uniq  = $("#filter-transaction_uniq").val();
                $scope.filter.from              = $("#filter-from").val();
                $scope.filter.to                = $("#filter-to").val();
                $scope.filter.dd_type           = $("#filter-discount").val();
                $scope.filter.gate              = $("#filter-gate").val();
                $scope.filter.bankget           = $("#bankget").val();
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/get?"+params
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    $scope.data = response.data;
                    $scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            function showAlert(val) {
                UIkit.modal.alert( val );
            }

            $scope.optionPerPage = [
                {
                    'name':'20',
                    'value': 20
                },{
                    'name':'25',
                    'value': 25
                },{
                    'name':'50',
                    'value': 50
                },{
                    'name':'100',
                    'value': 100
                }
            ];
            $scope.selectedOptionPerPage = $scope.optionPerPage[0];

            $scope.searchClick = function () {
                $scope.selectedOption = document.getElementById("search-column").value;
                $scope.spinner = false;
                $scope.is_search = true;
                $scope.pageStart = 1;
                $scope.readData($scope.pageStart);
            };

            $scope.reset = function () {
                $scope.spinner = false;
                $scope.is_search = false;
                $scope.perPage = 20;
                $scope.readData($scope.pageStart);
            };

            $scope.changedPerPage = function() {
                $scope.perPage = $scope.selectedOptionPerPage.value;
                $scope.readData($scope.pageStart);
            };

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.exportData = function()
            {
                $scope.filter.user_id           = $("#filter-user").val();
                $scope.filter.transaction_uniq  = $("#filter-transaction_uniq").val();
                $scope.filter.from              = $("#filter-from").val();
                $scope.filter.to                = $("#filter-to").val();
                $scope.filter.dd_type           = $("#filter-discount").val();
                $scope.filter.gate              = $("#filter-gate").val();
                var params = $.param( $scope.filter );
                window.location.href = cms_url+"/export?"+params;
            };

            $scope.readData();
            showBox();
        });
    </script>
@endsection
