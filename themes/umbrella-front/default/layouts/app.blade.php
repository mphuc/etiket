<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no"/>
    <link rel="apple-touch-icon" sizes="57x57" href="img/load/57/57/load/{{ $site_favicon }}">
    <link rel="apple-touch-icon" sizes="60x60" href="img/load/60/60/load/{{ $site_favicon }}">
    <link rel="apple-touch-icon" sizes="72x72" href="img/load/72/72/load/{{ $site_favicon }}">
    <link rel="apple-touch-icon" sizes="76x76" href="img/load/76/76/load/{{ $site_favicon }}">
    <link rel="apple-touch-icon" sizes="114x114" href="img/load/114/114/load/{{ $site_favicon }}">
    <link rel="apple-touch-icon" sizes="120x120" href="img/load/120/120/load/{{ $site_favicon }}">
    <link rel="apple-touch-icon" sizes="144x144" href="img/load/144/144/load/{{ $site_favicon }}">
    <link rel="apple-touch-icon" sizes="152x152" href="img/load/152/152/load/{{ $site_favicon }}">
    <link rel="apple-touch-icon" sizes="180x180" href="img/load/180/180/load/{{ $site_favicon }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/load/192/192/load/{{ $site_favicon }}">
    <link rel="icon" type="image/png" sizes="32x32" href="img/load/32/32/load/{{ $site_favicon }}">
    <link rel="icon" type="image/png" sizes="96x96" href="img/load/96/96/load/{{ $site_favicon }}">
    <link rel="icon" type="image/png" sizes="16x16" href="img/load/16/16/load/{{ $site_favicon }}">
    <link rel="manifest" href="{{ $asset }}icons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/load/1/1/full/{Favicon Logo}">
    <meta name="theme-color" content="#ffffff">
    <title>{{ $site_title }}</title>
    <link href="{{ $google_publisher }}" rel="publisher"/>
    <link href='{{ $google_author_page  }}' rel='author'/>
    <meta name="description" content="{{ $site_desc }}"/>
    <meta name="keywords" content="{{ $site_keyword }}"/>
    <meta name="author" content="{{ $meta_author }}"/>
    <meta property="og:site_name" content="{{ $site_title }}"/>
    <meta property="og:title" content="{{ $site_title }}"/>
    <meta property="og:image" content="{{ base_url() }}img/load/100/100/full/{{ $site_logo }}"/>
    <meta property="og:description" content="{{ $site_desc }}"/>
    <meta property="og:url" content="{{ base_url() }}"/>
    <meta name="google-site-verification" content="{{ $google_webmaster_tools }}"/>
    <meta name="alexaVerifyID" content="{{ $alexa_verification }}"/>
    <meta name="msvalidate.01" content="{{ $bing_webmaster }}"/>
    <meta name="p:domain_verify" content="{{ $pinterest }}"/>
    <meta name="yandex-verification" content="{{ $yandex_webmaster }}"/>
    <meta name="text:Google Analytics ID" content="{{ $google_analyty }}"/>
    <meta name="robots" content="{{ $robot_index }}"/>
    <meta name="thumbnailUrl" content="{{ base_url() }}img/load/100/100/full/{{ $site_logo }}" itemprop="thumbnailUrl"/>
    <meta content="{{ base_url() }}" itemprop="url"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="{{ $twitter_seo }}"/>
    <meta name="twitter:site:id" content="{{ $twitter_seo }}"/>
    <meta name="twitter:creator" content="{{ $twitter_seo }}"/>
    <meta name="twitter:description" content="{{ $site_desc }}"/>
    <meta name="twitter:image:src" content="{{ base_url() }}img/load/100/100/full/{{ $site_logo }}"/>
    <link rel="stylesheet" href="{{ $asset }}bower_components/uikit/css/uikit.almost-flat.min.css" media="all">
    <link rel="stylesheet" href="{{ $asset }}css/main.min.css" media="all">
    <link rel="stylesheet" href="{{ $asset }}css/custom.css?v=2" media="all">
    <!--[if lte IE 9]>
    <script type="text/javascript" src="bower_components/matchMedia/matchMedia.js"></script>
    <script type="text/javascript" src="bower_components/matchMedia/matchMedia.addListener.js"></script>
    <![endif]-->

    @yield('print-head')
</head>
<body>
@include('partials.nav')

@yield('body')

@include('partials.footer')

<!-- google web fonts -->
<script>
    WebFontConfig = {
        google: {
            families: [
                'Source+Code+Pro:400,700:latin',
                'Roboto:300,400,500,700,400italic:latin'
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
<!-- google web fonts -->
<script src="{{ $asset }}js/jquery-2.2.4.min.js"></script>
<script src="{{ $asset }}js/common.min.js"></script>
<script src="{{ $asset }}js/uikit_custom.min.js"></script>
<script src="{{ $asset }}js/altair_lp_common.js"></script>

@yield('script-body')

</body>
</html>