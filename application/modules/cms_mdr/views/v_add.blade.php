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
                                            <label class="uk-form-label" for="field-bank_name">Bank Name</label>
                                            <select class="md-input" name="id_bank" id="id_bank" style="margin-top: 20px;" onclick="cekBank()">
                                                <option value="">-- Bank --</option>
                                                @foreach ($bank as $item)
                                                    <option value="{{ $item->bank_id }}" nama="{{ $item->bank_name }}" id_card="{{ $item->id_card_type }}" name_card="{{ $item->card_type_name }}">{{ $item->bank_name }} - {{ $item->card_type_name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="mdr_bank" id="mdr_bank" readonly> 
                                            <input type="hidden" name="id_card_type" id="id_card_type" readonly> 
                                            <input type="hidden" name="mdr_card_type" id="mdr_card_type" readonly> 
                                        </div>
                                        {{-- <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-bank_order">Type Card</label>
                                            <select class="md-input" name="id_card_type" id="id_card_type" style="margin-top: 20px;" onclick="cekCard()">
                                                <option value="">-- Type Card --</option>
                                                @foreach ($type_card as $item)
                                                    <option value="{{ $item->card_type_id }}" nama="{{ $item->card_type_name }}">{{ $item->card_type_name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="mdr_card_type" id="mdr_card_type" readonly>                                            
                                        </div> --}}
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-bank_order">Value MDR</label>
                                            <input type="number" class="md-input" name="mdr_value" id="mdr_value" maxlength="4">
                                            
                                        </div>
                                        {{-- <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-bank_order">Payee Name</label>
                                            <select class="md-input" name="" id="" style="margin-top: 20px;">
                                                <option value="">-- Paye Name --</option>
                                                @foreach ($payee as $item)
                                                    <option value="">{{ $item->payee_name }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
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
    <script src="{{ base_url('assets/grocery_crud/texteditor/ckeditor/ckeditor.js') }}"></script>
@endsection
@section('script')
    <script type="text/javascript">
        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        // function hanyaAngka(evt) {
		//   var charCode = (evt.which) ? evt.which : event.keyCode
		//    if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		//     return false;
		//   return true;
        // }
        
        function cekBank(){
            var bank_name = $('#id_bank option:selected').attr('nama');
            var id_card = $('#id_bank option:selected').attr('id_card');
            var card_name = $('#id_bank option:selected').attr('name_card');

            $('#mdr_bank').val(bank_name);
            $('#id_card_type').val(id_card);
            $('#mdr_card_type').val(card_name);
            
        }

        function cekCard(){
            var card_name = $('#id_card_type option:selected').attr('nama');

            $('#mdr_card_type').val(card_name);
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
