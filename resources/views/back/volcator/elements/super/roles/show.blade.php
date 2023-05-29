@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Volcator</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong>{{ trans('access/roles_managment.roles_title') }}</strong>
                    </span>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current">{{ trans('access/roles_managment.show_title_roles') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('access/roles_managment.show_title_roles') }}</span>
                        <a class="btn btn-sm btn-light" href="{{ route(app('urlBack').'.super.roles.index') }}">
                            <i class="fa fa-arrow-left"></i> {{trans('access/roles_managment.show_back')}}</a>
                    </h5>
                </div>
                {{-- Content here --}}
                <table id="user" class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <td width="35%">{{trans('access/roles_managment.show_roles_type')}}</td>
                        <td width="65%"><a href="#" id="username" data-type="text" data-pk="1"
                                           class="editable editable-click">{{ $role->name }}</a></td>
                    </tr>
                    <tr>
                        <td>{{trans('access/roles_managment.permission_create_display_name')}}</td>
                        <td><a href="#" id="firstname" data-type="text" data-pk="1" data-placement="right"
                               class="editable editable-click editable-empty">{{ $role->display_name }}</a></td>
                    </tr>
                    <tr>
                        <td>{{trans('access/roles_managment.show_roles_description')}}</td>
                        <td><a href="#" id="firstname" data-type="text" data-pk="1" data-placement="right"
                               class="editable editable-click editable-empty">{{ $role->description }}</a></td>
                    </tr>
                    <tr>
                        <td>{{trans('access/roles_managment.show_roles_permission')}}</td>
                        <td><a href="#" id="country" data-type="select2" data-pk="1" data-value="BS"
                               data-title="Select country" class="editable editable-click">
                                @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                        <h5><span class="badge badge-secondary">{{ $v->display_name }}</span></h5>
                                    @endforeach
                                @endif
                            </a>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
