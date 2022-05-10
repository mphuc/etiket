@extends('app')
@section('body')
    <div id="page_content" ng-controller="displayController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_heading">
            <h1>Display Product by Vendor <a href="cms/{{ $module }}" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
            </h1> <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">You can edit promo data in this form</span>
        </div>
        <div id="page_content_inner" style="display: none;">
            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-1">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text"> Actions </h3>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-grid" data-uk-grid-margin="">
                                @foreach($vendors as $k => $v)
                                <div id="options-content" class="uk-width-medium-1-10">
                                    <a href="{{base_url("cms/$module/display?vendor=".$v['vendor_slug'])}}" class="md-btn @if($selected_vendor['vendor_slug']==$v['vendor_slug']) md-btn-success @endif"> {{$v['vendor_name']}}</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="uk-grid uk-grid-medium ">
                    <div class="uk-width-xLarge-12-12 uk-width-large-12-12">
                        <div ng-click="hideAlert()" ng-class="alertClass" ng-show="alertBox" class="uk-alert" data-uk-alert>
                            <div ng-bind-html="alertMessage"></div>
                        </div>
                        <div class="md-card uk-margin-medium-bottom">
                            <div class="md-card-content">
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <h3>{{$selected_vendor['vendor_name']}}</h3>
                                        <form method="post" action="">
                                            <input type="hidden" name="vendor" value="{{$selected_vendor['vendor_slug']}}" required>
                                            @foreach($products as $p)
                                                <p>
                                                    <input value="1" type="checkbox" name="{{$p['product_id']}}" id="{{$selected_vendor['vendor_slug']}}-{{$p['product_id']}}" data-md-icheck @if(@$display[$selected_vendor['vendor_slug']][$p['product_id']] == 1) checked @endif/>
                                                    <label for="{{$selected_vendor['vendor_slug']}}-{{$p['product_id']}}" class="inline-label">{{$p['product_title']}}</label>
                                                </p>
                                            @endforeach
                                            <hr>
                                                <div class="md-card-toolbar">
                                                    <div class="uk-grid" data-uk-grid-margin="">
                                                        <div id="options-content" class="uk-width-medium-1">
                                                            <button type="submit" class="md-btn md-btn-primary mdn-btn-small submit-form">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

        var app = angular.module('{{$module}}', ['ngSanitize']);
        app.controller('displayController', function ($scope, $http) {
            $scope.spinner = true;
            $scope.module = "{{$module}}";
            $scope.alertBox = false;

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };
            showBox();
        });

    </script>
@endsection
