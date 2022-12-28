@extends('elements.layouts.app')
@section('content')
    <style>
        .select2-search__field {
            width: auto !important;
        }
        .select2-results .select2-results__option[aria-selected=true] {
            display: none;
        }
    </style>
    <section id="middle">
        <div class="cui__layout__content">
            <div class="cui__breadcrumbs">
                <div class="cui__breadcrumbs__path">
                    <a href="javascript: void(0);">Stone</a>
                    <span>
                        <span class="cui__breadcrumbs__arrow"></span>
                        <strong
                            class="cui__breadcrumbs__current">{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_title') }}</strong>
                    </span>
                </div>
            </div>
            {{--     content       --}}
            <div class="cui__utils__content">
                <div class="kit__utils__heading">
                    <h5>
                        <span class="mr-3">{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_management') }}</span>
                        @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                        <a href="{{ route(app('urlBack').'.super.users.create') }}" data-toggle="modal" data-target="#InviteUserApplication" class="btn btn-sm btn-light">
                            <i class="fa fa-envelope"></i> {{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_invite') }}
                        </a>
                        @endpermission
                        @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                        <a href="{{ route(app('urlBack').'.super.users.create') }}" class="btn btn-sm btn-light">
                            <i class="fa fa-user"></i> {{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_create') }}
                        </a>
                        @endpermission

                    </h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">
                            <strong>{{ trans('Access-Controls::Access-Controls/Access-Controls.management_acl_users_list') }}</strong>
                        </h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-5">
                                    <table class="table table-hover nowrap" id="datatableUsersList">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_name') }}</th>
                                            <th>{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_email') }}</th>
                                            <th>{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_show') }}</th>
                                            @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                            <th>{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_edit') }}</th>
                                            @endpermission
                                            @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                            <th>{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_delete') }}</th>
                                            @endpermission
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($data as $key => $user)
                                            @if( $user->type != 'root')
                                                <tr>
                                                    <td>
                                                        {{ $user->name }}
                                                    </td>
                                                    <td class="center">
                                                        {{ $user->email }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route(app('urlBack').'.super.users.show',$user->id) }}">
                                                            <i class="fa fa-eye btn btn-darken-1" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                    @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                                        <td>
                                                            <a @if($user->id != 1) href="{{ route(app('urlBack').'.super.users.edit', $user->id) }}"
                                                               @else  disabled @endif>
                                                                <i class="fa fa-edit btn btn-darken-1 @if($user->id == 1) disabled stone-disable-click @endif"
                                                                   aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    @endpermission

                                                    @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                                        <td>
                                                            <a @if($user->id != 1) href="{{ route(app('urlBack').'.super.users.destroy', $user->id) }}"
                                                               @else  disabled @endif data-toggle="modal" data-target="#deleteUserSpace" class="delete_user_button" user="{{ $user->id }}">
                                                                <i class="fa fa-trash btn btn-darken-1 @if($user->id == 1) disabled stone-disable-click @endif"
                                                                   aria-hidden="true"></i> </a>
                                                        </td>
                                                    @endpermission
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_name') }}</th>
                                            <th>{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_email') }}</th>
                                            <th>{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_show') }}</th>
                                            @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                            <th>{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_edit') }}</th>
                                            @endpermission
                                            @permission(Config::get('stone.PERMISSION_USER_ACCESS_CONTROL'))
                                            <th>{{ trans('Access-Controls::Access-Controls/Access-Controls.index_users_delete') }}</th>
                                            @endpermission
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
                            $('#datatableUsersList').DataTable({
                                responsive: true,
                            })
                        })
                    })(jQuery)
                </script>
            </div>
        </div>
    </section>
    <div id="deleteUserSpace" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteUserSpace"
         aria-hidden="true" user="" href="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title pull-left" id="createSpace"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_user') }} </strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group name-space">
                        <label class="form-label label-name-space from_current_application"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_from_current_application') }}
                            {{ Form::checkbox(false, false, false, ['class' => 'checkbox_remove_from_current_application']) }}
                        </label>
                    </div>
                    @role(Config::get('stone.ROLE_USER_SPACE'))
                        <div class="form-group name-space">
                            <label class="form-label label-name-space remove_from_current_space"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_from_current_space') }}
                                {{ Form::checkbox(false, false, false, ['class' => ['checkbox_remove_from_current_space']]) }}
                            </label>
                        </div>
                    @endrole
                    @role(Config::get('stone.ROLE_MANAGER_SPACE'))
                        <div class="form-group name-space">
                            <label class="form-label label-name-space current_all_space"> {{ trans('Access-Controls::Access-Controls/Access-Controls.remove_from_all_space') }}
                                {{ Form::checkbox(false, false, false, ['class' => 'checkbox_remove_from_all_space']) }}
                            </label>
                        </div>
                    @endrole
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger delete-confirm stone-disable-click" disabled> {{ trans('Access-Controls::Access-Controls/Access-Controls.btn_remove') }} </button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">{{ trans('Access-Controls::Access-Controls/Access-Controls.btn_cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="InviteUserApplication" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="InviteUserApplication"
         aria-hidden="true" user="" href="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title pull-left" id="InviteUserApplication"> {{ trans('Access-Controls::Access-Controls/Access-Controls.invite_user') }} </strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="inviteUserSpaceAppForm" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="form-group liveSearchUserAutocomplete-group">
                            <label class="form-label label-name-space from_current_application"> {{ trans('Access-Controls::Access-Controls/Access-Controls.invite_user_live_search') }}</label>
                            <select class="select2 form-control liveSearchUserAutocomplete" multiple="'multiple" name="liveSearchUserAutocomplete"></select>
                            <div class="form-control-error-list" data-error-list="">
                                <ul>
                                    <li class="liveSearchUserAutocomplete-error">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @role(Config::get('stone.ROLE_MANAGER_SPACE'))
                        <div class="form-group name-space">
                            <label class="form-label invite-full-space"> {{ trans('Access-Controls::Access-Controls/Access-Controls.invite_full_space') }}
                                {{ Form::checkbox(false, false, false, ['class' => 'invite_full_space_checkbox']) }}
                            </label>
                        </div>
                        @endrole
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark" > {{ trans('Access-Controls::Access-Controls/Access-Controls.invite') }} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        function validateEmail(email) {
            let filter = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return filter.test(email);
        }

        const inviteFormSubmit = async (e) => {
            $('.liveSearchUserAutocomplete-group').removeClass('has-danger');
            $('.liveSearchUserAutocomplete-error').html('');
            e.preventDefault();
            let invites = $('.liveSearchUserAutocomplete').val();
            let type = $('.invite_full_space_checkbox').is(':checked');
            let formData = new FormData();
            let url = '{{ route('invite.users.invite') }}';
            formData.append('invites', invites);
            formData.append('type', type);
            formData.append('_token', "{{ csrf_token() }}");
            let validate = true;
            if (invites) {
                invites.forEach(function(email) {
                    validate = validateEmail(email);
                });
            }

            if (validate && invites) {
                try {
                    const apiUrl = url;
                    const options = {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
                        body: formData,
                        dataType: 'json',
                    };
                    const response = await fetch(apiUrl, options);
                    let result = await response.json();
                    $('#InviteUserApplication').modal('hide');
                } catch (error) {
                    //
                }
            } else {
                $('.liveSearchUserAutocomplete-group').addClass('has-danger')
                $('.liveSearchUserAutocomplete-error').html('{{ trans("Access-Controls::Access-Controls/Access-Controls.invite_user_error_email") }}');
            }
        }
        document.querySelector('#inviteUserSpaceAppForm').addEventListener("submit", inviteFormSubmit, false);


        $('.select2').select2({
            placeholder: "{{ trans('Access-Controls::Access-Controls/Access-Controls.invite_user_live_search_placeholder') }}",
            minimumInputLength: 3,
            tags: true,
            tokenSeparators: [',', ' '],
            width: 'resolve',
            allowClear: true,
            selectOnClose: false,
            ajax: {
                url:'{{ route(app('urlBack') . '.super.users.live-search') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.email,
                                id: item.email
                            }
                        })
                    };
                },
                // cache: true
            }
        });

        $('.delete_user_button').on('click', function (e) {
            $('#deleteUserSpace').attr('user', $(this).attr('user'));
            $('#deleteUserSpace').attr('href', $(this).attr('href'));
        });

        let checkbox_remove_from_current_application = $('.checkbox_remove_from_current_application');
        let checkbox_remove_from_current_space       = $('.checkbox_remove_from_current_space');
        let checkbox_remove_from_all_space           = $('.checkbox_remove_from_all_space');
        /**
         * unchecked all when modal closed
         */

        $('#deleteUserSpace').on('hidden.bs.modal', function (e) {
            checkbox_remove_from_current_application.prop('checked', false).attr("disabled", false);
            checkbox_remove_from_current_space.prop('checked', false).attr("disabled", false);
            checkbox_remove_from_all_space.prop('checked', false).attr("disabled", false);
            $('#deleteUserSpace').attr('user', '');
            $('#deleteUserSpace').attr('href', '');
        });

        $('.from_current_application').on('click', function (e) {
            if (checkbox_remove_from_current_application.is(':checked')) {
                $('.delete-confirm').removeClass("stone-disable-click").attr("disabled", false);
            } else {
                if (!checkbox_remove_from_current_space.is(':checked') && !checkbox_remove_from_all_space.is(':checked')) {
                    $('.delete-confirm').addClass("stone-disable-click").attr("disabled", true);
                }
            }
        });

        $('.remove_from_current_space').on('click', function (e) {
            if (checkbox_remove_from_current_space.is(':checked')) {
                $('.delete-confirm').removeClass("stone-disable-click").attr("disabled", false);
                checkbox_remove_from_current_application.attr("disabled", true).prop('checked', true);
            } else {
                if (!checkbox_remove_from_current_application.is(':checked') && !checkbox_remove_from_all_space.is(':checked')) {
                    $('.delete-confirm').addClass("stone-disable-click").attr("disabled", true);
                }
                checkbox_remove_from_current_application.attr("disabled", false);
            }
        });

        $('.current_all_space').on('click', function (e) {
            if (checkbox_remove_from_all_space.is(':checked')) {
                $('.delete-confirm').removeClass("stone-disable-click").attr("disabled", false);
                checkbox_remove_from_current_application.attr("disabled", true).prop('checked', true);
                checkbox_remove_from_current_space.attr("disabled", true).prop('checked', true);
            } else {
                if (!checkbox_remove_from_current_application.is(':checked') && !checkbox_remove_from_current_space.is(':checked')) {
                    $('.delete-confirm').addClass("stone-disable-click").attr("disabled", true);
                }
                checkbox_remove_from_current_space.attr("disabled", false);
            }
        });

        $('.delete-confirm').on('click', function (e) {
            let remove_level = 1;

            if (checkbox_remove_from_current_application.is(':checked')) {
                remove_level = 2;
            }
            @role(Config::get('stone.ROLE_USER_SPACE'))
                if (checkbox_remove_from_current_space.is(':checked')) {
                    remove_level = 3;
                }
            @endrole
            @role(Config::get('stone.ROLE_MANAGER_SPACE'))
                if (checkbox_remove_from_all_space.is(':checked')) {
                    remove_level = 4;
                }
            @endrole
            let url_delete_user = $('#deleteUserSpace').attr('href');
            window.location.href = url_delete_user+'/'+remove_level;
        });
    </script>

@endsection
