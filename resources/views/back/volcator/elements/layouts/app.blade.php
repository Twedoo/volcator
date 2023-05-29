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
    </title>

    <link rel="icon" type="image/png" href="{{ asset(app('back').'/assets/components/kit/core/img/favicon.png') }}" />
    <link href="https://fonts.googleapis.com/css?family=Mukta:400,700,800&display=swap" rel="stylesheet">

    <!-- VENDORS -->
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/ladda/dist/ladda-themeless.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/select2/dist/css/select2.min.css') }}">
<!--    <link rel="stylesheet" type="text/css"-->
<!--          href="{{ asset(app('back').'/assets/vendors/tempus-dominus-bs4/build/css/tempusdominus-bootstrap-4.min.css') }}">-->
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/fullcalendar/dist/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/bootstrap-sweetalert/dist/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/summernote/dist/summernote.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/ionrangeslider/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/datatables/r-2.2.2/datatables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/c3/c3.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/chartist/dist/chartist.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/nprogress/nprogress.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/jquery-steps/demo/css/jquery.steps.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/dropify/dist/css/dropify.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/font-feathericons/dist/feather.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/font-linearicons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/font-icomoon/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <script src="{{ asset(app('back').'/assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/jquery-mousewheel/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/spin.js/spin.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/ladda/dist/ladda.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/html5-form-validation/dist/jquery.validation.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/jquery-typeahead/dist/jquery.typeahead.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/autosize/dist/autosize.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/bootstrap-show-password/dist/bootstrap-show-password.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/moment/min/moment.min.js') }}"></script>
<!--    <script src="{{ asset(app('back').'/assets/vendors/tempus-dominus-bs4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>-->
    <script src="{{ asset(app('back').'/assets/vendors/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/bootstrap-sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/ionrangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/nestable/jquery.nestable.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/datatables/r-2.2.2/datatables.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/editable-table/mindmup-editabletable.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/d3/d3.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/c3/c3.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/chartist-plugin-tooltips-updated/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/jquery-countTo/jquery.countTo.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/nprogress/nprogress.js') }}"></script>
