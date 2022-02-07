@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <!-- page title -->
        <header id="page-header">
            <h1>{{ trans('Applications::Applications/applications.title_header') }}</h1>
            <div class="pull-right">
                <div class="col-md-6">
                    @permission('permissions-applications-type')
                        <a href="{{ route(app('urlBack').'.multi.applications.type') }}" class="btn btn-social btn-info">
                            <i class="fa fa-edit"></i> {{ trans('Applications::Applications/applications.create_type_application') }}
                        </a>
                    @endpermission
                </div>
                <div class="col-md-6">
                    @permission('permissions-applications-create')
                        <a href="{{ route(app('urlBack').'.multi.applications.create') }}" class="btn btn-social btn-success">
                            <i class="fa fa-edit"></i> {{ trans('Applications::Applications/applications.create_application') }}
                        </a>
                    @endpermission
                </div>
            </div>
            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}">Twedoo</a></li>
                <li class="active">{{ trans('Applications::Applications/applications.first_name_header') }}</li>
            </ol>
        </header>
        <!-- /page title -->
        <div id="content" class="padding-20">
        {!! Toastr::message() !!}
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="title elipsis">
                        <strong>{{ trans('Applications::Applications/applications.list_application') }}</strong>
                        <!-- panel title -->
                    </span>
                    <!-- right options -->
                    <ul class="options pull-right list-inline">
                        <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                               data-placement="bottom"></a></li>
                        <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                               data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                        <li><a href="#" class="opt panel_close" data-confirm-title="Confirm"
                               data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip"
                               title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
                    </ul>
                    <!-- /right options -->
                </div>

                <!-- panel content -->
                <div class="panel-body">
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                        <tr>
                            <th>{{ trans('Applications::Applications/applications.name_application') }}</th>
                            <th>{{ trans('Applications::Applications/applications.type_application') }}</th>
                            @permission('permissions-applications-view')
                            <th>{{ trans('Applications::Applications/applications.show') }}</th>
                            @endpermission
                            @permission('permissions-applications-create')
                            <th>{{ trans('Applications::Applications/applications.edit') }}</th>
                            @endpermission
                            @permission('permissions-applications-delete')
                            <th>{{ trans('Applications::Applications/applications.delete') }}</th>
                            @endpermission
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $key => $application)
                                    <tr>
                                        <td>
                                            {{ $application->display_name }}
                                        </td>
                                        <td class="center">
                                            {{ $application->type }}
                                        </td>

                                        @permission('permissions-applications-view')
                                        <td>
                                            <a href="#">
                                                <i class="glyphicon glyphicon-eye-open btn btn-info" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        @endpermission

                                        @permission('permissions-applications-create')
                                        <td>
                                            <a href="{{ route(app('urlBack').'.super.users.edit',$application->id) }}">
                                                <i class="glyphicon glyphicon-edit btn btn-success" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        @endpermission

                                        @permission('permissions-applications-delete')
                                        <td>
                                            <a href="{{ route(app('urlBack').'.multi.applications.delete', $application->id) }}">
                                                <i class="glyphicon glyphicon-trash btn btn-danger"
                                                   aria-hidden="true"></i> </a>
                                        </td>
                                        @endpermission
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- panel footer -->
                <div class="panel-footer">
                </div>
                <!-- /panel footer -->
            </div>
        </div>
    </section>
@endsection
