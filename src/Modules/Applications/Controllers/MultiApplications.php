<?php

namespace Modules\Applications\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Input;
use VolcatorLanguage;
use Route;
use Schema;
use Session;
use Twedoo\Volcator\Core\VolcatorApplication;
use Twedoo\Volcator\Core\VolcatorSpace;
use Twedoo\Volcator\Modules\Applications\Models\Applications;
use Validator;
use DB;
use App;
use Twedoo\VolcatorGuard\Models\User;
use Config;

// TODO : Pagination
class MultiApplications extends Controller
{
    /**
     * @param $application
     * @return void
     */
    public function switchApplication($application)
    {
        VolcatorApplication::setCurrentApplication($application);
        return Redirect::back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();
        $applications = VolcatorApplication::getApplicationsUserBySpaces($user->id, true, true);
        return view('Applications::Applications.index', compact('applications'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $application = Applications::find($id);
        $users = VolcatorApplication::getUserCurrentApplication($id);
        return view('Applications::Applications.show', compact('application', 'users'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = VolcatorApplication::getUsersCurrentSpace();
        return view('Applications::Applications.create', compact('users'));
    }

    /**
     * @param Request $requests
     */
    public function store(Request $request)
    {

        $rules = [
            "name" => "required|unique:applications,name",
            "display_name" => "required",
            "users"  => "required",
        ];

        $validate = Validator::make($request->all(), $rules);
        $validate->SetAttributeNames([
            "name" => trans('Applications::Applications/Applications.name_app'),
            "display_name" => trans('Applications::Applications/Applications.name_app_dis'),
            "users" => trans('Applications::Applications/Applications.owner_app')
        ]);

        if ($validate->fails()) {
//            VolcatorLanguage::displayNotificationProgress(
//                'error',
//                trans('Applications::Applications/Applications.errors_add'),
//                trans('Applications::Applications/Applications.errors')
//            );
            return back()->withInput()->withErrors($validate);

        } else {

            VolcatorApplication::createApplication($request);

            switch (App::getLocale()) {
                case "ar":
                    \Toastr::success(trans('Applications::Applications/Applications.success_add'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "fa":
                    \Toastr::success(trans('Applications::Applications/Applications.success_add'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "ur":
                    \Toastr::success(trans('Applications::Applications/Applications.success_add'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                default:
                    \Toastr::success(trans('Applications::Applications/Applications.success_add'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-right"]);
            }
        }
        return redirect()->route(app('urlBack') . '.multi.applications.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = Applications::where('id', $id)->first();
        $users = VolcatorApplication::getUsersCurrentSpace();
        return view('Applications::Applications.edit', compact('application', 'users'));
    }

    /**
     * @param Request $requests
     */
    public function update(Request $request, $id)
    {

        $rules = [
            "name" => "required|unique:applications,name". ($id ? ",$id" : ''),
            "display_name" => "required",
            "users"  => "required",
        ];

        $validate = Validator::make($request->all(), $rules);
        $validate->SetAttributeNames([
            "name" => trans('Applications::Applications/Applications.name_app'),
            "display_name" => trans('Applications::Applications/Applications.name_app_dis'),
            "users" => trans('Applications::Applications/Applications.owner_app')
        ]);

        if ($validate->fails()) {
            VolcatorLanguage::displayNotificationProgress(
                'error',
                trans('Applications::Applications/Applications.errors_add'),
                trans('Applications::Applications/Applications.errors')
            );
            return back()->withInput()->withErrors($validate);

        } else {

            VolcatorApplication::updateApplication($request, $id);

            switch (App::getLocale()) {
                case "ar":
                    \Toastr::success(trans('Applications::Applications/Applications.success_add'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "fa":
                    \Toastr::success(trans('Applications::Applications/Applications.success_add'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "ur":
                    \Toastr::success(trans('Applications::Applications/Applications.success_add'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                default:
                    \Toastr::success(trans('Applications::Applications/Applications.success_add'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-right"]);
            }
        }
        return redirect()->route(app('urlBack') . '.multi.applications.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        if (VolcatorApplication::deleteApplication($id)) {
            switch (App::getLocale()) {
                case "ar":
                    \Toastr::success(trans('Applications::Applications/Applications.success_delete_application'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "fa":
                    \Toastr::success(trans('Applications::Applications/Applications.success_delete_application'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "ur":
                    \Toastr::success(trans('Applications::Applications/Applications.success_delete_application'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                default:
                    \Toastr::success(trans('Applications::Applications/Applications.success_delete_application'), trans('Applications::Applications/Applications.success'), ["positionClass" => "toast-top-right"]);
            }
        }
        return redirect()->route(app('urlBack') . '.multi.applications.index');
    }

    public function createType()
    {
        return view('Applications::Type.create');
    }

}
