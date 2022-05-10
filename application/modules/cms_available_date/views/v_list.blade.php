@extends('app')
@section('body')
    <div id="page_content" ng-controller="listController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_content_inner" style="display: none;">
            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-1">

                    @php
                        $CI = &get_instance();
                        if($CI->session->flashdata('success')){
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>".$CI->session->flashdata('success')."</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
                        }
                        else if($CI->session->flashdata('error')){
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>".$CI->session->flashdata('error')."</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
                        }
                    @endphp

                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text"> Setting Date </h3>
                        </div>
                        <div class="md-card-content">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Holiday</a>
                                    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Available Days</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="margin: 20px;">

                                    <form action="cms/available_date/add" method="POST">
                                        <div class="form-row">
                                          <div class="form-group col-md-3">
                                            <label for="date">Date</label>
                                            <input type="date" class="form-control" name="date" id="date" onkeydown="return false" required>
                                          </div>
                                          <div class="form-group col-md-9">
                                            <label for="desc">Description</label>
                                            <input type="text" class="form-control" name="desc" id="desc" required>
                                          </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </form>

                                    <div class="card mt-3">
                                        <div class="card-header">
                                            List
                                        </div>
                                        <div class="card-body">
                                            <table class="uk-table uk-table-nowrap table_check uk-table-striped" style="margin-bottom: 68px;">
                                                <thead>
                                                    <tr>
                        
                                                        <th>Date</th>
                        
                                                        <th>Description</th>
                        
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="t in data">                   
                    
                                                        <td>@{{t.holiday_date}}</td>
                    
                                                        <td>@{{t.holiday_desc}}</td>
                    
                                                        <td>
                                                            <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                                                                <button class="md-btn mdn-btn-small"> Actions <i class="material-icons">expand_more</i></button>
                                                                <div class="uk-dropdown uk-dropdown-small uk-dropdown-bottom" style="">
                                                                    <ul class="uk-nav uk-nav-dropdown">
                                                                        <li ng-click="deleteClick(t.holiday_id)">
                                                                            <a href="" title="Delete"><i class="material-icons">delete_forever</i> Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                    
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="uk-grid" data-uk-grid-margin="" style="margin-top: 30px;">
                                                <div class="uk-width-large-1-4 uk-width-medium-1-2">
                                                    <div class="uk-input-group">
                                                        <select class="md-input" ng-change="changedPerPage()" data-ng-options="o.name for o in optionPerPage" data-ng-model="selectedOptionPerPage"></select>
                                                    </div>
                                                </div>
                                                <div class="uk-width-large-1-4 uk-width-medium-1-2">
                                                    <div style="margin-top:15px;" class="uk-input-group"> Page <span id="page-starts-from">@{{pageStart}}</span> from <span id="total_items">@{{maxPage}}</span> Total Pages</div>
                                                </div>
                                                <div class="uk-width-large-1-4 uk-width-medium-1-2">
                                                    <div class="uk-input-group">
                                                        <div class="md-input-wrapper md-input-filled">
                                                            <input class="md-input" name="tb_crud_page" type="text" value="@{{pageStart}}" id="tb_crud_page" disabled>
                                                            <span class="md-input-bar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-large-1-4 uk-width-medium-1-2">
                                                    <div style="margin-top:15px;" class="uk-input-group"> Total Data @{{ totalRows | number }}</div>
                                                </div>
                                            </div>
                        
                                            <ul class="pager" style="text-align: center;">

                                                <li class="md-btn md-btn-wave" ng-click="prevPageClick()"><a href="" >« Prev</a></li>
                                                <li class="md-btn md-btn-wave" ng-click="nextPageClick()"><a href="" >Next »</a></li>
                                            </ul>
                                        </div>
                                    </div>   

                                </div>

                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" style="margin: 20px;">
                                         
                                    <form>
                                        <div class="form-group row">
                                            <label for="sunday" class="col-sm-1 col-form-label">Sunday</label>
                                            <div class="col-sm-2">
                                                <select name="sunday" class="form-control" id="sunday" onchange="updateSunday()">
                                                    <option value="-1" {{ $sun == -1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $sun == 0 ? 'selected' : '' }}>Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="monday" class="col-sm-1 col-form-label">Monday</label>
                                            <div class="col-sm-2">
                                                <select name="monday" class="form-control" id="monday" onchange="updateMonday()">
                                                    <option value="-1" {{ $mon == -1 ? 'selected' : '' }}>Active</option>
                                                    <option value="1" {{ $mon == 1 ? 'selected' : '' }}>Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tuesday" class="col-sm-1 col-form-label">Tuesday</label>
                                            <div class="col-sm-2">
                                                <select name="tuesday" class="form-control" id="tuesday" onchange="updateTuesday()">
                                                    <option value="-1" {{ $tue == -1 ? 'selected' : '' }}>Active</option>
                                                    <option value="2" {{ $tue == 2 ? 'selected' : '' }}>Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="wednesday" class="col-sm-1 col-form-label">Wednesday</label>
                                            <div class="col-sm-2">
                                                <select name="wednesday" class="form-control" id="wednesday" onchange="updateWednesday()">
                                                    <option value="-1" {{ $wed == -1 ? 'selected' : '' }}>Active</option>
                                                    <option value="3" {{ $wed == 3 ? 'selected' : '' }}>Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="thursday" class="col-sm-1 col-form-label">Thursday</label>
                                            <div class="col-sm-2">
                                                <select name="thursday" class="form-control" id="thursday" onchange="updateThursday()">
                                                    <option value="-1" {{ $thu == -1 ? 'selected' : '' }}>Active</option>
                                                    <option value="4" {{ $thu == 4 ? 'selected' : '' }}>Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="friday" class="col-sm-1 col-form-label">Friday</label>
                                            <div class="col-sm-2">
                                                <select name="friday" class="form-control" id="friday" onchange="updateFriday()">
                                                    <option value="-1" {{ $fri == -1 ? 'selected' : '' }}>Active</option>
                                                    <option value="5" {{ $fri == 5 ? 'selected' : '' }}>Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="saturday" class="col-sm-1 col-form-label">Saturday</label>
                                            <div class="col-sm-2">
                                                <select name="saturday" class="form-control" id="saturday" onchange="updateSaturday()">
                                                    <option value="-1" {{ $sat == -1 ? 'selected' : '' }}>Active</option>
                                                    <option value="6" {{ $sat == 6 ? 'selected' : '' }}>Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
                                            <div class="col-3" align="right">
                                                <button type="submit" class="btn btn-success">Save Change</button>
                                            </div>                                            
                                        </div> --}}
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
        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 3000);
        });
    
        function updateSunday(){
            var value = $('#sunday').val();

            $.ajax({
                url     : "cms/available_date/change",
                type    : "post",
                data    : {
                    days    : 'sunday',
                    status  : value                
                },
                async   : true,
                dataType  : "json",
            });
        }

        function updateMonday(){
            var value = $('#monday').val();

            $.ajax({
                url     : "cms/available_date/change",
                type    : "post",
                data    : {
                    days    : 'monday',
                    status  : value                
                },
                async   : true,
                dataType  : "json",
            });
        }

        function updateTuesday(){
            var value = $('#tuesday').val();

            $.ajax({
                url     : "cms/available_date/change",
                type    : "post",
                data    : {
                    days    : 'tuesday',
                    status  : value                
                },
                async   : true,
                dataType  : "json",
            });
        }

        function updateWednesday(){
            var value = $('#wednesday').val();

            $.ajax({
                url     : "cms/available_date/change",
                type    : "post",
                data    : {
                    days    : 'wednesday',
                    status  : value                
                },
                async   : true,
                dataType  : "json",
            });
        }

        function updateThursday(){
            var value = $('#thursday').val();

            $.ajax({
                url     : "cms/available_date/change",
                type    : "post",
                data    : {
                    days    : 'thursday',
                    status  : value                
                },
                async   : true,
                dataType  : "json",
            });
        }

        function updateFriday(){
            var value = $('#friday').val();

            $.ajax({
                url     : "cms/available_date/change",
                type    : "post",
                data    : {
                    days    : 'friday',
                    status  : value                
                },
                async   : true,
                dataType  : "json",
            });
        }

        function updateSaturday(){
            var value = $('#saturday').val();

            $.ajax({
                url     : "cms/available_date/change",
                type    : "post",
                data    : {
                    days    : 'saturday',
                    status  : value                
                },
                async   : true,
                dataType  : "json",
            });
        }
        
        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        var app = angular.module( '{{ $module }}', ['ngSanitize']);
        app.controller('listController',function($scope, $http)
        {
            $scope.spinner = true;
            $scope.perPage = 20;
            $scope.totalRows = 0;
            $scope.pageStart = 1;
            $scope.pageEnd = 0;
            $scope.data = [];
            $scope.columns = [];
            $scope.maxPage = 0;
            $scope.is_search = false;
            $scope.selected = [];
            $scope.alertBox = false;
            $scope.filter = {};

            /*-------start checkbox operation---------*/
            var updateSelected = function(action, id) {
                if (action === 'add' && $scope.selected.indexOf(id) === -1) {
                    $scope.selected.push(id);
                }
                if (action === 'remove' && $scope.selected.indexOf(id) !== -1) {
                    $scope.selected.splice($scope.selected.indexOf(id), 1);
                }
            };

            $scope.updateSelection = function($event, id) {
                var checkbox = $event.target;
                var action = (checkbox.checked ? 'add' : 'remove');
                updateSelected(action, id);
            };

            $scope.selectAll = function($event) {
                var checkbox = $event.target;
                var action = (checkbox.checked ? 'add' : 'remove');
                for ( var i = 0; i < $scope.data.length; i++) {
                    var entity = $scope.data[i];
                    updateSelected(action, entity.id);
                }
            };

            $scope.getSelectedClass = function(entity) {
                return $scope.isSelected(entity.id) ? 'selected' : '';
            };
            /*--------checkbox operation----------*/

            $scope.readData = function(page) {
                $scope.spinner = false;
                $scope.filter.limit = $scope.perPage;
                if( page ) $scope.filter.page = page;
                if( $scope.is_search ){
                    $scope.filter.col   = $scope.selectedOption;
                    $scope.filter.q     = $scope.q;
                }
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/get?"+params
                }).then(function successCallback(response) {
                    $scope.data = response.data;
                    $scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                    $scope.updateRowData();
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            $scope.updateRowData = function() {
                if( $scope.is_search ){
                    $scope.filter.col   = $scope.selectedOption;
                    $scope.filter.q     = $scope.q;
                }
                var params = $.param( $scope.filter );
                $http({
                    method: 'GET',
                    url: cms_url+"/rows?"+params
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    $scope.totalRows = response.data;
                    $scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            function showAlert(val) {
                UIkit.modal.alert( val );
            }

            $scope.optionPerPage = [
                {
                    'name':'20',
                    'value': 20
                },{
                    'name':'25',
                    'value': 25
                },{
                    'name':'50',
                    'value': 50
                },{
                    'name':'100',
                    'value': 100
                }
            ];
            $scope.selectedOptionPerPage = $scope.optionPerPage[0];

            $scope.searchClick = function () {
                $scope.selectedOption = document.getElementById("search-column").value;
                $scope.spinner = false;
                $scope.is_search = true;
                $scope.pageStart = 1;
                $scope.readData($scope.pageStart);
            };

            $scope.reset = function () {
                $scope.spinner = false;
                $scope.is_search = false;
                $scope.perPage = 20;
                $scope.readData($scope.pageStart);
            };

            $scope.changedPerPage = function() {
                $scope.perPage = $scope.selectedOptionPerPage.value;
                $scope.readData($scope.pageStart);
            };

            $scope.deleteClickBulkAction = function() {
                var scope_selection = $scope.selected;
                if( scope_selection.length > 0 ){
                    var id_to_delete = scope_selection.join('-');
                    UIkit.modal.confirm('Are you sure that you want to delete this record?', function(){
                        $scope.spinner = false;
                        $http({
                            method: 'GET',
                            url: cms_url+"/delete/"+id_to_delete
                        }).then(function successCallback(response) {
                            $scope.selected = [];
                            $scope.spinner = true;
                            if( response.status === 200 ){
                                $scope.alertMessage = response.data;
                                $scope.alertClass = 'uk-alert-success';
                                $scope.alertBox = true;
                                $scope.readData();
                            }else{
                                $scope.alertMessage = response.data;
                                $scope.alertClass = 'uk-alert-danger';
                                $scope.alertBox = true;
                            }
                        }, function errorCallback(response) {
                            $scope.spinner = true;
                            console.log(response);
                        });
                    });
                }else{
                    showAlert('No Data Selected!');
                }
            };

            $scope.deleteClick = function(id_to_delete) {
                UIkit.modal.confirm('Are you sure that you want to delete this record?', function(){
                    $scope.spinner = false;
                    $http({
                        method: 'GET',
                        url: cms_url+"/delete/"+id_to_delete
                    }).then(function successCallback(response) {
                        $scope.spinner = true;
                        if( response.status === 200 ){
                            $scope.alertMessage = response.data;
                            $scope.alertClass = 'uk-alert-success';
                            $scope.alertBox = true;
                            $scope.readData();
                        }else{
                            $scope.alertMessage = response.data;
                            $scope.alertClass = 'uk-alert-danger';
                            $scope.alertBox = true;
                        }
                    }, function errorCallback(response) {
                        $scope.spinner = true;
                        console.log(response);
                    });
                });
            };

            $scope.nextPageClick = function () {
                var maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                if($scope.pageStart < maxPage){
                    $scope.spinner = false;
                    $scope.pageStart +=1;
                    $scope.readData($scope.pageStart);
                }
            };
            $scope.prevPageClick = function () {
                if( $scope.pageStart > 1 ){
                    $scope.spinner = false;
                    $scope.pageStart -=1;
                    $scope.readData($scope.pageStart);
                }
            };
            $scope.startPageClick = function () {
                $scope.spinner = false;
                $scope.pageStart = 1;
                $scope.readData($scope.pageStart);
            };
            $scope.endPageClick = function () {
                $scope.spinner = false;
                $scope.pageStart = Math.ceil($scope.totalRows/$scope.perPage);
                $scope.readData($scope.pageStart);
            };

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.readData();
            showBox();
        });

    </script>
@endsection
