@extends('app')
@section('body')
    <div id="page_content" ng-controller="addController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_heading">
            <h1>Add {{$subject}} <a href="cms/{{ $module }}" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
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
                                        <div class="uk-form-row" id="username_field_box">
                                            <label id="username_display_as_box" for="field-username">Username</label>
                                            <input class="md-input" id="field-username" name="username" type="text" value="" maxlength="100" required/>
                                        </div>

                                        <div class="uk-form-row" id="email_field_box">
                                            <label id="email_display_as_box" for="field-email">Email</label>
                                            <input class="md-input" id="field-email" name="email" type="text" value="" maxlength="100" required/>
                                        </div>

                                        <div class="uk-form-row" id="user_display_name_field_box">
                                            <label id="user_display_name_display_as_box" for="field-user_display_name">Full Name</label>
                                            <input class="md-input" id="field-user_display_name" name="user_display_name" type="text" value="" maxlength="150" required/>
                                        </div>

                                        <div class="uk-form-row" id="active_field_box">
                                            <label id="activedisplay_as_box" for="field-active">Active</label>
                                            <p id="field-active">
                                                <input type="radio" name="active" value="1" id="field-active-1" data-md-icheck />
                                                <label for="field-active-1" class="inline-label">Yes</label>
                                                <input type="radio" name="active" value="0" id="field-active-2" data-md-icheck />
                                                <label for="field-active-2" class="inline-label">No</label>
                                            </p>
                                        </div>

                                        <div class="uk-form-row" id="user_gender_field_box">
                                            <label id="user_genderdisplay_as_box" for="field-user_gender">User Gender</label>
                                            <p id="field-user_gender">
                                                <input type="radio" name="user_gender" value="male" id="field-user_gender-1" data-md-icheck />
                                                <label for="field-user_gender-1" class="inline-label">Male</label>&nbsp;
                                                <input type="radio" name="user_gender" value="female" id="field-user_gender-2" data-md-icheck />
                                                <label for="field-user_gender-2" class="inline-label">Female</label>
                                            </p>
                                        </div>

                                        <div class="uk-form-row" id="user_mobile_field_box">
                                            <label id="user_mobile_display_as_box" for="field-user_mobile">User Mobile</label>
                                            <input class="md-input" id="field-user_mobile" name="user_mobile" type="text" value="" maxlength="14" />
                                        </div>

                                        <div class="uk-form-row" id="password_field_box">
                                            <label id="password_display_as_box" for="field-password">Password</label>
                                            <input class="md-input" id="field-password" name="password" type="password" value="" maxlength="250" required/>
                                        </div>

                                        <div class="uk-form-row" id="group_field_box">
                                            <div class="md-input-wrapper md-input-filled">
                                                <select class="multi-s" id="field-groups" multiple>
                                                    @foreach( $groups as $v )
                                                        <option value="{{$v['id']}}" @if( in_array($v['id'], $selected_groups) ) selected @endif>{{$v['name']}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="md-input-bar "></span>
                                            </div>
                                            <span class="uk-form-help-block">Groups</span>
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

                                <div class="uk-form-row" id="user_date_birth_field_box">
                                    <label id="user_date_birth_display_as_box" for="field-user_date_birth">User Date Birth</label>
                                    <input class="datepic" id="field-user_date_birth" name="user_date_birth" type="text" value="" maxlength="" />
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Form Detail </h3>
                            </div>
                            <div class="md-card-content">
                                <div id="user_avatar_field_box">
                                    <div id="user_avatar_display_as_box"> User Avatar : </div>
                                    <div id="user_avatar_input_box">
                                                    <span class="uk-form-file md-btn md-btn-primary">
                                                        <span>Upload a file</span>
                                                        <input type="file" data-column="user_avatar" class="gc-file-upload" file-model="user_avatar" ng-model="user_avatar" onchange="angular.element(this).scope().uploadImage(this.files,this)" name="user_avatar">
                                                        <input id="field_user_avatar" class="hidden-upload-input" type="hidden" name="user_avatar" value="">
                                                    </span>
                                        <div id="success_user_avatar" class="upload-success-url" style="display:none;padding-top:7px;">
                                            <a href="" id="file_user_avatar" class="open-file" target="_blank"></a>
                                            <br>
                                            <a href="javascript:void(0)" data-column="user_avatar" id="delete_user_avatar" data-filename="" ng-click="deleteFileClick($event)" class="md-btn md-btn-danger">delete</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
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
    <script src="{{ base_url('assets/grocery_crud/texteditor/ckeditor/ckeditor.js') }}"></script>
@endsection
@section('script')
    <script type="text/javascript">
        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        var app = angular.module( '{{$module}}', ['ngSanitize']);
        app.controller('addController',function($scope, $http)
        {
            $scope.alertBox = false;
            $scope.spinner = true;
            $scope.data = [];
            $scope.columns = [];
            $scope.module = 'users';

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.deleteFileClick = function (event) {
                var item = event.target;
                var file_name = item.attributes['data-filename'].value;
                var field = item.attributes['data-column'].value;
                UIkit.modal.confirm('Apakah anda yakin ingin menghapus file ini?', function(){
                    $scope.spinner = false;
                    $http({
                        method: 'GET',
                        url: cms_url+"/upload/"+file_name
                    }).then(function successCallback(response) {
                        $scope.spinner = true;
                        var result = response.data;
                        $("#success_"+field).hide();
                        $("#field_"+field).val(result.message.file_name);
                    }, function errorCallback(response) {
                        $scope.spinner = true;
                        console.log(response);
                    });
                });
            };

            $scope.uploadImage = function (files,item) {
                $scope.spinner = false;
                var field = item.attributes['data-column'].value;
                if( files.length ){
                    var fd = new FormData();
                    fd.append("file", files[0]);
                    var uploadUrl = cms_url+"/upload";

                    $http.post(uploadUrl, fd, {
                        withCredentials: true,
                        headers: {'Content-Type': undefined },
                        transformRequest: angular.identity
                    }).then(function successCallback(response) {
                        $scope.spinner = true;
                        var result = response.data;
                        if( result.status ){
                            $("#success_"+field).show();
                            $("#file_"+field).html( result.message.file_name ).attr('href', base_url+'assets/uploads/'+result.message.file_name);
                            $("#delete_"+field).attr('data-filename', result.message.file_name);
                            $("#field_"+field).val(result.message.file_name);
                        }else{
                            $scope.alertMessage = result.message;
                            $scope.alertClass = 'uk-alert-danger';
                            $scope.alertBox = true;
                        }
                    }, function errorCallback(response) {
                        $scope.spinner = true;
                        console.log(response);
                    });
                }
            };

            $scope.mySave = function (redirect=false) {
                var formDataArray = $('#form').serializeArray();
                var formData = {};
                formDataArray.forEach(function(entry) {
                    formData[entry.name]=entry.value;
                });
                formData['groups']=$("#field-groups").val();
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
                        document.getElementById("form").reset();
                        if( redirect ) window.location = cms_url;
                    }else{
                        $scope.alertMessage = result.message;
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
