<section id="middle">

    <!-- page title -->
    <header id="page-header">
        <h1> {{ $title_bar_top }}  </h1>

        @permission('users-access')
        <div class="pull-right">
            <a href="{{ route(app('urlBack').'.super.users.create') }}" class="btn btn-social btn-success">
                <i class="fa fa-edit"></i> {{ trans('roles_managment.index_users_create') }}
            </a>
        </div>
        @endpermission

        <ol class="breadcrumb">
            <li><a href="{{url(app('urlBack').'/')}}">{{ trans('roles_managment.site_name') }}</a></li>
            <li class="active">{{ trans('roles_managment.index_users_managment') }}</li>
        </ol>

    </header>
    <!-- /page title -->

    <div id="content" class="padding-20">
        {!! Toastr::message() !!}
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>{{ trans('roles_managment.create_users_create') }}</strong>
            </div>
            <div class="panel-body">
                <?php $plugins = $packageviews;  ?>

                @include('packages.'.$plugins)

            </div>
        </div>

    </div>
</section>
