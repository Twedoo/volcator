<div class="flex left__menu__stone__space">
    <div class="left__menu__stone__space">
        <div class="cui__menuLeft__trigger__stone__space text-center">
            <i class="fa fa-gear " ></i>
        </div>
        <div class="container__menu__space">
            <div class=" title__top__space text-center">
                <strong>Stone</strong>
            </div>
            <div class="create__space">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#createSpace">
                    <i class="fa fa-plus text-center mt-24 icon__create__space"></i>
                </a>
            </div>
            <div class="stone__spaces__list height-700 kit__customScroll__space ps-active-y">
                @foreach (StoneSpace::getSpaces() as $id => $space)
                <a href="{{ route(app('urlBack').'.space.switch', $id) }}" >
                    <div class="stone__spaces__element ">
                        <div class="active__stone__space  @if ($id != StoneSpace::getCurrentSpaceId()) stone-visibility-hidden @endif">
                            <div class="is_active__icon__stone__space"></div>
                        </div>
                        <div class="block__stone__space">
                            <div class="round__stone__space">
                                <div class="name__in__round__stone__space text-uppercase">
                                    {{ StoneSpace::getFirstTwoLetterName($space) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </div>
</div>
<div class="cui__menuLeft">
    <div class="cui__menuLeft__mobileTrigger"><span></span></div>
    <div class="cui__menuLeft__trigger"></div>
    <div class="cui__menuLeft__outer">
        <div class="cui__menuLeft__logo__container">
            <div class="cui__menuLeft__logo">
                <img src="{{ asset(app('back').'/assets/images/logos/stone-logo.png') }}"
                     class="mr-2 cui__menuLeft__logo_img" alt="{{ app('APP_NAME') }}"/>
            </div>
        </div>
        <div class="cui__menuLeft__scroll kit__customScroll">
            <ul class="cui__menuLeft__navigation">

                <li class="cui__menuLeft__category">
                    Dashboards
                </li>
                <li class="cui__menuLeft__item cui__menuLeft__submenu">
                  <span class="cui__menuLeft__item__link">
                    <span class="cui__menuLeft__item__title">Dashboards</span>
                    <span class="badge badge-primary ml-2">4</span>
                    <i class="cui__menuLeft__item__icon fe fe-home"></i>
                  </span>
                    <ul class="cui__menuLeft__navigation">
                        <li class="cui__menuLeft__item">
                            <a class="cui__menuLeft__item__link" href="dashboards-alpha.html">
                                <span class="cui__menuLeft__item__title">Dashboard Alpha</span>
                            </a>
                        </li>
                        <li class="cui__menuLeft__item">
                            <a class="cui__menuLeft__item__link" href="dashboards-beta.html">
                                <span class="cui__menuLeft__item__title">Dashboard Beta</span>
                            </a>
                        </li>
                        <li class="cui__menuLeft__item">
                            <a class="cui__menuLeft__item__link" href="dashboards-gamma.html">
                                <span class="cui__menuLeft__item__title">Dashboard Gamma</span>
                            </a>
                        </li>
                        <li class="cui__menuLeft__item">
                            <a class="cui__menuLeft__item__link" href="dashboards-crypto.html">
                                <span class="cui__menuLeft__item__title">Dashboard Crypto</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @foreach(StoneMenu::getMenuModule() as $key => $moduleByMenuCategory)
                <li class="cui__menuLeft__category">
                    {{ trans('sidebar/sidebar.'.$key.'') }}
                </li>
                @foreach( $moduleByMenuCategory as $key => $ModuleSideBar)
                @if(StoneMenu::hasPermissionsMenu(json_decode($ModuleSideBar->permission_name)))
                <li class="cui__menuLeft__item cui__menuLeft__submenu">
                          <span class="cui__menuLeft__item__link">
                            <span class="cui__menuLeft__item__title"> {{ trans($ModuleSideBar->name.'::sidebar/sidebar.'.$ModuleSideBar->display_name.'')  }}</span>
                            <i class="cui__menuLeft__item__icon {!! $ModuleSideBar->menu_icon !!}"></i>
                          </span>
                    <ul class="cui__menuLeft__navigation">
                        @foreach(StoneMenu::getSubMenuModule('getSubMenuModule') as $SubMenu)
                        @if( $ModuleSideBar->id == $SubMenu->id_stone)
                        @permission($SubMenu->mb_permission)
                        <li class="cui__menuLeft__item">
                            <a class="cui__menuLeft__item__link"
                               href="{{ url(app('urlBack').'/'.$SubMenu->route_link) }}">
                                <span class="cui__menuLeft__item__title">{{ trans($ModuleSideBar->name.'::sidebar/sidebar.'.$SubMenu->name_menu)  }}</span>
                            </a>
                        </li>
                        @endpermission
                        @endif
                        @endforeach
                    </ul>
                </li>
                @endpermission
                @endforeach
                @endforeach
        </div>
    </div>
</div>
<script>
    ;(function($) {
        'use strict'
        $(function() {
            /////////////////////////////////////////////////////////////////////////////////////////
            // custom scroll
            $('.kit__customScroll__space').perfectScrollbar({
                theme: 'kit',
                useBothWheelAxes: false,
                suppressScrollY: false,
                suppressScrollX: true,
            })
        })
    })(jQuery)

</script>
