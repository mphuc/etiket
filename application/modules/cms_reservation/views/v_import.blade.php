@extends('app')
@section('body')
    <div id="page_content" ng-controller="addController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_heading">
            <h1>Add <a href="cms/{{ $module }}" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
            </h1> <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">You can add new data in this form</span>
        </div>
        <div id="page_content_inner" style="display: none;">
            <form id="form">
                <div class="uk-grid uk-grid-medium ">
                    <div class="uk-width-xLarge-8-10 uk-width-large-7-10" >

                        <div ng-click="hideAlert()" ng-class="alertClass" ng-show="alertBox" class="uk-alert" data-uk-alert>
                            <div ng-bind-html="alertMessage"></div>
                        </div>

                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Download Template </h3>
                            </div>
                            <div class="md-card-content large-padding">
                                <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                    <div class="uk-width-large-1">
                                        <div class="uk-form-row">
                                            <div class="uk-width-medium-1-6">
                                                <a class="md-btn md-btn-primary md-btn-wave-light" href="{{base_url("cms/$module/template")}}">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Upload File (.xlsx) </h3>
                            </div>
                            <div class="md-card-content large-padding">
                                <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                    <div class="uk-width-large-1">
                                        <input type="hidden" name="upload" value="1">
                                        <div class="uk-form-row">
                                            <div id="reservation_field_box">
                                                <div id="reservation_input_box">
                                                    <span class="uk-form-file md-btn md-btn-primary">
                                                        <span>Upload a file</span>
                                                        <input type="file" data-column="reservation" class="gc-file-upload" file-model="reservation" ng-model="reservation" onchange="angular.element(this).scope().uploadImage(this.files,this)" name="reservation">
                                                        <input id="field_reservation" class="hidden-upload-input" type="hidden" name="reservation" value="">
                                                    </span>
                                                    <div id="success_reservation" class="upload-success-url" style="display:none;padding-top:7px;">
                                                        <a href="" id="file_reservation" class="open-file" target="_blank"></a>
                                                        <br>
                                                        <a href="javascript:void(0)" data-column="reservation" id="delete_reservation" data-filename="" ng-click="deleteFileClick($event)" class="md-btn md-btn-danger">delete</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <div ng-if="progressValue > 0" class="uk-progress">
                                    <div ng-style="progressStyle" class="uk-progress-bar" ng-bind-html="progressValue"></div>
                                </div>
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
        app.controller('addController',function($scope, $http, $q)
        {
            $scope.alertBox = false;
            $scope.spinner = true;
            $scope.data = [];
            $scope.columns = [];
            $scope.module = "{{$module}}";
            $scope.progressStyle = {'width':'0%'};
            $scope.progressValue = 0;
            var promises = [];

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            function asyncPost(formData) {
                var deferred = $q.defer();
                $http({
                    url: cms_url+"/import",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: formData
                }).then(function successCallback(response) {
                    if( response.status === 200 ){
                        var count = promises.length;
                        $scope.progressValue += parseInt(100/count);
                        $scope.progressStyle = {'width': $scope.progressValue+'%'};
                        deferred.resolve(formData);
                        console.log( formData );
                    }else{
                        deferred.reject('Form Data is not allowed.');
                    }
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
                return deferred.promise;
            }

            $scope.mySave = function (redirect) {

                angular.forEach($scope.data, function(value, key) {
                    promises.push( asyncPost(value) );
                });

                $q.all(promises).then(function(greeting) {
                    $scope.progressValue = 100;
                    $scope.progressStyle = {'width': $scope.progressValue+'%'};
                    /*if(redirect) window.location = cms_url;*/
                }, function(reason) {
                    $scope.alertMessage = reason;
                    $scope.alertClass = 'uk-alert-danger';
                    $scope.alertBox = true;
                }, function(update) {
                    $scope.alertMessage = update;
                    $scope.alertClass = 'uk-alert-danger';
                    $scope.alertBox = true;
                });
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
                        var result  = response.data;
                        $scope.data = result.data;

                        console.log(  result.data  );

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

            showBox();
        });

    </script>
@endsection
