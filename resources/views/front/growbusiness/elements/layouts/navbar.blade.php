<header class="navbar.blade.php">
    <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <a href="{{ route(app('urlFront') . '.pages.easycms.dispatcher', '/') }}">
                    <img src="{{ asset(app('front').'/assets/img/prestais.png') }}" alt="" style="width: 133px; height: 75px"/>
                </a>
            </div>
            <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                    <ul class="navbar-nav">
                        @foreach($menus as $key => $menu)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route(app('urlFront') . '.pages.easycms.dispatcher', $menu->route) }}">{{ $menu->{$lang.'_trans'} }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- /.navbar-nav -->
                    <div class="offcanvas-footer d-lg-none">
                        <div>
                            <a href="mailto:first.last@email.com" class="link-inverse">contact@prestais.com</a>
                            <br /> 00 (123) 456 78 90 <br />
                            <nav class="nav social social-white mt-4">
                                <a href="#"><i class="uil uil-twitter"></i></a>
                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                                <a href="#"><i class="uil uil-dribbble"></i></a>
                                <a href="#"><i class="uil uil-instagram"></i></a>
                                <a href="#"><i class="uil uil-youtube"></i></a>
                            </nav>
                            <!-- /.social -->
                        </div>
                    </div>
                    <!-- /.offcanvas-footer -->
                </div>
                <!-- /.offcanvas-body -->
            </div>

            <div class="navbar-other w-100 d-flex ms-auto">
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <li class="nav-item dropdown language-select text-uppercase">
                        <a class="nav-link dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{App::getLocale()}}</a>
                        <ul class="dropdown-menu">
                            @foreach($list_languages as $key => $language)
                                @if(App::getLocale() != $key)
                                    <li class="nav-item"><a class="dropdown-item" href="{{ route('lang.switch', $key) }}">{{ $language }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-info"><i class="uil uil-info-circle"></i></a></li>
                    <li class="nav-item d-lg-none">
                        <button class="hamburger offcanvas-nav-btn"><span></span></button>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.navbar -->
    <div class="offcanvas offcanvas-end text-inverse" id="offcanvas-info" data-bs-scroll="true">
        <div class="offcanvas-header">
            <h3 class="text-white fs-30 mb-0">PrestAIs</h3>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body pb-6">
            <div class="widget mb-8">
                <p>We are driven by our passion for AI technology and its transformative potential. Our primary goal is to develop innovative modules that cater to the unique needs of our clients, harnessing the power of artificial intelligence to propel businesses forward in the new digital age.
                </p>
            </div>
            <!-- /.widget -->
            <div class="widget mb-8">
                <h4 class="widget-title text-white mb-3">Contact Info</h4>
                <a href="mailto:first.last@email.com">contact@prestais.com</a><br /> +33 07 76 73 68 60
            </div>
            <!-- /.widget -->
            <div class="widget">
                <h4 class="widget-title text-white mb-3">Follow Us</h4>
                <nav class="nav social social-white">
                    <a href="https://t.me/prestais_official" target="_blank" href="#"><i class="uil uil-telegram"></i></a>
                    <a href="https://www.youtube.com/@HoussemMAAMRIA" target="_blank"><i class="uil uil-youtube"></i></a>
                    <a href="https://twitter.com/houssem_maamria" target="_blank"><i class="uil uil-twitter"></i></a>
                </nav>
                <!-- /.social -->
            </div>
            <!-- /.widget -->
        </div>
        <!-- /.offcanvas-body -->
    </div>
    <!-- /.offcanvas -->
</header>

