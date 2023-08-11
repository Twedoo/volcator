@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Volcator</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong>{{ trans('access/roles_managment.permission_managment_index') }}</strong>
                    </span>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current">{{ trans('access/roles_managment.permission_edit_edit') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('access/roles_managment.permission_title_edit') }}</span>
                        <a class="btn btn-sm btn-light" href="{{ route(app('urlBack').'.super.permissions.index') }}">
                            <i class="fa fa-arrow-left"></i> {{trans('access/roles_managment.permission_back_edit')}}</a>
                    </h5>
                </div>
                {{-- Content here --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-5">
                                        <h5 class="mb-4">
                                            <strong>{{ trans('access/roles_managment.edit_users_edit') }}</strong>
                                        </h5>
                                        {!! Form::model($permission, ['method' => 'PATCH','route' => [app('urlBack').'.super.permissions.update', $permission->id]]) !!}
                                        <div class="form-group @if ($errors->has('name')) has-danger @endif">
                                            <label class="form-label">{{ trans('access/roles_managment.permission_name_edit') }}</label>
                                            {!! Form::text('name', null, array('placeholder' => trans('access/roles_managment.permission_name_edit'),'class' => 'form-control')) !!}
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
                                            <label class="form-label">{{ trans('access/roles_managment.permission_display_name_edit') }}</label>
                                            {!! Form::text('display_name', null, array('placeholder' => trans('access/roles_managment.permission_display_name_edit'),'class' => 'form-control')) !!}
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
                                            <label class="form-label">{{ trans('access/roles_managment.permission_description_edit') }}</label>
                                            {!! Form::textarea('description', null, array('placeholder' => trans('access/roles_managment.permission_description_edit'),'class' => 'form-control','style'=>'height:100px')) !!}
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
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-dark mr-2 px-5 pull-right">{{ trans('access/roles_managment.permission_update_edit') }}</button>
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
