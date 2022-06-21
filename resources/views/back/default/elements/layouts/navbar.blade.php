<!-- Mobile Button -->
<button id="mobileMenuBtn"></button>
<!-- Logo -->
<span class="logo pull-left">
    <img src="{{ asset(app('back')[0].'/assets/images/twedoo_logo.png') }}" alt="admin panel" height="35"/>
</span>
<form method="get" action="page-search.html" class="search pull-left hidden-xs">
    <input type="text" class="form-control" name="k" placeholder="Search for something..."/>
</form>
<nav>
    <!-- OPTIONS LIST -->
    <ul class="nav pull-right">

        <!-- USER OPTIONS -->

        <li class="dropdown pull-left" style="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <?php
                if (App::getLocale() == 'ar') {
                    $flag = 'tn';
                } elseif (App::getLocale() == 'en') {
                    $flag = 'en';
                } elseif (App::getLocale() == 'jp') {
                    $flag = 'ja';
                } else {
                    $flag = App::getLocale();
                }
                ?>

                <img class="user-avatar" style="width:16px; height:11px;" alt=""
                     src="{{  asset(app('back')[0].'/assets/images/flags/'.$flag.'.png')}}" height="34"/>
                <span class="user-name">
											<span class="hidden-xs">
											{{ Config::get('languages')[App::getLocale()] }}
                                                <i class="fa fa-angle-down"></i>
										</span>
									</span>
            </a>
            <ul class="dropdown-menu hold-on-click">
                @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                        <li>
                            <a href="{{ route('lang.switch', $lang) }}">
                                <img class="user-avatar" style="width:16px; height:11px;" alt=""
                                     src="{{  asset(app('back')[0].'/assets/images/flags/'.$lang.'.png') }}"
                                     height="34"/>
                                <span class="user-name">{{ $language }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="dropdown pull-left">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img class="user-avatar" alt="" src="{{ asset('resources/assets/assets/images/noavatar.jpg')}}"
                     height="34"/>
                <span class="user-name">
									<span class="hidden-xs">
										John Doe <i class="fa fa-angle-down"></i>
									</span>
								</span>
            </a>
            <ul class="dropdown-menu hold-on-click">
                <li><!-- my calendar -->
                    <a href="calendar.html"><i class="fa fa-calendar"></i> Calendar</a>
                </li>
                <li><!-- my inbox -->
                    <a href="#"><i class="fa fa-envelope"></i> Inbox
                        <span class="pull-right label label-default">0</span>
                    </a>
                </li>
                <li><!-- settings -->
                    <a href="page-user-profile.html"><i class="fa fa-cogs"></i> Settings</a>
                </li>


                <li><!-- lockscreen -->
                    <a href="page-lock.html"><i class="fa fa-lock"></i> Lock Screen</a>
                </li>
                <li><!-- logout -->
                    <a href="{{ url(app('urlBack').'/logout')}}"><i class="fa fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
        <!-- /USER OPTIONS -->
    </ul>
    <!-- /OPTIONS LIST -->
</nav>


