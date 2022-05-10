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
                                    <input class="md-input" id="filter-transaction_code" ng-keydown="$event.keyCode === 13 && readData()">
                                    <span class="uk-form-help-block">Code</span>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <input class="md-input" id="filter-transaction_uniq" ng-keydown="$event.keyCode === 13 && readData()">
                                    <span class="uk-form-help-block">Transaction ID</span>
                                </div>
                                <div id="options-content" class="uk-width-medium-1-6">
                                    <select id="filter-status" class="md-input">
                                        <option disabled="" selected="" value="">Status</option>
                                        <option value="paid">PAID</option>
                                        <option value="unpaid">UNPAID</option>
                                    </select>
                                    <span class="uk-form-help-block">Used</span>
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
                                {{-- <div id="options-content-type" class="uk-width-medium-1-6">
                                    <select id="filter-type" class="md-input">
                                        <option disabled="" selected="" value="">Transaction Type</option>
                                        <option value="offline">Offline</option>
                                        <option value="online">Online</option>
                                    </select>
                                    <span class="uk-form-help-block">Transaction Type</span>
                                </div> --}}
                                <div id="options-content" class="uk-width-medium-1-6">
                                    <select id="filter-transaction_vendor" class="md-input" name="transaction_vendor">
                                        <option disabled="" selected="" value="">Vendor</option>
                                        @foreach( $vendors as $item )
                                            <option value="{{$item['vendor_slug']}}">{{$item['vendor_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="uk-form-help-block">Vendor</span>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="filter-date" name="date" value="" type="text" required/>
                                        <span class="md-input-bar"></span>
                                    </div>
                                    <span class="uk-form-help-block">Date</span>
                                </div>
                                <div id="options-content" class="uk-width-medium-1-5">
                                    <button ng-click="readData()" class="md-btn md-btn-primary">Filter</button>
                                    <a href="{{ base_url("cms/$module") }}" class="md-btn">Reset</a>
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
                                <th>Card</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>@{{ transaction.transaction_discount | number }}</td>
                                <td>@{{ transaction.transaction_member_card }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="uk-table uk-table-nowrap table_check">
                            <thead>
                            <tr>
                                <th>Approval Code</th>
                                <th>Payee Type</th>
                                <th>Card Type</th>
                                <th>Card Number</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>@{{ transaction.transaction_approval_code }}</td>
                                <td>@{{ transaction.payee_name }}</td>
                                <td>@{{ transaction.bank_name }}</td>
                                <td>@{{ transaction.card_type_name }}</td>
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
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text"> List {{ $subject }}</h3>
                </div>
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap table_check uk-table-striped" style="margin-bottom: 68px;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code and Pass</th>
                                <th>Username</th>
                                <th>Discount</th>
                                <th>Total(Rp)</th>
                                <th>Fee</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in data">
                                <td>
                                    <a title="@{{t.transaction_id}}" ng-click="readDetails(t.transaction_id)" href="#" data-uk-modal="{target:'#modal-detail'}" >#@{{t.transaction_uniq}}</a>
                                    <br>
                                    <small ng-if="t.transaction_paid==1"><span class="uk-badge uk-badge-success">paid</span></small>
                                    <small ng-if="t.transaction_paid!=1"><span class="uk-badge uk-badge-warning">unpaid</span></small>
                                    <small ng-if="t.transaction_status=='Success' || t.transaction_status=='success'"><span class="uk-badge uk-badge-success">@{{  t.transaction_status }}</span></small>
                                    <small ng-if="t.transaction_status=='Pending' || t.transaction_status=='pending'"><span class="uk-badge uk-badge-warning">@{{  t.transaction_status }}</span></small>
                                    <small ng-if="t.transaction_status=='Failed' || t.transaction_status=='failed'"><span class="uk-badge uk-badge-danger">@{{  t.transaction_status }}</span></small>
                                    <small ng-if="t.transaction_vendor"><span class="uk-badge">@{{  t.transaction_vendor }}</span></small>
                                    <small ng-if="t.transaction_type"><span class="uk-badge uk-badge-notification">@{{  t.transaction_type }}</span></small>
                                </td>
                                <td>
                                    code : @{{t.transaction_code}}<br>
                                    pass : @{{t.transaction_pass}}
                                </td>
                                <td>@{{t.username != null ? t.username : '-'}}</td>
                                <td>@{{t.transaction_discount | number}}</td>
                                <td ng-if="t.transaction_discount==0">@{{t.transaction_total -t.transaction_fee | number}}</td>
                                <td ng-if="t.transaction_discount>0">
                                    <strike>@{{t.transaction_total -t.transaction_fee | number}}</strike>
                                    <br>@{{t.transaction_total-t.transaction_discount -t.transaction_fee | number}}
                                </td>
                                <td>@{{t.transaction_fee | number}}</td>
                                <td>
                                    @{{t.transaction_created | moment: 'format': 'dddd, Do MMMM YYYY, H:mm'}}<br>
                                    <span title="@{{ t.transaction_date_used | moment: 'format': 'LL' }}" class="uk-badge uk-badge-primary">Digunakan @{{t.transaction_date_used | moment: 'format': 'LL'}}</span>
                                </td>
                                <td>
                                    <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                                        <button class="md-btn mdn-btn-small"> Actions <i class="material-icons">expand_more</i></button>
                                        <div class="uk-dropdown uk-dropdown-small uk-dropdown-bottom" style="">
                                            <ul class="uk-nav uk-nav-dropdown">
                                                {{--<li ng-click="refundClick(t.transaction_id)">
                                                    <a href="" title="Delete"><i class="material-icons">reply</i> Refund</a>
                                                </li>--}}
                                                <li ng-click="deleteClick(t.transaction_id)">
                                                    <a href="" title="Delete"><i class="material-icons">delete_forever</i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin="" style="margin-top: 30px;">
                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
                            <div class="uk-input-group">
                                <select class="md-input" ng-change="changedPerPage()" data-ng-options="o.name for o in optionPerPage" data-ng-model="selectedOptionPerPage"></select>
                            </div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
                            <div style="margin-top:15px;" class="uk-input-group"> Page <span id="page-starts-from">@{{pageStart}}</span> from <span id="total_items">@{{maxPage}}</span> Total Pages</div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
                            <div class="uk-input-group">
                                <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="tb_crud_page" type="text" value="@{{pageStart}}" id="tb_crud_page" disabled>
                                    <span class="md-input-bar"></span>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
                            <div style="margin-top:15px;" class="uk-input-group"> Total Data @{{ totalRows | number }}</div>
                        </div>
                    </div>
                    <hr>
                    <ul class="pager" style="text-align: center;">
                        <li class="md-btn md-btn-wave" ng-click="startPageClick()" style="float: left;"><a href="" >« First</a></li>
                        <li class="md-btn md-btn-wave" ng-click="prevPageClick()"><a href="" >« Prev</a></li>
                        <li class="md-btn md-btn-wave" ng-click="nextPageClick()"><a href="" >Next »</a></li>
                        <li class="md-btn md-btn-wave" ng-click="endPageClick()" style="float: right;"><a href="" >Last »</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $("#filter-date").kendoDatePicker({
            format: "yyyy-MM-dd",
            /*max: new Date()*/
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
                $scope.filter.transaction_code      = $("#filter-transaction_code").val();
                $scope.filter.transaction_uniq      = $("#filter-transaction_uniq").val();
                $scope.filter.date                  = $("#filter-date").val();
                $scope.filter.transaction_vendor    = $("#filter-transaction_vendor").val();
                $scope.filter.user                  = $("#filter-user").val();
                $scope.filter.status                = $("#filter-status").val();
                $scope.filter.type                  = $("#filter-type").val();
                $scope.filter.limit                 = $scope.perPage;
                $scope.filter.page                  = $scope.pageStart;
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/get?"+params
                }).then(function successCallback(response) {
                    $scope.data = response.data.message;
                    $scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                    $scope.updateRowData();
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    UIkit.modal.alert('error '+JSON.parse(response));
                });
            };

            $scope.updateRowData = function() {
                $scope.filter.transaction_code      = $("#filter-transaction_code").val();
                $scope.filter.transaction_uniq      = $("#filter-transaction_uniq").val();
                $scope.filter.date                  = $("#filter-date").val();
                $scope.filter.transaction_vendor    = $("#filter-transaction_vendor").val();
                $scope.filter.user                  = $("#filter-user").val();
                $scope.filter.status                = $("#filter-status").val();
                $scope.filter.type                  = $("#filter-type").val();
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/rows?"+params
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    $scope.totalRows = response.data.message;
                    $scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    UIkit.modal.alert('error '+JSON.parse(response));
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
                $scope.readData();
            };

            $scope.reset = function () {
                $scope.spinner = false;
                $scope.is_search = false;
                $scope.perPage = 20;
                $scope.readData();
            };

            $scope.changedPerPage = function() {
                $scope.perPage = $scope.selectedOptionPerPage.value;
                $scope.readData();
            };

            $scope.paidClickBulkAction = function() {
                var scope_selection = $scope.selected;
                if( scope_selection.length > 0 ){
                    var id_to_delete = scope_selection.join('-');
                    UIkit.modal.confirm('Are you sure that you want to update this record?', function(){
                        $scope.spinner = false;
                        $http({
                            method: 'GET',
                            url: cms_url+"/paid/"+id_to_delete
                        }).then(function successCallback(response) {
                            $scope.selected = [];
                            $scope.spinner = true;
                            var result = response.data;
                            if( result.status ){
                                $scope.alertMessage = result.message;
                                $scope.alertClass = 'uk-alert-success';
                                $scope.alertBox = true;
                                $scope.readData();
                            }else{
                                $scope.alertMessage = result.message;
                                $scope.alertClass = 'uk-alert-danger';
                                $scope.alertBox = true;
                            }
                        }, function errorCallback(response) {
                            $scope.spinner = true;
                            showAlert('error'+JSON.parse(response));
                        });
                    });
                }else{
                    showAlert('No Data Selected!');
                }
            };

            $scope.deleteClickBulkAction = function() {
                var scope_selection = $scope.selected;
                if( scope_selection.length > 0 ){
                    var id_to_delete = scope_selection.join('-');
                    UIkit.modal.confirm('Are you sure that you want to delete this record?', function(){
                        $scope.spinner = false;
                        $http({
                            method: 'GET',
                            url: cms_url+"/delete/"+id_to_delete
                        }).then(function successCallback(response) {
                            $scope.selected = [];
                            $scope.spinner = true;
                            var result = response.data;
                            if( result.status ){
                                $scope.alertMessage = result.message;
                                $scope.alertClass = 'uk-alert-success';
                                $scope.alertBox = true;
                                $scope.readData();
                            }else{
                                $scope.alertMessage = result.message;
                                $scope.alertClass = 'uk-alert-danger';
                                $scope.alertBox = true;
                            }
                        }, function errorCallback(response) {
                            $scope.spinner = true;
                            showAlert('error'+JSON.parse(response));
                        });
                    });
                }else{
                    showAlert('No Data Selected!');
                }
            };

            $scope.refundClick = function(id_to_delete) {
                UIkit.modal.prompt("Transaction ID : ",'', function(value){
                    $scope.spinner = false;
                    $http({
                        method: 'GET',
                        url: cms_url+"/refund/"+id_to_delete+"/"+value
                    }).then(function successCallback(response) {
                        $scope.selected = [];
                        $scope.spinner = true;
                        var result = response.data;
                        if( result.status ){
                            $scope.alertMessage = result.message;
                            $scope.alertClass = 'uk-alert-success';
                            $scope.alertBox = true;
                            $scope.readData();
                        }else{
                            $scope.alertMessage = result.message;
                            $scope.alertClass = 'uk-alert-danger';
                            $scope.alertBox = true;
                        }
                    }, function errorCallback(response) {
                        $scope.spinner = true;
                        showAlert('error'+JSON.parse(response));
                    });
                });
            };

            $scope.deleteClick = function(id_to_delete) {
                UIkit.modal.confirm('Are you sure that you want to delete this record?', function(){
                    $scope.spinner = false;
                    $http({
                        method: 'GET',
                        url: cms_url+"/delete/"+id_to_delete
                    }).then(function successCallback(response) {
                        $scope.spinner = true;
                        var result = response.data;
                        if( result.status ){
                            $scope.alertMessage = result.message;
                            $scope.alertClass = 'uk-alert-success';
                            $scope.alertBox = true;
                            $scope.readData();
                        }else{
                            $scope.alertMessage = result.message;
                            $scope.alertClass = 'uk-alert-danger';
                            $scope.alertBox = true;
                        }
                    }, function errorCallback(response) {
                        $scope.spinner = true;
                        UIkit.modal.alert('error '+JSON.parse(response));
                    });
                });
            };

            $scope.nextPageClick = function () {
                var maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                if($scope.pageStart < maxPage){
                    $scope.spinner = false;
                    $scope.pageStart +=1;
                    $scope.readData();
                }
            };
            $scope.prevPageClick = function () {
                if( $scope.pageStart > 1 ){
                    $scope.spinner = false;
                    $scope.pageStart -=1;
                    $scope.readData();
                }
            };
            $scope.startPageClick = function () {
                $scope.spinner = false;
                $scope.pageStart = 1;
                $scope.readData();
            };
            $scope.endPageClick = function () {
                $scope.spinner = false;
                $scope.pageStart = Math.ceil($scope.totalRows/$scope.perPage);
                $scope.readData();
            };

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.readData();
            showBox();
        });
    </script>
@endsection
