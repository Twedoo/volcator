@extends('elements.layouts.app')



@section('content')


    <section id="middle">

        <header id="page-header">
            <h1>{{ trans('access/roles_managment.roles_title_create') }}</h1>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route(app('urlBack').'.super.roles.index') }}"><i
                            class="glyphicon glyphicon-arrow-left"
                            aria-hidden="true"></i> {{ trans('access/roles_managment.roles_back_create') }}</a>

            </div>


            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}">{{ trans('access/roles_managment.roles_site_name_create') }}</a>
                </li>
                <li class="active"><a
                            href="{{ route(app('urlBack').'.super.roles.index') }}">{{ trans('access/roles_managment.roles_management_create') }}</a>
                </li>
                <li class="active">{{ trans('access/roles_managment.roles_create_role') }}</li>


            </ol>


        </header>


        <div id="content" class="padding-20">
            {!! Toastr::message() !!}
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>{{ trans('access/roles_managment.roles_create_role') }}</strong>
                </div>

                <div class="panel-body">

                    {!! Form::open(array('route' => app('urlBack').'.super.roles.store','method'=>'POST')) !!}
                    <fieldset>
                        <!-- required [php action request] -->

                        <div class="row">
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.roles_create_name') }}</label>
                                    {!! Form::text('name', null, array('placeholder' => trans('access/roles_managment.roles_create_name'),'class' => 'form-control', 'value' =>old('name') )) !!}
                                    <p class="help-block">{{ $errors->first('name') }}</p>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group @if ($errors->has('display_name')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.roles_create_display_name') }}</label>
                                    {!! Form::text('display_name', null, array('placeholder' => trans('access/roles_managment.roles_create_display_name'),'class' => 'form-control', 'value' =>old('display_name'))) !!}
                                    <p class="help-block">{{ $errors->first('display_name') }}</p>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{ trans('access/roles_managment.roles_create_description') }}</label>
                                    {!! Form::textarea('description', null, array('placeholder' => trans('access/roles_managment.roles_create_description') ,'class' => 'form-control', 'value' =>old('description'),'style'=>'height:100px')) !!}
                                    <p class="help-block">{{ $errors->first('description') }}</p>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group @if ($errors->has('permission')) has-error @endif">
                                <div class="col-md-12 col-sm-12">
                                    <div>{{ trans('access/roles_managment.roles_create_permission') }}</div>
                                    @foreach($getFilterRole as $key => $rolePermission)
                                        <div class="all-permission @if ($errors->has('permission')) has-error @endif">
                                            <div class="name-permission">
                                                {{ trans('sidebar/sidebar.'.$key.'')  }}
                                            </div>
                                            <div>
                                                @foreach ( $rolePermission as $idPermission => $namePermission)
                                                    <span class="border-permission @if ($errors->has('permission')) has-error @endif">
                                                            <label>
                                                                <label class="switch switch-success switch-round">
                                                                    {{ Form::checkbox('permission[]', $idPermission, false, array('class' => 'name')) }}
                                                                    <span class="switch-label" data-on="YES" data-off="NO"></span>
                                                                </label>
                                                                {{ $namePermission }}
                                                            </label>
                                                        </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach

                                    {{--@foreach($permission as $value)--}}
                                        {{--<label>--}}
                                            {{--<label class="switch switch-success switch-round">--}}
                                                {{--{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}--}}
                                                {{--<span class="switch-label" data-on="YES" data-off="NO"></span>--}}
                                            {{--</label>{{ $value->display_name }}--}}
                                        {{--</label>--}}
                                    {{--@endforeach--}}
                                    <p class="help-block">{{ $errors->first('permission') }}</p>
                                </div>
                            </div>
                        </div>


                        <div class="pull-right">
                            <button type="submit"
                                    class="btn btn-primary">{{ trans('access/roles_managment.roles_create_create') }}</button>
                        </div>


                    </fieldset>
                    {!! Form::close() !!}
                </div>

            </div>

        </div>

    </section>

@endsection
