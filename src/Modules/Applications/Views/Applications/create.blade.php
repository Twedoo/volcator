@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <header id="page-header">
            <h1>{{ trans('Applications::Applications/applications.title_header') }}</h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route(app('urlBack') .'.multi.applications.index') }}"><i
                            class="glyphicon glyphicon-arrow-left"
                            aria-hidden="true"></i> {{ trans('global/global.back') }}</a>
            </div>
            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}">Twedoo</a></li>
                <li class="active"><a
                            href="{{ route(app('urlBack') .'.multi.applications.index') }}">{{ trans('Applications::Applications/applications.first_name_header') }}</a>
                </li>
                <li class="active">{{ trans('Applications::Applications/applications.create_application') }}</li>
            </ol>
        </header>
        <div id="content" class="padding-20">
            {!! Toastr::message() !!}
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>{{ trans('Applications::Applications/applications.create_application') }}</strong>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('route' => app('urlBack').'.multi.applications.create', 'method'=>'POST')) !!}
                    <fieldset>
                        <div class="row">
                            <div class="form-group @if ($errors->has('name_app')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('Applications::Applications/applications.name_app') }}</label>
                                    {!! Form::text('name_app', null, array('placeholder' => trans('Applications::Applications/applications.name_app'),'class' => 'form-control', 'value' =>old('name_app') )) !!}
                                    <p class="help-block">{{ $errors->first('name_app') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group @if ($errors->has('name_app_dis')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('Applications::Applications/applications.name_app_dis') }}</label>
                                    {!! Form::text('name_app_dis', null, array('placeholder' => trans('Applications::Applications/applications.name_app_dis'),'class' => 'form-control', 'value' =>old('name_app_dis'))) !!}
                                    <p class="help-block">{{ $errors->first('name_app_dis') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group @if ($errors->has('type_app')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('Applications::Applications/applications.type_app') }}</label>
                                    {!! Form::text('type_app', null, array('placeholder' => trans('Applications::Applications/applications.type_app'),'class' => 'form-control', 'value' =>old('type_app'))) !!}
                                    <p class="help-block">{{ $errors->first('type_app') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group @if ($errors->has('owner_app')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('Applications::Applications/applications.owner_app') }}</label>
                                    {!! Form::select('owner_app[]', $users, [], array('class' => 'form-control', 'multiple', 'placeholder' => trans('Applications::Applications/applications.select_option'))) !!}
                                    <p class="help-block">{{ $errors->first('owner_app') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">{{ trans('global/global.create') }}</button>
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
