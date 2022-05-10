@extends('app')
@section('body')
    <div id="page_content" ng-controller="editController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_heading">
            <h1>Edit <a href="cms/{{ $module }}" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
            </h1> <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">You can add new data in this form</span>
        </div>
        <div id="page_content_inner" style="display: none;">
            <form id="form" action="" method="post" class="form-div uk-form-stacked" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
                <input type="hidden" name="id" value="{{ $row[$pk] }}">
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
                                            <label class="uk-form-label" for="field-name">Name</label>
                                            <input class="md-input" id="field-name" name="name" type="text" value="{{$row["name"]}}" maxlength="20" @if( $row['name']=='admin' || $row['name']=='members' || $row['name']=='loket' || $row['name']=='reservasi' ) disabled @endif>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-description">Description</label>
                                            <input class="md-input" id="field-description" name="description" type="text" value="{{$row["description"]}}" maxlength="100" >
                                        </div>
                                        <div class="uk-form-row" id="roles_field_box">
                                            <div class="md-input-wrapper md-input-filled">
                                                <select style="width: 100%" id="field-roles" multiple data-md-select2 data-allow-clear="true" data-placeholder="Select roles...">
                                                    @foreach( $roles as $v )
                                                        <option value="{{$v['setting_id']}}" @if(in_array($v['setting_id'], $selected_roles)) selected @endif>{{$v['setting_name']}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="md-input-bar "></span>
                                            </div>
                                            <span class="uk-form-help-block">Roles</span>
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

        </div>
    </div>
@endsection
@section('head')
    <link rel="stylesheet" href="{{assets_back()}}bower_components/select2/dist/css/select2.min.css">
@endsection
@section('script')
    <script src="{{assets_back()}}bower_components/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $("#field-roles").select2();
        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        var app = angular.module( '{{$module}}', ['ngSanitize']);
        app.controller('editController',function($scope, $http)
        {
            $scope.alertBox = false;
            $scope.spinner = true;
            $scope.data = [];
            $scope.columns = [];
            $scope.module = "{{$module}}";

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.mySave = function (redirect) {
                var formDataArray = $('#form').serializeArray();
                var formData = {};
                formDataArray.forEach(function(entry) {
                    formData[entry.name]=entry.value;
                });
                formData['roles']=$("#field-roles").val();
                $scope.spinner = false;
                $http({
                    url: cms_url+"/edit",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: formData
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    if( response.status === 200 ){
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'uk-alert-success';
                        $scope.alertBox = true;
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
