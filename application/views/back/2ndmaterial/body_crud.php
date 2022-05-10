
<!-- flag icons -->
<link rel="stylesheet" href="<?php echo $asset; ?>icons/flags/flags.min.css" media="all">
<!-- altair admin -->
<link rel="stylesheet" href="<?php echo $asset; ?>css/main.min.css" media="all">
<link rel="stylesheet" href="<?php echo $asset; ?>css/custom.css?v=2" media="all">
<link rel="stylesheet" href="<?php echo $asset; ?>bower_components/kendo-ui-core/styles/kendo.common-material.min.css"/>
<link rel="stylesheet" href="<?php echo $asset; ?>bower_components/kendo-ui-core/styles/kendo.material.min.css"/>
<?php
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<script src="<?php echo $asset; ?>js/jquery-1.10.2.min.js"></script>
<!-- common functions -->
<script src="<?php echo $asset; ?>js/common.min.js"></script>
<script type="text/javascript">
    var jQ = $.noConflict(true);
</script>
<?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>



<?php
if(!empty($output))
    echo $output;
?>
<style type="text/css">
    body {
        background: none !important;
    }
</style>
<!-- secondary sidebar -->
<aside id="sidebar_secondary" class="tabbed_sidebar">
    <ul class="uk-tab uk-tab-icons uk-tab-grid" data-uk-tab="{connect:'#dashboard_sidebar_tabs', animation:'slide-horizontal'}">
        <li class="uk-active uk-width-1-2"><a href="#"><i class="material-icons">&#xE422;</i></a></li>
        <li class="uk-width-1-2 chat_sidebar_tab"><a href="#"><i class="material-icons">&#xE0B7;</i></a></li>
    </ul>

    <div class="scrollbar-inner">
        <ul style="margin-top:40px;" id="dashboard_sidebar_tabs" class="uk-switcher">
            <li>
                <div class="timeline timeline_small uk-margin-bottom">
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
                <ul class="md-list md-list-addon ">
                    <?php $userpanellist=$this->base_config->userpanellist(); ?>
                    <?php foreach($userpanellist as $user) { ?>
                        <li>
                            <div class="md-list-addon-element">
                                <span class="element-status element-status-<?php if($user->active == 1){ echo 'success';}else {echo 'danger';} ?>"></span>
                                <img class="md-user-image md-list-addon-avatar" src="img/load/80/80/crop/<?php echo $user->user_avatar; ?>" alt=""/>
                            </div>
                            <div class="md-list-content">
                                <div class="md-list-action-placeholder"></div>
                                <span class="md-list-heading"><?php echo $user->user_display_name; ?></span>
                                <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo $user->user_company; ?></span>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        </ul>
    </div>

    <button type="button" class="chat_sidebar_close uk-close"></button>
    <div class="chat_submit_box">
        <div class="uk-input-group">
            <input type="text" class="md-input" name="submit_message" id="submit_message" placeholder="Send message">
            <span class="uk-input-group-addon">
                    <a href="#"><i class="material-icons md-24">&#xE163;</i></a>
                </span>
        </div>
    </div>
</aside>
<!-- secondary sidebar end -->

<!-- google web fonts -->
<script type="text/javascript">

    /*NAV SIDEBAR ONLY*/
    $("#menu_top>li").each(function (index,value) {
        var length_li = $(this).children().children('ul').children('li').length;
        if( index != 0 && index != $("#menu_top>li").length-1 ){
            if( length_li == 0 ){
                $(this).hide();
            }
        }
    });
    $("#nav-left>li").each(function (index,value) {
        var length_li = $(this).children().children('li').length;
        if( index != 0 && index != $("#nav-left>li").length-1 ){
            if( length_li == 0 ){
                $(this).hide();
            }
        }
    });
    /*NAV SIDEBAR ONLY*/

    WebFontConfig = {
        google: {
            families: [
                'Source+Code+Pro:400,700:latin',
                'Roboto:400,300,500,700,400italic:latin'
            ]
        }
    };
    (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
</script>


<script src="<?php echo $asset; ?>js/uikit_custom.min.js"></script>
<!-- altair common functions/helpers -->
<script src="<?php echo $asset; ?>js/altair_admin_common.min.js"></script>

<!-- handlebars.js -->
<script src="<?php echo $asset; ?>bower_components/handlebars/handlebars.min.js"></script>
<script src="<?php echo $asset; ?>js/custom/handlebars_helpers.min.js"></script>
<!-- CLNDR -->
<script src="<?php echo $asset; ?>bower_components/clndr/src/clndr.js"></script>
<!-- momentJS date library -->
<script src="<?php echo $asset; ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo $asset; ?>js/pages/dashboard.min.js"></script>
<!--  forms advanced functions -->
<script src="<?php echo $asset; ?>js/pages/forms_advanced.min.js"></script>
<script src="<?php echo $asset; ?>bower_components/ionrangeslider/js/ion.rangeSlider.min.js"></script>
<!-- page specific plugins -->
<!-- kendo UI -->
<script src="<?php echo $asset; ?>js/kendoui.custom.min.js"></script>

<!--  kendoui functions -->
<script src="<?php echo $asset; ?>js/pages/kendoui.min.js"></script>
<script>
    function preview(e) {
        $(".icon_preview").children('i').css("color", e.value);
    }
    $(".colorpic").kendoColorPicker({value:"#fff",buttons:!1,select:preview});
</script>

<script>
    $('document').ready(function() {
        $(".notifupdate" ).click(function() {
            var url    = "<?php echo base_url(); ?>img/updatenotif/";
            var id     = <?php echo $this->ion_auth->user()->row()->id; ?>;

            if(id !== "") {
                $.post(url,{ user:id}, function (html) {

                });
            }
        });
    });
</script>
<script>
    $(".timepic").kendoDateTimePicker({
        format: 'yyyy-MM-dd HH:mm:ss',
        timeFormat: "HH:mm:ss"
    });
    $(".datepic").kendoDatePicker({
        format: "yyyy-MM-dd"
    });
    $(function() {
        altair_helpers.retina_images();
        if(Modernizr.touch) {
            FastClick.attach(document.body);
        }
    });
</script>
<script>
    $(function() {
        var $switcher = $('#style_switcher'),
            $switcher_toggle = $('#style_switcher_toggle'),
            $theme_switcher = $('#theme_switcher'),
            $mini_sidebar_toggle = $('#style_sidebar_mini'),
            $boxed_layout_toggle = $('#style_layout_boxed'),
            $body = $('body');


        $switcher_toggle.click(function(e) {
            e.preventDefault();
            $switcher.toggleClass('switcher_active');
        });

        $theme_switcher.children('li').click(function(e) {
            e.preventDefault();
            var $this = $(this),
                this_theme = $this.attr('data-app-theme');

            $theme_switcher.children('li').removeClass('active_theme');
            $(this).addClass('active_theme');
            $body
                .removeClass('app_theme_a app_theme_b app_theme_c app_theme_d app_theme_e app_theme_f app_theme_g')
                .addClass(this_theme);

            if(this_theme == '') {
                localStorage.removeItem('altair_theme');
            } else {
                localStorage.setItem("altair_theme", this_theme);
            }

        });

        $document.on('click keyup', function(e) {
            if( $switcher.hasClass('switcher_active') ) {
                if (
                    ( !$(e.target).closest($switcher).length )
                    || ( e.keyCode == 27 )
                ) {
                    $switcher.removeClass('switcher_active');
                }
            }
        });


        if(localStorage.getItem("altair_theme") !== null) {
            $theme_switcher.children('li[data-app-theme='+localStorage.getItem("altair_theme")+']').click();
        }

        if((localStorage.getItem("altair_sidebar_mini") !== null && localStorage.getItem("altair_sidebar_mini") == '1') || $body.hasClass('sidebar_mini')) {
            $mini_sidebar_toggle.iCheck('check');
        }

        $mini_sidebar_toggle
            .on('ifChecked', function(event){
                $switcher.removeClass('switcher_active');
                localStorage.setItem("altair_sidebar_mini", '1');
                location.reload(true);
            })
            .on('ifUnchecked', function(event){
                $switcher.removeClass('switcher_active');
                localStorage.removeItem('altair_sidebar_mini');
                location.reload(true);
            });

        if((localStorage.getItem("altair_layout") !== null && localStorage.getItem("altair_layout") == 'boxed') || $body.hasClass('boxed_layout')) {
            $boxed_layout_toggle.iCheck('check');
            $body.addClass('boxed_layout');
            $(window).resize();
        }

        $boxed_layout_toggle
            .on('ifChecked', function(event){
                $switcher.removeClass('switcher_active');
                localStorage.setItem("altair_layout", 'boxed');
                location.reload(true);
            })
            .on('ifUnchecked', function(event){
                $switcher.removeClass('switcher_active');
                localStorage.removeItem('altair_layout');
                location.reload(true);
            });


    });
</script>


</body>
</html>
