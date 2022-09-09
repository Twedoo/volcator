@extends('elements.layouts.app')
@section('content')

    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Stone</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong class="cui__breadcrumbs__current">{{ trans('Organizer::Organizer/Organizer.module_managment')  }}</strong>
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
                                        <strong>{{ trans('Organizer::Organizer/Organizer.upload_file_module_zip') }}</strong>
                                    </h5>
                                </div>
                                <div class="row">
                                    @foreach( $GetArrayModules as $key => $module)
                                        @if ($module == "Organizer")
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
                                                                 src="{{ asset(app('back').'/assets/images/logos/stone-logo.png') }}"
                                                                 alt="Module"/>
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="font-size-18 font-weight-bold text-dark mb-2 text-center">
                                                        @if (StoneEngine::isActiveStoneInCurrentApplication($module))
                                                            <i class="fe @if(StoneEngine::getStatusModule($module)) fe-check-circle text-success @else fe fe-eye-off text-danger @endif font-weight-bolder font-size-32"></i>
                                                        @else
                                                            <a href="{{ route(app('urlBack').'.pre.module.building', [$module, StoneApplication::isStoneInstalledAsMain($module)]) }}">
                                                                <i class="fe fe-download text-info font-weight-bolder font-size-32"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a class="kit__g16__productFavourite text-gray-10 flex"
                                                           href="javascript: void(0);">
                                                            @if (StoneEngine::isActiveStoneInCurrentApplication($module))
                                                                @foreach($modules as $onemodule)
                                                                    @if( $onemodule->name == $module)
                                                                        <div class="float-left">
                                                                            {{ trans($onemodule->name.'::sidebar/sidebar.'.$onemodule->display_name.'') }}
                                                                        </div>
                                                                        <div class="float-right">
                                                                            {!! StoneEngine::getModulesParams($module, $onemodule->id, $onemodule->enable) !!}
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @else
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
                                            <strong>{{ trans('Organizer::Organizer/Organizer.upload_file_module_zip') }}</strong>
                                        </h5>
                                        <div class="mb-5 @if ($errors->has('filezipupload')) has-danger @endif">
                                            {!! Form::open(array('route' => app('urlBack').'.super.modules.upload','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                                            <input type="file" name="filezipupload" class="dropify has-danger"
                                                   data-default-file=""/>
                                            <div class="col-md-1 col-sm-1 float-right mt-5">
                                                <div class="float-right">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{ trans('Organizer::Organizer/Organizer.btn_save')  }} </button>
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
