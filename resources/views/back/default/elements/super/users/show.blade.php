@extends('elements.layouts.app')



@section('content')



    <section id="middle">


        <!-- page title -->
        <header id="page-header">
            <h1>{{trans('access/roles_managment.show_users_title')}}</h1>
            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route(app('urlBack').'.super.users.index') }}"><i
                            class="glyphicon glyphicon-arrow-left"
                            aria-hidden="true"></i> {{trans('access/roles_managment.show_back')}}</a>

            </div>
            <ol class="breadcrumb">
                <li><a href="{{url(app('urlBack').'/')}}">{{trans('access/roles_managment.site_name')}}</a></li>
                <li class="active"><a
                            href="{{ route(app('urlBack').'.super.users.index') }}">{{trans('access/roles_managment.show_users_management')}}</a>
                </li>
                <li class="active">{{trans('access/roles_managment.show_users_title')}}</li>
            </ol>
        </header>
        <!-- /page title -->


        <div id="content" class="padding-20">

            <!-- ------ -->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>{{trans('access/roles_managment.show_title_users')}}</strong>
                </div>

                <div class="panel-body">

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
            <!-- /----- -->


        </div>


    </section>
@endsection
