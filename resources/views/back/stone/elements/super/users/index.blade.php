@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Stone</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current">{{ trans('access/roles_managment.index_users_title') }}</strong>
                    </span>
                </div>
            </div>
            {{--     content       --}}
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('access/roles_managment.index_users_managment') }}</span>
                        @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                        <a href="{{ route(app('urlBack').'.super.users.create') }}" class="btn btn-sm btn-light">
                            <i class="fa fa-edit"></i> {{ trans('access/roles_managment.index_users_create') }}
                        </a>
                        @endpermission
                    </h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">
                            <strong>{{ trans('access/roles_managment.managment_acl_users_list') }}</strong>
                        </h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-5">
                                    <table class="table table-hover nowrap" id="datatableUsersList">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('access/roles_managment.index_users_name') }}</th>
                                            <th>{{ trans('access/roles_managment.index_users_email') }}</th>
                                            <th>{{ trans('access/roles_managment.index_users_show') }}</th>
                                            @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                            <th>{{ trans('access/roles_managment.index_users_edit') }}</th>
                                            @endpermission
                                            @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                            <th>{{ trans('access/roles_managment.index_users_delete') }}</th>
                                            @endpermission
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($data as $key => $user)
                                            @if( $user->type != 'root')
                                                <tr>
                                                    <td>
                                                        {{ $user->name }}
                                                    </td>
                                                    <td class="center">
                                                        {{ $user->email }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route(app('urlBack').'.super.users.show',$user->id) }}">
                                                            <i class="fa fa-eye btn btn-darken-1" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                    @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                                        <td>
                                                            <a @if($user->id != 1) href="{{ route(app('urlBack').'.super.users.edit', $user->id) }}"
                                                               @else  disabled @endif>
                                                                <i class="fa fa-edit btn btn-darken-1 @if($user->id == 1) disabled stone-disable-click @endif"
                                                                   aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    @endpermission

                                                    @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                                        <td>
                                                            <a @if($user->id != 1) href="{{ route(app('urlBack').'.super.users.destroy', $user->id) }}"
                                                               @else  disabled @endif data-toggle="modal" data-target="#deleteUserSpace">
                                                                <i class="fa fa-trash btn btn-darken-1 @if($user->id == 1) disabled stone-disable-click @endif"
                                                                   aria-hidden="true"></i> </a>
                                                        </td>
                                                    @endpermission
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>{{ trans('access/roles_managment.index_users_name') }}</th>
                                            <th>{{ trans('access/roles_managment.index_users_email') }}</th>
                                            <th>{{ trans('access/roles_managment.index_users_show') }}</th>
                                            @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                            <th>{{ trans('access/roles_managment.index_users_edit') }}</th>
                                            @endpermission
                                            @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                            <th>{{ trans('access/roles_managment.index_users_delete') }}</th>
                                            @endpermission
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    ;(function ($) {
                        'use strict'
                        $(function () {
                            $('#datatableUsersList').DataTable({
                                responsive: true,
                            })
                        })
                    })(jQuery)
                </script>
            </div>
        </div>
    </section>
    <div id="deleteUserSpace" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteUserSpace"
         aria-hidden="true"  >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title pull-left" id="createSpace"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_user') }} </strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_space_form" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="form-group name-space">
                            <label class="form-label label-name-space"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_current_application') }} </label>
                            {{ Form::checkbox('permission[]', false, false, array('class' => 'name')) }}
                        </div>
                        <div class="form-group name-space">
                            <label class="form-label label-name-space"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_current_space') }} </label>
                            {{ Form::checkbox('permission[]', false, false, array('class' => 'name')) }}
                        </div>
                        <div class="form-group name-space">
                            <label class="form-label label-name-space"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_current_all_space') }} </label>
                            {{ Form::checkbox('permission[]', false, false, array('class' => 'name')) }}
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger"> {{ trans('Access-Controls::Access-Controls/Access-Controls.btn_remove') }} </button>
                            <button type="button" class="btn btn-success" data-dismiss="modal">{{ trans('Access-Controls::Access-Controls/Access-Controls.btn_cancel') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
