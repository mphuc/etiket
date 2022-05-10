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
    <title>Reset Password | {title}</title>
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
                    <img style="max-width: 50%;" alt="panel logo" src="<?php echo base_url("themes/umbrella-front/default/img/kidsfun.JPG")?> "/>
                </div>
                <h3>Please input new password</h3>
                <?php echo form_open("cms/auth/reset_password", array('method' => 'post'));?>
                    <div class="uk-form-row">
                        <label for="password"> New Password</label>
                        <?php echo form_input($password,'', 'required autofocus');?>
                    </div>
                    <input type="hidden" name="code" value="<?php echo $code?>" required>
                    <div class="uk-margin-medium-top">
                        <?php echo form_submit('submit', 'Update Password', 'class="md-btn md-btn-primary md-btn-block md-btn-large"');?>
                    </div>
                 <?php echo form_close();?>
            </div>
        </div>
        <div class="uk-margin-top">
            <a href="<?php echo base_url('cms/auth')?>" id="login_help_show">Back to login</a>
        </div>
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