<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="<?php echo base_url(); ?>" />
    <link rel="icon" type="image/png" href="{asset}img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="{asset}img/favicon-32x32.png" sizes="32x32">
    <title>Cpanel | Museum Nasional Indonesia</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{asset}bower_components/uikit/css/uikit.almost-flat.min.css"/>
    <?php if(isset($dashboard)){ ?>
        <link rel="stylesheet" href="{asset}bower_components/metrics-graphics/dist/metricsgraphics.css">
        <link rel="stylesheet" href="{asset}bower_components/c3js-chart/c3.min.css">
    <?php } ?>
    <link rel="stylesheet" href="{asset}icons/flags/flags.min.css" media="all">
    <link rel="stylesheet" href="{asset}css/main.min.css" media="all">
    <link rel="stylesheet" href="{asset}css/custom.css" media="all">
    <link rel="stylesheet" href="{asset}css/login_page.min.css" />
    <script src="{asset}js/jquery-1.10.2.min.js"></script>
    <!-- common functions -->
    <script src="{asset}js/common.min.js"></script>
    <script type="text/javascript">
        var jQ = $.noConflict(true);
    </script>
</head>
<body class="login_page">

    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <img style="max-width: 50%;" alt="panel logo" src="<?php echo base_url("themes/umbrella-back/2ndmaterial/img/kemendikbud.png")?> "/>
                </div>
                <?php echo form_open("cms/auth");?>
                    <div class="uk-form-row">
                        <label for="username"><?php echo lang('login_identity_label', 'identity');?></label>
                        <?php echo form_input($identity,'','required autofocus');?>
                    </div>
                    <div class="uk-form-row">
                        <label for="password"> <?php echo lang('login_password_label', 'password');?></label>
                        <?php echo form_input($password,'', 'required');?>
                    </div>
                    <div class="uk-margin-medium-top">
                        <?php echo form_submit('submit', lang('login_submit_btn'), 'class="md-btn md-btn-primary md-btn-block md-btn-large"');?>
                    </div>
                <?php
                if($button_google != null):
                ?>
                <!--     <div class="uk-margin-medium-top" style="margin-top: 10px !important;">
                        <a href="<?php echo $button_google;?>" class="md-btn md-btn-gplus md-btn-large md-btn-block md-btn-icon"><i class="uk-icon-google-plus"></i>Sign in with Google+</a>
                    </div> -->
                <?php
                endif;
                ?>

                    <div class="uk-margin-top">
                        <span class="icheck-inline">
                            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                            <label for="login_page_stay_signed" class="inline-label"><?php echo lang('login_remember_label', 'remember');?></label>
                        </span>
                    </div>
                 <?php echo form_close();?>
            </div>
            <div class="md-card-content large-padding uk-position-relative" id="login_help" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top" id="login_help_close"></button>
                <h2 class="heading_b uk-text-success">Can't log in?</h2>
                <p>Here’s the info to get you back in to your account as quickly as possible.</p>
                <p>First, try the easiest thing: if you remember your password but it isn’t working, make sure that Caps Lock is turned off, and that your username is spelled correctly, and then try again.</p>
                <p>If your password still isn’t working, it’s time to <a href="#" id="login_password_reset_show">reset your password</a>.</p>
            </div>
            <div class="md-card-content large-padding" id="login_password_reset" style="display: none">
                <h2 class="heading_a uk-margin-large-bottom">Reset password</h2>
                <form action="<?php echo base_url('cms/auth/forgot')?>" method="post">
                    <div class="uk-form-row">
                        <label for="login_email_reset">Your email address</label>
                        <input class="md-input" type="text" id="login_email_reset" name="email" required/>
                    </div>
                    <div class="uk-margin-medium-top">
                        <button type="submit" class="md-btn md-btn-primary md-btn-block">Reset password</button>
                    </div>
                </form>
            </div>
        </div>
       <!--  <div class="uk-margin-top">
            <a href="#" id="login_help_show">Need help?</a>
        </div> -->
    </div>

    <script src="{asset}js/common.min.js"></script>

    <script src="{asset}js/altair_admin_common.min2.js"></script>
    <script src="{asset}bower_components/moment/min/moment.min.js"></script>
    <script src="{asset}js/uikit_custom.min2.js"></script>
    
    <script src="{asset}js/pages/login_page.min.js"></script>
    <script src="{asset}js/pages/components_notifications.min.js"></script>

    <script>
        <?php if(!empty($message)) 
        {  
        ?>
        UIkit.notify({
            message : '<i class="uk-icon-check"></i> <?php echo str_replace(array("\n", "\r"), ' ',strip_tags($message))?>',
            status  : 'danger',
            timeout : 5000,
            pos     : 'top-center'
        });
        <?php
        }   
        ?>
    </script>
</body>
</html>