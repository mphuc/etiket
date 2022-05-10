@extends('app')

@section('body')
    <div id="page_content" ng-controller="listController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_content_inner" style="display: none;">
            <h3 class="heading_b">Data {{ $subject }}</h3>
            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-1">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text"> Actions </h3>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-grid" data-uk-grid-margin="">
                                <div id="options-content" class="uk-width-medium-1-2">
                                    <a href="{{ base_url("cms/$module/add") }}" title="Add Post" class="md-btn"><i class="material-icons">add</i>Add {{ $subject }}</a>
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
                        <table class="uk-table uk-table-nowrap table_check" style="margin-bottom: 68px;">
                            <thead>
                            <tr>
                                <th>Module</th>
                                <th>Role Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in data">
                                <td>@{{t.alias}}</td>
                                <td>
                                    <button ng-if="t.menu==true" class="md-btn md-btn-default md-btn-wave-light waves-effect waves-button waves-light"><i class="fa fa-bars"></i> Menu</button>
                                    <button ng-if="t.add==true" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light"><i class="fa fa-plus-circle"></i> Add</button>
                                    <button ng-if="t.edit==true" class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light"><i class="fa fa-pencil"></i> Edit</button>
                                    <button ng-if="t.delete==true" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light"><i class="fa fa-trash"></i> Delete</button>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                        <button ng-click="deleteClick(t.value)" type="button" class="md-btn md-btn-danger md-btn-wave-light waves-effect waves-button waves-light" title="Delete">Delete</button>
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

        function toggle(source) {
            checkboxes = document.getElementsByClassName('role');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        var app = angular.module( '{{$module}}', ['ngSanitize']);
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

            $scope.readData = function() {
                $http({
                    method: 'GET',
                    url: cms_url+"/get"
                }).then(function successCallback(response) {
                    $scope.data = response.data.message;
                }, function errorCallback(response) {
                    console(JSON.parse(response));
                    UIkit.modal.alert('Oops error, please refresh this page');
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
                        console.log(JSON.parse(response));
                        UIkit.modal.alert('Oops error, please refresh this page');
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