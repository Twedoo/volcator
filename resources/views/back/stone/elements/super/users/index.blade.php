@extends('elements.layouts.app')
@section('content')
    <style>

    </style>
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
                                                               @else  disabled @endif data-toggle="modal" data-target="#deleteUserSpace" class="delete_user_button" user="{{ $user->id }}">
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
         aria-hidden="true" user="" href="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title pull-left" id="createSpace"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_user') }} </strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group name-space">
                        <label class="form-label label-name-space from_current_application"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_from_current_application') }}
                            {{ Form::checkbox(false, false, false, ['class' => 'checkbox_remove_from_current_application']) }}
                        </label>
                    </div>
                    @role(Config::get('stone.ROLE_USER_SPACE'))
                        <div class="form-group name-space">
                            <label class="form-label label-name-space remove_from_current_space"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_from_current_space') }}
                                {{ Form::checkbox(false, false, false, ['class' => ['checkbox_remove_from_current_space']]) }}
                            </label>
                        </div>
                    @endrole
                    @role(Config::get('stone.ROLE_MANAGER_SPACE'))
                        <div class="form-group name-space">
                            <label class="form-label label-name-space current_all_space"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_from_all_space') }}
                                {{ Form::checkbox(false, false, false, ['class' => 'checkbox_remove_from_all_space']) }}
                            </label>
                        </div>
                    @endrole
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger delete-confirm stone-disable-click" disabled> {{ trans('Access-Controls::Access-Controls/Access-Controls.btn_remove') }} </button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">{{ trans('Access-Controls::Access-Controls/Access-Controls.btn_cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.delete_user_button').on('click', function (e) {
            $('#deleteUserSpace').attr('user', $(this).attr('user'));
            $('#deleteUserSpace').attr('href', $(this).attr('href'));
        });

        let checkbox_remove_from_current_application = $('.checkbox_remove_from_current_application');
        let checkbox_remove_from_current_space       = $('.checkbox_remove_from_current_space');
        let checkbox_remove_from_all_space           = $('.checkbox_remove_from_all_space');
        /**
         * unchecked all when modal closed
         */

        $('#deleteUserSpace').on('hidden.bs.modal', function (e) {
            checkbox_remove_from_current_application.prop('checked', false).attr("disabled", false);
            checkbox_remove_from_current_space.prop('checked', false).attr("disabled", false);
            checkbox_remove_from_all_space.prop('checked', false).attr("disabled", false);
            $('#deleteUserSpace').attr('user', '');
            $('#deleteUserSpace').attr('href', '');
        });

        $('.from_current_application').on('click', function (e) {
            if (checkbox_remove_from_current_application.is(':checked')) {
                $('.delete-confirm').removeClass("stone-disable-click").attr("disabled", false);
            } else {
                if (!checkbox_remove_from_current_space.is(':checked') && !checkbox_remove_from_all_space.is(':checked')) {
                    $('.delete-confirm').addClass("stone-disable-click").attr("disabled", true);
                }
            }
        });

        $('.remove_from_current_space').on('click', function (e) {
            if (checkbox_remove_from_current_space.is(':checked')) {
                $('.delete-confirm').removeClass("stone-disable-click").attr("disabled", false);
                checkbox_remove_from_current_application.attr("disabled", true).prop('checked', true);
            } else {
                if (!checkbox_remove_from_current_application.is(':checked') && !checkbox_remove_from_all_space.is(':checked')) {
                    $('.delete-confirm').addClass("stone-disable-click").attr("disabled", true);
                }
                checkbox_remove_from_current_application.attr("disabled", false);
            }
        });

        $('.current_all_space').on('click', function (e) {
            if (checkbox_remove_from_all_space.is(':checked')) {
                $('.delete-confirm').removeClass("stone-disable-click").attr("disabled", false);
                checkbox_remove_from_current_application.attr("disabled", true).prop('checked', true);
                checkbox_remove_from_current_space.attr("disabled", true).prop('checked', true);
            } else {
                if (!checkbox_remove_from_current_application.is(':checked') && !checkbox_remove_from_current_space.is(':checked')) {
                    $('.delete-confirm').addClass("stone-disable-click").attr("disabled", true);
                }
                checkbox_remove_from_current_space.attr("disabled", false);
            }
        });

        $('.delete-confirm').on('click', function (e) {
            let remove_level = 1;

            if (checkbox_remove_from_current_application.is(':checked')) {
                remove_level = 2;
            }
            @role(Config::get('stone.ROLE_USER_SPACE'))
                if (checkbox_remove_from_current_space.is(':checked')) {
                    remove_level = 3;
                }
            @endrole
            @role(Config::get('stone.ROLE_MANAGER_SPACE'))
                if (checkbox_remove_from_all_space.is(':checked')) {
                    remove_level = 4;
                }
            @endrole
            let url_delete_user = $('#deleteUserSpace').attr('href');
            window.location.href = url_delete_user+'/'+remove_level;
        });
    </script>

@endsection