<!--    <script src="{{ asset(app('back').'/assets/vendors/jquery-steps/build/jquery.steps.min.js') }}"></script>-->
    <script src="{{ asset(app('back').'/assets/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/d3-dsv/dist/d3-dsv.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/d3-time-format/dist/d3-time-format.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/techan/dist/techan.min.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/vendors/jqvmap/dist/maps/jquery.vmap.usa.js') }}"></script>

    <!-- CLEAN UI PRO HTML ADMIN TEMPLATE MODULES-->
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/kit/vendors/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/kit/core/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/cleanui/styles/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/kit/widgets/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/kit/apps/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/cleanui/ecommerce/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/cleanui/dashboards/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/cleanui/system/auth/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/cleanui/layout/breadcrumbs/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/cleanui/layout/footer/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/cleanui/layout/menu-left/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/cleanui/layout/menu-top/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/cleanui/layout/sidebar/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/cleanui/layout/support-chat/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/cleanui/layout/topbar/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset(app('back').'/assets/components/kit/vendors/custom.css') }}">

    <script src="{{ asset(app('back').'/assets/components/kit/core/index.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/components/cleanui/layout/menu-left/index.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/components/cleanui/layout/menu-top/index.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/components/cleanui/layout/sidebar/index.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/components/cleanui/layout/support-chat/index.js') }}"></script>
    <script src="{{ asset(app('back').'/assets/components/cleanui/layout/topbar/index.js') }}"></script>


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
<div class="initial__loading"></div>
<div class="cui__layout cui__layout--hasSider">
    <div class="kit__chat">
        <button class="kit__chat__toggleButton kit__chat__actionToggle">
            <i class="fe fe-message-square mr-md-2"></i>
            <span class="d-none d-md-inline">Support Chat</span>
        </button>
        <div class="kit__chat__container">
            <div class="d-flex flex-wrap mb-2">
                <div class="text-dark font-size-18 font-weight-bold mr-auto">Support Chat1</div>
                <button class="kit__g14__closeBtn btn btn-link">
                    <i class="fe fe-x-square font-size-21 align-middle text-gray-6"></i>
                </button>
            </div>
            <div class="height-300 d-flex flex-column justify-content-end">
                <div class="kit__g14__contentWrapper kit__customScroll">
                    <div class="kit__g14__message">
                        <div class="kit__g14__messageContent">
                            <div class="text-gray-4 font-size-12 text-uppercase">You, 5 min ago</div>
                            <div>
                                Hi! Anyone here? I want to know how I can buy Clean UI KIT Pro?
                            </div>
                        </div>
                        <div class="kit__g14__messageAvatar kit__utils__avatar">
                            <img src="{{ asset(app('back').'/assets/components/kit/core/img/avatars/avatar-2.png') }}" alt="You" />
                        </div>
                    </div>
                    <div class="kit__g14__message kit__g14__message--answer">
                        <div class="kit__g14__messageContent">
                            <div class="text-gray-4 font-size-12 text-uppercase">Mary, 14 sec ago</div>
                            <div>
                                Please call us + 100 295 000
                            </div>
                        </div>
                        <div class="kit__g14__messageAvatar kit__utils__avatar mr-3">
                            <img src="{{ asset(app('back').'/assets/components/kit/core/img/avatars/2.jpg') }}" alt="Mary Stanform" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-2 pb-2">
                Mary is typing...
            </div>
            <div>
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Send message..."
                        aria-label="Recipient's username"
                    />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fe fe-send align-middle"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="cui__sidebar kit__customScroll">
        <div class="cui__sidebar__inner">
            <a
                href="javascript: void(0);"
                class="cui__sidebar__close cui__sidebar__actionToggle fe fe-x-circle"
            ></a>
            <h5>
                <strong>Theme Settings</strong>
            </h5>
            <div class="cui__utils__line" style="margin-top: 25px; margin-bottom: 30px"></div>
            <div class="cui__sidebar__type">
                <div class="cui__sidebar__type__title">
                    <span>Application Name</span>
                </div>
                <div class="cui__sidebar__type__items">
                    <input id="appName" class="form-control" value="Clean UI Pro" />
                </div>
            </div>
            <div class="cui__sidebar__item hideIfMenuTop">
                <div class="cui__sidebar__label">
                    Left Menu: Collapsed
                </div>
                <div class="cui__sidebar__container">
                    <label class="cui__sidebar__switch">
                        <input type="checkbox" to="body" setting="cui__menuLeft--toggled" />
                        <span class="cui__sidebar__switch__slider"></span>
                    </label>
                </div>
            </div>
            <div class="cui__sidebar__item hideIfMenuTop">
                <div class="cui__sidebar__label">
                    Left Menu: Unfixed
                </div>
                <div class="cui__sidebar__container">
                    <label class="cui__sidebar__switch">
                        <input type="checkbox" to="body" setting="cui__menuLeft--unfixed" />
                        <span class="cui__sidebar__switch__slider"></span>
                    </label>
                </div>
            </div>
            <div class="cui__sidebar__item hideIfMenuTop">
                <div class="cui__sidebar__label">
                    Left Menu: Shadow
                </div>
                <div class="cui__sidebar__container">
                    <label class="cui__sidebar__switch">
                        <input type="checkbox" to="body" setting="cui__menuLeft--shadow" />
                        <span class="cui__sidebar__switch__slider"></span>
                    </label>
                </div>
            </div>
            <div class="cui__sidebar__item">
                <div class="cui__sidebar__label">
                    Menu: Color
                </div>
                <div class="cui__sidebar__container">
                    <div class="cui__sidebar__select" to="body">
                        <div
                            class="cui__sidebar__select__item cui__sidebar__select__item--white cui__sidebar__select__item--active"
                        ></div>
                        <div
                            class="cui__sidebar__select__item cui__sidebar__select__item--gray"
                            setting="cui__menuLeft--gray cui__menuTop--gray"
                        ></div>
                        <div
                            class="cui__sidebar__select__item cui__sidebar__select__item--black"
                            setting="cui__menuLeft--dark cui__menuTop--dark"
                        ></div>
                    </div>
                </div>
            </div>
            <div class="cui__sidebar__item">
                <div class="cui__sidebar__label">
                    Auth: Background
                </div>
                <div class="cui__sidebar__container">
                    <div class="cui__sidebar__select" to="body">
                        <div
                            class="cui__sidebar__select__item cui__sidebar__select__item--white cui__sidebar__select__item--active"
                        ></div>
                        <div
                            class="cui__sidebar__select__item cui__sidebar__select__item--gray"
                            setting="cui__auth--gray"
                        ></div>
                        <div
                            class="cui__sidebar__select__item cui__sidebar__select__item--img"
                            setting="cui__auth--img"
                        ></div>
                    </div>
                </div>
            </div>
            <div class="cui__sidebar__item">
                <div class="cui__sidebar__label">
                    Topbar: Fixed
                </div>
                <div class="cui__sidebar__container">
                    <label class="cui__sidebar__switch">
                        <input type="checkbox" to="body" setting="cui__topbar--fixed" />
                        <span class="cui__sidebar__switch__slider"></span>
                    </label>
                </div>
            </div>
            <div class="cui__sidebar__item">
                <div class="cui__sidebar__label">
                    Topbar: Gray Background
                </div>
                <div class="cui__sidebar__container">
                    <label class="cui__sidebar__switch">
                        <input type="checkbox" to="body" setting="cui__topbar--gray" />
                        <span class="cui__sidebar__switch__slider"></span>
                    </label>
                </div>
            </div>
            <div class="cui__sidebar__item">
                <div class="cui__sidebar__label">
                    App: Content Max-Width
                </div>
                <div class="cui__sidebar__container">
                    <label class="cui__sidebar__switch">
                        <input type="checkbox" to="body" setting="cui__layout--contentMaxWidth" />
                        <span class="cui__sidebar__switch__slider"></span>
                    </label>
                </div>
            </div>
            <div class="cui__sidebar__item">
                <div class="cui__sidebar__label">
                    App: Max-Width
                </div>
                <div class="cui__sidebar__container">
                    <label class="cui__sidebar__switch">
                        <input type="checkbox" to="body" setting="cui__layout--appMaxWidth" />
                        <span class="cui__sidebar__switch__slider"></span>
                    </label>
                </div>
            </div>
            <div class="cui__sidebar__item">
                <div class="cui__sidebar__label">
                    App: Gray background
                </div>
                <div class="cui__sidebar__container">
                    <label class="cui__sidebar__switch">
                        <input type="checkbox" to="body" setting="cui__layout--grayBackground" />
                        <span class="cui__sidebar__switch__slider"></span>
                    </label>
                </div>
            </div>
            <div class="cui__sidebar__item">
                <div class="cui__sidebar__label">
                    Cards: Squared Borders
                </div>
                <div class="cui__sidebar__container">
                    <label class="cui__sidebar__switch">
                        <input type="checkbox" to="body" setting="cui__layout--squaredBorders" />
                        <span class="cui__sidebar__switch__slider"></span>
                    </label>
                </div>
            </div>
            <div class="cui__sidebar__item">
                <div class="cui__sidebar__label">
                    Cards: Shadow
                </div>
                <div class="cui__sidebar__container">
                    <label class="cui__sidebar__switch">
                        <input type="checkbox" to="body" setting="cui__layout--cardsShadow" />
                        <span class="cui__sidebar__switch__slider"></span>
                    </label>
                </div>
            </div>
            <div class="cui__sidebar__item">
                <div class="cui__sidebar__label">
                    Cards: Borderless
                </div>
                <div class="cui__sidebar__container">
                    <label class="cui__sidebar__switch">
                        <input type="checkbox" to="body" setting="cui__layout--borderless" />
                        <span class="cui__sidebar__switch__slider"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <a
        href="javascript: void(0);"
        style="bottom: calc(50% + 120px)"
        class="cui__sidebar__toggleButton cui__sidebar__actionToggle"
        data-toggle="tooltip"
        data-placement="left"
        title="Settings"
    >
        <i class="fe fe-settings"></i>
    </a>
    <a
        href="javascript: void(0);"
        style="bottom: calc(50% + 60px)"
        class="cui__sidebar__toggleButton cui__sidebar__actionToggleTheme"
        data-toggle="tooltip"
        data-placement="left"
        title="Switch Dark / Light Theme"
    >
        <i class=" fe fe-moon cui__sidebar__on"></i>
        <i class="fe fe-sun cui__sidebar__off"></i>
    </a>
    <a
        href="javascript: void(0);"
        style="bottom: calc(50%)"
        class="cui__sidebar__toggleButton color reset"
        data-toggle="tooltip"
        data-placement="left"
        title="Set Primary Color"
    >
        <button type="button" id="resetColor" tabindex="0">
            <i class="fe fe-x-circle"></i>
        </button>
        <input type="color" id="colorPicker" value="#4b7cf3" />
        <i class="fe fe-package"></i>
    </a>
    <a
        href="https://docs.cleanuitemplate.com"
        target="_blank"
        rel="noopener noreferrer"
        style="bottom: calc(50% - 60px)"
        class="cui__sidebar__toggleButton"
        data-toggle="tooltip"
        data-placement="left"
        title="Documentation"
    >
        <i class=" fe fe-book-open"></i>
    </a>

    @if (!Auth::guest())
    @include('elements.layouts.side')
    @endif
    <div class="cui__layout">
        @if (!Auth::guest())
        @include('elements.layouts.navbar')
        @endif
        @yield('content')
        <div id="createSpace" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createSpace"
             aria-hidden="true"  >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <strong class="modal-title pull-left" id="createSpace"> {{ trans('Applications::Space/space.create_space') }} </strong>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="create_space_form" enctype="multipart/form-data">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="form-group name-space">
                                <label class="form-label label-name-space"> {{ trans('Applications::Space/space.name') }} </label>
                                <input class="form-control name-space" name="name_space_stone" type="text" id="name_space_stone"
                                       placeholder="{{ trans('Applications::Space/space.name_space') }}" />
                                <span class="text-name-space form-control-error-text"></span>
                            </div>
                            <div class="form-group image-space extension-space">
                                <label class="form-label label-image-space label-extension-space"> {{ trans('Applications::Space/space.image') }} </label>
                                <input type="file" name="image_space_stone" class="dropify-picture-space dropify-event image-space extension-space" id="input-file-events image_space_stone"
                                       data-allowed-formats="portrait square landscape" data-max-file-size="10M" />
                                <span class="text-image-space text-extension-space form-control-error-text"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"> {{ trans('Organizer::Organizer/Organizer.btn_save') }} </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
