<?php
namespace Twedoo\Stone\Modules\Applications\Models\seeder;

use Twedoo\Stone\Modules\Applications\Models\Applications;
use Twedoo\Stone\Modules\Applications\Models\Spaces;
use Twedoo\Stone\Organizer\Models\modules;
use Illuminate\Database\Seeder;
use Twedoo\Stone\Models\Menuback;
use Twedoo\StoneGuard\Models\Permission;
use Twedoo\StoneGuard\Models\Role;
use Twedoo\StoneGuard\Models\User;
use DB;

class applicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $user = new User();
        $setModule = [
            [
                'im_name_modules' => 'Applications',
                'im_name_modules_display' => 'applications_module',
                'im_menu_icon' => 'fe fe-layers',
                'im_permission' => 'permissions-applications-view',
                'im_status' => '1',
                'application' => 'main'
            ]
        ];

        foreach ($setModule as $key => $value) {
            $insert = modules::create($value);
        }

        $idModule = $insert->im_id;
        $setrder = modules::where('im_id', '=', $idModule)->first();
        $setrder->im_order = $idModule;
        $setrder->update();

        $setMenus = [
            [
                'name_menu' => "managment_apps",
                'route_link' => "applications",
                'id_module' => $idModule,
                'mb_permission' => 'permissions-applications-view',
            ]
        ];

        foreach ($setMenus as $key => $value) {
            Menuback::create($value);
        }


        /**
         * Create roles and permissions manager space
         */
        $permissions_manager_space = [
            [
                'name' => 'permissions-stone-manager',
                'display_name' => 'Manager Space',
                'description' => 'Permission manager spaces'
            ],
        ];

        $roles_manager_spaces = [
            [
                'name' => 'Manager-Space',
                'display_name' => 'Manager Space',
                'description' => 'Manager Manager Space, permissions to create spaces'
            ]
        ];

        foreach ($roles_manager_spaces as $key => $value) {
            $role_manager_space = Role::create($value);
        }

        $id_role_manager_space = $role_manager_space->id;

        foreach ($permissions_manager_space as $key => $value) {
            $setPermission = Permission::create($value);
            DB::table("permission_role")->insert([
                'permission_id' => $setPermission->id,
                'role_id' => $id_role_manager_space,
            ]);
        }

        /**
         * Create roles and permissions Multi-Applications
         */
        $permission = [
            [
                'name' => 'permissions-applications-view',
                'display_name' => 'View Multi-Applications',
                'description' => 'Permission management Applications for users',
                'id_module' => $idModule
            ],
            [
                'name' => 'permissions-applications-create',
                'display_name' => 'Create Multi-Applications',
                'description' => 'Permission Create Applications',
                'id_module' => $idModule
            ],
            [
                'name' => 'permissions-applications-delete',
                'display_name' => 'Delete Multi-Applications',
                'description' => 'Permission Delete Applications',
                'id_module' => $idModule
            ],
            [
                'name' => 'permissions-applications-type',
                'display_name' => 'Create Type Multi-Applications',
                'description' => 'Permission Create Type Applications',
                'id_module' => $idModule
            ]
        ];

        $roles = [
            [
                'name' => 'Manager-Multi-Application',
                'display_name' => 'Manager Multi-Application',
                'description' => 'Manager Multi-Application, permissions to create his owner Applications'
            ]
        ];

        foreach ($roles as $key => $value) {
            $role_application = Role::create($value);
        }

        $id_role = $role_application->id;

        foreach ($permission as $key => $value) {
            $setPermission = Permission::create($value);
            DB::table("permission_role")->insert([
                'permission_id' => $setPermission->id,
                'role_id' => $id_role,
            ]);
        }

        // add role multi-application to Majestic
        $users_majestic = User::whereHas('roles', function($q) {
            $q->where('roles.name', 'Root');
        })->pluck('id')->toArray();

        foreach ($users_majestic as $key => $user_id) {
            DB::table("role_user")->insert([
                'user_id' => $user_id,
                'role_id' => $id_role_manager_space,
            ]);
            DB::table("role_user")->insert([
                'user_id' => $user_id,
                'role_id' => $id_role,
            ]);
        }

        foreach ($users_majestic as $key => $user_id) {
            $space = Spaces::create([
                'name' => 'Main Workspace',
                'unique_identity' => uniqid(),
                'owner_id' => $user_id,
            ]);
            $application = Applications::create([
                'name' => 'Main',
                'display_name' => 'Main Application',
                'unique_identity' => uniqid(),
                'type' => 'main',
                'space_id' => $space->id,
            ]);
            $application_attached = Modules::where('application', 'main')->pluck('im_id')->toArray();
            $users_attached[] = (string) $user_id;
            $application->users()->attach($users_attached);
            $application->modules()->attach($application_attached);
        }
        // end permission cms
    }

}
