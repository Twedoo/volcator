@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <header id="page-header">
            <h1>{{ trans('Applications::Applications/Applications.title_header') }}</h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route(app('urlBack') .'.multi.applications.index') }}"><i
                            class="glyphicon glyphicon-arrow-left"
                            aria-hidden="true"></i> {{ trans('global/global.back') }}</a>
            </div>
            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}">Twedoo</a></li>
                <li class="active"><a
                            href="{{ route(app('urlBack') .'.multi.applications.index') }}">{{ trans('Applications::Applications/Applications.first_name_header') }}</a>
                </li>
                <li class="active">{{ trans('Applications::Applications/Applications.create_type_application') }}</li>
            </ol>
        </header>
        <div id="content" class="padding-20">
            {!! Toastr::message() !!}
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>{{ trans('Applications::Applications/Applications.create_type_application') }}</strong>
                </div>
                <div class="panel-body padding-left-300 padding-right-300">
                    {!! Form::open(array('route' => app('urlBack').'.multi.applications.type', 'method'=>'POST')) !!}
                    <fieldset>
                        <div class="row">
                            <div class="form-group @if ($errors->has('type_app')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('Applications::Applications/Applications.type_app') }}</label>
                                    {!! Form::text('type_app', null, array('placeholder' => trans('Applications::Applications/Applications.type_app'),'class' => 'form-control', 'value' =>old('type_app'))) !!}
                                    <p class="help-block">{{ $errors->first('type_app') }}</p>
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
