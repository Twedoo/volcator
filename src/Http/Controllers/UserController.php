<?php

namespace Twedoo\Stone\Http\Controllers;

use App;
use App\Models\Role;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;
use Validator;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = auth()->user();
        if($user->id == 1)
            $data = User::orderBy('id', 'DESC')->get();
        else
            $data = User::orderBy('id', 'DESC')->where('id', '!=', 1)->get();

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
        if(!$user->hasRole('Root'))
            $roles = Role::where('id', '!=', 1)->pluck('display_name', 'id');
        else
            $roles = Role::pluck('display_name', 'id');

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
            "name" => trans('access/roles_managment.create_users_name'),
            "email" => trans('access/roles_managment.create_users_email'),
            "password" => trans('access/roles_managment.create_users_password'),
            "confirm-password" => trans('access/roles_managment.create_users_password_confirm'),
            "roles" => trans('access/roles_managment.create_users_roles')
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
        if(!$user->hasRole('Root') && $id == 1)
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
        if(!$user->hasRole('Root') && $id == 1)
            return back();

        $user = User::where('id', '=', $id)->first();
        $roles = Role::where('id', '!=', 1)->pluck('display_name', 'id');
        $userRole = $user->roles->pluck('id', 'id')->toArray();
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
                DB::table('role_user')->where('user_id', $id)->delete();

                foreach ($request->input('roles') as $key => $value) {
                    $user->attachRole($value);
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)

    {

        if (User::where('id', '=', $id)->where('id', '!=', '1')->delete()) {
            if (App::getLocale() == 'ar' || App::getLocale() == 'ur') {
                \Toastr::success(trans('access/roles_managment.toastr_success_delete_users'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-left"]);
            } else {
                \Toastr::success(trans('access/roles_managment.toastr_success_delete_users'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-right"]);
            }
        }

        return redirect()->route(app('urlBack') . '.super.users.index');

    }

}
