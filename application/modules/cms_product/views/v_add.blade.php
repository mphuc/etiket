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
                                            <label class="uk-form-label" for="field-product_title">Title</label>
                                            <input class="md-input" id="field-product_title" name="product_title" type="text" value="" maxlength="255" />
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="product_desc">Descripstion</label>
                                            <textarea class="md-input" id="product_desc" name="product_desc"></textarea>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-product_price">Price</label>
                                            <input class="md-input numeric" id="field-product_price" name="product_price" type="text" value="0" autocomplete="off"/>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-product_min">Min (Min.Buy)</label>
                                            <input class="md-input" id="field-product_min" name="product_min" type="number" value="1" min="1" autocomplete="off"/>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-product_stock">Stock</label>
                                            <input class="md-input" id="field-product_stock" name="product_stock" type="number" value="1" min="1" autocomplete="off"/>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-product_active">Active</label >
                                            <p id="field-product_active">
                                                <input type="radio" name="product_active" value="1" id="field-product_active-1" data-md-icheck checked/>
                                                <label for="field-product_active-1" class="inline-label">Yes</label>&nbsp;&nbsp;
                                                <input type="radio" name="product_active" value="0" id="field-product_active-2" data-md-icheck />
                                                <label for="field-product_active-2" class="inline-label">No</label>
                                            </p>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-is_ticket">Ticket</label>
                                            <p id="field-is_ticket">
                                                <input type="radio" name="is_ticket" value="1" id="field-is_ticket-1" data-md-icheck checked>
                                                <label for="field-is_ticket-1" class="inline-label">Yes</label>&nbsp;&nbsp;
                                                <input type="radio" name="is_ticket" value="0" id="field-is_ticket-2" data-md-icheck>
                                                <label for="field-is_ticket-2" class="inline-label">No</label>
                                            </p>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-gate_name">Access Gate</label>
                                            <p id="field-gate_name">
                                                @foreach($gate as $k => $v)
                                                    <input type="radio" name="gate_name" value="{{$v['gate_name']}}" id="field-gate_name-{{$k}}" data-md-icheck checked>
                                                    <label for="field-gate_name-{{$k}}" class="inline-label">{{$v['gate_desc']}}</label>
                                                    <br>
                                                @endforeach
                                            </p>
                                        </div>

                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-product_code">BarCode</label>
                                            <input class="md-input" id="field-product_code" name="product_code" type="text" value="" autocomplete="off"/>
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
                                    <label for="product_order">Order</label>
                                    <input id="product_order" name="product_order" value="{{$count+1}}" class="md-input" required>
                                </div>
                                <div class="uk-form-row">
                                    <label for="category">Category</label>
                                    <select id="category" name="category_id" class="md-input" data-md-selectize>
                                        @foreach($categories as $v)
                                        <option value="{{$v['category_id']}}">{{$v['category_name']}}</option>
                                        @endforeach
                                    </select>
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
                        $("#success_"+field).hide();
                        $("#field_"+field).val(response.data.file_name);
                    }, function errorCallback(response) {
                        $scope.spinner = true;
                        console.log(response);
                    });
                });
            };

            $scope.uploadImage = function (files,item) {
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
                        if( response.status === 200 ){
                            $("#success_"+field).show();
                            $("#file_"+field).html( response.data.file_name ).attr('href', base_url+'assets/uploads/'+response.data.file_name);
                            $("#delete_"+field).attr('data-filename', response.data.file_name);
                            $("#field_"+field).val(response.data.file_name);
                        }else{
                            $scope.alertMessage = response.data;
                            $scope.alertClass = 'uk-alert-danger';
                            $scope.alertBox = true;
                        }
                    }, function errorCallback(response) {
                        $scope.spinner = true;
                        console.log(response);
                    });
                }
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
