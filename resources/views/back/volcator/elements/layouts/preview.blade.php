<!DOCTYPE html>
<html lang="en" data-kit-theme="default">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if (app('APP_NAME') != null)
        {{ app('APP_NAME') }}
        @else
        {{ Config::get('volcator.app_name') }}
        @endif
        {{ trans('Configurations::Configurations/Configurations.title_tab_description') }}
    </title>


    @if(App::getLocale() == 'ar' || App::getLocale() == 'he' || App::getLocale() == 'ru' || App::getLocale() == 'fa' )
    <link id="rtl_ltr_b1"
          href="{{asset(app('back').'/assets/plugins/bootstrap/RTL/bootstrap-rtl.min.css')}}"
          rel="stylesheet" type="text/css" title="rtl"/>
    <link id="rtl_ltr_b2"
          href="{{asset(app('back').'/assets/plugins/bootstrap/RTL/bootstrap-flipped.min.css')}}"
          rel="stylesheet" type="text/css" title="rtl"/>
    <link id="rtl_ltr" href="{{asset(app('back').'/assets/css/layout-RTL.css')}}" rel="stylesheet"
          type="text/css" title="rtl"/>
    @endif


    <!-- PRELOADER STYLES-->
    <style>
        .initial__loading {
            position: fixed;
            z-index: 99999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-position: center center;
            background-repeat: no-repeat;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDFweCIgIGhlaWdodD0iNDFweCIgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIiBjbGFzcz0ibGRzLXJvbGxpbmciPiAgICA8Y2lyY2xlIGN4PSI1MCIgY3k9IjUwIiBmaWxsPSJub25lIiBuZy1hdHRyLXN0cm9rZT0ie3tjb25maWcuY29sb3J9fSIgbmctYXR0ci1zdHJva2Utd2lkdGg9Int7Y29uZmlnLndpZHRofX0iIG5nLWF0dHItcj0ie3tjb25maWcucmFkaXVzfX0iIG5nLWF0dHItc3Ryb2tlLWRhc2hhcnJheT0ie3tjb25maWcuZGFzaGFycmF5fX0iIHN0cm9rZT0iIzAxOTBmZSIgc3Ryb2tlLXdpZHRoPSIxMCIgcj0iMzUiIHN0cm9rZS1kYXNoYXJyYXk9IjE2NC45MzM2MTQzMTM0NjQxNSA1Ni45Nzc4NzE0Mzc4MjEzOCIgdHJhbnNmb3JtPSJyb3RhdGUoODQgNTAgNTApIj4gICAgICA8YW5pbWF0ZVRyYW5zZm9ybSBhdHRyaWJ1dGVOYW1lPSJ0cmFuc2Zvcm0iIHR5cGU9InJvdGF0ZSIgY2FsY01vZGU9ImxpbmVhciIgdmFsdWVzPSIwIDUwIDUwOzM2MCA1MCA1MCIga2V5VGltZXM9IjA7MSIgZHVyPSIxcyIgYmVnaW49IjBzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlVHJhbnNmb3JtPiAgICA8L2NpcmNsZT4gIDwvc3ZnPg==);
            background-color: #fff;
        }

        [data-kit-theme='dark'] .initial__loading {
            background-color: #0c0c1b;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('.initial__loading').delay(200).fadeOut(400)
        })
    </script>
    {!! VolcatorMediaStyle::cssMediaHook() !!}
</head>

<body class="cui__layout--cardsShadow cui__menuLeft--dark cui__menuTop--dark">
@yield('content')
</body>
<script>
    $(document).ready(function(){
        $('.dropify-picture-space').dropify();
    });
</script>
{!! VolcatorMediaStyle::jsMediaHook() !!}
</html>
