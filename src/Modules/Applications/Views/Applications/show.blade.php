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
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current">{{ trans('Applications::Applications/Applications.show_application') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('Applications::Applications/Applications.show_application') }}</span>
                        <a class="btn btn-sm btn-light" href="{{ route(app('urlBack').'.multi.applications.index') }}">
                            <i class="fa fa-arrow-left"></i> {{ trans('Applications::Applications/Applications.back') }}
                        </a>
                    </h5>
                </div>
                <table id="user" class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <td width="35%">{{ trans('Applications::Applications/Applications.name') }}</td>
                        <td width="65%"><a href="#" id="username" data-type="text" data-pk="1"
                                           data-title="Enter username"
                                           class="editable editable-click">{{ $application->name }}</a></td>
                    </tr>
                    <tr>
                        <td>{{ trans('Applications::Applications/Applications.display_name') }}</td>
                        <td><a href="#" id="firstname" data-type="text" data-pk="1" data-placement="right"
                               data-placeholder="Required" data-title="Enter your firstname"
                               class="editable editable-click editable-empty">{{ $application->display_name }}</a></td>
                    </tr>


                    <tr>
                        <td>{{ trans('Applications::Applications/Applications.owner_app') }}</td>
                        <td><a href="#" id="country" data-type="select2" data-pk="1" data-value="BS"
                               data-title="Select country" class="editable editable-click">
                                @if(count($users))
                                    @foreach($users as $v)
                                        <label class="badge badge-secondary">{{ $v }}</label>
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
