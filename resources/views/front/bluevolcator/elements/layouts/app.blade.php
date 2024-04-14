<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset(app('front').'/assets/images/twedoo-icon.ico') }}" sizes="16x16">

    <title>Twedoo - Stack Services Platform</title>


    <script src="{{ asset(app('front').'/assets/js/vue.js') }}" type="text/javascript"></script>

    <script src="{{ asset(app('front').'/assets/js/TweenMax-latest-beta.js') }}" type="text/javascript"></script>
    <script src="{{ asset(app('front').'/assets/js/MorphSVGPlugin.js') }}" type="text/javascript"></script>

    <!-- Styles -->
    <link href="{{ asset(app('front').'/assets/css/marketing.css') }}" rel="stylesheet">
{{--    <link href="{{ asset(app('front').'/assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">--}}

    <!-- Scripts --> <script>try {
            Object.defineProperty(screen, "availTop", { value: 0 });
        } catch (e) {}
        try {
            Object.defineProperty(screen, "availLeft", { value: 0 });
        } catch (e) {}
        try {
            Object.defineProperty(screen, "availWidth", { value: 1920 });
        } catch (e) {}
        try {
            Object.defineProperty(screen, "availHeight", { value: 1080 });
        } catch (e) {}
        try {
            Object.defineProperty(screen, "colorDepth", { value: 24 });
        } catch (e) {}
        try {
            Object.defineProperty(screen, "pixelDepth", { value: 24 });
        } catch (e) {}
        try {
            Object.defineProperty(navigator, "hardwareConcurrency", { value: 8 });
        } catch (e) {}
        try {
            Object.defineProperty(navigator, "appVersion", { value: "5.0 (X11)" });
        } catch (e) {}
        try {
            Object.defineProperty(navigator, "doNotTrack", { value: "unspecified" });
        } catch (e) {}

        try {
            window.screenY = 0
        } catch (e) { }

        try {
            window.screenTop = 0
        } catch (e) { }

        try {
            window.top.window.outerHeight = window.screen.height
        } catch (e) { }

        try {
            window.screenX = 0
        } catch (e) { }

        try {
            window.screenLeft = 0
        } catch (e) { }

        try {
            window.top.window.outerWidth = window.screen.width
        } catch (e) { }
    </script>
    <script>try {
            Object.defineProperty(screen, "availTop", { value: 0 });
        } catch (e) {}
        try {
            Object.defineProperty(screen, "availLeft", { value: 0 });
        } catch (e) {}
        try {
            Object.defineProperty(screen, "availWidth", { value: 1920 });
        } catch (e) {}
        try {
            Object.defineProperty(screen, "availHeight", { value: 1080 });
        } catch (e) {}
        try {
            Object.defineProperty(screen, "colorDepth", { value: 24 });
        } catch (e) {}
        try {
            Object.defineProperty(screen, "pixelDepth", { value: 24 });
        } catch (e) {}
        try {
            Object.defineProperty(navigator, "hardwareConcurrency", { value: 8 });
        } catch (e) {}
        try {
            Object.defineProperty(navigator, "appVersion", { value: "5.0 (X11)" });
        } catch (e) {}
        try {
            Object.defineProperty(navigator, "doNotTrack", { value: "unspecified" });
        } catch (e) {}

        try {
            window.screenY = 0
        } catch (e) { }

        try {
            window.screenTop = 0
        } catch (e) { }

        try {
            window.top.window.outerHeight = window.screen.height
        } catch (e) { }

        try {
            window.screenX = 0
        } catch (e) { }

        try {
            window.screenLeft = 0
        } catch (e) { }

        try {
            window.top.window.outerWidth = window.screen.width
        } catch (e) { }
    </script>
    <script src="{{ asset(app('front').'/assets/js/TweenMax-latest-beta.js') }}" type="text/javascript"></script>
    <script src="{{ asset(app('front').'/assets/js/MorphSVGPlugin.js') }}" type="text/javascript"></script>

</head>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Twedoo - CMS</title>
    <meta name="description" content="Twedoo CMS">

    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">

{{--    <link href="{{ asset(app('front').'/assets/css/...') }}" rel="stylesheet">--}}

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

{{--    <script src="{{ asset(app('front').'/assets/js/...') }}"></script>--}}

</head>
<body class="font-sans antialiased text-gray-900" cz-shortcut-listen="true">

@yield('content')
@include('elements.layouts.footer')

<script>
    window.addEventListener('DOMContentLoaded', ()=> {
        const menuBtn = document.querySelector('#btn-translate')
        const dropdown = document.querySelector('#dropdown')
        menuBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden')
            dropdown.classList.toggle('flex')
        })
    })
</script>
</body>
</html>