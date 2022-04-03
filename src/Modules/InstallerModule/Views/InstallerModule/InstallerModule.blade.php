@extends('elements.layouts.app')
@section('content')

    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Home</a>
                    <span>
            <span class="cui__breadcrumbs__arrow"></span>
            <strong
                class="cui__breadcrumbs__current">{{ trans('InstallerModule::InstallerModule/InstallerModule.module_managment')  }}</strong>
          </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="text">
                                    <h5 class="mb-4">
                                        <strong>{{ trans('InstallerModule::InstallerModule/InstallerModule.upload_file_module_zip') }}</strong>
                                    </h5>
                                </div>
                                <div class="row">

                                    @foreach( $GetArrayModules as $key => $module)
                                        @if ($module == "InstallerModule")
                                            @continue
                                        @endif
                                        <div class="col-xl-2 col-lg-4">
                                            <div class="card">
                                                <div class="card-body">

                                                    <div class="kit__g16__productImage mb-3">
                                                        @if(file_exists('app/Modules/'.$module.'/screenshot.jpg'))
                                                            <img class="kit__g16__productPhoto img-fluid"
                                                                 style="height:150px; width:210px"
                                                                 src="{{ asset('app/Modules/'.$module.'/screenshot.jpg') }}"
                                                                 alt="Module">
                                                        @else
                                                            <img class="kit__g16__productPhoto img-fluid"
                                                                 style="height:150px; width:210px"
                                                                 src="{{ asset(app('back').'/assets/images/logos/stone-logo.svg') }}"
                                                                 alt="Module"/>
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="font-size-18 font-weight-bold text-dark mb-2 text-center">
                                                        @if( StoneEngine::isInstallModule($module) )
                                                            @if(StoneEngine::getStatusModule($module))
                                                                <i class="fe fe-check-circle text-success font-weight-bolder font-size-32"></i>
                                                            @else
                                                                <i class="fe fe-eye-off text-danger font-weight-bolder font-size-32"></i>
                                                            @endif
                                                        @else
                                                            <a href="{{ route(app('urlBack').'.pre.module.building',$module) }}">
                                                                <i class="fe fe-download text-info font-weight-bolder font-size-32"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a class="kit__g16__productFavourite text-gray-10 flex"
                                                           href="javascript: void(0);">
                                                            @if( StoneEngine::isInstallModule($module) )
                                                                @foreach($modules as $onemodule)
                                                                    @if( $onemodule->im_name_modules == $module)
                                                                        <div class="float-left">
                                                                            {{ trans('sidebar/sidebar.'.$onemodule->im_name_modules_display.'')  }}
                                                                        </div>
                                                                        <div class="float-right">
                                                                            {!! StoneEngine::getModulesParams($module, $onemodule->im_id, $onemodule->im_status) !!}
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                {{ $module }}
                                                                <div class="float-left">
                                                                    {{ $module }}
                                                                </div>
                                                                <div class="float-right">
                                                                    {!! StoneEngine::displayRemove($module) !!}
                                                                </div>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="col-lg-12 mb-5">
                                        <h5 class="mb-4">
                                            <strong>{{ trans('InstallerModule::InstallerModule/InstallerModule.upload_file_module_zip') }}</strong>
                                        </h5>
                                        <div class="mb-5 @if ($errors->has('filezipupload')) has-danger @endif">
                                            {!! Form::open(array('route' => app('urlBack').'.super.modules.upload','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                                            <input type="file" name="filezipupload" class="dropify has-danger"
                                                   data-default-file=""/>
                                            <div class="col-md-1 col-sm-1 float-right mt-5">
                                                <div class="float-right">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{ trans('InstallerModule::InstallerModule/InstallerModule.btn_save')  }} </button>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    ;(function ($) {
                        'use strict'
                        $(function () {
                            $('.dropify').dropify()
                        })
                    })(jQuery)
                </script>

            </div>


@endsection
