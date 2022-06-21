<?php

namespace Twedoo\Stone\Http\Controllers;

use App;
use Twedoo\Stone\Organizer\Models\Stones;
use Twedoo\StoneGuard\Models\Permission;
use Twedoo\StoneGuard\Models\Role;
use DB;
use Config;
use Illuminate\Http\Request;
use Schema;
use Session;
use Validator;
use Twedoo\StoneGuard\Models\User;

// TODO : Pagination dynamic
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $user = auth()->user();
        $myRole = $user->roles->pluck('id', 'id')->toarray();
        if ($user->id == 1) {
            $roles = Role::orderBy('id', 'DESC')->get();
        } else {
            $roles = Role::orderBy('id', 'DESC')->where('id', '!=', 1)->whereNotIn('id', $myRole)->get();
        }


        return view('elements.super.roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $module = Stones::All();
        $getPermissions = $user->with('roles.permissions')->where("users.id", $user->id)->get();
        $getFilterRole = $this->getPermissionsPerUserAll($module, $getPermissions);
        return view('elements.super.roles.create', compact('getFilterRole'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user->hasRole('Root'))
            return back();

        $rules = [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        $validate->SetAttributeNames([
            "name" => trans('access/roles_managment.roles_create_name'),
            "display_name" => trans('access/roles_managment.roles_create_display_name'),
            "description" => trans('access/roles_managment.roles_create_description'),
            "permission" => trans('access/roles_managment.roles_create_permission')
        ]);

        if ($validate->fails()) {
            if (App::getLocale() == 'ar' || App::getLocale() == 'ur') {
                \Toastr::error(trans('access/roles_managment.toastr_errors_create_roles'), trans('access/roles_managment.toastr_errors'), ["positionClass" => "toast-top-left"]);
            } else {
                \Toastr::error(trans('access/roles_managment.toastr_errors_create_roles'), trans('access/roles_managment.toastr_errors'), ["positionClass" => "toast-top-right"]);
            }
            return back()->withInput()->withErrors($validate);
        } else {
            $role = new Role();
            $role->name = $request->input('name');
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');
            if ($role->save()) {
                foreach ($request->input('permission') as $key => $value) {
                    if (in_array($value, $this->getPermissionsPerUser())) {
                        $role->attachPermission($value);
                    }
                }

                if (App::getLocale() == 'ar' || App::getLocale() == 'ur') {
                    \Toastr::success(trans('access/roles_managment.toastr_success_create_roles'), trans('access/roles_managment.toastr_errors'), ["positionClass" => "toast-top-left"]);
                } else {
                    \Toastr::success(trans('access/roles_managment.toastr_success_create_roles'), trans('access/roles_managment.toastr_errors'), ["positionClass" => "toast-top-right"]);
                }
            }
        }
        return redirect()->route(app('urlBack') . '.super.roles.index');
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
        if (!$user->hasRole('Root') && $id == 1)
            return back();

        $role = Role::find($id);
        $rolePermissions = Permission::join("permission_role", "permission_role.permission_id", "=", "permissions.id")
            ->where("permission_role.role_id", $id)->get();
        return view('elements.super.roles.show', compact('role', 'rolePermissions'));
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
        if (!$user->hasRole('Root') && $id == 1)
            return back();

        $role = Role::find($id);
        $module = Stones::All();
        $permission = Permission::orderBy('id', 'DESC')->where('id_stone', '')->get();
        $rolePermissions = DB::table("permission_role")->where("permission_role.role_id", $id)
            ->pluck('permission_role.permission_id', 'permission_role.permission_id')->toarray();

        $getPermissions = $user->with('roles.permissions')->where("users.id", $user->id)->get();
        $getFilterRole = $this->getPermissionsPerUserAll($module, $getPermissions);
        return view('elements.super.roles.edit', compact('role', 'permission', 'getPermissions', 'rolePermissions', 'module', 'getFilterRole'));
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
        if (!$user->hasRole('Root') && $id == 1)
            return back();

        $rules = [
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        $validate->SetAttributeNames([
            "display_name" => trans('access/roles_managment.roles_edit_name'),
            "description" => trans('access/roles_managment.roles_edit_description'),
            "permission" => trans('access/roles_managment.roles_edit_permission')
        ]);

        if ($validate->fails()) {
            if (App::getLocale() == 'ar' || App::getLocale() == 'ur') {
                \Toastr::error(trans('access/roles_managment.toastr_errors_update_roles'), trans('access/roles_managment.toastr_errors'), ["positionClass" => "toast-top-left"]);
            } else {
                \Toastr::error(trans('access/roles_managment.toastr_errors_update_roles'), trans('access/roles_managment.toastr_errors'), ["positionClass" => "toast-top-right"]);
            }
            return back()->withInput()->withErrors($validate);
        } else {
            $role = Role::find($id);
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');
            if ($role->save()) {
                DB::table("permission_role")->where("permission_role.role_id", $id)->delete();
                foreach ($request->input('permission') as $key => $value) {
//                    if (in_array($value, $this->getPermissionsPerUser())) {
                        $role->attachPermission($value);
//                    }
                }

                if (App::getLocale() == 'ar' || App::getLocale() == 'ur') {
                    \Toastr::success(trans('access/roles_managment.toastr_success_update_roles'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-left"]);
                } else {
                    \Toastr::success(trans('access/roles_managment.toastr_success_update_roles'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-right"]);
                }
            }
        }
        return redirect()->route(app('urlBack') . '.super.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        if (DB::table("roles")->where('id', $id)->where('id', '!=', '1')->delete()) {
            if (App::getLocale() == 'ar' || App::getLocale() == 'ur') {
                \Toastr::success(trans('access/roles_managment.toastr_success_delete_roles'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-left"]);
            } else {
                \Toastr::success(trans('access/roles_managment.toastr_success_delete_roles'), trans('access/roles_managment.toastr_success'), ["positionClass" => "toast-top-right"]);
            }
        }
        return redirect()->route(app('urlBack') . '.super.roles.index');
    }

    /**
     * @return array
     */
    public function getPermissionsPerUser()
    {
        $user = auth()->user();
        $getPermissions = $user->with('roles.permissions')->where("users.id", $user->id)->get();
        foreach ($getPermissions as $key => $roles) {
            foreach ($roles->roles as $rolePermission) {
                foreach ($rolePermission->permissions as $permission) {
                    $getFilterRole[] = $permission->id;
                }
            }
        }
        return $getFilterRole;
    }


    public function getPermissionsPerUserAll($module, $getPermissions)
    {
        $getFilterRole = [];
        foreach ($module as $value) {
            foreach ($value->getPermissions()->where('id_stone', $value->id)->get() as $getModulePermission) {
                foreach ($getPermissions as $key => $roles) {
                    foreach ($roles->roles as $rolePermission) {
                        foreach ($rolePermission->permissions as $permission) {
                            if ($getModulePermission->id == $permission->id) {
                                $getFilterRole[$value->name][$permission->id] = $permission->display_name;
                            }
                        }
                    }
                }
            }
        }
//        dump($getFilterRole);die;
        return $getFilterRole;
    }
}
