<div id="page_content" ng-controller="listController">
    <div class="loading" ng-hide="spinner"></div>
    <div id="page_content_inner" style="display: none;">
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                <div class="uk-overflow-container">
                    <h3 class="heading_b uk-margin-bottom"><?php echo $subject?></h3>
                    <div class="md-card uk-margin-medium-bottom">
                        <div class="md-card-content">
                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1_content'}" id="tabs_1">
                                        <?php foreach ($types as $k => $type):?>
                                            <li <?php if( $k==0 ){echo 'class="uk-active"';}?>><a href="#"><?php echo str_replace('_',' ', $type)?></a></li>
                                        <?php endforeach;?>
                                    </ul>
                                    <ul id="tabs_1_content" class="uk-switcher uk-margin">
                                        <?php foreach ($types as $k => $type):?>
                                            <?php if( $type == 'front-theme' ):?>
                                                <li>
                                                    <div class="uk-grid uk-margin-medium-top" data-uk-grid-margin>
                                                    <?php foreach ( $settings[$type] as $y => $value ):?>
                                                            <div class="uk-width-medium-1-4">
                                                                <img src="<?php echo base_url('img/load/300/300/theme/'.str_replace('theme-', '',$value['setting_name']))?>">
                                                                <p>
                                                                    <input ng-click="changeThemeClick($event)" value="<?php echo $value['setting_name']?>" name="theme" id="<?php echo $value['setting_name']?>" type="radio"  <?php if($value['setting_value'] == 'active') {echo ' checked="checked"';}?>>
                                                                    <label class="inline-label" for="<?php echo $value['setting_name']?>"><?php echo ucfirst( str_replace('theme-', '',$value['setting_name']))?></label>
                                                                </p>
                                                            </div>
                                                    <?php endforeach;?>
                                                    </div>
                                                </li>
                                            <?php else:?>
                                                <li>
                                                    <?php foreach ( $settings[$type] as $y => $value ):?>
                                                        <div class="uk-grid uk-margin-medium-top" data-uk-grid-margin>
                                                            <div class="uk-width-medium-1-1">
                                                                <label><?php echo ucfirst( str_replace('_', ' ',$value['setting_name']))?></label>
                                                                <input ng-blur="keydownClick($event)" data-id="<?php echo $value['setting_id']?>" name="setting-<?php echo $value['setting_id']?>" value="<?php echo $value['setting_value']?>" type="text" class="md-input uk-form-width-large" />
                                                            </div>
                                                        </div>
                                                    <?php endforeach;?>
                                                </li>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>