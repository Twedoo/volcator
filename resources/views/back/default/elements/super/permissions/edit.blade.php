@extends('elements.layouts.app')



@section('content')




    <section id="middle">

        <header id="page-header">
            <h1>{{ trans('access/roles_managment.permission_title_edit') }}</h1>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route(app('urlBack').'.super.permissions.index') }}"><i
                            class="glyphicon glyphicon-arrow-left"
                            aria-hidden="true"></i> {{ trans('access/roles_managment.permission_back_edit') }}</a>

            </div>


            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}">{{ trans('access/roles_managment.site_name') }}</a></li>
                <li class="active"><a
                            href="{{ route(app('urlBack').'.super.permissions.index') }}">{{ trans('access/roles_managment.permission_managment_edit') }}</a>
                </li>
                <li class="active">{{ trans('access/roles_managment.permission_edit_edit') }}</li>
            </ol>


        </header>

        <div id="content" class="padding-20">

            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>{{ trans('access/roles_managment.permission_edit_edit') }}</strong>
                </div>

                <div class="panel-body">

                    {!! Form::model($permission, ['method' => 'PATCH','route' => [app('urlBack').'.super.permissions.update', $permission->id]]) !!}
                    <fieldset>
                        <!-- required [php action request] -->

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.permission_name_edit') }}</label>
                                    {!! Form::text('name', null, array('placeholder' => trans('access/roles_managment.permission_name_edit'),'class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.permission_display_name_edit') }}</label>
                                    {!! Form::text('display_name', null, array('placeholder' => trans('access/roles_managment.permission_display_name_edit'),'class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.permission_description_edit') }}</label>
                                    {!! Form::textarea('description', null, array('placeholder' => trans('access/roles_managment.permission_description_edit'),'class' => 'form-control','style'=>'height:100px')) !!}
                                </div>
                            </div>
                        </div>


                        <div class="pull-right">
                            <button type="submit"
                                    class="btn btn-primary">{{ trans('access/roles_managment.permission_update_edit') }}</button>
                        </div>


                    </fieldset>
                    {!! Form::close() !!}
                </div>

            </div>

        </div>

    </section>

@endsection
