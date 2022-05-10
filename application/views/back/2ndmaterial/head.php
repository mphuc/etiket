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
    <title>Cpanel | {title}</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{asset}bower_components/uikit/css/uikit.almost-flat.min.css"/>
    <?php if(isset($dashboard)){ ?>
        <link rel="stylesheet" href="{asset}bower_components/metrics-graphics/dist/metricsgraphics.css">
        <link rel="stylesheet" href="{asset}bower_components/c3js-chart/c3.min.css">
    <?php } ?>
    <link rel="stylesheet" href="{asset}icons/flags/flags.min.css" media="all">
    <link rel="stylesheet" href="{asset}css/main.min.css" media="all">
    <link rel="stylesheet" href="{asset}css/custom.css?v=2" media="all">
    <link rel="stylesheet" href="{asset}bower_components/kendo-ui-core/styles/kendo.common-material.min.css"/>
    <link rel="stylesheet" href="{asset}bower_components/kendo-ui-core/styles/kendo.material.min.css"/>
    <script src="{asset}js/jquery-1.10.2.min.js"></script>
    <!-- common functions -->
    <script src="{asset}js/common.min.js"></script>
    <script type="text/javascript">
        var jQ = $.noConflict(true);
    </script>
</head>

<body class="sidebar_main_open sidebar_main_swipe">