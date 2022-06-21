@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Stone</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong>{{ trans('Applications::Applications/Applications.title_header') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('Applications::Applications/Applications.application') }}</span>
                        <a href="{{ route(app('urlBack').'.multi.applications.create') }}" class="btn btn-sm btn-light">
                            <i class="fa fa-edit"></i> {{ trans('Applications::Applications/Applications.create_application') }}
                        </a>
                    </h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">
                            <strong>{{ trans('Applications::Applications/Applications.list_application') }}</strong>
                        </h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-5">
                                    <table class="table table-hover nowrap" id="datatableApplicationList">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('Applications::Applications/Applications.name_application') }}</th>
                                            <th>{{ trans('Applications::Applications/Applications.name_app_dis') }}</th>
                                            @permission(Config::get('stone.PERMISSION_APPLICATION_FULL'))
                                                <th>{{ trans('Applications::Applications/Applications.show') }}</th>
                                            @endpermission
                                            @permission(Config::get('stone.PERMISSION_APPLICATION_FULL'))
                                                <th>{{ trans('Applications::Applications/Applications.edit') }}</th>
                                            @endpermission
                                            @permission(Config::get('stone.PERMISSION_APPLICATION_FULL'))
                                                <th>{{ trans('Applications::Applications/Applications.delete') }}</th>
                                            @endpermission
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($applications as $key => $application)
                                            <tr>
                                                <td>{{ $application->name }}</td>
                                                <td class="center">{{ $application->display_name }}</td>
                                                @permission(Config::get('stone.PERMISSION_APPLICATION_FULL'))
                                                <td>
                                                    <a href="{{ route(app('urlBack') . '.multi.applications.show', $application->id) }}">
                                                        <i class="fa fa-eye btn btn-darken-1" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                @endpermission
                                                @permission(Config::get('stone.PERMISSION_APPLICATION_FULL'))
                                                <td>
                                                    <a href="{{ route(app('urlBack').'.multi.applications.edit', $application->id) }}">
                                                        <i class="fa fa-edit btn btn-darken-1" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                @endpermission
                                                @permission(Config::get('stone.PERMISSION_APPLICATION_FULL'))
                                                <td>
                                                    <a href="{{ route(app('urlBack').'.multi.applications.delete', $application->id) }}"
                                                       @if ($application->type == 'main') class="disabled stone-disable-click " @endif>
                                                        <i class="fa fa-trash btn btn-darken-1 @if ($application->type == 'main') disabled stone-disable-click @endif" aria-hidden="true" ></i>
                                                    </a>
                                                </td>
                                                @endpermission
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>{{ trans('Applications::Applications/Applications.name_application') }}</th>
                                                <th>{{ trans('Applications::Applications/Applications.name_app_dis') }}</th>
                                                @permission(Config::get('stone.PERMISSION_APPLICATION_FULL'))
                                                <th>{{ trans('Applications::Applications/Applications.show') }}</th>
                                                @endpermission
                                                @permission(Config::get('stone.PERMISSION_APPLICATION_FULL'))
                                                <th>{{ trans('Applications::Applications/Applications.edit') }}</th>
                                                @endpermission
                                                @permission(Config::get('stone.PERMISSION_APPLICATION_FULL'))
                                                <th>{{ trans('Applications::Applications/Applications.delete') }}</th>
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
                            $('#datatableApplicationList').DataTable({
                                responsive: true,
                            })
                        })
                    })(jQuery)
                </script>
            </div>
        </div>
    </section>
@endsection

