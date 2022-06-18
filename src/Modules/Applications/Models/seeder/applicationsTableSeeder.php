<?php
namespace Twedoo\Stone\Modules\Applications\Models\seeder;

use Twedoo\Stone\Modules\Applications\Models\Applications;
use Twedoo\Stone\Modules\Applications\Models\Spaces;
use Twedoo\Stone\Organizer\Models\Stones;
use Illuminate\Database\Seeder;
use Twedoo\Stone\Models\Menuback;
use Twedoo\StoneGuard\Models\Permission;
use Twedoo\StoneGuard\Models\Role;
use Twedoo\StoneGuard\Models\User;
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
        $PERMISSION_SPACE_FULL                 = Config::get('stone.PERMISSION_SPACE_FULL');
        $PERMISSION_SPACE_VIEW                 = Config::get('stone.PERMISSION_SPACE_VIEW');

        $PERMISSION_APPLICATION_FULL           = Config::get('stone.PERMISSION_APPLICATION_FULL');
        $PERMISSION_APPLICATION_VIEW           = Config::get('stone.PERMISSION_APPLICATION_VIEW');

        $ROLE_APPLICATION_FULL                 = Config::get('stone.ROLE_APPLICATION_FULL');
        $ROLE_APPLICATION_VIEW                 = Config::get('stone.ROLE_APPLICATION_VIEW');

        Stones::create([
            'name' => 'Stones',
            'display_name' => 'stone',
            'permission_name' => json_encode([$PERMISSION_SPACE_FULL, $PERMISSION_SPACE_VIEW]),
            'menu_type' => 'hidden',
            'menu_icon' => null,
            'enable' => '1',
            'application' => 'main'
        ]);

        $add_application_module = Stones::create([
            'name' => 'Applications',
            'display_name' => 'applications_stone',
            'permission_name' => json_encode([$PERMISSION_APPLICATION_FULL]),
            'menu_type' => 'hidden-organizer',
            'menu_icon' => 'fe fe-layers',
            'enable' => '1',
            'application' => 'main'
        ]);

        $id_application_module = $add_application_module->id;
        $add_order = Stones::where('id', '=', $id_application_module)->first();
        $add_order->order = $id_application_module;
        $add_order->update();

        Menuback::create([
            'name_menu' => "multi_applications_menu",
            'route_link' => "applications",
            'id_stone' => $id_application_module,
            'mb_permission' => $PERMISSION_APPLICATION_FULL,
        ]);

        /**
         * Begin Comment
         * Add Permissions Multi-Applications
         */
        $add_permission_application_view = Permission::create([
            'name' => $PERMISSION_APPLICATION_VIEW,
            'display_name' => 'View Applications',
            'description' => 'Permission let user switch between his application',
            'id_stone' => $id_application_module
        ]);

        $add_permission_application_full = Permission::create([
            'name' => $PERMISSION_APPLICATION_FULL,
            'display_name' => 'Create and Delete Multi-Applications',
            'description' => 'Users can manipulate Multi-Applications',
            'id_stone' => $id_application_module
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
            'display_name' => 'Manager Multi-Application',
            'description' => 'Manager Multi-Application, permissions to create his owner Applications'
        ]);

        $add_role_application_view = Role::create([
            'name' => $ROLE_APPLICATION_VIEW,
            'display_name' => 'View Applications',
            'description' => 'View Applications, user switch between his applications'
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
            $q->where('roles.name', Config::get('stone.MAJESTIC'));
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
                'name' => 'Main Workspace',
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
            $application_attached = Stones::where('application', 'main')->pluck('id')->toArray();
            $users_attached[] = (string) $user_id;
            $application->users()->attach($users_attached);
            $application->stones()->attach($application_attached);
        }
        /**
         * End Comment
         * Create Spaces and Applications TO Users MAJESTIC
         */
    }
}
