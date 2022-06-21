@extends('elements.layouts.app')

@section('content')

    <section id="middle">
        <header id="page-header">
            <h1>{{ trans('access/roles_managment.errors_permissions') }}</h1>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route(app('urlBack').'.super.roles.index') }}"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> {{ trans('access/roles_managment.roles_back_create') }}</a>
            </div>
        </header>

        <div id="content" class="padding-20">
            <div class="container">
                <div class="content">
                    <div class=""><h2> {{ trans('access/roles_managment.message_error_permissions') }} </h2></div>
                </div>
            </div>
        </div>
    </section>

@endsection



