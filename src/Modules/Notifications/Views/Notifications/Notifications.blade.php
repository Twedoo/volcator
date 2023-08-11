@extends('elements.layouts.app')
@section('content')
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Volcator</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong>{{ trans('Notifications::Notifications/Notifications.title_header') }}</strong>
                    </span>
                </div>
            </div>
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('Notifications::Notifications/Notifications.list_notification') }}</span>
                    </h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-5">
                                    <table class="table table-hover nowrap" id="datatableNotificationList">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('Notifications::Notifications/Notifications.notification_column') }}</th>
                                            <th>{{ trans('Notifications::Notifications/Notifications.open_column') }}</th>
                                            <th>{{ trans('Notifications::Notifications/Notifications.type_column') }}</th>
                                            <th>{{ trans('Notifications::Notifications/Notifications.space_column') }}</th>
                                            <th>{{ trans('Notifications::Notifications/Notifications.application_column') }}</th>
                                            <th>{{ trans('Notifications::Notifications/Notifications.by_column') }}</th>
                                            <th>{{ trans('Notifications::Notifications/Notifications.owner_column') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($notifications as $key => $notification)
                                            <tr>
                                                <td>
                                                    <a href="{{ VolcatorPath::openNotificationByStringRoute($notification->id, $notification->route, $notification->space_id, $notification->application_id) }}">
                                                        <strong>{!! VolcatorTranslation::translateNotification($notification->title) !!}</strong>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ VolcatorPath::openNotificationByStringRoute($notification->id, $notification->route, $notification->space_id, $notification->application_id) }}">
                                                        {!! VolcatorTranslation::translateNotification($notification->notification) !!}
                                                    </a>
                                                </td>
                                                <td>{{ $notification->open }}</td>
                                                <td>{{ VolcatorSpace::getSpaceNameById($notification->space_id) }}</td>
                                                <td>{{ VolcatorApplication::getApplicationNameById($notification->application_id) }}</td>
                                                <td>{{ VolcatorPushNotification::getUserNameById($notification->user_id) }}</td>
                                                <td>{{ VolcatorPushNotification::getUserNameById($notification->owner_id) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>{{ trans('Notifications::Notifications/Notifications.notification_column') }}</th>
                                                <th>{{ trans('Notifications::Notifications/Notifications.open_column') }}</th>
                                                <th>{{ trans('Notifications::Notifications/Notifications.type_column') }}</th>
                                                <th>{{ trans('Notifications::Notifications/Notifications.space_column') }}</th>
                                                <th>{{ trans('Notifications::Notifications/Notifications.application_column') }}</th>
                                                <th>{{ trans('Notifications::Notifications/Notifications.by_column') }}</th>
                                                <th>{{ trans('Notifications::Notifications/Notifications.owner_column') }}</th>
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
                            $('#datatableNotificationList').DataTable({
                                responsive: true,
                            })
                        })
                    })(jQuery)
                </script>
            </div>
        </div>
    </section>
@endsection

