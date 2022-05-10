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
                                                <li><a href="javascript:void(0)" ng-click="deleteClickBulkAction()">Delete Permanently</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-10">
                                    <input class="md-input" id="filter-product_title" name="product_title" ng-keydown="$event.keyCode === 13 && readData()">
                                    <span class="uk-form-help-block">Title</span>
                                </div>
                                <div id="options-content" class="uk-width-medium-1-10">
                                    <select id="filter-category_id" class="md-input" name="category_id">
                                        <option disabled="" selected="" value="">Category</option>
                                        @foreach( $categories as $item )
                                            <option value="{{$item['category_id']}}">{{$item['category_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="uk-form-help-block">Category</span>
                                </div>
                                <div id="options-content" class="uk-width-medium-1-10">
                                    <select id="filter-gate_name" class="md-input" name="gate_name">
                                        <option disabled="" selected="" value="">Gate</option>
                                        @foreach( $gates as $item )
                                            <option value="{{$item['gate_name']}}">{{$item['gate_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="uk-form-help-block">Gate</span>
                                </div>
                                <div id="options-content" class="uk-width-medium-1-2">
                                    <button ng-click="readData()" class="md-btn md-btn-primary">Filter</button>
                                    <a href="{{ base_url("cms/$module") }}" class="md-btn">Reset</a>
                                    <a href="{{ base_url("cms/$module/add") }}" title="Add {{$subject}}" class="md-btn md-btn-success"><i class="material-icons">add</i> Add</a>
                                    <a href="{{ base_url("cms/$module/display") }}" title="Display {{$subject}}" class="md-btn"><i class="material-icons">visibility</i></a>
                                    {{-- <a target="_blank" href="{{ base_url("cms/$module/barcode") }}" title="Export Barcode {{$subject}}" class="md-btn"><i class="material-icons">play_for_work</i></a> --}}
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
                                <th>Title</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Min.Buy(Qty)</th>
                                <th>Category</th>
                                <th>Order</th>
                                <th>BarCode</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in data">
                                <td><input class="check_row" type="checkbox" ng-checked="checkbox" ng-click="updateSelection($event, t.product_id)" title="Select"></td>
                                <td>
                                    @{{t.product_title}}
                                    <br>
                                    <small ng-if="t.product_active==1"><span class="uk-badge uk-badge-success">Active</span></small>
                                    <small ng-if="t.product_active!=1"><span class="uk-badge uk-badge-danger">Not Active</span></small>
                                    <small ng-if="t.is_ticket==1"><span class="uk-badge uk-badge-primary">Ticket</span></small>
                                    <small ng-if="t.gate_name"><span class="uk-badge uk-badge-warning">@{{ t.gate_name }}</span></small>
                                </td>
                                <td>@{{t.product_stock}}</td>
                                <td>@{{t.product_price | number}}</td>
                                <td>@{{t.product_min | number}}</td>
                                <td>@{{t.category_name}}</td>
                                <td>@{{t.product_order}}</td>
                                <td>@{{t.product_code}}</td>
                                <td>
                                    <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                                        <button class="md-btn mdn-btn-small"> Actions <i class="material-icons">expand_more</i></button>
                                        <div class="uk-dropdown uk-dropdown-small uk-dropdown-bottom" style="">
                                            <ul class="uk-nav uk-nav-dropdown">
                                                <li class="edit-row">
                                                    <a href="{{ base_url("cms/$module/edit") }}/@{{t.product_id}}" title="Edit"><i class="material-icons">mode_edit</i> Edit</a>
                                                </li>
                                              {{--   <li class="price-row">
                                                    <a href="{{ base_url("cms/$module/price?product_id=") }}@{{t.product_id}}" title="Price"><i class="material-icons">build</i> Price</a>
                                                </li> --}}
                                                <li ng-click="deleteClick(t.product_id)">
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
                    updateSelected(action, entity.product_id);
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
                $scope.filter.category_id = $("#filter-category_id").val();
                $scope.filter.product_title = $("#filter-product_title").val();
                $scope.filter.gate_name = $("#filter-gate_name").val();
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
                $scope.filter.category_id = $("#filter-category_id").val();
                $scope.filter.product_title = $("#filter-product_title").val();
                $scope.filter.gate_name = $("#filter-gate_name").val();
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
                            $scope.alertMessage = response.data;
                            $scope.alertClass = 'uk-alert-danger';
                            $scope.alertBox = true;
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
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'uk-alert-danger';
                        $scope.alertBox = true;
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
