<div id="page_content" ng-controller="listController">
    <div class="loading" ng-hide="spinner"></div>
    <div id="page_content_inner" style="display: none;">
        <div class="md-card">
            <div class="md-card-content">
                <form action="">
                    <div class="uk-grid" data-uk-grid-margin="">

                        <div class="uk-width-medium-1-5" ng-hide="disableTypeDate">
                            <div class="md-input-wrapper md-input-filled">
                                <input id="input-date" class="md-input" type="text" required data-uk-datepicker="{format:'YYYY-MM-DD', maxDate:'0'}" />
                                <span class="md-input-bar "></span>
                            </div>
                            <span class="uk-form-help-block">Pilih Tanggal</span>
                        </div>

                        <div class="uk-width-medium-1-5" ng-hide="disableTypeText">
                            <div class="md-input-wrapper md-input-filled">
                                <input ng-model="q" class="md-input" type="text" required>
                                <span class="md-input-bar "></span>
                            </div>
                            <span class="uk-form-help-block">Kata Pencarian</span>
                        </div>

                        <div class="uk-width-medium-1-5">
                            <div class="md-input-wrapper md-input-filled">
                                <select class="md-input" ng-change="changedOption()" data-ng-model="selectedOption">
                                    <option ng-repeat="c in columns" ng-if="c.primary_key!=1" value="{{c.name}}">{{c.name}}</option>
                                </select>
                                <span class="md-input-bar"></span>
                            </div>
                            <span class="uk-form-help-block">Pilih kolom</span>
                        </div>

                        <div class="uk-width-medium-1-5 width-100 text-right">
                            <span class="uk-input-group-addon width-0">
                                <a class="md-btn" ng-click="searchClick()">Cari</a>
                            </span>
                            <span class="uk-input-group-addon  width-0">
                            <input type="reset" class="md-btn" onclick="document.forms[0].reset();" ng-click="reset()" value="Reset">
                            </span>
                            <span class="uk-input-group-addon width-0">
                                <a href="cms/angular/add" class="md-btn">Add</a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                <div class="uk-overflow-container">
                    <table class="uk-table uk-table-hover uk-table-striped" width="100%" style="margin-bottom: 60px;">
                        <thead>
                        <tr>
                            <th>Pilihan</th>
                            <th ng-repeat="c in columns" ng-if="c.primary_key!=1">
                                {{c.name}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="t in tikets">
                                <?php foreach ($fields as $field):?>
                                        <?php if($field->primary_key==1):?>
                                        <td>
                                            <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                                                <button class="md-btn mdn-btn-small"> Pilihan <i class="material-icons"></i></button>
                                                <div class="uk-dropdown uk-dropdown-small uk-dropdown-bottom" style="">
                                                    <ul class="uk-nav uk-nav-dropdown">
                                                        <li class="edit-row">
                                                            <a href="cms/<?php echo $subject?>/edit/{{t.<?php echo $field->name?>}}" title="Edit"><i class="icon-pencil"></i>Edit</a>
                                                        </li>
                                                        <li data-id="{{t.<?php echo $field->name?>}}" ng-click="deleteClick($event)" class="delete-row">
                                                            <a href="" title="Hapus"><i class="icon-trash"></i>Hapus</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <?php else:?>
                                            <?php if($field->type=='tinyint'):?>
                                                <td ng-if="t.<?php echo $field->name?>==1"><span class="uk-badge uk-badge-success">Yes</span></td>
                                                <td ng-if="t.<?php echo $field->name?>!=1"><span class="uk-badge uk-badge-danger">No</span></td>
                                            <?php else:?>
                                                <td>{{t.<?php echo $field->name?>}}</td>
                                            <?php endif;?>
                                        <?php endif;?>
                                <?php endforeach;?>
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
                        <div style="margin-top:15px;" class="uk-input-group">
                            Halaman <span id="page-starts-from">{{pageStart}}</span> dari <span id="total_items">{{maxPage}}</span> total									Halaman	                            </div>
                    </div>
                    <div class="uk-width-large-1-4 uk-width-medium-1-2">
                        <div class="uk-input-group">
                            <div class="md-input-wrapper md-input-filled">
                                <input class="md-input" name="tb_crud_page" type="text" value="{{pageStart}}" size="4" id="tb_crud_page">
                                <span class="md-input-bar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-large-1-4 uk-width-medium-1-2">
                        <div class="uk-input-group">
                            <div class="md-input-wrapper md-input-wrapper-disabled md-input-filled">
                                <span class="md-input-bar"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="pager" style="text-align: center;">
                    <li class="md-btn md-btn-wave" ng-click="startPageClick()" style="float: left;"><a href="" >« Awal</a></li>
                    <li class="md-btn md-btn-wave" ng-click="prevPageClick()"><a href="" >« Sebelumnya</a></li>
                    <li class="md-btn md-btn-wave" ng-click="nextPageClick()"><a href="" >Selanjutnya »</a></li>
                    <li class="md-btn md-btn-wave" ng-click="endPageClick()" style="float: right;"><a href="" >Terakhir »</a></li>
                </ul>

            </div>
        </div>
    </div>
</div>