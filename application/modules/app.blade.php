<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="id"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="id"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="{{ base_url() }}" />
    <link rel="icon" type="image/png" href="{{ assets_back() }}img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ assets_back() }}img/favicon-32x32.png" sizes="32x32">
    <title>{{ @$subject ? $subject : $site_title }}</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ assets_back() }}bower_components/uikit/css/uikit.almost-flat.min.css"/>
   <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">    

    <link rel="stylesheet" href="{{ assets_back() }}icons/flags/flags.min.css" media="all">
    <link rel="stylesheet" href="{{ assets_back() }}css/main.min.css" media="all">
    <link rel="stylesheet" href="{{ assets_back() }}css/custom.css?v=2" media="all">
    <link rel="stylesheet" href="{{ assets_back() }}bower_components/kendo-ui-core/styles/kendo.common-material.min.css"/>
    <link rel="stylesheet" href="{{ assets_back() }}bower_components/kendo-ui-core/styles/kendo.material.min.css"/>
    
    @yield('head')
    <style type="text/css">
        /* Absolute Center Spinner */
        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: visible;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.3);
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 1500ms infinite linear;
            -moz-animation: spinner 1500ms infinite linear;
            -ms-animation: spinner 1500ms infinite linear;
            -o-animation: spinner 1500ms infinite linear;
            animation: spinner 1500ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
    <style type="text/css">
        .k-multiselect.k-header {
            border-color: #675e5e !important;
        }
    </style>
    <script>
        var base_url = '{{ base_url() }}';
    </script>
    <script src="{{ assets_back() }}angular/angular.min.js"></script>
    <script src="{{ assets_back() }}angular-sanitize/angular-sanitize.min.js"></script>
    <script src="{{ assets_back() }}angular-route/angular-route.min.js"></script>
    <script src="{{ assets_back() }}angular-storage/ngStorage.min.js"></script>
    <script src="{{ assets_back() }}js/jquery-1.10.2.min.js"></script>
    <script src="{{ assets_back() }}js/icheck/icheck.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"> </script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- common functions -->
    <script src="{{ assets_back() }}js/common.min.js"></script>
    <script type="text/javascript">
        var jQ = $.noConflict(true);
    </script>
    <script type="text/javascript">
        var cms_module = '{{ $module }}';
        var cms_url = '{{ base_url("cms/$module") }}';
    </script>
    
</head>

<body class="sidebar_main_open sidebar_main_swipe" ng-app="{{ $module }}">

@include('header')

@include('sidebar')

@yield('body')

@include('footer')

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ assets_back() }}js/common.min.js"></script>
<script src="{{ assets_back() }}js/uikit_custom.min.js"></script>
<script src="{{ assets_back() }}js/altair_admin_common.min.js"></script>
<script src="{{ assets_back() }}js/pages/dashboard.min.js"></script>
<script src="{{ assets_back() }}js/kendoui.min.js"></script>
<script src="{{ assets_back() }}js/kendoui.custom.min.js"></script>

@if(isset($profile))
<script src="{{ assets_back() }}bower_components/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="{{ assets_back() }}js/pages/page_user_profile.min.js"></script>
@endif

@if(isset($nastable))
<script src="{{ assets_back() }}js/pages/components_nestable.min.js"></script>
@endif
<script src="{{ assets_back() }}autoNumeric/autoNumeric.min.js"></script>
<script src="{{ assets_back() }}moment/moment.min.js"></script>
<script src="{{ assets_back() }}moment/locale/id.js"></script>
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
            var url    = "{{ base_url("img/updatenotif") }}/";
            var id     = {{ get_instance()->ion_auth->user()->row()->id }};

            if(id !== "") {
                $.post(url,{ user:id}, function (html) {

                });
            }
        });
    });
</script>
@if(isset($nastable))
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
    @php
        $msg = get_instance()->session->flashdata('msg');
    @endphp

    @if(!empty($msg))
        <script>
            UIkit.notify({
                message : 'Add data menus success',
                status  : 'success',
                timeout : 5000,
                pos     : 'top-center'
            });
        </script>
    @endif
@endif

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
    $('.numeric').autoNumeric('init',{digitGroupSeparator: '.', decimalCharacter: ',',allowDecimalPadding: false});

    $(".timepic").kendoDateTimePicker({
        format: 'yyyy-MM-dd HH:mm:ss',
        timeFormat: "HH:mm"
    });
    $(".datepic").kendoDatePicker({
        format: "yyyy-MM-dd"
    });

    $(".icheck").iCheck();

    $(".multi-s").kendoMultiSelect();

</script>

@yield('script')

<script type="text/javascript">
    if( typeof app !== "undefined"){
        app.filter('moment', function () {
            return function (input, momentFn /*, param1, param2, ...param n */) {
                var args = Array.prototype.slice.call(arguments, 2),
                    momentObj = moment(input);
                return momentObj[momentFn].apply(momentObj, args);
            };
        });
    }
</script>

</body>
</html>
