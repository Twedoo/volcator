<footer class="bg-navy text-inverse">
    <div class="container pt-15 pt-md-17 pb-13 pb-md-15">
        <div class="d-lg-flex flex-row align-items-lg-center">
            <h3 class="display-4 mb-6 mb-lg-0 pe-lg-20 pe-xl-22 pe-xxl-25 text-white">{{ trans('EasyCMS::Front/Front.Join_our_community') }}</h3>
            <a href="https://addons.prestashop.com/fr/demo/BO83890.html" target="_blank" class="btn btn-primary rounded-pill mb-0 text-nowrap">{{ trans('EasyCMS::Front/Front.Try_Demo') }}</a>
        </div>
        <hr class="mt-11 mb-12" />
        <div class="row gy-6 gy-lg-0">
            <div class="col-md-4 col-lg-6">
                <h4 class="widget-title text-white mb-3">
                    <a href="{{ route(app('urlFront') . '.pages.easycms.dispatcher', '/') }}">
                        <img src="{{ asset(app('front').'/assets/img/prestais.png') }}" srcset="./assets/img/logo-dark@2x.png 2x" alt="" style="width: 15%; filter: brightness(0) invert(1);" />
                    </a>
                </h4>
                    <div class="widget">
                        {{ trans('EasyCMS::Front/Front.About_US') }}
                    </div>
            </div>
            <div class="col-md-4 col-lg-3 mt-2">
                <div class="widget">
                    <h1 class="widget-title text-white mb-3">{{ trans('EasyCMS::Front/Front.Contact') }}</h1>
                    <a href="mailto:#">contact@prestais.com</a><br> +33 07 76 73 68 60
                    <nav class="nav social social-white">
                        <a href="https://t.me/prestais_official" target="_blank" href="#"><i class="uil uil-telegram"></i></a>
                        <a href="https://www.youtube.com/@HoussemMAAMRIA" target="_blank"><i class="uil uil-youtube"></i></a>
                        <a href="https://twitter.com/houssem_maamria" target="_blank"><i class="uil uil-twitter"></i></a>
                    </nav>
                </div>
            </div>
            <div class="col-md-12 col-lg-3 mt-11">
                <div class="widget">
                    <div class="widget">
                        <img class="mb-4" src="./assets/img/logo-light.png" srcset="./assets/img/logo-light@2x.png 2x" alt="" />
                        <p class="mb-4">© <script>
                                document.write(new Date().getUTCFullYear());
                            </script> PrestAIs. <br class="d-none d-lg-block" />{{ trans('EasyCMS::Front/Front.copyright') }}</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
