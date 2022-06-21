@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Stone</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong>{{ trans('access/roles_managment.show_users_management') }}</strong>
                    </span>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current">{{ trans('access/roles_managment.show_users_title') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('access/roles_managment.show_users_title') }}</span>
                        <a class="btn btn-sm btn-light" href="{{ route(app('urlBack').'.super.users.index') }}">
                           <i class="fa fa-arrow-left"></i> {{trans('access/roles_managment.show_back')}}</a>
                    </h5>
                </div>
                <table id="user" class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <td width="35%">{{trans('access/roles_managment.show_users_name')}}</td>
                        <td width="65%"><a href="#" id="username" data-type="text" data-pk="1"
                                           data-title="Enter username"
                                           class="editable editable-click">{{ $user->name }}</a></td>
                    </tr>
                    <tr>
                        <td>{{trans('access/roles_managment.show_users_email')}}</td>
                        <td><a href="#" id="firstname" data-type="text" data-pk="1" data-placement="right"
                               data-placeholder="Required" data-title="Enter your firstname"
                               class="editable editable-click editable-empty">{{ $user->email }}</a></td>
                    </tr>


                    <tr>
                        <td>{{trans('access/roles_managment.show_users_role')}}</td>
                        <td><a href="#" id="country" data-type="select2" data-pk="1" data-value="BS"
                               data-title="Select country" class="editable editable-click">
                                @if(!empty($user->roles))
                                    @foreach($user->roles as $v)
                                        <label class="label label-success">{{ $v->display_name }}</label>
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
