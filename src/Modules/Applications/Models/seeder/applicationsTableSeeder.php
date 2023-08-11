<?php
namespace Twedoo\Volcator\Modules\Applications\Models\seeder;

use Twedoo\Volcator\Core\VolcatorSpace;
use Twedoo\Volcator\Modules\Applications\Models\Applications;
use Twedoo\Volcator\Modules\Applications\Models\Spaces;
use Twedoo\Volcator\Organizer\Models\Volcators;
use Illuminate\Database\Seeder;
use Twedoo\Volcator\Models\Menuback;
use Twedoo\VolcatorGuard\Models\Permission;
use Twedoo\VolcatorGuard\Models\Role;
use Twedoo\VolcatorGuard\Models\User;
use DB;
use Config;

class applicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $PERMISSION_SPACE_FULL                 = Config::get('volcator.PERMISSION_SPACE_FULL');
        $PERMISSION_SPACE_VIEW                 = Config::get('volcator.PERMISSION_SPACE_VIEW');

        $ROLE_MANAGER_SPACE                    = Config::get('volcator.ROLE_MANAGER_SPACE');
        $ROLE_USER_SPACE                       = Config::get('volcator.ROLE_USER_SPACE');

        $PERMISSION_APPLICATION_FULL           = Config::get('volcator.PERMISSION_APPLICATION_FULL');
        $PERMISSION_APPLICATION_VIEW           = Config::get('volcator.PERMISSION_APPLICATION_VIEW');

        $ROLE_APPLICATION_FULL                 = Config::get('volcator.ROLE_APPLICATION_FULL');
        $ROLE_APPLICATION_VIEW                 = Config::get('volcator.ROLE_APPLICATION_VIEW');

        $add_application_module = Volcators::create([
            'name' => 'Applications',
            'display_name' => 'applications_volcator',
            'permission_name' => json_encode([$PERMISSION_APPLICATION_FULL]),
            'menu_type' => 'hidden',
            'menu_icon' => 'fe fe-layers',
            'enable' => '1',
            'application' => 'main',
            'publish' => 'public'
        ]);

        $id_application_module = $add_application_module->id;
        $add_order = Volcators::where('id', '=', $id_application_module)->first();
        $add_order->order = $id_application_module;
        $add_order->update();

        /**
         * Begin Comment
         * Add Permissions Multi-Applications
         */
        $add_permission_application_view = Permission::create([
            'name' => $PERMISSION_APPLICATION_VIEW,
            'display_name' => 'Permission User Multi-Application',
            'description' => 'Permission user multi-applications, switch between his applications',
            'id_volcator' => $id_application_module
        ]);

        $add_permission_application_full = Permission::create([
            'name' => $PERMISSION_APPLICATION_FULL,
            'display_name' => 'Permission Manager Multi-Application',
            'description' => 'Permission Manager multi-applications, management multi-applications create, edit, delete...',
            'id_volcator' => $id_application_module
        ]);
        /**
         * End Comment
         * Add Permissions Multi-Applications
         */

        /**
         * Begin Comment
         * Add Roles Multi-Applications
         */
        $add_role_application_full = Role::create([
            'name' => $ROLE_APPLICATION_FULL,
            'display_name' => 'Role Manager Multi-Application',
            'description' => 'Role manager multi-applications, management multi-Applications create, edit, delete...',
            'type' => 'main'
        ]);

        $add_role_application_view = Role::create([
            'name' => $ROLE_APPLICATION_VIEW,
            'display_name' => 'Role User Multi-Application',
            'description' => 'Role user multi-applications, switch between his applications',
            'type' => 'main'
        ]);
        /**
         * End Comment
         * Add Roles Multi-Applications
         */

        /**
         * Begin Comment
         * Add Permissions To Roles Multi-Applications
         */
        DB::table("permission_role")->insert([
            'permission_id' => $add_permission_application_view->id,
            'role_id' => $add_role_application_view->id,
        ]);

        DB::table("permission_role")->insert([
            'permission_id' => $add_permission_application_full->id,
            'role_id' => $add_role_application_full->id,
        ]);
        /**
         * End Comment
         * Add Permissions To Roles Multi-Applications
         */

        /**
         * Begin Comment
         * Add Roles To Users Multi-Applications
         */
        $users_majestic = User::whereHas('roles', function($q) {
            $q->where('roles.name', Config::get('volcator.MAJESTIC'));
        })->pluck('id')->toArray();

        foreach ($users_majestic as $key => $user_id) {
            DB::table("role_user")->insert([
                'user_id' => $user_id,
                'role_id' => $add_role_application_full->id,
            ]);
            DB::table("role_user")->insert([
                'user_id' => $user_id,
                'role_id' => $add_role_application_view->id,
            ]);
        }
        /**
         * End Comment
         * Add Roles To Users Multi-Applications
         */

        /**
         * Begin Comment
         * Create Spaces and Applications TO Users MAJESTIC
         */
        foreach ($users_majestic as $key => $user_id) {
            $space = Spaces::create([
                'unique_identity' => uniqid(),
                'name' => VolcatorSpace::MAIN_SPACE_NAME,
                'owner_id' => $user_id,
                'type' => 'main',
                'enable' => 1,
                'image' => null,
            ]);
            $application = Applications::create([
                'name' => 'Main',
                'display_name' => 'Main Application',
                'unique_identity' => uniqid(),
                'type' => 'main',
                'space_id' => $space->id,
            ]);
            $application_attached = Volcators::where('application', 'main')->pluck('id')->toArray();
            $users_attached[] = (string) $user_id;
            $application->users()->attach($users_attached, ['space_id' => $space->id]);
            $application->volcators()->attach($application_attached, ['space_id' => $space->id]);
        }

        DB::table('role_user')->update(['application_id' => $application->id]);

        /**
         * End Comment
         * Create Spaces and Applications TO Users MAJESTIC
         */



        /**
         * Begin Comment
         * Add Permissions and Roles Manager Space & User Space
         */

        $add_volcator = Volcators::create([
            'name' => 'Volcators',
            'display_name' => 'volcator',
            'permission_name' => json_encode([$PERMISSION_SPACE_FULL, $PERMISSION_SPACE_VIEW]),
            'menu_type' => 'hidden',
            'menu_icon' => null,
            'enable' => '1',
            'application' => 'main',
            'publish' => 'public'
        ]);

        $last_id_volcator = $add_volcator->id;
        $insert_order_volcator = Volcators::where('id', '=', $last_id_volcator)->first();
        $insert_order_volcator->order = $last_id_volcator;
        $insert_order_volcator->update();

        $add_permissions_manager_space = Permission::create([
            'name' => $PERMISSION_SPACE_FULL,
            'id_volcator' => $add_volcator->id,
            'display_name' => 'Permission Manager Space',
            'description' => 'Permission manager spaces  (Create, Edit, Delete spaces)'
        ]);

        $add_permissions_user_space = Permission::create([
            'name' => $PERMISSION_SPACE_VIEW,
            'id_volcator' => $add_volcator->id,
            'display_name' => 'Permission User Space',
            'description' => 'Permission user spaces (Switch between spaces)'
        ]);

        $add_roles_manager_space = Role::create([
            'name' => $ROLE_MANAGER_SPACE,
            'display_name' => 'Role Manager Space',
            'description' => 'Manager Space, permissions to create spaces',
            'type' => 'main'
        ]);

        $add_roles_user_space = Role::create([
            'name' => $ROLE_USER_SPACE,
            'display_name' => 'Role User Space',
            'description' => 'User Space, permissions to create spaces',
            'type' => 'main'
        ]);


        $permissions_roles_manager_and_user_space = [
            [
                'permission_id' => $add_permissions_manager_space->id,
                'role_id' => $add_roles_manager_space->id
            ],
            [
                'permission_id' => $add_permissions_user_space->id,
                'role_id' => $add_roles_user_space->id
            ]
        ];

        foreach ($permissions_roles_manager_and_user_space as $key => $value) {
            DB::table("permission_role")->insert($value);
        }

        foreach ($users_majestic as $key => $user_id) {
            $roles_users_manager_and_user_space = [
                [
                    'user_id' => $user_id,
                    'role_id' => $add_roles_manager_space->id
                ],
                [
                    'user_id' => $user_id,
                    'role_id' => $add_roles_user_space->id
                ]
            ];

            foreach ($roles_users_manager_and_user_space as $value) {
                DB::table("role_user")->insert($value);
            }
        }

        /**
         * End Comment
         * Add Permissions and Roles Manager Space & User Space
         */

    }
}
