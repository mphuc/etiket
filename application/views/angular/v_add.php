<div id="page_content" ng-controller="addController">
    <div id="page_heading">
        <h1>Add <?php echo $module?> <a href="<?php echo base_url('cms/'.$module)?>" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
        </h1> <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">You can add new data in this form</span>
    </div>
    <div id="page_content_inner">
        <form ng-submit="submit()">
            <div class="uk-grid uk-grid-medium ">
                <div class="uk-width-xLarge-8-10 uk-width-large-7-10" >
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text"> Form Detail </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                <div class="uk-width-large-1">
                                    <?php foreach ($fields as $field):?>
                                        <?php if($field->primary_key!=1):?>
                                            <?php if($field->type=='varchar'):?>
                                            <div class="uk-form-row" id="<?php echo $field->name?>_field_box">
                                                <label id="<?php echo $field->name?>_display_as_box" for="field-<?php echo $field->name?>"><?php echo $field->name?></label>
                                                <input ng-model="form.<?php echo $field->name?>" class='md-input' id='field-<?php echo $field->name?>' name='<?php echo $field->name?>' type='text' value="" maxlength='<?php echo $field->max_length?>' />
                                            </div>
                                            <?php endif;?>
                                            <?php if($field->type=='int'):?>
                                                <div class="uk-form-row" id="<?php echo $field->name?>_field_box">
                                                    <label id="<?php echo $field->name?>_display_as_box" for="field-<?php echo $field->name?>"><?php echo $field->name?></label>
                                                    <input ng-model="form.<?php echo $field->name?>" class='md-input' id='field-<?php echo $field->name?>' name='<?php echo $field->name?>' type='number' value="" maxlength='<?php echo $field->max_length?>' />
                                                </div>
                                            <?php endif;?>
                                            <?php if($field->type=='text'):?>
                                                <div class="uk-form-row" id="<?php echo $field->name?>_field_box">
                                                    <label id="<?php echo $field->name?>_display_as_box" for="field-<?php echo $field->name?>"><?php echo $field->name?></label>
                                                    <textarea ng-model="form.<?php echo $field->name?>" class='md-input' id='field-<?php echo $field->name?>' name='<?php echo $field->name?>' maxlength='<?php echo $field->max_length?>'></textarea>
                                                </div>
                                            <?php endif;?>
                                            <?php if($field->type=='tinyint'):?>
                                    <div class="uk-form-row" id="<?php echo $field->name?>_field_box">
                                                <label id="<?php echo $field->name?>display_as_box" for="field-<?php echo $field->name?>"><?php echo $field->name?></label>
                                                <p id="field-<?php echo $field->name?>">
                                                    <input type="radio" name="<?php echo $field->name?>" value="1" id="field-<?php echo $field->name?>-1" data-md-icheck />
                                                    <label for="field-<?php echo $field->name?>-1" class="inline-label">Yes</label>
                                                    <input type="radio" name="<?php echo $field->name?>" value="0" id="field-<?php echo $field->name?>-2" data-md-icheck />
                                                    <label for="field-<?php echo $field->name?>-2" class="inline-label">No</label>
                                                </p>
                                    </div>
                                            <?php endif;?>
                                        <?php endif;?>
                                    <?php endforeach;?>
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
                            <?php foreach ($fields as $field):?>
                                <?php if($field->primary_key!=1):?>
                                    <?php if($field->type=='date'):?>
                                        <div class="uk-form-row" id="<?php echo $field->name?>_field_box">
                                            <label id="<?php echo $field->name?>_display_as_box" for="field-<?php echo $field->name?>"><?php echo $field->name?></label>
                                            <input ng-model="form.<?php echo $field->name?>" class='datepic' id='field-<?php echo $field->name?>' name='<?php echo $field->name?>' type='text' value="" maxlength='<?php echo $field->max_length?>' />
                                        </div>
                                    <?php endif;?>
                                    <?php if($field->type=='datetime'):?>
                                        <div class="uk-form-row" id="<?php echo $field->name?>_field_box">
                                            <label id="<?php echo $field->name?>_display_as_box" for="field-<?php echo $field->name?>"><?php echo $field->name?></label>
                                            <input ng-model="form.<?php echo $field->name?>" class='timepic' id='field-<?php echo $field->name?>' name='<?php echo $field->name?>' type='text' value="" maxlength='<?php echo $field->max_length?>' />
                                        </div>
                                    <?php endif;?>
                                    <?php if($field->type=='enum'):?>
                                        <div class="uk-form-row" id="<?php echo $field->name?>_field_box">
                                            <label id="<?php echo $field->name?>_display_as_box" for="field-<?php echo $field->name?>"><?php echo $field->name?></label>
                                            <select ng-model="form.<?php echo $field->name?>" id='field-<?php echo $field->name?>' name='<?php echo $field->name?>' data-md-selectize>
                                            <?php foreach ($field->data as $value):?>
                                                <option value="<?php echo $value?>"><?php echo $value?></option>
                                            <?php endforeach;?>
                                            </select>
                                        </div><br>
                                    <?php endif;?>
                                <?php endif;?>
                            <?php endforeach;?>

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
                                    <input type="submit" class="md-btn md-btn-primary mdn-btn-small" value="Submit">
                                    <button type="button" class="md-btn mdn-btn-small md-btn-success save-and-go-back-button">Save & Back</button>
                                    <button ng-click="cancelClick()" type="button" class="md-btn mdn-btn-small return-to-list">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>