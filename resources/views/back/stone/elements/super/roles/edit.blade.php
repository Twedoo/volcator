@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <header id="page-header">
            <h1> {{ trans('access/roles_managment.roles_title_edit') }} </h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route(app('urlBack').'.super.roles.index') }}"><i
                            class="glyphicon glyphicon-arrow-left"
                            aria-hidden="true"></i> {{ trans('access/roles_managment.roles_title_back') }}</a>
            </div>
            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}">{{ trans('access/roles_managment.roles_edit_site_name') }}</a>
                </li>
                <li class="active"><a
                            href="{{ route(app('urlBack').'.super.roles.index') }}">{{ trans('access/roles_managment.roles_edit_role_maangement') }}</a>
                </li>
                <li class="active"> {{ trans('access/roles_managment.roles_edit_role_edit') }}</li>
            </ol>
        </header>

        <div id="content" class="padding-20">
            {!! Toastr::message() !!}
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>{{ trans('access/roles_managment.roles_edit_role_edit') }}</strong>
                </div>
                <div class="panel-body">
                    {!! Form::model($role, ['method' => 'PATCH','route' => [app('urlBack').'.super.roles.update', $role->id]]) !!}
                    <fieldset>
                        <!-- required [php action request] -->
                        <div class="row">
                            <div class="form-group @if ($errors->has('display_name')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.roles_edit_name') }}</label>
                                    {!! Form::text('display_name', null, array('placeholder' => trans('access/roles_managment.roles_edit_name'),'class' => 'form-control', 'value' =>old('display_name') )) !!}
                                    <p class="help-block">{{ $errors->first('display_name') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.roles_edit_description') }}</label>
                                    {!! Form::textarea('description', null, array('placeholder' => trans('access/roles_managment.roles_edit_description'),'class' => 'form-control', 'value' =>old('description'),'style'=>'height:100px')) !!}
                                    <p class="help-block">{{ $errors->first('description') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group @if ($errors->has('permission')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <div class="list-permissions">{{ trans('access/roles_managment.roles_edit_permission') }}</div>
                                    @foreach($getFilterRole as $key => $rolePermission)
                                        <div class="all-permission">
                                                <div class="name-permission">
                                                    {{ trans('sidebar/sidebar.'.$key.'')  }}
                                                </div>
                                                <div>
                                                    @foreach ( $rolePermission as $idPermission => $namePermission)
                                                        <span class="border-permission">
                                                            <label>
                                                                <label class="switch switch-success switch-round">
                                                                    {{ Form::checkbox('permission[]', $idPermission, in_array($idPermission, $rolePermissions) ?
                                                                    true : false, array('class' => 'name')) }}
                                                                    <span class="switch-label" data-on="YES"
                                                                          data-off="NO"></span>
                                                                </label>
                                                                {{ $namePermission }}
                                                            </label>
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                    @endforeach
                                    <p class="help-block">{{ $errors->first('permission') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="submit"
                                    class="btn btn-primary">{{ trans('access/roles_managment.roles_edit_update') }}</button>
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
