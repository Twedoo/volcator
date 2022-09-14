@extends('elements.layouts.app')
@section('content')
    <div class="cui__layout">
        <div class="cui__layout__content">
            <div class="cui__utils__content">
                <div class="cui__auth__authContainer">
                    <div class="cui__auth__topbar">
                        <div class="cui__auth__logoContainer">
                            <div class="cui__auth__logoContainer__logo">
                                <img src="{{ asset(app('back').'/assets/images/logos/stone-logo.png') }}" class="mr-2 cui__logo_w70_h70" alt="{{ app('APP_NAME') }}" />
                            </div>
                        </div>
                        <div class="d-none d-sm-block">
                        <span>
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
                        </span>
                            <span class="dropdown mr-2 d-sm-block">
                                <a href="" class="dropdown-toggle text-nowrap" data-toggle="dropdown" data-offset="5,15">
                                    <span class="dropdown-toggle-text">Language : <span class="text-uppercase">{{App::getLocale()}}</span></span>
                                </a>
                                <span class="dropdown-menu dropdown-menu-right" role="menu">
                                    @foreach (Config::get('languages') as $lang => $language)
                                        @if ($lang != App::getLocale())
                                            <a class="dropdown-item " href="{{ route('lang.switch', $lang) }}">
                                <span class="font-size-12 mr-1">
                                <img class="user-avatar" style="width:16px; height:11px;" alt="" src="{{  asset(app('back').'/assets/images/flags/'.$lang.'.png')}}" height="34"/></span> {{ $language }}
                                            </a>
                                        @endif
                                    @endforeach
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="cui__auth__containerInner">

                        <div class="text-center mb-5">
                            <h3 class="mb-5 px-3 cui__auth__text__above__form__login">
                                <strong>Welcome {{ $name }} ! to {{ app('APP_NAME') }}</strong>
                            </h3>
                        </div>
                        <div class="card cui__auth__boxContainer">
                            <div class="mb-2">
                                <div class="form-group">
                                    {{  trans('Notifications::Notifications/Notifications.message_after_create_account_with_accept')   }}
                                    <p class="text-center">
                                        <a href="{{ url(app('urlBack').'/login') }}" class="kit__utils__link font-size-16">
                                            <button class="btn btn__primary__stone text-center w-30  mt-4">
                                                <strong>{{ trans('Access-Controls::Access-Controls/Access-Controls.login') }}</strong>
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-auto pb-5 pt-5">
                        <ul class="cui__auth__footerNav list-unstyled d-flex mb-0 flex-wrap justify-content-center">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);">Terms of Use</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);">Compliance</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);">Support</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);">Contacts</a>
                            </li>
                        </ul>
                        <div class="text-center">
                            Copyright &copy; <script>document.write(new Date().getFullYear())</script> Stonespace.io |
                            <a href="https://www.stonespace.io/privacy" target="_blank" rel="noopener noreferrer">
                                Privacy Policy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
