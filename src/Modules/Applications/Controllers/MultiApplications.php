<?php

namespace Modules\Applications\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Input;
use StoneLanguage;
use Route;
use Schema;
use Session;
use Twedoo\Stone\Core\StoneApplication;
use Twedoo\Stone\Core\StoneSpace;
use Twedoo\Stone\Modules\Applications\Models\Applications;
use Validator;
use DB;
use App;
use Twedoo\StoneGuard\Models\User;

// TODO : Pagination
class MultiApplications extends Controller
{
    /**
     * @param $application
     * @return void
     */
    public function switchApplication($application)
    {
        StoneApplication::setCurrentApplication($application);
        return Redirect::back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user->hasRole('Root')) {
            $applications = Applications::whereHas('users', function($q) use($user) {
                $q->where('user_id', $user->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $applications = Applications::all();
        }

        return view('Applications::Applications.index', compact('applications'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = StoneApplication::getUsersOfAllSpaces();

        return view('Applications::Applications.create', compact('users'));
    }

    /**
     * @param Request $requests
     */
    public function store(Request $request)
    {
        $rules = [
            "name_app" => "required|unique:applications,name",
            "name_app_dis" => "required",
            "owner_app"  => "required",
        ];

        $validate = Validator::make($request->all(), $rules);
        $validate->SetAttributeNames([
            "name_app" => trans('Applications::Applications/applications.name_app'),
            "name_app_dis" => trans('Applications::Applications/applications.name_app_dis'),
            "owner_app" => trans('Applications::Applications/applications.owner_app')
        ]);

        if ($validate->fails()) {
            StoneLanguage::displayNotificationProgress(
                'error',
                trans('Applications::Applications/applications.errors_add'),
                trans('Applications::Applications/applications.errors')
            );
            return back()->withInput()->withErrors($validate);

        } else {

            StoneApplication::createApplication($request);

            switch (App::getLocale()) {
                case "ar":
                    \Toastr::success(trans('Applications::Applications/applications.success_add'), trans('Applications::Applications/applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "fa":
                    \Toastr::success(trans('Applications::Applications/applications.success_add'), trans('Applications::Applications/applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "ur":
                    \Toastr::success(trans('Applications::Applications/applications.success_add'), trans('Applications::Applications/applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                default:
                    \Toastr::success(trans('Applications::Applications/applications.success_add'), trans('Applications::Applications/applications.success'), ["positionClass" => "toast-top-right"]);
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
        $user = auth()->user()->id;
        $applications = Applications::whereHas('users', function($q) use($id, $user) {
            $q->where('application_id', $id);
            $q->where('user_id', $user);
        })->first();

        dump($applications->users());die;

        $roles = Role::where('id', '!=', 1)->pluck('display_name', 'id');
        $userRole = $user->roles->pluck('id', 'id')->toArray();
        return view('elements.super.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        if (DB::table("applications")->where('id', $id)->delete()) {
            switch (App::getLocale()) {
                case "ar":
                    \Toastr::success(trans('Applications::Applications/applications.success_delete_application'), trans('Applications::Applications/applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "fa":
                    \Toastr::success(trans('Applications::Applications/applications.success_delete_application'), trans('Applications::Applications/applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "ur":
                    \Toastr::success(trans('Applications::Applications/applications.success_delete_application'), trans('Applications::Applications/applications.success'), ["positionClass" => "toast-top-left"]);
                    break;
                default:
                    \Toastr::success(trans('Applications::Applications/applications.success_delete_application'), trans('Applications::Applications/applications.success'), ["positionClass" => "toast-top-right"]);
            }
        }
        return redirect()->route(app('urlBack') . '.multi.applications.index');
    }

    public function createType()
    {
        return view('Applications::Type.create');
    }

}
