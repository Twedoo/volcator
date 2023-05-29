@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Volcator</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current">{{ trans('access/roles_managment.roles_title') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('access/roles_managment.roles_managment') }}</span>
                        <a href="{{ route(app('urlBack').'.super.roles.create') }}" class="btn btn-social btn-light">
                            <i class="fa fa-edit"></i> {{trans('access/roles_managment.roles_title_create')}}
                        </a>
                    </h5>
                </div>
                {!! Toastr::message() !!}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-5">
                                    <table class="table table-hover nowrap" id="datatableRolesList">
                                        <thead>
                                        <tr>
                                            <th>{{ trans( 'access/roles_managment.roles_type_table' )}}</th>
                                            <th>{{ trans( 'access/roles_managment.roles_name_table' )}}</th>
                                            <th>{{ trans( 'access/roles_managment.roles_description_table' )}}</th>
                                            <th>{{ trans( 'access/roles_managment.roles_show_table' )}}</th>
                                            @permission(Config::get('volcator.PERMISSION_ROLE_ACCESS_CONTROL'))
                                            <th>{{ trans( 'access/roles_managment.roles_edit_table' )}}</th>
                                            @endpermission
                                            @permission(Config::get('volcator.PERMISSION_ROLE_ACCESS_CONTROL'))
                                            <th>{{ trans( 'access/roles_managment.roles_delete_table' )}}</th>
                                            @endpermission
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>
                                                    {{ $role->name }}
                                                </td>
                                                <td class="center">
                                                    {{ $role->display_name }}
                                                </td>
                                                <td class="center">
                                                    {{ $role->description }}
                                                </td>
                                                <td>
                                                    <a href="{{ route(app('urlBack').'.super.roles.show',$role->id) }}">
                                                        <i class="fa fa-eye btn btn-darken-1" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                @permission(Config::get('volcator.PERMISSION_ROLE_ACCESS_CONTROL'))
                                                <td>
                                                    <a href="{{ route(app('urlBack').'.super.roles.edit',$role->id) }}">
                                                        <i class="fa fa-edit btn btn-darken-1  @if($role->type == "main") disabled @endif" aria-hidden="true"></i> </a>
                                                </td>
                                                @endpermission

                                                @permission(Config::get('volcator.PERMISSION_ROLE_ACCESS_CONTROL'))
                                                <td>
                                                    <a @if($role->id != 1) href="{{ route(app('urlBack').'.super.roles.destroy', $role->id) }}"
                                                       @else  disabled @endif>
                                                        <i class="fa fa-trash btn btn-darken-1 @if($role->type == "main") disabled @endif"
                                                           aria-hidden="true"></i> </a>
                                                </td>
                                                @endpermission
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>{{ trans( 'access/roles_managment.roles_type_table' )}}</th>
                                            <th>{{ trans( 'access/roles_managment.roles_name_table' )}}</th>
                                            <th>{{ trans( 'access/roles_managment.roles_description_table' )}}</th>
                                            <th>{{ trans( 'access/roles_managment.roles_show_table' )}}</th>
                                            @permission(Config::get('volcator.PERMISSION_ROLE_ACCESS_CONTROL'))
                                            <th>{{ trans( 'access/roles_managment.roles_edit_table' )}}</th>
                                            @endpermission
                                            @permission(Config::get('volcator.PERMISSION_ROLE_ACCESS_CONTROL'))
                                            <th>{{ trans( 'access/roles_managment.roles_delete_table' )}}</th>
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
                            $('#datatableRolesList').DataTable({
                                responsive: true,
                            })
                        })
                    })(jQuery)
                </script>
            </div>
        </div>
    </section>
@endsection
