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
                                            <label class="uk-form-label" for="field-product_id">Product</label>
                                            <select id="field-product_id" class="md-input" data-ng-options="o.product_title for o in products" data-ng-model="selectedProduct"></select>
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-promo_discount">Promo Discount</label>
                                            <input class="md-input" id="field-promo_discount" name="promo_discount" type="number" value="" maxlength="3" />
                                        </div>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-promo_active">Promo Active</label >
                                            <p id="field-promo_active">
                                                <input type="radio" name="promo_active" value="1" id="field-promo_active-1" data-md-icheck />
                                                <label for="field-promo_active-1" class="inline-label">Yes</label>
                                                <input type="radio" name="promo_active" value="0" id="field-promo_active-2" data-md-icheck />
                                                <label for="field-promo_active-2" class="inline-label">No</label>
                                            </p>
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
                                    <label class="uk-form-label" for="field-promo_date_start">Promo Date Start</label>
                                    <input class="datepic" id="field-promo_date_start" name="promo_date_start" type="text" value="" maxlength="" />
                                </div>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-promo_date_end">Promo Date End</label>
                                    <input class="datepic" id="field-promo_date_end" name="promo_date_end" type="text" value="" maxlength="" />
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
            $scope.module = "{{$module}}";

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.products = [{
                'name':'Pilih Product',
                'id': 0
            }];
            $scope.selectedProduct = $scope.products[0];
            $scope.loadProducts = function () {
                $http({
                    method: 'GET',
                    url: base_url+"api/product"
                }).then(function successCallback(response) {
                    $scope.products = response.data;
                    $scope.selectedProduct = $scope.products[0];
                }, function errorCallback(response) {
                    alert("Terjadi kesalahan pada server, Silahkan coba lagi!");
                    console.log(response);
                });
            };
            $scope.loadProducts();

            $scope.mySave = function (redirect) {
                var formDataArray = $('#form').serializeArray();
                var formData = {};
                formDataArray.forEach(function(entry) {
                    formData[entry.name]=entry.value;
                });
                formData['product_id']=$scope.selectedProduct.product_id;
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
