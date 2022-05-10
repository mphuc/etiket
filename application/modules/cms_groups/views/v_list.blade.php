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
                                <div id="options-content" class="uk-width-medium-1-2">
                                    <a href="{{ base_url("cms/$module/add") }}" title="Add Post" class="md-btn md-btn-success"><i class="material-icons">add</i>Add </a>
                                    <button class="md-btn" data-uk-modal="{target:'#filtering-form-search'}"><i class="material-icons">search</i> Search</button>
                                    <button ng-click="readData()" class="md-btn md-btn-primary"><i class="material-icons">loop</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-modal" id="filtering-form-search" aria-hidden="true">
                <div class="uk-modal-dialog" style="top: -15.5px;">
                    <div class="uk-modal-header">
                        <div class="uk-clearfix">
                            <div class="uk-float-left">
                                <h3 class="uk-modal-title">Search {{ $subject }}</h3>
                            </div>
                            <div class="uk-float-right">
                                <a class="md-btn md-btn-flat md-btn-wave waves-effect waves-button uk-modal-close" href="javascript:void(0)"><i class="material-icons">close</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-medium-1">
                        <form autocomplete="off" accept-charset="utf-8">
                            <div class="uk-form-row">
                                <div class="md-input-wrapper">
                                    <label for="search_text">Search</label>
                                    <input ng-model="q" type="text" class="md-input" size="30" id="search_text">
                                    <span class="md-input-bar"></span>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <div class="md-input-wrapper">
                                    <select id="search-column" class="md-input">
                                        <option value="name">Name</option>
                                        <option value="description">Description</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div class="uk-width-medium-1">
                                        <input class="md-btn md-btn-primary uk-modal-close" type="button" value="Search" ng-click="searchClick()">
                                        <input class="md-btn md-btn-success uk-modal-close" type="reset" onclick="document.forms[0].reset();" ng-click="reset()" value="Clear filtering">
                                    </div>
                                </div>
                            </div>
                        </form>
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in data">
                                <td>@{{t.name}}</td>
                                <td>@{{t.description}}</td>
                                <td>
                                    <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                                        <button class="md-btn mdn-btn-small"> Actions <i class="material-icons">expand_more</i></button>
                                        <div class="uk-dropdown uk-dropdown-small uk-dropdown-bottom" style="">
                                            <ul class="uk-nav uk-nav-dropdown">
                                                <li>
                                                    <a href="{{ base_url("cms/$module/assign") }}/@{{t.id}}" title="Assign"><i class="material-icons">verified_user</i> Assign</a>
                                                </li>
                                                <li ng-if="t.name!='admin'" class="edit-row">
                                                    <a href="{{ base_url("cms/$module/edit") }}/@{{t.id}}" title="Edit"><i class="material-icons">mode_edit</i> Edit</a>
                                                </li>
                                                <li ng-if="t.name!='admin' && t.name!='loket' && t.name!='reservasi'" ng-click="deleteClick(t.id)">
                                                    <a title="Delete"><i class="material-icons">delete_forever</i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
            $scope.group = {};

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
                    updateSelected(action, entity.id);
                }
            };

            $scope.getSelectedClass = function(entity) {
                return $scope.isSelected(entity.id) ? 'selected' : '';
            };
            /*--------checkbox operation----------*/

            $scope.readData = function(page) {
                $scope.spinner = false;
                $scope.filter.limit = $scope.perPage;
                if( page ) $scope.filter.page = page;
                if( $scope.is_search ){
                    $scope.filter.col   = $scope.selectedOption;
                    $scope.filter.q     = $scope.q;
                }
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
                if( $scope.is_search ){
                    $scope.filter.col   = $scope.selectedOption;
                    $scope.filter.q     = $scope.q;
                }
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

            $scope.selectedClick = function(id) {
                angular.forEach($scope.data, function(value, key) {
                    if( id === value.id ) $scope.group = value;
                });
            };

            $scope.assignClick = function(group) {
                $scope.spinner = false;
                var req = {};
                req.user  = 1;
                req.group = group;
                var params = $.param( req );
                $http({
                    method: 'GET',
                    url: cms_url+"/assign?"+params
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
