@extends('elements.layouts.app')



@section('content')

    <section id="middle">


        <header id="page-header">
            <h1>{{ trans('access/roles_managment.edit_users_title') }}</h1>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route(app('urlBack').'.super.users.index') }}"><i
                            class="glyphicon glyphicon-arrow-left"
                            aria-hidden="true"></i> {{ trans('access/roles_managment.edit_users_back') }}</a>
            </div>

            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}"> {{ trans('access/roles_managment.edit_users_site') }}</a></li>
                <li class="active"><a
                            href="{{ route(app('urlBack').'.super.permissions.index') }}">{{ trans('access/roles_managment.edit_users_managment') }}</a>
                </li>
                <li class="active">{{ trans('access/roles_managment.edit_users_edit') }}</li>
            </ol>
        </header>

        <div id="content" class="padding-20">
            {!! Toastr::message() !!}


            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>{{ trans('access/roles_managment.edit_users_edit') }}</strong>
                </div>

                <div class="panel-body">

                    {!! Form::model($user, ['method' => 'PATCH','route' => [app('urlBack').'.super.users.update', $user->id]]) !!}
                    <fieldset>
                        <!-- required [php action request] -->

                        <div class="row">
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.edit_users_name') }}</label>
                                    {!! Form::text('name', null, array('placeholder' => trans('access/roles_managment.edit_users_name'),'class' => 'form-control', 'value' =>old('name') )) !!}
                                    <p class="help-block">{{ $errors->first('name') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.edit_users_email') }}</label>
                                    {!! Form::text('email', null, array('placeholder' => trans('access/roles_managment.edit_users_email'),'class' => 'form-control', 'value' =>old('email') )) !!}
                                    <p class="help-block">{{ $errors->first('email') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.edit_users_password') }}</label>
                                    {!! Form::password('password', array('placeholder' => trans('access/roles_managment.edit_users_password'),'class' => 'form-control', 'value' =>old('password'))) !!}
                                    <p class="help-block">{{ $errors->first('password') }}</p>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group @if ($errors->has('confirm-password')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.edit_users_password_confirm') }}</label>
                                    {!! Form::password('confirm-password', array('placeholder' => trans('access/roles_managment.edit_users_password_confirm'),'class' => 'form-control', 'value' =>old('confirm-password'))) !!}
                                    <p class="help-block">{{ $errors->first('confirm-password') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group @if ($errors->has('roles')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.edit_users_role') }}</label>
                                    {!! Form::select('roles[]', $roles, array('class' => 'form-control','multiple')) !!}
                                    <p class="help-block">{{ $errors->first('roles') }}</p>
                                </div>
                            </div>
                        </div>


                        <div class="pull-right">
                            <button type="submit"
                                    class="btn btn-primary">{{ trans('access/roles_managment.edit_users_update') }}</button>
                        </div>


                    </fieldset>
                    {!! Form::close() !!}
                </div>

            </div>

        </div>

    </section>

@endsection
