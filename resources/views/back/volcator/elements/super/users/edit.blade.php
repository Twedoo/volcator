@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Volcator</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong>{{ trans('Access-Controls::Access-Controls/Access-Controls.show_users_management') }}</strong>
                    </span>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current">{{ trans('Access-Controls::Access-Controls/Access-Controls.edit_users_edit') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('Access-Controls::Access-Controls/Access-Controls.edit_users_edit') }}</span>
                        <a class="btn btn-sm btn-light" href="{{ route(app('urlBack').'.super.users.index') }}">
                            <i class="fa fa-arrow-left"></i> {{trans('Access-Controls::Access-Controls/Access-Controls.show_back')}}</a>
                    </h5>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-5">
                                        <h5 class="mb-4">
                                            <strong>{{ trans('Access-Controls::Access-Controls/Access-Controls.edit_users_edit') }}</strong>
                                        </h5>
                                        {!! Form::model($user, ['method' => 'PATCH','route' => [app('urlBack').'.super.users.update', $user->id]]) !!}
                                            <div class="form-group @if ($errors->has('name')) has-danger @endif">
                                                <label class="form-label">{{ trans('Access-Controls::Access-Controls/Access-Controls.edit_users_name') }}</label>
                                                {!! Form::text('name', null, array('placeholder' => trans('Access-Controls::Access-Controls/Access-Controls.edit_users_name'),'class' => 'form-control', 'value' =>old('name') )) !!}
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
                                            <div class="form-group @if ($errors->has('email')) has-danger @endif">
                                                <label class="form-label">{{ trans('Access-Controls::Access-Controls/Access-Controls.edit_users_email') }}</label>
                                                {!! Form::text('email', null, array('placeholder' => trans('Access-Controls::Access-Controls/Access-Controls.edit_users_email'),'class' => 'form-control', 'value' =>old('email') )) !!}
                                                @if ($errors->has('email'))
                                                    <div class="form-control-error-list" data-error-list="">
                                                        <ul>
                                                            <li>
                                                                {{ $errors->first('email') }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group @if ($errors->has('password')) has-danger @endif">
                                                <label class="form-label">{{ trans('Access-Controls::Access-Controls/Access-Controls.edit_users_password') }}</label>
                                                {!! Form::password('password', array('placeholder' => trans('Access-Controls::Access-Controls/Access-Controls.edit_users_password'),'class' => 'form-control', 'value' =>old('password'))) !!}
                                                @if ($errors->has('password'))
                                                    <div class="form-control-error-list" data-error-list="">
                                                        <ul>
                                                            <li>
                                                                {{ $errors->first('password') }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group @if ($errors->has('confirm-password')) has-danger @endif">
                                                <label class="form-label">{{ trans('Access-Controls::Access-Controls/Access-Controls.edit_users_password_confirm') }}</label>
                                                {!! Form::password('confirm-password', array('placeholder' => trans('Access-Controls::Access-Controls/Access-Controls.edit_users_password_confirm'),'class' => 'form-control', 'value' =>old('confirm-password'))) !!}
                                                @if ($errors->has('confirm-password'))
                                                    <div class="form-control-error-list" data-error-list="">
                                                        <ul>
                                                            <li>
                                                                {{ $errors->first('confirm-password') }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group @if ($errors->has('roles')) has-error @endif">
                                                <label>{{ trans('Access-Controls::Access-Controls/Access-Controls.edit_users_role') }}</label>
                                                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'select2', 'multiple' => 'multiple']) !!}
                                                @if ($errors->has('roles'))
                                                    <div class="form-control-error-list" data-error-list="">
                                                        <ul>
                                                            <li>
                                                                {{ $errors->first('roles') }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-dark mr-2 px-5 pull-right">{{ trans('Access-Controls::Access-Controls/Access-Controls.edit_users_update') }}</button>
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

                $('#form-validation').validate({
                    submit: {
                        settings: {
                            inputContainer: '.form-group',
                            errorListClass: 'form-control-error',
                            errorClass: 'has-danger',
                        },
                    },
                })

                $('#form-validation .remove-error').on('click', function() {
                    $('#form-validation').removeError()
                })

                $('#form-validation-simple').validate({
                    submit: {
                        settings: {
                            inputContainer: '.form-group',
                            errorListClass: 'form-control-error-list',
                            errorClass: 'has-danger',
                        },
                    },
                })

                $('#form-validation-simple .remove-error').on('click', function() {
                    $('#form-validation-simple').removeError()
                })

                $('.select2').select2()
            })
        })(jQuery)
    </script>

@endsection
