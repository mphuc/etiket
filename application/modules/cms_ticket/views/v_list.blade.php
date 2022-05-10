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
                                    <div class="uk-button-dropdown pull-right" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                                        <button class="md-btn ">Bulk Action <i class="material-icons">expand_more</i></button>
                                        <div class="uk-dropdown uk-dropdown-small">
                                            <ul class="uk-nav uk-nav-dropdown">
                                                <li class="uk-nav-header">Bulk Action</li>
                                                <li><a id="usedall" href="javascript:void(0)" ng-click="usedClickBulkAction()">Set Used</a></li>
                                                <li><a id="deleteall" href="javascript:void(0)" ng-click="deleteClickBulkAction()">Delete Permanently</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <input class="md-input" id="filter-transaction_uniq" name="transaction_uniq" ng-keydown="$event.keyCode === 13 && readData()">
                                    <span class="uk-form-help-block">Transaction ID</span>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <input class="md-input" id="filter-ticket_code" name="ticket_code" ng-keydown="$event.keyCode === 13 && readData()">
                                    <span class="uk-form-help-block">Ticket Code</span>
                                </div>
                                <div id="options-content" class="uk-width-medium-1-6">
                                    <select id="filter-ticket_active" class="md-input" name="ticket_active">
                                        <option disabled="" selected="" value="">Ticket Used</option>
                                        <option value="yes">YES</option>
                                        <option value="no">NO</option>
                                    </select>
                                    <span class="uk-form-help-block">Used</span>
                                </div>
                                {{--  
                                <div id="options-content" class="uk-width-medium-1-6">
                                    <select id="filter-transaction_vendor" class="md-input" name="transaction_vendor">
                                        <option disabled="" selected="" value="">Vendor</option>
                                        @foreach( $vendors as $item )
                                            <option value="{{$item['vendor_slug']}}">{{$item['vendor_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="uk-form-help-block">Vendor</span>
                                </div> 
                                --}}
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
                                <th class="small_col"><input class="check_all" type="checkbox" ng-model="checkbox" ng-click="selectAll($event)" title="Select All"></th>
                                <th>Code</th>
                                <th>ID Transaction</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Used</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in data">
                                <td><input class="check_row" type="checkbox" ng-checked="checkbox" ng-click="updateSelection($event, t.ticket_id)" title="Select"></td>
                                <td>@{{t.ticket_code}}</td>
                                <td>#@{{t.transaction_uniq}}</td>
                                <td>@{{t.product_title}}</td>
                                <td>@{{t.transaction_detail_price | number}}</td>
                                <td>@{{t.ticket_qty}}</td>
                                <td ng-if="t.ticket_active==1"><span class="uk-badge uk-badge-danger">Yes</span></td>
                                <td ng-if="t.ticket_active!=1"><span class="uk-badge uk-badge-success">No</span></td>
                                <td>@{{t.ticket_date | moment: 'format': 'LL'}}</td>
                                <td>
                                    <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                                        <button class="md-btn mdn-btn-small"> Actions <i class="material-icons">expand_more</i></button>
                                        <div class="uk-dropdown uk-dropdown-small uk-dropdown-bottom" style="">
                                            <ul class="uk-nav uk-nav-dropdown">
                                                <li ng-click="deleteClick(t.ticket_id)">
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
        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        $("#filter-date").kendoDatePicker({
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

            /*-------start checkbox operation---------*/
            var updateSelected = function(action, id) {
                if (action === 'add' && $scope.selected.indexOf(id) === -1) {
                    $scope.selected.push(id);
                }
                if (action === 'remove' && $scope.selected.indexOf(id) !== -1) {
                    $scope.selected.splice($scope.selected.indexOf(id), 1);
                }
            };

            $scope.updateSelection = function($event, id) {
                var checkbox = $event.target;
                var action = (checkbox.checked ? 'add' : 'remove');
                updateSelected(action, id);
            };

            $scope.selectAll = function($event) {
                var checkbox = $event.target;
                var action = (checkbox.checked ? 'add' : 'remove');
                for ( var i = 0; i < $scope.data.length; i++) {
                    var entity = $scope.data[i];
                    updateSelected(action, entity.ticket_id);
                }
            };

            $scope.getSelectedClass = function(entity) {
                return $scope.isSelected(entity.id) ? 'selected' : '';
            };
            /*--------checkbox operation----------*/

            $scope.readData = function(page) {
                $scope.spinner = false;
                $scope.filter.limit   = $scope.perPage;
                $scope.filter.page    = page;
                $scope.filter.ticket_active = $("#filter-ticket_active").val();
                $scope.filter.transaction_uniq = $("#filter-transaction_uniq").val();
                $scope.filter.transaction_created = $("#filter-date").val();
                $scope.filter.transaction_vendor = $("#filter-transaction_vendor").val();
                $scope.filter.ticket_code = $("#filter-ticket_code").val();
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/get?"+params
                }).then(function successCallback(response) {
                    $scope.data = response.data;
                    $scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                    $scope.updateRowData();
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            $scope.updateRowData = function() {
                $scope.filter.ticket_active = $("#filter-ticket_active").val();
                $scope.filter.transaction_uniq = $("#filter-transaction_uniq").val();
                $scope.filter.transaction_created = $("#filter-date").val();
                $scope.filter.transaction_vendor = $("#filter-transaction_vendor").val();
                $scope.filter.ticket_code = $("#filter-ticket_code").val();
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/rows?"+params
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    $scope.totalRows = response.data;
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
                }else{
                    showAlert('No Data Selected!');
                }
            };

            $scope.usedClickBulkAction = function() {
                var scope_selection = $scope.selected;
                if( scope_selection.length > 0 ){
                    var id_to_delete = scope_selection.join('-');
                    UIkit.modal.confirm('Are you sure that you want to update this record?', function(){
                        $scope.spinner = false;
                        $http({
                            method: 'GET',
                            url: cms_url+"/used/"+id_to_delete
                        }).then(function successCallback(response) {
                            $scope.selected = [];
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
                }else{
                    showAlert('No Data Selected!');
                }
            };

            $scope.deleteClick = function(id_to_delete) {
                UIkit.modal.confirm('Are you sure that you want to delete this record?', function(){
                    $scope.spinner = false;
                    $http({
                        method: 'GET',
                        url: cms_url+"/delete/"+id_to_delete
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

            $scope.nextPageClick = function () {
                var maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                if($scope.pageStart < maxPage){
                    $scope.spinner = false;
                    $scope.pageStart +=1;
                    $scope.readData($scope.pageStart);
                }
            };
            $scope.prevPageClick = function () {
                if( $scope.pageStart > 1 ){
                    $scope.spinner = false;
                    $scope.pageStart -=1;
                    $scope.readData($scope.pageStart);
                }
            };
            $scope.startPageClick = function () {
                $scope.spinner = false;
                $scope.pageStart = 1;
                $scope.readData($scope.pageStart);
            };
            $scope.endPageClick = function () {
                $scope.spinner = false;
                $scope.pageStart = Math.ceil($scope.totalRows/$scope.perPage);
                $scope.readData($scope.pageStart);
            };

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.readData();
            showBox();
        });
    </script>
@endsection
