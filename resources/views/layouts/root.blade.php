<!doctype html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Content-Language" content="en" />
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="theme-color" content="#4188c9">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <link rel="icon" href="{{ URL::asset('images/favicon.png') }}" type="image/png"/>
        <link rel="shortcut icon" href="{{ URL::asset('images/favicon.png') }}" type="image/png"/>
        <!-- Generated: 2018-04-16 09:29:05 +0200 -->
        <title>@yield('title_page')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
        <script src="{{ URL::asset('js/require.min.js') }}"></script>
        @yield('cssasset')
        @yield('cssinline')
        <!-- Dashboard Core -->
        <link href="{{ URL::asset('css/dashboard.css') }}?time=1" rel="stylesheet" />
        <script src="{{ URL::asset('js/dashboard.js') }}?time=1"></script>
        <!-- c3.js Charts Plugin -->
        <link href="{{ URL::asset('plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
        <script src="{{ URL::asset('plugins/charts-c3/plugin.js') }}?t=1"></script>
        <!-- Google Maps Plugin -->
        <link href="{{ URL::asset('plugins/maps-google/plugin.css') }}" rel="stylesheet" />
        <script src="{{ URL::asset('plugins/maps-google/plugin.js') }}"></script>
        <!-- Input Mask Plugin -->
        <script src="{{ URL::asset('plugins/input-mask/plugin.js') }}"></script>
        @yield('jsasset')
        <script>
            requirejs.config({
                baseUrl: '.',
                paths: {
                    app: '../app'
                }
            });
        </script>
        @yield('jsinline')
    </head>
    <body>
        @yield('content_root')
    </body>
</html>