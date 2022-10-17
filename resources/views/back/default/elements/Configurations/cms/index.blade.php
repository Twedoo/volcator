@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <header id="page-header">
            <h1>{{ trans('configuration.cms_title') }}</h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route(app('urlBack').'.super.roles.index') }}"><i
                            class="glyphicon glyphicon-arrow-left"
                            aria-hidden="true"></i> {{ trans('configuration.cms_back') }}</a>
            </div>
            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}">{{ trans('configuration.cms_site_name') }}</a></li>
                <li class="active"><a
                            href="{{ route(app('urlBack').'.super.roles.index') }}">{{ trans('configuration.cms_settings') }}</a>
                </li>
                <li class="active">{{ trans('configuration.cms_add_settings') }}</li>
            </ol>
        </header>
        <div id="content" class="padding-20">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>{{ trans('configuration.cms_settings') }}</strong>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('route' => app('urlBack').'.configuration.cms.store','method'=>'POST')) !!}
                    <fieldset>
                        <!-- required [php action request] -->
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('configuration.cms_conf_name') }}</label>
                                    {!! Form::text('name', null, array('placeholder' => trans('roles_managment.roles_create_name'),'class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('roles_managment.roles_create_display_name') }}</label>
                                    {!! Form::text('display_name', null, array('placeholder' => trans('roles_managment.roles_create_display_name'),'class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('roles_managment.roles_create_description') }}</label>
                                    {!! Form::textarea('description', null, array('placeholder' => trans('roles_managment.roles_create_description') ,'class' => 'form-control','style'=>'height:100px')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="submit"
                                    class="btn btn-primary">{{ trans('roles_managment.roles_create_create') }}</button>
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
