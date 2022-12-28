@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Stone</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong>{{ trans('Applications::Applications/Applications.title_header') }}</strong>
                    </span>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current">{{ trans('Applications::Applications/Applications.edit_application') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('Applications::Applications/Applications.edit_application') }}</span>
                        <a class="btn btn-sm btn-light" href="{{ route(app('urlBack').'.multi.applications.index') }}">
                            <i class="fa fa-arrow-left"></i> {{ trans('Applications::Applications/Applications.back') }}
                        </a>
                    </h5>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-5">
                                        {!! Form::model($application, ['method' => 'PATCH','route' => [app('urlBack').'.multi.applications.edit', $application->id]]) !!}

                                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                                            <label class="form-label">{{ trans('Applications::Applications/Applications.name_app') }}</label>
                                            {!! Form::text('name', null, array('placeholder' => trans('Applications::Applications/Applications.name_app'),'class' => 'form-control', 'value' =>old('name') )) !!}
                                            @if ($errors->has('name'))
                                                <div class="form-control-error-list" data-error-list="">
                                                    <ul>
                                                        <li>
                                                            {{ $errors->first('name') }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group @if ($errors->has('name_app_dis')) has-error @endif">
                                            <label class="form-label">{{ trans('Applications::Applications/Applications.name_app_dis') }}</label>
                                            {!! Form::text('display_name', null, array('placeholder' => trans('Applications::Applications/Applications.name_app_dis'),'class' => 'form-control', 'value' =>old('display_name') )) !!}
                                            @if ($errors->has('display_name'))
                                                <div class="form-control-error-list" data-error-list="">
                                                    <ul>
                                                        <li>
                                                            {{ $errors->first('display_name') }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group @if ($errors->has('users')) has-error @endif">
                                            <label class="form-label">{{ trans('Applications::Applications/Applications.owner_app') }}</label>
                                            {!! Form::select('users[]', $users, null, ['class' => 'select2', 'multiple' => 'multiple', 'placeholder' => trans('Applications::Applications/Applications.select_option')]) !!}
                                            @if ($errors->has('users'))
                                                <div class="form-control-error-list" data-error-list="">
                                                    <ul>
                                                        <li>
                                                            {{ $errors->first('users') }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-dark mr-2 px-5 pull-right">{{ trans('Applications::Applications/Applications.create') }}</button>
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
