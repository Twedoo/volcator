@extends('elements.layouts.app')

    @section('content')
        <section id="middle">
            <!-- page title -->
            <header id="page-header">
                <h1>{{trans('access/roles_managment.roles_title')}}</h1>

                    <div class="pull-right">
                            <a href="{{ route(app('urlBack').'.super.roles.create') }}" class="btn btn-social btn-success">
                                <i class="fa fa-edit"></i> {{trans('access/roles_managment.roles_title_create')}}
                            </a>
                    </div>

                <ol class="breadcrumb">
                    <li><a href="{{url(app('urlBack').'/')}}">{{trans('access/roles_managment.site_name')}} </a></li>
                    <li class="active">{{trans('access/roles_managment.roles_managment')}}</li>
                </ol>

            </header>
            <!-- /page title -->

            <div id="content" class="padding-20">
            {!! Toastr::message() !!}
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
                                    <strong>{{trans('access/roles_managment.roles_managment')}}</strong>
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
                                <th>{{ trans( 'access/roles_managment.roles_type_table' )}}</th>
                                <th>{{ trans( 'access/roles_managment.roles_name_table' )}}</th>
                                <th>{{ trans( 'access/roles_managment.roles_description_table' )}}</th>
                                <th>{{ trans( 'access/roles_managment.roles_show_table' )}}</th>
                                @permission('roles-access')
                                    <th>{{ trans( 'access/roles_managment.roles_edit_table' )}}</th>
                                @endpermission
                                @permission('roles-access')
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
                                            <i class="glyphicon glyphicon-eye-open btn btn-info" aria-hidden="true"></i>
                                        </a>
                                    </td>

                                    @permission('roles-access')
                                        <td>
                                            <a href="{{ route(app('urlBack').'.super.roles.edit',$role->id) }}">
                                                <i class="glyphicon glyphicon-edit btn btn-success" aria-hidden="true"></i> </a>
                                        </td>
                                    @endpermission

                                    @permission('roles-access')
                                    <td>
                                        <a @if($role->id != 1) href="{{ route(app('urlBack').'.super.roles.destroy', $role->id) }}"
                                           @else  disabled @endif>
                                            <i class="glyphicon glyphicon-trash btn btn-danger @if($role->id == 1) disabled @endif"
                                               aria-hidden="true"></i> </a>
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

                    </div>
                    <!-- /panel footer -->

                </div>
                <!-- /PANEL -->

            </div>
        </section>

@endsection
