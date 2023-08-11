<?php

namespace Twedoo\Volcator\Http\Controllers;

use App;
use Illuminate\Support\Facades\Notification;
use Twedoo\Volcator\Core\VolcatorSpace;
use Twedoo\Volcator\Modules\Applications\Models\Applications;
use Twedoo\Volcator\Core\VolcatorApplication;
use Twedoo\Volcator\Modules\Applications\Models\Spaces;
use Twedoo\Volcator\Organizer\Models\Volcators;
use Twedoo\VolcatorGuard\Models\Role;
use Twedoo\VolcatorGuard\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;
use Validator;
use Config;

// TODO : Pagination dynamic
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = VolcatorSpace::getUsersByCurrentApplicationCurrentSpace();
        return view('elements.super.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if(!$user->hasRole(Config::get('volcator.MAJESTIC'))) {
            $roles = Role::where('id', '!=', 1)->pluck('display_name', 'id');
        }  else {
            $roles = Role::pluck('display_name', 'id');
        }

        return view('elements.super.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "name" => "required ",
            "email" => 'required|email|unique:users,email',
            "password" => 'required|same:confirm-password',
            "roles" => "required",
        ];

        $validate = Validator::make($request->all(), $rules);
        $validate->SetAttributeNames([
            "name" => trans('Access-Controls::Access-Controls/Access-Controls.create_users_name'),
            "email" => trans('Access-Controls::Access-Controls/Access-Controls.create_users_email'),
            "password" => trans('Access-Controls::Access-Controls/Access-Controls.create_users_password'),
            "confirm-password" => trans('Access-Controls::Access-Controls/Access-Controls.create_users_password_confirm'),
            "roles" => trans('Access-Controls::Access-Controls/Access-Controls.create_users_roles')
        ]);

        if ($validate->fails()) {
            if (App::getLocale() == 'ar' || App::getLocale() == 'ur') {
                \Toastr::error(trans('access/roles_managment.toastr_errors_create_users'), trans('access/roles_managment.toastr_errors'), ["positionClass" => "toast-top-left"]);
            } else {
                \Toastr::error(trans('access/roles_managment.toastr_errors_create_users'), trans('access/roles_managment.toastr_errors'), ["positionClass" => "toast-top-right"]);
            }
            return back()->withInput()->withErrors($validate);
        } else {
            $request->merge(['code' => strtoupper(uniqid())]);
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);

            foreach ($request->input('roles') as $key => $value) {
                $user->attachRole($value);
            }

            VolcatorApplication::CreateMainApplicationOrAssignUser($user);

            if (App::getLocale() == 'ar' || App::getLocale() == 'ur') {
                \Toastr::success(trans('access/roles_managment.toastr_success_create_users'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-left"]);
            } else {
                \Toastr::success(trans('access/roles_managment.toastr_success_create_users'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-right"]);
            }
            return redirect()->route(app('urlBack') . '.super.users.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        if(!$user->hasRole(Config::get('volcator.MAJESTIC')) && $id == 1)
            return back();

        $user = User::find($id);
        return view('elements.super.users.show', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        if(!$user->hasRole(Config::get('volcator.MAJESTIC')) && $id == 1)
            return back();

        $user = User::where('id', '=', $id)->first();
        $roles = Role::where('id', '!=', 1)->pluck('display_name', 'id');
        $userRole = DB::table('role_user')->where('application_id', VolcatorApplication::getCurrentApplicationId())
            ->where('user_id', $id)->distinct()->pluck('role_id')->toArray();
//        dd($userRole, VolcatorApplication::getCurrentApplicationId() );
        return view('elements.super.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        if(!$user->hasRole('Root') && $id == 1)
            return back();

        $rules = [
            "name" => "required ",
            'email' => 'required|email|unique:users,email,' . $id,
            "roles" => "required",
        ];

        $validate = Validator::make($request->all(), $rules);
        $validate->SetAttributeNames([
            "name" => trans('access/roles_managment.create_users_name'),
            "email" => trans('access/roles_managment.create_users_email'),
            "roles" => trans('access/roles_managment.create_users_roles')
        ]);

        if ($validate->fails()) {
            if (App::getLocale() == 'ar' || App::getLocale() == 'ur') {
                \Toastr::error(trans('access/roles_managment.toastr_errors_update_users'), trans('access/roles_managment.toastr_errors'), ["positionClass" => "toast-top-left"]);
            } else {
                \Toastr::error(trans('access/roles_managment.toastr_errors_update_users'), trans('access/roles_managment.toastr_errors'), ["positionClass" => "toast-top-right"]);
            }
            return back()->withInput()->withErrors($validate);
        } else {
            $input = $request->all();

            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = array_except($input, array('password'));
            }

            $user = User::find($id);
            $user->update($input);

            if (User::where('id', '=', $id)->where('id', '!=', '1')->first()) {
                VolcatorApplication::deleteUserRoleByCurrentApplication($id);

                foreach ($request->input('roles') as $key => $value) {
                    $user->attachRole($value, ['application_id', VolcatorApplication::getCurrentApplicationId()]);
                }
            }

            if (App::getLocale() == 'ar' || App::getLocale() == 'ur') {
                \Toastr::success(trans('access/roles_managment.toastr_success_update_users'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-left"]);
            } else {
                \Toastr::success(trans('access/roles_managment.toastr_success_update_users'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-right"]);
            }
            return redirect()->route(app('urlBack') . '.super.users.index');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param null $level
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, $level = null)
    {
        $user = auth()->user();
        $is_destroy = false;
        if (!$level) {
            return redirect()->route(app('urlBack') . '.super.users.index');
        }

        if ($level == 2) {
            $is_destroy = VolcatorSpace::destroyUserByApplication($id);
        }

       if ($level == 3 && $user->hasRole(Config::get('volcator.ROLE_USER_SPACE'))) {
           $is_destroy = VolcatorSpace::destroyUserSpace($id);
       }

        if ($level == 4 && $user->hasRole(Config::get('volcator.ROLE_MANAGER_SPACE'))) {
            $is_destroy = VolcatorSpace::destroyUserBySpacesStrict($id);
        }
        if ($is_destroy) {
            if (App::getLocale() == 'ar' || App::getLocale() == 'ur') {
                \Toastr::success(trans('access/roles_managment.toastr_success_delete_users'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-left"]);
            } else {
                \Toastr::success(trans('access/roles_managment.toastr_success_delete_users'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-right"]);
            }
        }
        return redirect()->route(app('urlBack') . '.super.users.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function liveSearch(Request $request): \Illuminate\Http\JsonResponse
    {
        $users = [];
        if($request->has('q')){
            $search = $request->q;
            $users = User::select("email", "id")
                ->where('email', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($users);
    }
}
