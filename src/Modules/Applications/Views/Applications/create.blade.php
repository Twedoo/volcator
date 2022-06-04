@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Stone</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong>{{ trans('Applications::Applications/applications.title_header') }}</strong>
                    </span>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current">{{ trans('Applications::Applications/applications.create_application') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('Applications::Applications/applications.create_application') }}</span>
                        <a class="btn btn-sm btn-light" href="{{ route(app('urlBack').'.multi.applications.index') }}">
                            <i class="fa fa-arrow-left"></i> {{ trans('Applications::Applications/applications.back') }}
                        </a>
                    </h5>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-5">
                                        {!! Form::open(array('route' => app('urlBack').'.multi.applications.create', 'method'=>'POST')) !!}
                                        <div class="form-group @if ($errors->has('name_app')) has-error @endif">
                                            <label class="form-label">{{ trans('Applications::Applications/applications.name_app') }}</label>
                                            {!! Form::text('name_app', null, array('placeholder' => trans('Applications::Applications/applications.name_app'),'class' => 'form-control', 'value' =>old('name_app') )) !!}
                                            @if ($errors->has('name'))
                                                <div class="form-control-error-list" data-error-list="">
                                                    <ul>
                                                        <li>
                                                            {{ $errors->first('name_app') }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group @if ($errors->has('name_app_dis')) has-error @endif">
                                            <label class="form-label">{{ trans('Applications::Applications/applications.name_app_dis') }}</label>
                                            {!! Form::text('name_app_dis', null, array('placeholder' => trans('Applications::Applications/applications.name_app_dis'),'class' => 'form-control', 'value' =>old('name_app') )) !!}
                                            @if ($errors->has('name'))
                                                <div class="form-control-error-list" data-error-list="">
                                                    <ul>
                                                        <li>
                                                            {{ $errors->first('name_app_dis') }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group @if ($errors->has('owner_app')) has-error @endif">
                                            <label class="form-label">{{ trans('Applications::Applications/applications.owner_app') }}</label>
                                            {!! Form::select('owner_app[]', $users, [], array('class' => 'select2', 'multiple', 'placeholder' => trans('Applications::Applications/applications.select_option'))) !!}
                                            @if ($errors->has('name'))
                                                <div class="form-control-error-list" data-error-list="">
                                                    <ul>
                                                        <li>
                                                            {{ $errors->first('owner_app') }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-dark mr-2 px-5 pull-right">{{ trans('Applications::Applications/applications.create') }}</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        ;(function($) {
            'use strict'
            $(function() {
                $('.select2').select2()
                $('.select2-tags').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                })
                $('.select2').select2()
            })
        })(jQuery)
    </script>
@endsection
