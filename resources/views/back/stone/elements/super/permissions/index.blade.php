@extends('elements.layouts.app')



@section('content')




    <section id="middle">
        <!-- page title -->
        <header id="page-header">
            <h1>{{ trans('access/roles_managment.permission_title_index') }}</h1>

            @permission('permissions-access')
            <div class="pull-right">
                <a href="{{ route(app('urlBack').'.super.permissions.create') }}" class="btn btn-social btn-success">
                    <i class="fa fa-edit"></i> {{ trans('access/roles_managment.permission_create_new_index') }}
                </a>
            </div>
            @endpermission

            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}">{{ trans('access/roles_managment.site_name') }}</a></li>
                <li class="active">{{ trans('access/roles_managment.permission_managment_index') }}</li>


            </ol>


        </header>
        <!-- /page title -->


        <div id="content" class="padding-20">

            <!--
                PANEL CLASSES:
                    panel-default
                    panel-danger
                    panel-warning
                    panel-info
                    panel-success

                INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
                        All pannels should have an unique ID or the panel collapse status will not be stored!
            -->
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
	  							<span class="title elipsis">
	  								<strong>{{ trans('access/roles_managment.permission_managment_index') }}</strong>
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
                                        <i class="glyphicon glyphicon-edit btn btn-success" aria-hidden="true"></i> </a>
                                </td>
                                @endpermission

                                @permission('permissions-access')
                                <td>
                                    <a href="{{ route(app('urlBack').'.super.permissions.destroy', $user->id) }}">
                                        <i class="glyphicon glyphicon-trash btn btn-danger" aria-hidden="true"></i> </a>
                                </td>
                                @endpermission
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
                <!-- /panel content -->

                <!-- panel footer -->
                <div class="panel-footer">

                    <!-- pre code -->


                    <!-- /pre code -->

                </div>
                <!-- /panel footer -->

            </div>
            <!-- /PANEL -->

        </div>
    </section>


@endsection
