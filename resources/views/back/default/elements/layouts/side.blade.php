
<nav id="sideNav"><!-- MAIN MENU -->
    <ul class="nav nav-list">
        <li class="active"><!-- dashboard -->
            <a class="dashboard" href="index.html"><!-- warning - url used by default by ajax (if eneabled) -->
                <i class="main-icon fa fa-dashboard"></i> <span>Dashboard	</span>
            </a>
        </li>

        @foreach( VolcatorMenu::getMenuModule() as $key => $moduleByMenuCategory)
            <br/><h3>{{ trans('sidebar/sidebar.'.$key.'')  }}</h3>
            @foreach( $moduleByMenuCategory as $key => $ModuleSideBar)
                @permission($ModuleSideBar->im_permission)
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        {!! $ModuleSideBar->im_menu_icon !!}
                        <span>
                            {{ trans('sidebar/sidebar.'.$ModuleSideBar->im_name_modules_display.'')  }}
                        </span>
                    </a>
                    <ul><!-- submenus -->
                        @foreach( VolcatorMenu::getSubMenuModule('getSubMenuModule') as $SubMenu)
                            @if( $ModuleSideBar->im_id == $SubMenu->id_volcator)
                                @permission($SubMenu->mb_permission)
                                <li>
                                    @if($SubMenu->id_volcator >= 3)
                                        <a href="{{ url(app('urlBack').'/'.app('module').'/'.$SubMenu->route_link) }}">
                                            {{ trans('sidebar/sidebar.'.$SubMenu->name_menu.'')  }}
                                        </a>

                                    @else
                                        <a href="{{ url(app('urlBack').'/'.$SubMenu->route_link) }}">
                                            {{ trans('sidebar/sidebar.'.$SubMenu->name_menu.'')  }}
                                        </a>
                                    @endif
                                </li>
                                @endpermission
                            @endif
                        @endforeach

                    </ul>
                </li>
                @endpermission
            @endforeach
        @endforeach
    </ul>
</nav>
<span id="asidebg"><!-- aside fixed background --></span>
