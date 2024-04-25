<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page_data->base_meta_title }} | PrestAIs</title>
    <meta name="keywords" content="{{ $page_data->base_meta_keywords }}">
    <meta name="description" content="{{ $page_data->base_meta_description }}">
    <meta name="author" content="Prestais">

    <script src="{{ asset(app('front').'/assets/js/jquery/dist/jquery.min.js') }}"></script>
    <link rel="shortcut icon" href="{{ asset(app('front').'/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset(app('front').'/assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset(app('front').'/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset(app('front').'/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset(app('front').'/assets/css/colors/yellow.css') }}">
    <link rel="preload" href="{{ asset(app('front').'/assets/css/fonts/thicccboi.css') }}" as="style" onload="this.rel='stylesheet'">

    @if(App::getLocale() == 'ar' || App::getLocale() == 'he' || App::getLocale() == 'ru' || App::getLocale() == 'fa' )
    <link id="rtl_ltr_b1"
          href="{{asset(app('front').'/assets/plugins/bootstrap/RTL/bootstrap-rtl.min.css')}}"
          rel="stylesheet" type="text/css" title="rtl"/>
    <link id="rtl_ltr_b2"
          href="{{asset(app('front').'/assets/plugins/bootstrap/RTL/bootstrap-flipped.min.css')}}"
          rel="stylesheet" type="text/css" title="rtl"/>
    <link id="rtl_ltr" href="{{asset(app('front').'/assets/css/layout-RTL.css')}}" rel="stylesheet"
          type="text/css" title="rtl"/>
    @endif

</head>

<body>
    @include('elements.layouts.navbar')
    @yield('content')
    @include('elements.layouts.footer')
    <script src="{{ asset(app('front').'/assets/js/plugins.js') }}"></script>
    <script src="{{ asset(app('front').'/assets/js/theme.js') }}"></script>
</body>
</html>
