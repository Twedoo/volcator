@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Stone</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong>{{ trans('Applications::Applications/applications.title_header') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
{{--                    <a href="{{ route(app('urlBack').'.multi.applications.create') }}" class="btn btn-social btn-success">--}}
{{--                        <i class="fa fa-edit"></i> {{ trans('Applications::Applications/applications.create_application') }}--}}
{{--                    </a>--}}
                    <h5>
                        <span class="mr-3">{{ trans('Applications::Applications/applications.application') }}</span>
                        <a href="{{ route(app('urlBack').'.multi.applications.create') }}" class="btn btn-sm btn-light">
                            <i class="fa fa-edit"></i> {{ trans('Applications::Applications/applications.create_application') }}
                        </a>
                    </h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">
                            <strong>{{ trans('Applications::Applications/applications.list_application') }}</strong>
                        </h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-5">
                                    <table class="table table-hover nowrap" id="datatableApplicationList">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('Applications::Applications/applications.name_application') }}</th>
                                            <th>{{ trans('Applications::Applications/applications.name_app_dis') }}</th>
                                            @permission('permissions-applications-view')
                                                <th>{{ trans('Applications::Applications/applications.show') }}</th>
                                            @endpermission
                                            @permission('permissions-applications-create ')
                                                <th>{{ trans('Applications::Applications/applications.edit') }}</th>
                                            @endpermission
                                            @permission('permissions-applications-delete ')
                                                <th>{{ trans('Applications::Applications/applications.delete') }}</th>
                                            @endpermission
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($applications as $key => $application)
                                            <tr>
                                                <td>{{ $application->name }}</td>
                                                <td class="center">{{ $application->display_name }}</td>
                                                @permission('permissions-applications-view')
                                                <td>
                                                    <a href="#">
                                                        <i class="fa fa-eye btn btn-darken-1" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                @endpermission
                                                @permission('permissions-applications-create')
                                                <td>
                                                    <a href="{{ route(app('urlBack').'.multi.applications.edit', $application->id) }}">
                                                        <i class="fa fa-edit btn btn-darken-1" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                @endpermission
                                                @permission('permissions-applications-delete')
                                                <td>
                                                    <a href="{{ route(app('urlBack').'.multi.applications.delete', $application->id) }}">
                                                        <i class="fa fa-trash btn btn-darken-1" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                @endpermission
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>{{ trans('Applications::Applications/applications.name_application') }}</th>
                                                <th>{{ trans('Applications::Applications/applications.name_app_dis') }}</th>
                                                @permission('permissions-applications-view')
                                                <th>{{ trans('Applications::Applications/applications.show') }}</th>
                                                @endpermission
                                                @permission('permissions-applications-create ')
                                                <th>{{ trans('Applications::Applications/applications.edit') }}</th>
                                                @endpermission
                                                @permission('permissions-applications-delete ')
                                                <th>{{ trans('Applications::Applications/applications.delete') }}</th>
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

