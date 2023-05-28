@extends('elements.layouts.app')
@section('content')

    <section id="middle">

        <!-- page title -->
        <header id="page-header">
            <h1>{{  trans('Configurations::Configurations/Languages.title_languages')   }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></a>
                </li>
                <li class="active"> {{  trans('Configurations::Configurations/Languages.title_languages')   }} </li>
            </ol>

        </header>
        <!-- /page title -->

        <div id="content" class="padding-20">
            {!! Toastr::message() !!}

            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong> {{  trans('Configurations::Configurations/Languages.part_languages') }} </strong>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="col-lg-4">
                                <span class="label label-info"
                                      style="margin-left: 15px;">{{ trans('Configurations::Configurations/Languages.back_languages') }}</span>
                                <br/>
                                <br/>
                                {!! Form::open(['method' => 'GET', 'route' => [app('urlBack').'.languages.module.tranlate']]) !!}


                                <div class="col-lg-10">
                                    <select id="mySelect" name="moduleTranslate" class="form-control">
                                        <option value="">
                                            -- {{ trans('Configurations::Configurations/Languages.select_language') }}
                                            --
                                        </option>
                                        @foreach($moduleBack as $module)
                                            <option value="{{ $module }}">{{$module}}</option>
                                        @endforeach
                                        <input type="hidden" name="lang"
                                               value="{{VolcatorLanguage::getDefaultLanguage(true)}}"/>
                                    </select>
                                </div>

                                <div class="col-lg-2 pull-right">
                                    <button type="submit"
                                            class="btn btn-primary">{{  trans('Configurations::Configurations/Languages.access')   }}</button>
                                </div>
                                {!! Form::close() !!}
                            </div>

                            <div class="col-lg-4">
                                <span class="label label-info"
                                      style="margin-left: 15px;">{{ trans('Configurations::Configurations/Languages.front_languages') }}</span>
                                <br/>
                                <br/>
                                {!! Form::open(['method' => 'GET', 'route' => [app('urlBack').'.languages.module.tranlate']]) !!}
                                <div class="col-lg-10">
                                    <select id="mySelect" name="moduleTranslate" class="form-control">
                                        <option value="">
                                            -- {{ trans('Configurations::Configurations/Languages.select_language') }}
                                            --
                                        </option>
                                        @foreach($moduleFront as $module)
                                            <option value="{{ $module }}">{{$module}}</option>
                                        @endforeach
                                        <input type="hidden" name="lang"
                                               value="{{VolcatorLanguage::getDefaultLanguage(true)}}"/>
                                    </select>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <button type="submit"
                                            class="btn btn-primary">{{  trans('Configurations::Configurations/Languages.access')   }}</button>
                                </div>
                                {!! Form::close() !!}
                            </div>


                            <div class="col-lg-4">
                                <span class="label label-info"
                                      style="margin-left: 15px;">{{ trans('Configurations::Configurations/Languages.base_languages') }}</span>
                                <br/>
                                <br/>
                                {!! Form::open(['method' => 'GET', 'route' => [app('urlBack').'.languages.module.tranlate']]) !!}
                                <div class="col-lg-10">
                                    <select id="mySelect" name="file" class="form-control">
                                        <option value="">
                                            -- {{ trans('Configurations::Configurations/Languages.select_language') }}
                                            --
                                        </option>
                                        @foreach($getFileBase as $module)
                                            <option value="{{ $module }}">{{$module}}</option>
                                        @endforeach
                                        <input type="hidden" name="lang"
                                               value="{{VolcatorLanguage::getDefaultLanguage(true)}}"/>
                                        <input type="hidden" name="moduleTranslate" value="langRresources"/>
                                    </select>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <button type="submit"
                                            class="btn btn-primary">{{  trans('Configurations::Configurations/Languages.access')   }}</button>
                                </div>
                                {!! Form::close() !!}
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection
