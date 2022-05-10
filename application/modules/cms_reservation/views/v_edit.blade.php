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
                <input type="hidden" name="res_id" value="{{ $row[$pk] }}">
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
                                            <label class="uk-form-label" for="field-res_customer">Customer</label>
                                            <input class="md-input" id="field-res_customer" name="res_customer" type="text" value="{{$row["res_customer"]}}" maxlength="50" >
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_dp">Dp</label>
                                            <input class="md-input" id="field-res_dp" name="res_dp" type="number" value="{{$row["res_dp"]}}" maxlength="11" disabled/>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_pelunasan">Pelunasan</label>
                                            <input class="md-input" id="field-res_pelunasan" name="res_pelunasan" type="number" value="{{$row["res_pelunasan"]}}" maxlength="11" disabled/>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_dp_type">Dp Type</label>
                                            <input class="md-input" id="field-res_dp_type" name="res_dp_type" type="text" value="{{$row["res_dp_type"]}}" maxlength="100" >
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_dp_bank">Dp Bank</label>
                                            <input class="md-input" id="field-res_dp_bank" name="res_dp_bank" type="text" value="{{$row["res_dp_bank"]}}" maxlength="100" >
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_pelunasan_type">Pelunasan Type</label>
                                            <input class="md-input" id="field-res_pelunasan_type" name="res_pelunasan_type" type="text" value="{{$row["res_pelunasan_type"]}}" maxlength="100" >
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_pelunasan_bank">Pelunasan Bank</label>
                                            <input class="md-input" id="field-res_pelunasan_bank" name="res_pelunasan_bank" type="text" value="{{$row["res_pelunasan_bank"]}}" maxlength="100" >
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_note_operasional">Note Operasional</label>
                                            <textarea class="md-input" id="field-res_note_operasional" name="res_note_operasional" maxlength="res_note_operasional">{{$row["res_note_operasional"]}}</textarea>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_note_teknik">Note Teknik</label>
                                            <textarea class="md-input" id="field-res_note_teknik" name="res_note_teknik" maxlength="res_note_teknik">{{$row["res_note_teknik"]}}</textarea>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_note_bus">Note Bus</label>
                                            <textarea class="md-input" id="field-res_note_bus" name="res_note_bus" maxlength="res_note_bus">{{$row["res_note_bus"]}}</textarea>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_note_tambahan">Note Tambahan</label>
                                            <textarea class="md-input" id="field-res_note_tambahan" name="res_note_tambahan" maxlength="res_note_tambahan">{{$row["res_note_tambahan"]}}</textarea>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_souvenir_tour">Souvenir Tour</label>
                                            <input class="md-input" id="field-res_souvenir_tour" name="res_souvenir_tour" type="text" value="{{$row["res_souvenir_tour"]}}" maxlength="100" >
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_souvenir_panggung">Souvenir Panggung</label>
                                            <input class="md-input" id="field-res_souvenir_panggung" name="res_souvenir_panggung" type="text" value="{{$row["res_souvenir_panggung"]}}" maxlength="100" >
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-bus_1">Bus 1</label>
                                            <input class="md-input" id="field-bus_1" name="bus_1" type="text" value="{{$row["bus_1"]}}" maxlength="100" >
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-bus_2">Bus 2</label>
                                            <input class="md-input" id="field-bus_2" name="bus_2" type="text" value="{{$row["bus_2"]}}" maxlength="100" >
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_driver_price">Driver Price</label>
                                            <input class="md-input" id="field-res_driver_price" name="res_driver_price" type="number" value="{{$row["res_driver_price"]}}" maxlength="11" disabled/>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_bus_price">Bus Price</label>
                                            <input class="md-input" id="field-res_bus_price" name="res_bus_price" type="number" value="{{$row["res_bus_price"]}}" maxlength="11" disabled/>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_total_person">Total Person</label>
                                            <input class="md-input" id="field-res_total_person" name="res_total_person" type="number" value="{{$row["res_total_person"]}}" maxlength="11" />
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_kabupaten">Kabupaten</label>
                                            <input class="md-input" id="field-res_kabupaten" name="res_kabupaten" type="text" value="{{$row["res_kabupaten"]}}" maxlength="255" >
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_biro">Biro</label>
                                            <input class="md-input" id="field-res_biro" name="res_biro" type="text" value="{{$row["res_biro"]}}" maxlength="255" >
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_total_box">Total Box</label>
                                            <input class="md-input" id="field-res_total_box" name="res_total_box" type="number" value="{{$row["res_total_box"]}}" maxlength="11" />
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-res_tempat">Tempat</label>
                                            <input class="md-input" id="field-res_tempat" name="res_tempat" type="text" value="{{$row["res_tempat"]}}" maxlength="255" >
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
                                    <label class="uk-form-label" for="field-res_dp_date">Res Dp Date</label>
                                    <input class="datepic" id="field-res_dp_date" name="res_dp_date" type="text" value="{{$row["res_dp_date"]}}" >
                                </div><br>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-res_pelunasan_date">Res Pelunasan Date</label>
                                    <input class="datepic" id="field-res_pelunasan_date" name="res_pelunasan_date" type="text" value="{{$row["res_pelunasan_date"]}}" >
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
