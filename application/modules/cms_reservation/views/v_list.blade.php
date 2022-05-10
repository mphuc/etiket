@extends('app')
@section('body')
    <div id="page_content" ng-controller="listController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_content_inner" style="display: none;">
            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-1">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text"> Actions </h3>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-grid" data-uk-grid-margin="">
                                <div class="uk-width-medium-1-6">
                                    <input class="md-input" id="filter-transaction_uniq" name="transaction_uniq" ng-keydown="$event.keyCode === 13 && readData()">
                                    <span class="uk-form-help-block">Transaction ID</span>
                                </div>
                                <div id="options-content-user" class="uk-width-medium-1-6">
                                    <select id="filter-user" class="md-input" name="user">
                                        <option disabled="" selected="" value="">User Loket</option>
                                        @foreach( $users as $item )
                                            <option value="{{$item['id']}}">{{$item['username']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="uk-form-help-block">User Loket</span>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="filter-from" name="from" value="" type="text" required/>
                                        <span class="md-input-bar"></span>
                                    </div>
                                    <span class="uk-form-help-block">Date (From)</span>
                                </div>
                                <div class="uk-width-medium-1-6">
                                    <div class="md-input-wrapper md-input-filled">
                                        <input id="filter-to" name="to" value="" type="text" required/>
                                        <span class="md-input-bar"></span>
                                    </div>
                                    <span class="uk-form-help-block">Date (To)</span>
                                </div>
                                <div id="options-content-filter" class="uk-width-medium-1-2">
                                    <button ng-click="readData()" class="md-btn md-btn-primary">Filter</button>
                                    <a href="{{ base_url("cms/$module") }}" class="md-btn">Reset</a>
                                    <button ng-click="exportData()" class="md-btn">Export</button>
                                    <a href="{{ base_url("cms/$module/add") }}" class="md-btn md-btn-success">Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-modal" id="modal-detail" aria-hidden="true">
                <div class="uk-modal-dialog" style="top: -15.5px;">
                    <div class="uk-modal-header">
                        <div class="uk-clearfix">
                            <div class="uk-float-left">
                                <h3 class="uk-modal-title">Detail Transaction - @{{ transaction.transaction_uniq }}</h3>
                            </div>
                            <div class="uk-float-right">
                                <a class="md-btn md-btn-flat md-btn-wave waves-effect waves-button uk-modal-close" href="javascript:void(0)"><i class="material-icons">close</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-medium-1">
                        <table ng-if="transaction.transaction_discount>0" class="uk-table uk-table-nowrap table_check uk-table-striped">
                            <thead>
                            <tr>
                                <th>Discount</th>
                                <th>Card</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>@{{ transaction.transaction_discount | number }}</td>
                                <td>@{{ transaction.transaction_member_card }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table ng-if="transaction.transaction_type=='edc'" class="uk-table uk-table-nowrap table_check uk-table-striped">
                            <thead>
                            <tr>
                                <th>Approval Code</th>
                                <th>Card Type</th>
                                <th>Card Number</th>
                                <th>Bank</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>@{{ transaction.transaction_approval_code }}</td>
                                <td>@{{ transaction.transaction_card_type }}</td>
                                <td>@{{ transaction.transaction_card_number }}</td>
                                <td>@{{ transaction.transaction_bank }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="uk-table uk-table-nowrap table_check uk-table-striped">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Discount</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in details">
                                <td title="@{{ t.transaction_detail_id }}">
                                    @{{ t.product_title }}
                                    <br>
                                    <span ng-if="t.transaction_detail_discount>0">
                                        <b ng-repeat="d in t.discount">
                                            @{{ d.dd_type }} @{{ d.dd_percent_discount }}% @{{ d.dd_discount | number }}<br>
                                        </b>
                                    </span>
                                </td>
                                <td>@{{ t.transaction_detail_price | number}}</td>
                                <td>@{{ t.transaction_detail_qty }}</td>
                                <td>@{{ t.transaction_detail_discount | number }}</td>
                                <td>@{{ t.transaction_detail_subtotal | number}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table ng-if="transaction.transaction_user_name" class="uk-table uk-table-nowrap table_check uk-table-striped">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>@{{ transaction.transaction_user_name }}</td>
                                <td>@{{ transaction.transaction_user_email }}</td>
                                <td>@{{ transaction.transaction_user_phone }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>

            <div class="uk-modal" id="modal-paid" aria-hidden="true">
                <div class="uk-modal-dialog" style="top: -15.5px;">
                    <div class="uk-modal-header">
                        <div class="uk-clearfix">
                            <div class="uk-float-left">
                                <h3 class="uk-modal-title" title="@{{ transaction.transaction_id }}">Set Paid - @{{ transaction.transaction_uniq }}</h3>
                            </div>
                            <div class="uk-float-right">
                                <a class="md-btn md-btn-flat md-btn-wave waves-effect waves-button uk-modal-close" href="javascript:void(0)"><i class="material-icons">close</i></a>
                            </div>
                        </div>
                    </div>
                    <form id="form-paid">
                    <div class="uk-width-medium-1">
                        <div class="uk-form-row">
                            <table class="uk-table uk-table-nowrap table_check uk-table-striped" style="margin-bottom: 68px;">
                                <tbody>
                                <tr>
                                    <td>Kode Uniq</td>
                                    <td>@{{ transaction.transaction_uniq }}</td>
                                </tr>
                                <tr>
                                    <td>Kode Transaksi</td>
                                    <td>@{{ transaction.transaction_id }}</td>
                                </tr>
                                <tr>
                                    <td>Total Biaya</td>
                                    <td>
                                        @{{ transaction.transaction_total-transaction.transaction_discount | number}}
                                        <br>
                                        <span ng-if="transaction.transaction_discount>0">
                                            <strike>@{{ transaction.transaction_total | number}}</strike>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>DP</td>
                                    <td>@{{ transaction.res_dp | number }}</td>
                                </tr>
                                <tr>
                                    <td>Diskon</td>
                                    <td>@{{ transaction.transaction_discount | number}}</td>
                                </tr>
                                <tr>
                                    <td>Pelunasan</td>
                                    <td>@{{ transaction.transaction_total-transaction.transaction_discount-transaction.res_dp | number }}</td>
                                </tr>
                                <tr ng-if="transaction.transaction_paid==1">
                                    <td>Tipe Pelunasan</td>
                                    <td>@{{ transaction.res_pelunasan_type }}</td>
                                </tr>
                                <tr ng-if="transaction.transaction_paid==1">
                                    <td>Bank</td>
                                    <td>@{{ transaction.res_pelunasan_bank }}</td>
                                </tr>
                                <tr ng-if="transaction.transaction_paid!=1">
                                    <td>Tipe Pelunasan</td>
                                    <td>
                                        <p style="margin: 0;" id="res_pelunasan_type">
                                            <input type="radio" name="res_pelunasan_type" value="cash" id="res_pelunasan_type-1" data-md-icheck checked/>
                                            <label for="res_pelunasan_type-1" class="inline-label">Cash</label>&nbsp;&nbsp;
                                            <input type="radio" name="res_pelunasan_type" value="transfer" id="res_pelunasan_type-2" data-md-icheck />
                                            <label for="res_pelunasan_type-2" class="inline-label">Transfer</label>
                                        </p>
                                    </td>
                                </tr>
                                <tr ng-if="transaction.transaction_paid!=1">
                                    <td>Bank</td>
                                    <td>
                                        <p id="res_pelunasan_bank">
                                            @foreach($banks as $k => $v)
                                                <input type="radio" name="res_pelunasan_bank" value="{{$v['bank_name']}}" id="res_pelunasan_bank-{{$k}}" data-md-icheck/>
                                                <label for="res_pelunasan_bank-{{$k}}" class="inline-label">{{$v['bank_name']}}</label>&nbsp;&nbsp;<br>
                                            @endforeach
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td>@{{ transaction.res_customer }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div ng-if="transaction.transaction_paid!=1" style="margin-top: 0" class="uk-form-row">
                            <div class="uk-grid" data-uk-grid-margin="">
                                <div class="uk-width-medium-1">
                                    <input class="md-btn md-btn-success uk-modal-close" type="button" value="Set Paid" ng-click="paidClick()">
                                    <input class="md-btn md-btn-danger uk-modal-close" type="button" value="Cancel">
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <br>

            <div ng-click="hideAlert()" ng-class="alertClass" ng-show="alertBox" class="uk-alert" data-uk-alert>
                <div ng-bind-html="alertMessage"></div>
            </div>

            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-toolbar"> <h3 class="md-card-toolbar-heading-text"> List {{ $subject }}</h3> </div>
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap table_check uk-table-striped" style="margin-bottom: 68px;">
                            <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Jam Kunjungan</th>
                                <th>Jam Acara</th>
                                <th>Jam Makan</th>
                                <th>Tempat</th>
                                <th>Dp</th>
                                <th>Pelunasan</th>
                                <th>Souvenir Tour</th>
                                <th>Souvenir Panggung</th>
                                <th>Bus 1</th>
                                <th>Bus 2</th>
                                <th>Driver Price</th>
                                <th>Bus Price</th>
                                <th>Total Person</th>
                                <th>Kabupaten</th>
                                <th>Biro</th>
                                <th>Total Box</th>
                                <th>Note Operasional</th>
                                <th>Note Teknik</th>
                                <th>Note Bus</th>
                                <th>Note Tambahan</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in data">
                                <td>
                                    @{{t.res_customer}}<br>
                                    <a title="@{{t.transaction_id}}" ng-click="readDetails(t.transaction_id)" href="javascript:void(0)" data-uk-modal="{target:'#modal-detail'}" >#@{{t.transaction_uniq}}</a><br>
                                    <small ng-if="t.transaction_paid==1"><span class="uk-badge uk-badge-success">paid</span></small>
                                    <small ng-if="t.transaction_paid!=1"><span class="uk-badge uk-badge-warning">unpaid</span></small>
                                    <small ng-if="t.username"><span class="uk-badge uk-badge-notification">@{{  t.username }}</span></small>
                                    <small title="Date Used"><span class="uk-badge uk-badge-primary">@{{t.transaction_date_used | moment: 'format': 'LL'}}</span></small>
                                    <small title="Total After Discount"><span class="uk-badge uk-badge-warning">Rp @{{t.transaction_total - t.transaction_discount | number}}</span></small>
                                </td>
                                <td>@{{t.res_jam_kunjungan}}</td>
                                <td>@{{t.res_jam_acara}}</td>
                                <td>@{{t.res_jam_makan}}</td>
                                <td>@{{t.res_tempat}}</td>
                                <td>
                                    @{{t.res_dp | number}}<br>
                                    <small title="DP Date" ng-if="t.res_dp>0 && t.res_dp_type!='cash'"><span class="uk-badge uk-badge-primary">@{{t.res_dp_date | moment: 'format': 'LL'}}</span></small>
                                    <small title="DP Type" ng-if="t.res_dp>0 && t.res_dp_type!='cash'"><span class="uk-badge uk-badge-primary">@{{t.res_dp_type}}</span></small>
                                    <small title="DP Bank" ng-if="t.res_dp>0 && t.res_dp_type!='cash'"><span class="uk-badge uk-badge-primary">@{{t.res_dp_bank}}</span></small>
                                    <small title="DP Date" ng-if="t.res_dp>0 && t.res_dp_type=='cash'"><span class="uk-badge uk-badge-success">@{{t.res_dp_date | moment: 'format': 'LL'}}</span></small>
                                    <small title="DP Type" ng-if="t.res_dp>0 && t.res_dp_type=='cash'"><span class="uk-badge uk-badge-success">@{{t.res_dp_type}}</span></small>
                                </td>
                                <td>
                                    @{{t.res_pelunasan | number}}<br>
                                    <small title="Pelunasan Date" ng-if="t.res_pelunasan>0 && t.res_pelunasan_type!='cash'"><span class="uk-badge uk-badge-primary">@{{t.res_pelunasan_date | moment: 'format': 'LL'}}</span></small>
                                    <small title="Pelunasan Type" ng-if="t.res_pelunasan>0 && t.res_pelunasan_type!='cash'"><span class="uk-badge uk-badge-primary">@{{t.res_pelunasan_type}}</span></small>
                                    <small title="Pelunasan Bank" ng-if="t.res_pelunasan>0 && t.res_pelunasan_type!='cash'"><span class="uk-badge uk-badge-primary">@{{t.res_pelunasan_bank}}</span></small>
                                    <small title="Pelunasan Date" ng-if="t.res_pelunasan>0 && t.res_pelunasan_type=='cash'"><span class="uk-badge uk-badge-success">@{{t.res_pelunasan_date | moment: 'format': 'LL'}}</span></small>
                                    <small title="Pelunasan Type" ng-if="t.res_pelunasan>0 && t.res_pelunasan_type=='cash'"><span class="uk-badge uk-badge-success">@{{t.res_pelunasan_type}}</span></small>
                                </td>
                                <td>@{{t.res_souvenir_tour}}</td>
                                <td>@{{t.res_souvenir_panggung}}</td>
                                <td>@{{t.bus_1}}</td>
                                <td>@{{t.bus_2}}</td>
                                <td>@{{t.res_driver_price | number}}</td>
                                <td>@{{t.res_bus_price | number}}</td>
                                <td>@{{t.res_total_person | number}}</td>
                                <td>@{{t.res_kabupaten}}</td>
                                <td>@{{t.res_biro}}</td>
                                <td>@{{t.res_total_box | number}}</td>
                                <td>@{{t.res_note_operasional}}</td>
                                <td>@{{t.res_note_teknik}}</td>
                                <td>@{{t.res_note_bus}}</td>
                                <td>@{{t.res_note_tambahan}}</td>
                                <td ng-if="t.transaction_paid!=1">
                                    <a ng-click="readDetails(t.transaction_id)" data-uk-modal="{target:'#modal-paid'}" class="md-btn md-btn-warning md-btn-wave-light waves-effect waves-button waves-light" href="javascript:void(0)">Set Paid</a>
                                </td>
                                <td ng-if="t.transaction_paid==1">
                                    <a ng-click="readDetails(t.transaction_id)" data-uk-modal="{target:'#modal-paid'}" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" href="javascript:void(0)">Paid</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

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
                        <li class="md-btn md-btn-wave" ng-click="startPageClick()" style="float: left;"><a href="" >« First</a></li>
                        <li class="md-btn md-btn-wave" ng-click="prevPageClick()"><a href="" >« Prev</a></li>
                        <li class="md-btn md-btn-wave" ng-click="nextPageClick()"><a href="" >Next »</a></li>
                        <li class="md-btn md-btn-wave" ng-click="endPageClick()" style="float: right;"><a href="" >Last »</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

        $("#filter-from").kendoDatePicker({
            format: "yyyy-MM-dd"
        });

        $("#filter-to").kendoDatePicker({
            format: "yyyy-MM-dd"
        });

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

            $scope.details = [];
            $scope.transaction = {};
            $scope.readDetails = function (id) {
                angular.forEach($scope.data, function(value, key) {
                    if( id === value.transaction_id ) $scope.transaction = value;
                });
                $http({
                    method: 'GET',
                    url: cms_url+"/detail?id="+id
                }).then(function successCallback(response) {
                    $scope.details = response.data;
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    UIkit.modal.alert('error '+JSON.parse(response));
                });
            };

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
                    updateSelected(action, entity.res_id);
                }
            };

            $scope.getSelectedClass = function(entity) {
                return $scope.isSelected(entity.id) ? 'selected' : '';
            };
            /*--------checkbox operation----------*/

            $scope.readData = function(page) {
                $scope.spinner = false;
                $scope.filter.user_id           = $("#filter-user").val();
                $scope.filter.transaction_uniq  = $("#filter-transaction_uniq").val();
                $scope.filter.from              = $("#filter-from").val();
                $scope.filter.to                = $("#filter-to").val();
                $scope.filter.limit             = $scope.perPage;
                $scope.filter.page              = page;
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
                $scope.filter.user_id           = $("#filter-user").val();
                $scope.filter.transaction_uniq  = $("#filter-transaction_uniq").val();
                $scope.filter.from              = $("#filter-from").val();
                $scope.filter.to                = $("#filter-to").val();
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

            $scope.exportData = function()
            {
                $scope.filter.user_id           = $("#filter-user").val();
                $scope.filter.transaction_uniq  = $("#filter-transaction_uniq").val();
                $scope.filter.from              = $("#filter-from").val();
                $scope.filter.to                = $("#filter-to").val();
                var params = $.param( $scope.filter );
                window.location.href = cms_url+"/export?"+params;
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

            $scope.paidClick = function () {
                var formDataArray = $('#form-paid').serializeArray();
                var formData = {};
                formDataArray.forEach(function(entry) {
                    formData[entry.name]=entry.value;
                });
                formData['transaction_id']=$scope.transaction.transaction_id;
                $scope.spinner = false;
                $http({
                    url: cms_url+"/paid",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: formData
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    if( response.status === 200 ){
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'uk-alert-success';
                        $scope.alertBox = true;
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

            $scope.readData();
            showBox();
        });
    </script>
@endsection
