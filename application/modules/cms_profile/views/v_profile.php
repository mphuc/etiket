
<div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-7-10">
                    <div class="md-card">
                        <div style="background-image:url(img/load/1120/186/crop/{user_cover});" >
                            <div style="background:url(img/load/400/186/cover/{user_cover}); background-repeat:no-repeat;" class="user_heading">
                            <div class="user_heading_avatar ">
                                <img src="img/load/100/100/png/{user_avatar}" alt="{user_display_name}"/>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate">{user_display_name}</span><span class="sub-heading">{user_company}</span></h2>
                                <ul class="user_stats">
                                    <li>
                                        <h4 class="heading_a">{user_total_post} <span class="sub-heading">{_p_posts}</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">{user_total_photo} <span class="sub-heading">{_p_photo}</span></h4>
                                    </li>
                                </ul>
                                
                            </div>

                            <a class="md-fab md-fab-small md-fab-accent" href="cms/profile/index/edit/{id}">
                                <i class="material-icons">&#xE150;</i>
                            </a>
                            </div>                                 
                        </div>
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}">
                                <li <?php if($cekdisplay != 'profile' && $cekdisplay != 'posts' ){ echo 'class="uk-active"'; } ?>><a href="#">{_p_about}</a></li>
                                <!-- <li <?php if($cekdisplay == 'profile'){ echo 'class="uk-active"'; } ?>><a href="#">{_p_photo}</a></li>
                                <li <?php if($cekdisplay == 'posts'){ echo 'class="uk-active"'; } ?>><a href="#">{_p_posts}</a></li> -->
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                    {user_bio}
                                    <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">{_p_contact_info}</h4>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{email}</span>
                                                        <span class="uk-text-small uk-text-muted">{_p_email}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{user_mobile}</span>
                                                        <span class="uk-text-small uk-text-muted">{_p_phone}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{user_facebook}</span>
                                                        <span class="uk-text-small uk-text-muted">{_p_fb}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{user_twitter}</span>
                                                        <span class="uk-text-small uk-text-muted">{_p_twitter}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-google-plus"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{user_google_plus}</span>
                                                        <span class="uk-text-small uk-text-muted">{_p_gplus}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-birthday-cake"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{user_date_birth}</span>
                                                        <span class="uk-text-small uk-text-muted">{_p_birth}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-genderless"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{user_gender}</span>
                                                        <span class="uk-text-small uk-text-muted">{_p_gender}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-map-marker"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{user_current_location}</span>
                                                        <span class="uk-text-small uk-text-muted">{_p_current_location}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-clock-o"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo timespan($last_login); ?></span>
                                                        <span class="uk-text-small uk-text-muted">{_p_last_login}</span>
                                                    </div>
                                                </li>
                                                 <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-laptop"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{_p_ip}</span>
                                                        <span class="uk-text-small uk-text-muted">{_p_ip_address}</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">{_p_groups}</h4>
                                            <ul class="md-list">
                                               <?php foreach($data_user_groups as $groups) { ?> 
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo $groups->name; ?></span>
                                                        <span class="uk-text-small uk-text-muted"><?php echo $groups->description; ?></span>
                                                    </div>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <h4 class="heading_c uk-margin-bottom">{_p_timline}</h4>
                                    <div class="timeline">
                                    <?php $notif=$this->base_config->notificationlist(); ?>
                                    
                                    <?php 
                                        $nonotif2 =false;
                                        foreach($notif as $notifval2) {
                                                if($notifval2->notification_type  == 'timeline') {
                                                    $nonotif2 =true;
                                        ?>
                                        <div class="timeline_item">
                                            <div class="timeline_icon timeline_icon_success"><i class="material-icons"><?php if($notifval2->notification_icon == 'update'){ echo "&#xE150;"; }else if($notifval2->notification_icon == 'delete') {echo '&#xE15C;'; }else{ echo '&#xE147;'; } ?></i></div>
                                            <div class="timeline_date">
                                                <?php echo $this->base_config->timeAgo($notifval2->notification_date); ?>
                                            </div>
                                            <div class="timeline_content"><?php echo $notifval2->notification_desc; ?></div>
                                        </div>
                                        <?php 
                                                }
                                            }
                                        ?>

                                    </div>
                                </li>
                                <li>
                                    <div  data-uk-check-display class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4" data-uk-grid="{gutter: 4}">
                                        <?php foreach($data_user_photo as $tbmedia) { ?>
                                        <div>
                                            <a  data-uk-modal="{target:'#usermedia<?php echo $tbmedia->post_id; ?>'}" href="#">
                                                <img src="img/load/261/174/b/<?php echo $tbmedia->post_name; ?>" alt=""/>
                                            </a>
                                            <div class="uk-modal" id="usermedia<?php echo $tbmedia->post_id; ?>">
                                                <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                                    <button type="button" class="uk-modal-close uk-close uk-close-alt"></button>
                                                    <img src="img/load/261/174/full/<?php echo $tbmedia->post_name; ?>" alt=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <?php  } ?>
                                    </div>
                                    {data_user_photo_pagging}
                                </li>
                                <li>
                                    <ul class="md-list">
                                        <?php  foreach($data_user_posts as $tbposts) { ?>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><a target="_blank" href="<?php echo $tbposts->post_name; ?>"><?php echo $tbposts->post_title; ?></a></span>
                                                <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small"><?php echo $tbposts->post_date; ?></span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small"><?php echo $tbposts->post_comment_count; ?></span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small"><?php echo $tbposts->post_view; ?></span>
                                                </span>
                                                </div>
                                            </div>
                                        </li>
                                         <?php  } ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div> 
                </div>
                <div class="uk-width-large-3-10">
                    <div class="md-card" data-uk-sticky="{ top: 48, media: 960 }">
                        <div class="md-card-content">
                            <div class="uk-margin-medium-bottom">
                                <h3 class="heading_c uk-margin-bottom">{_notif}</h3>
                                <ul class="md-list md-list-addon">
                                    <?php 
                                     $nonotif =false;
                                    foreach($notif as $notifval) {
                                            if($notifval->notification_type  == 'comment' && $notifval->notification_type == 'contact') {
                                                 $nonotif =true;
                                    ?>
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons uk-text-warning"><?php if($notifval->notification_icon == 'update'){ echo "&#xE150;"; }else if($notifval->notification_icon == 'delete') {echo '&#xE15C;'; }else{ echo '&#xE147;'; } ?></i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading"><?php echo $notifval->notification_desc; ?></span>
                                            <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo lang('in_notif')." : ".$this->base_config->timeAgo($notifval2->notification_date);?>.</span>
                                        </div>
                                    </li>

                                    <li>
                                    <?php 
                                            }
                                        }
                                        if($nonotif == false){
                                            echo '<li>'.lang('no_notif').'</li>';
                                        }   
                                    ?>
                                </ul>
                            </div>
                            <a class="md-btn md-btn-flat md-btn-flat-primary" href="cms/notification">{_p_s_all}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>