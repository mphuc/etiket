@extends('app')
@section('body')
    <div id="page_content" ng-controller="addController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_heading">
            <h1>Add <a href="cms/{{ $module }}" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
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
                                            <label class="uk-form-label" for="field-nama">Nama</label>
                                            <input class="md-input" id="field-nama" name="nama" type="text" value="" maxlength="200" />
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-gender">Gender</label >
                                            <p id="field-gender">
                                                <input type="radio" name="gender" value="L" id="field-gender-1" data-md-icheck checked/>
                                                <label for="field-gender-1" class="inline-label">LAKI-LAKI</label>&nbsp;&nbsp;
                                                <input type="radio" name="gender" value="P" id="field-gender-2" data-md-icheck />
                                                <label for="field-gender-2" class="inline-label">PEREMPUAN</label>
                                            </p>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-phone">Phone</label>
                                            <input class="md-input" id="field-phone" name="phone" type="text" value="" maxlength="20" />
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-city">City</label>
                                            <select style="width: 100%" id="field-city" name="city" class="uk-width-1-1" data-md-select2 data-allow-clear="true" data-placeholder="city..."></select>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-address">Address</label>
                                            <input class="md-input" id="field-address" name="address" type="text" value="" maxlength="255" />
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-email">Email</label>
                                            <input class="md-input" id="field-email" name="email" type="text" value="" maxlength="50" />
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-facebook">Facebook</label>
                                            <input class="md-input" id="field-facebook" name="facebook" type="text" value="" maxlength="100" />
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-twitter">Twitter</label>
                                            <input class="md-input" id="field-twitter" name="twitter" type="text" value="" maxlength="100" />
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-instagram">Instagram</label>
                                            <input class="md-input" id="field-instagram" name="instagram" type="text" value="" maxlength="100" />
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
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-birthday">Birthday</label>
                                    <input class="datepic" id="field-birthday" name="birthday" type="text" value="" maxlength="" />
                                </div>
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
    <link rel="stylesheet" href="{{ base_url('themes/umbrella-back/2ndmaterial/bower_components/select2/dist/css/select2.min.css') }}">
@endsection
@section('script')
    <script src="{{ base_url('themes/umbrella-back/2ndmaterial/bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">

        $('#field-city').select2({
            ajax: {
                url: '{{base_url("api/area/cities")}}',
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });

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
                $scope.spinner = false;
                $http({
                    url: cms_url+"/add",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: formData
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    if( response.status === 200 ){
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'uk-alert-success';
                        $scope.alertBox = true;
                        document.getElementById("form").reset();
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
