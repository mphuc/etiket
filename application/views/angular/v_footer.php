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

<script src="{asset}js/common.min.js"></script>
<script src="{asset}js/uikit_custom.min.js"></script>
<script src="{asset}js/altair_admin_common.min.js"></script>
<script src="{asset}js/pages/dashboard.min.js"></script>
<script src="{asset}js/kendoui.min.js"></script>
<script src="{asset}js/kendoui.custom.min.js"></script>

<?php if(isset($profile)){ ?>
    <script src="{asset}bower_components/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="{asset}js/pages/page_user_profile.min.js"></script>
<?php } ?>

<?php if(isset($nastable)){ ?>
    <script src="{asset}js/pages/components_nestable.min.js"></script>
<?php } ?>
<script>
    $(function() {
        altair_helpers.retina_images();
        if(Modernizr.touch) {
            FastClick.attach(document.body);
        }
    });
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
<?php if(isset($nastable)){ ?>
    <script>
        $('document').ready(function() {
            updatelist();
            $('.selectall').on('ifChecked', function(event){
                var target = $(this).attr('id');
                $('.'+target).iCheck('check');
            });
            $('.selectall').on('ifUnchecked', function(event){
                var target = $(this).attr('id');
                $('.'+target).iCheck('uncheck');
            });
            $(".sendtolistmenu").on("click",function(){
                var target = $(this).attr('id');
                var parenttype = $(this).attr('title');
                $('.'+target).each(function() {
                    if ($(this).is(":checked")) {
                        var textvalue = '<div  class="uk-nestable-panel"><div class="uk-nestable-toggle" data-nestable-action="toggle"></div><span class="uk-text-muted uk-text-small">'+$(this).attr('title')+'<a href="javascript:void(0)" title="Remove this" data-uk-tooltip class="removethis material-icons float-right">&#xE14A;</a></span></div>';
                        $("#nestable").append("<li class='uk-nestable-item' data-id='" + $(this).val()+ "' data-parenttype='"+parenttype+"'>" +textvalue+ "</li>");
                        updatelist();
                        $(this).iCheck('uncheck');
                    }
                });
                return false;
            });
            $("#savefinallist").on("click",function(){
                var t = $("#nestable");
                var e = t.data("nestable").serialize();
                console.log(e);
                return false;
            });
            $('#nestable').on('click', '.removethis', function() {
                $(this).closest( "li" ).slideUp("slow", function() {  $(this).closest( "li" ).remove();  updatelist();});
                return false;
            });
            $("#changetypemenu").on("click",function(){
                var id = $("#jenis_menu").val();
                window.location.href = "<?php echo base_url(); ?>cpanel/menus?type="+id;
                return true;
            });
        });

        function savemultiple() {
            altair_helpers.content_preloader_show();
            var category_name  = $('#textlink').val();
            var category_desc  = $('#urllink').val();
            var category_type  = "link";
            var url            = "cms/menus/add_link";
            if(category_name != "" && category_type != ""){
                $.post(url,{ category_name :category_name,category_type :category_type,category_desc :category_desc }, function (html) {
                    var item = $.parseJSON(html);
                    var textvalue = '<div class="uk-nestable-panel"><div class="uk-nestable-toggle" data-nestable-action="toggle"></div><span class="uk-text-muted uk-text-small">'+item.category_name+'<a href="javascript:void(0)" title="Remove this" data-uk-tooltip class="removethis material-icons float-right">&#xE14A;</a></span></div>';
                    $("#nestable").append("<li class='uk-nestable-item' data-id='" +item.category_id+ "' data-parenttype='2'>" +textvalue+ "</li>");
                    updatelist();
                    altair_helpers.content_preloader_hide();
                    UIkit.notify({
                        message : 'Add data <i>link</i> success',
                        status  : 'success',
                        timeout : 5000,
                        pos     : 'top-center'
                    });
                });
            }
            updatelist();
        }
        $(function() {
            altair_nestable.init()
        }), altair_nestable = {
            init: function() {
                function e(a, l) {

                }
                var t = $("#nestable");
                if (t.length) {
                    if (lsTest() && null !== localStorage.getItem("nestable_items")) {
                        var a = localStorage.getItem("nestable_items"),
                            l = t.clone().empty();
                        e(JSON.parse(a), l);
                    } {
                        UIkit.nestable(t, {})
                    }
                    t.on("change.uk.nestable", function() {
                        var e = t.data("nestable").serialize();
                        $('#tmp').val(JSON.stringify(e));
                        lsTest() && (0 === localStorage.length || localStorage.getItem("nestable_items") != JSON.stringify(e)) && localStorage.setItem("nestable_items", JSON.stringify(e))
                    })
                }

            }
        };
        function updatelist(){
            altair_nestable.init();
            altair_nestable = {
                init: function() {
                    function e(a, l) {

                    }
                    var t = $("#nestable");
                    if (t.length) {
                        if (lsTest() && null !== localStorage.getItem("nestable_items")) {

                        } {
                            UIkit.nestable(t, {})
                        }

                        var e = t.data("nestable").serialize();
                        $('#tmp').val(JSON.stringify(e));
                        lsTest() && (0 === localStorage.length || localStorage.getItem("nestable_items") != JSON.stringify(e)) && localStorage.setItem("nestable_items", JSON.stringify(e))

                    }

                }
            };
        }
    </script>
    <?php
    $msg = $this->session->flashdata('msg');
    if(!empty($msg)) {
        ?>
        <script>
            UIkit.notify({
                message : 'Add data menus success',
                status  : 'success',
                timeout : 5000,
                pos     : 'top-center'
            });
        </script>
    <?php } ?>

<?php } ?>

<script type="text/javascript">

    $('.uk-pagination a').on('click', function (event) {
        event.preventDefault();
        /* if ( $(this).attr('href') != '#' ) {
         $("html, body").animate({ scrollTop: 0 }, "fast");
         $('#ajaxContent').load($(this).attr('href'));
         }*/
        $('.uk-pagination li').removeClass('uk-active');
        console.log( $(this).attr('data-url') );
        $(this).parent().addClass('uk-active');

    });
</script>

<script type="text/javascript">
    $document.ready(function () {
        $("#export-pdf").click(function () {
            $('form').append('<input type="hidden" name="export" value="pdf" />').attr('target', '_blank').submit();
            $('form').removeAttr("target");
            $("form").find('input[type="hidden"][name="export"]').remove();
        });
        $("#export-excel").click(function () {
            $('form').append('<input type="hidden" name="export" value="excel" />').attr('target', '_blank').submit();
            $('form').removeAttr("target");
            $("form").find('input[type="hidden"][name="export"]').remove();
        });
    });

    $(".timepic").kendoDateTimePicker({
        format: 'yyyy-MM-dd HH:mm:ss',
        timeFormat: "HH:mm"
    });
    $(".datepic").kendoDatePicker({
        format: "yyyy-MM-dd"
    });

</script>

</body>
</html>