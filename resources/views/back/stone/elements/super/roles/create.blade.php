@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Stone</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong>{{ trans('access/roles_managment.roles_title') }}</strong>
                    </span>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current">{{ trans('access/roles_managment.roles_create') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('access/roles_managment.roles_create_role') }}</span>
                        <a class="btn btn-sm btn-light" href="{{ route(app('urlBack').'.super.roles.index') }}">
                            <i class="fa fa-arrow-left"></i> {{trans('access/roles_managment.show_back')}}</a>
                    </h5>
                </div>
                {{-- Content here --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-5">
                                        {!! Form::open(array('route' => app('urlBack').'.super.roles.store','method'=>'POST')) !!}
                                        <div class="form-group @if ($errors->has('name')) has-danger @endif">
                                            <label class="form-label">{{ trans('access/roles_managment.roles_create_name') }}</label>
                                            {!! Form::text('name', null, array('placeholder' => trans('access/roles_managment.roles_create_name'),'class' => 'form-control', 'value' =>old('name') )) !!}
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
                                        <div class="form-group @if ($errors->has('display_name')) has-danger @endif">
                                            <label class="form-label">{{ trans('access/roles_managment.roles_create_display_name') }}</label>
                                            {!! Form::text('display_name', null, array('placeholder' => trans('access/roles_managment.roles_create_display_name'),'class' => 'form-control', 'value' =>old('display_name') )) !!}
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
                                        <div class="form-group @if ($errors->has('description')) has-danger @endif">
                                            <label class="form-label">{{ trans('access/roles_managment.roles_create_description') }}</label>
                                            {!! Form::text('description', null, array('placeholder' => trans('access/roles_managment.roles_create_description'),'class' => 'form-control', 'value' =>old('description'))) !!}
                                            @if ($errors->has('description'))
                                                <div class="form-control-error-list" data-error-list="">
                                                    <ul>
                                                        <li>
                                                            {{ $errors->first('description') }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group @if ($errors->has('permission')) has-error @endif">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="list-permissions">{{ trans('access/roles_managment.roles_create_permission') }}</div>
                                                @foreach($getFilterRole as $key => $rolePermission)
                                                    <div class="all-permission">
                                                        <div class="name-permission">
                                                            {{ trans($key.'::'.$key.'/'.$key.'.'.$key.'')  }}
                                                        </div>
                                                        <div>
                                                            @foreach ( $rolePermission as $idPermission => $namePermission)
                                                                <span class="border-permission">
                                                                    <label class="permission-margin">
                                                                        <label class="kit__utils__control kit__utils__control__checkbox">
                                                                            {{ Form::checkbox('permission[]', $idPermission, false, array('class' => 'name')) }}
                                                                            <span class="kit__utils__control__indicator"></span>
                                                                            {{ $namePermission }}
                                                                        </label>

                                                                    </label>
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if ($errors->has('permission'))
                                                    <div class="form-control-error-list" data-error-list="">
                                                        <ul>
                                                            <li>
                                                                {{ $errors->first('permission') }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-dark mr-2 px-5 pull-right">{{ trans('access/roles_managment.edit_users_update') }}</button>
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

@endsection
