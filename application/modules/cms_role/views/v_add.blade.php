@extends('app')

@section('body')
    <div id="page_content" ng-controller="addController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_heading">
            <h1>Add <a href="cms/{{$module}}" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
            </h1> <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">You can add new data in this form</span>
        </div>
        <div id="page_content_inner" style="display: none;">
            <form id="form" action="" method="post" class="form-div uk-form-stacked" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
                <div class="uk-grid uk-grid-medium ">
                    <div class="uk-width-xLarge-8-10 uk-width-large-7-10" >

                        <div ng-click="hideAlert()" ng-class="alertClass" ng-show="alertBox" class="uk-alert" data-uk-alert>
                            <div ng-bind-html="alertMessage"></div>
                        </div>

                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Form Detail </h3>
                            </div>
                            <div class="md-card-content large-padding">
                                <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                    <div class="uk-width-large-1">
                                        <div class="uk-form-row">
                                            <label for="input-alias">Alias</label>
                                            <input id="input-alias" class="md-input" name="alias" type="text" required>
                                        </div>

                                        <div class="uk-form-row">
                                            <label for="input-custom">Module Custom</label>
                                            <input id="input-custom" class="md-input" name="custom" type="text">
                                        </div>

                                        <div class="uk-form-row">
                                            <p class="text-bold">Role Type</p>
                                            <div class="radio">
                                                <label>
                                                    <input class="role" onclick="toggle(this)" type="checkbox">
                                                    Select All
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="checkbox" class="role" name="menu">
                                                    Menu
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="checkbox" class="role" name="add">
                                                    Add
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="checkbox" class="role" name="edit">
                                                    Edit
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="checkbox" class="role" name="delete">
                                                    Delete
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-xLarge-2-10 uk-width-large-3-10 uk-sortable sortable-handler" data-uk-grid-margin data-uk-sortable>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Form Detail </h3>
                            </div>
                            <div class="md-card-content">
                                <div class="uk-form-row" id="">
                                    <label for="module">Module Name</label>
                                    <select id="module" name="module" data-md-selectize>
                                        <option value="" disabled selected>Select Modules</option>
                                        @foreach ($modules as $value):?>
                                        <option value="{{$value}}">{{format_title($value)}}</option>
                                        @endforeach
                                    </select>
                                </div><br>
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
                                        <button class="md-btn md-btn-primary mdn-btn-small submit-form" ng-click="mySave()">Save</button>
                                        <button class="md-btn mdn-btn-small md-btn-success save-and-go-back-button" ng-click="mySaveBack()">Save & Back</button>
                                        <a href="cms/{{$module}}"
                                           class="md-btn mdn-btn-small return-to-list">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
        app.controller('addController',function($scope, $http)
        {
            $scope.alertBox = false;
            $scope.spinner = true;
            $scope.data = [];
            $scope.columns = [];
            $scope.module = '{{$module}}';

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.mySave = function () {
                var formDataArray = $('#form').serializeArray();
                var formData = {};
                formDataArray.forEach(function(entry) {
                    formData[entry.name]=entry.value;
                });
                $scope.spinner = false;
                $http({
                    url: cms_url+"/add",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: formData
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    var result = response.data;
                    if( result.status ){
                        $scope.alertMessage = result.message;
                        $scope.alertClass = 'uk-alert-success';
                        $scope.alertBox = true;
                        $(".upload-success-url").hide();
                        document.getElementById("form").reset();
                    }else{
                        $scope.alertMessage = result.message;
                        $scope.alertClass = 'uk-alert-danger';
                        $scope.alertBox = true;
                    }
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log('error : '+ JSON.stringify(response));
                    UIkit.modal.alert('Oops error, please refresh this page');
                });
            };

            $scope.mySaveBack = function () {
                var formDataArray = $('#form').serializeArray();
                var formData = {};
                formDataArray.forEach(function(entry) {
                    formData[entry.name]=entry.value;
                });
                $scope.spinner = false;
                $http({
                    url: cms_url+"/add",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: formData
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    var result = response.data;
                    if( result.status ){
                        window.location = cms_url;
                    }else{
                        $scope.alertMessage = result.message;
                        $scope.alertClass = 'uk-alert-danger';
                        $scope.alertBox = true;
                    }
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log('error : '+ JSON.stringify(response));
                    UIkit.modal.alert('Oops error, please refresh this page');
                });
            };

            showBox();
        });
    </script>
@endsection