<script>
    $(document).ready(function(){
        $('.dropify-picture-space').dropify();
    });
</script>
<link href="{{ asset(app('back').'/assets/laravel-echo/toastr/toastr.min.css') }}" rel="stylesheet" />
<script src="{{ asset(app('back').'/assets/laravel-echo/toastr/toastr.min.js') }}"></script>
<script>
    window.currentUserId = {!! auth()->check() ? auth()->user()->id : null !!};
    window.PUSHER_APP_KEY =  '{{ env('PUSHER_APP_KEY')}}';
    window.PUSHER_APP_CLUSTER = '{{ env('PUSHER_APP_CLUSTER') }}';
    window.PUSHER_STONE_FORCE_TLS = '{{ env('PUSHER_STONE_FORCE_TLS') }}';
    window.PUSHER_STONE_WS_HOST = '{{ env('PUSHER_STONE_WS_HOST') }}';
    window.PUSHER_STONE_WS_PORT = '{{ env('PUSHER_STONE_WS_PORT') }}';
    window.PUSHER_STONE_WSS_PORT = '{{ env('PUSHER_STONE_WSS_PORT') }}';
    window.PUSHER_STONE_ENCRYPTED = '{{ env('PUSHER_STONE_ENCRYPTED') }}';
    window.SOUND_NOTIFY = '{{ asset(app('back').'/assets/laravel-echo/volcator-notify.mp3') }}';
