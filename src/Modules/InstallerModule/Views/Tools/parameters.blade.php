<div class="btn-group ml-2">
    <button type="button"
            class="btn btn-sm btn-default dropdown-toggle "
            data-toggle="dropdown" aria-expanded="false">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>

    <ul class="dropdown-menu pull-right" role="menu">

        @if($btnParameters)
            <li><a href="{{ route(app('urlBack').'.super.module.parametres',[$idModule, $modulesName]) }}">
                    <i class="main-icon fa fa-cog"></i> {{ trans('InstallerModule::InstallerModule/InstallerModule.parameters')  }}
                </a></li>
        @endif

        @if($btnEnable)
            @if($statusModule == 1)
                <li><a href="{{ route(app('urlBack').'.super.module.status',[$idModule, $modulesName]) }}"
                       class="statutsModule"><i
                                class="main-icon fa fa-minus-circle"></i> {{ trans('InstallerModule::InstallerModule/InstallerModule.disabled')  }}
                    </a></li>
            @else
                <li><a href="{{ route(app('urlBack').'.super.module.status',[$idModule, $modulesName]) }}"
                       class="statutsModule"><i
                                class="main-icon fa fa-eye"></i> {{ trans('InstallerModule::InstallerModule/InstallerModule.enable')  }}
                    </a></li>
            @endif
        @endif

        @if($btnReset)
            <li>
                <a href="{{ route(app('urlBack').'.super.module.reset',$modulesName) }}">
                    {{--                <a href="{{ array('route' => array(app('urlBack').'.super.module.reset', $idModule,$modulesName,$dropTbale)) }}">--}}
                    <i class="main-icon fa fa-exchange"></i>
                    {{ trans('InstallerModule::InstallerModule/InstallerModule.reset')  }}
                </a>
            </li>
        @endif

        @if($btnUninstall)
            <li>
                <a href="{{ route(app('urlBack').'.super.module.uninstall',$modulesName) }}">
                    <i class="main-icon fa fa-trash"></i> {{ trans('InstallerModule::InstallerModule/InstallerModule.uninstall')  }}
                </a>
            </li>
        @endif

        <li class="disabled">
            <a>
                <i class="main-icon fa fa-remove"></i> {{ trans('InstallerModule::InstallerModule/InstallerModule.remove')  }}
            </a>
        </li>

        <li class="divider"></li>

        <li>
            <a href="#" data-toggle="modal" data-target="#{{$modulesName}}"><i
                        class="main-icon fa fa-globe"></i> {{ trans('InstallerModule::InstallerModule/InstallerModule.about') }}
            </a>
        </li>
    </ul>


</div>


<div id="{{$modulesName}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <strong class="modal-title"
                        id="myModalLabel">{{ trans('InstallerModule::InstallerModule/InstallerModule.about') }}</strong>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <strong><h5>{{ trans('InstallerModule::InstallerModule/InstallerModule.name_modules') }}</h5></strong>
                <h6>{!! StoneEngine::getAttributes($modulesName, 'name') !!}</h6>

                <strong><h5>{{ trans('InstallerModule::InstallerModule/InstallerModule.description_modules') }}</h5>
                </strong>
                <h6>{!! StoneEngine::getAttributes($modulesName, 'description') !!}</h6>

                <strong><h5>{{ trans('InstallerModule::InstallerModule/InstallerModule.author_modules') }}</h5></strong>
                <h6>{!! StoneEngine::getAttributes($modulesName, 'author') !!}</h6>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">{{ trans('InstallerModule::InstallerModule/InstallerModule.close') }}</button>
            </div>

        </div>
    </div>
</div>
