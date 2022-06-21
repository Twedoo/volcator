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
                            class="cui__breadcrumbs__current">{{ trans('access/roles_managment.permission_managment_index') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('access/roles_managment.permission_title_index') }}</span>
                        @permission('permissions-access')
                            <a href="{{ route(app('urlBack').'.super.permissions.create') }}" class="btn btn-light">
                                <i class="fa fa-edit"></i> {{ trans('access/roles_managment.permission_create_new_index') }}
                            </a>
                        @endpermission
                    </h5>
                </div>
                {{-- Content here --}}
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">
                            <strong>{{ trans('access/roles_managment.permission_managment_list') }}</strong>
                        </h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-5">
                                    <table class="table table-hover nowrap" id="datatablePermissionList">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('access/roles_managment.permission_permission_index') }}</th>
                                            <th>{{ trans('access/roles_managment.permission_display_name_index') }}</th>
                                            <th>{{ trans('access/roles_managment.permission_description_index') }}</th>
                                            @permission('permissions-access')
                                                <th>{{ trans('access/roles_managment.permission_edit_index') }}</th>
                                            @endpermission
                                            @permission('permissions-access')
                                                <th>{{ trans('access/roles_managment.permission_delete_index') }}</th>
                                            @endpermission
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($data as $key => $user)
                                            <tr>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                                <td class="center">
                                                    {{ $user->display_name }}
                                                </td>
                                                <td class="center">
                                                    {{ $user->description }}
                                                </td>
                                                @permission('permissions-access')
                                                    <td>
                                                        <a href="{{ route(app('urlBack').'.super.permissions.edit',$user->id) }}">
                                                            <i class="fa fa-edit btn btn-darken-1"></i> </a>
                                                    </td>
                                                @endpermission
                                                @permission('permissions-access')
                                                    <td>
                                                        <a href="{{ route(app('urlBack').'.super.permissions.destroy', $user->id) }}">
                                                            <i class="fa fa-trash btn btn-trash" ></i> </a>
                                                    </td>
                                                @endpermission
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>{{ trans('access/roles_managment.permission_permission_index') }}</th>
                                            <th>{{ trans('access/roles_managment.permission_display_name_index') }}</th>
                                            <th>{{ trans('access/roles_managment.permission_description_index') }}</th>
                                            @permission('permissions-access')
                                                <th>{{ trans('access/roles_managment.permission_edit_index') }}</th>
                                            @endpermission
                                            @permission('permissions-access')
                                                <th>{{ trans('access/roles_managment.permission_delete_index') }}</th>
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
                            $('#datatablePermissionList').DataTable({
                                responsive: true,
                            })
                        })
                    })(jQuery)
                </script>
            </div>
        </div>
    </section>
@endsection