</script>
<script type="module" src="{{ asset(app('back').'/assets/laravel-echo/howler/howler.js') }}"></script>
<script type="module" src="{{ asset(app('back').'/assets/laravel-echo/volcator-websocket.js') }}"></script>
<script>
    function clearError() {
        $('.name-space').removeClass('has-danger');
        $('.image-space').removeClass('has-danger');
        $('.extension-space').removeClass('has-danger');

        $('.text-image-space').html('');
        $('.text-extension-space').html('');
        $('.text-name-space').html('');

        $('.label-image-space').removeClass('form-control-error-text');
        $('.label-extension-space').removeClass('form-control-error-text');
        $('.label-name-space').removeClass('form-control-error-text');
    }

    $('#createSpace').on('hidden.bs.modal', function (e) {
        clearError();
        $('.name-space').val('');
        $('button.dropify-clear').trigger('click');
    })

    const spaceVolcatorFormSubmit = async (e) => {
        e.preventDefault();
        clearError();
        let formData = new FormData();

        let url = '{{ route(app('urlBack') . '.store.manager') }}';
        formData.append('name', e.target.elements.name_space_stone.value);
        formData.append('image', e.target.elements.image_space_stone.files[0]);
        formData.append('_token', "{{ csrf_token() }}");

        try {
            const apiUrl = url;
            const options = {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
                body: formData,
                dataType: 'json',
            };
            const response = await fetch(apiUrl, options);
            let result = await response.json();
            if (Object.keys(result).length > 0) {
                jQuery.each(result, function(index, value) {
                    $('.'+index).addClass('has-danger')
                    $('.text-'+index).html(value.error)
                    $('.label-'+index).addClass('form-control-error-text')
                });
            } else {
                $('#createSpace').modal('hide');
                window.location.reload();
            }
        } catch (error) {
            //
        }
    }
    document.querySelector('#create_space_form').addEventListener("submit", spaceVolcatorFormSubmit, false);
</script>
{!! VolcatorMediaStyle::jsMediaHook() !!}
</html>
