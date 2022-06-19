<?php
namespace Twedoo\Stone\database\seeders;

use Twedoo\Stone\Modules\Applications\Models\seeder\applicationsTableSeeder;
use Twedoo\Stone\Organizer\Models\Stones;
use Illuminate\Database\Seeder;
use Twedoo\Stone\Models\Parameters;
use Twedoo\Stone\Models\Languages;
use Twedoo\Stone\Models\Menuback;
use Twedoo\StoneGuard\Models\Permission;
use Twedoo\StoneGuard\Models\Role;
use App\Models\User;
use DB;
use Config;

class StoneTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permissions name constants
         */
        $MAJESTIC                              = Config::get('stone.MAJESTIC');
        $PERMISSION_MAJESTIC_STONE             = Config::get('stone.PERMISSION_MAJESTIC_STONE');
        $PERMISSION_MANAGER_ORGANIZER_FULL     = Config::get('stone.PERMISSION_MANAGER_ORGANIZER_FULL');
        $PERMISSION_USER_ACCESS_CONTROL        = Config::get('stone.PERMISSION_USER_ACCESS_CONTROL');
        $PERMISSION_ROLE_ACCESS_CONTROL        = Config::get('stone.PERMISSION_ROLE_ACCESS_CONTROL');
        $PERMISSION_PERMISSION_ACCESS_CONTROL  = Config::get('stone.PERMISSION_PERMISSION_ACCESS_CONTROL');
        $PERMISSION_SPACE_FULL                 = Config::get('stone.PERMISSION_SPACE_FULL');
        $PERMISSION_SPACE_VIEW                 = Config::get('stone.PERMISSION_SPACE_VIEW');

        /**
         * Roles name constants
         */
        $ROLE_MANAGER_SPACE                    = Config::get('stone.ROLE_MANAGER_SPACE');
        $ROLE_USER_SPACE                       = Config::get('stone.ROLE_USER_SPACE');
        $ROLE_MANAGER_ORGANIZER_FULL           = Config::get('stone.ROLE_MANAGER_ORGANIZER_FULL');
        $ROLE_ACCESS_CONTROL_FULL              = Config::get('stone.ROLE_ACCESS_CONTROL_FULL');

        /**
         * Begin Comment
         * Add parameters Stone
         */
        $default_parameters_app = [
            [
                'name' => 'TW_APP_TEMPLATE_BACK',
                'value' => 'stone',
                'application' => 'main'
            ],
            [
                'name' => 'TW_APP_TEMPLATE_FRONT',
                'value' => 'bluestone',
                'application' => 'main'
            ],
            [
                'name' => 'TW_APP_PREFIX',
                'value' => 'atw',
                'application' => 'main'
            ],
            [
                'name' => 'TW_APP_MODULE',
                'value' => 'module+',
                'application' => 'main'
            ]
        ];

        foreach ($default_parameters_app as $key => $value) {
            Parameters::create($value);
        }
        /**
         * End Comment
         * Add parameters Stone
         */

        /**
         * Begin Comment
         * Add Administrator
         */
        $users = [
            [
                'code' => time(),
                'name' => 'Administrator',
                'email' => 'admin@mail.com',
                'password' => '$2y$10$TcrbiAk0sonoDHCuZGnHluiNzsw7uF9cr5E.hWqGK7bP31dWVTikW',
                'date' => '',
                'genre' => '',
                'avatar' => '',
                'status' => '1',
                'type' => 'back'
            ]
        ];

        foreach ($users as $key => $value) {
            $add_users = User::create($value);
        }
        /**
         * End Comment
         * Add Administrator
         */

        /**
         * Begin Comment
         * Add Permission and role majestic
         */
        $add_permission_majestic = Permission::create([
            'name' => $PERMISSION_MAJESTIC_STONE ,
            'id_stone' => "FULL",
            'display_name' => 'Permission Majestic Manager Stone',
            'description' => 'Super administrator of all stone'
        ]);

        $add_roles_majestic = Role::create([
            'name' => $MAJESTIC,
            'display_name' => 'Majestic',
            'description' => 'Full permission, System Administrator'
        ]);

        DB::table("permission_role")->insert([
            'permission_id' => $add_permission_majestic->id,
            'role_id' => $add_roles_majestic->id,
        ]);
        DB::table("role_user")->insert([
            'user_id' => $add_users->id,
            'role_id' => $add_roles_majestic->id,
        ]);
        /**
         * End Comment
         * Add Permission and role majestic
         */

        /**
         * Begin Comment
         * Add Module Organizer
         */

        $add_organizer = Stones::create([
            'name' => 'Organizer',
            'display_name' => 'organizer_stone',
            'permission_name' => json_encode([$PERMISSION_MANAGER_ORGANIZER_FULL]),
            'menu_type' => null,
            'menu_icon' => 'fe fe-box',
            'enable' => '1',
            'application' => 'main',
            'publish' => 'public'
        ]);
        $last_id = $add_organizer->id;
        $insertOrder = Stones::where('id', '=', $last_id)->first();
        $insertOrder->order = $last_id;
        $insertOrder->update();

        $add_stone = Stones::create([
            'name' => 'Stones',
            'display_name' => 'stone',
            'permission_name' => json_encode([$PERMISSION_SPACE_FULL, $PERMISSION_SPACE_VIEW]),
            'menu_type' => 'hidden',
            'menu_icon' => null,
            'enable' => '1',
            'application' => 'main',
            'publish' => 'public'
        ]);

        $last_id_stone = $add_stone->id;
        $insert_order_stone = Stones::where('id', '=', $last_id_stone)->first();
        $insert_order_stone->order = $last_id_stone;
        $insert_order_stone->update();


        $menu_module_organizer = [
            [
                'name_menu' => "organizer_menu",
                'route_link' => "organizer/modules",
                'id_stone' => $last_id,
                'mb_permission' => $PERMISSION_MANAGER_ORGANIZER_FULL,
            ]
        ];

        foreach ($menu_module_organizer as $key => $value) {
            Menuback::create($value);
        }
        /**
         * End Comment
         * Add Module Organizer
         */

        /**
         * Begin Comment
         * Add Module Access Controls
         */
        $module_access_control = [
            [
                'name' => 'Access-Controls',
                'display_name' => 'access_controls_stone',
                'permission_name' => json_encode([$PERMISSION_USER_ACCESS_CONTROL, $PERMISSION_ROLE_ACCESS_CONTROL, $PERMISSION_PERMISSION_ACCESS_CONTROL]),
                'menu_type' => 'core',
                'menu_icon' => 'fe fe-shield',
                'enable' => '1',
                'application' => 'main',
                'publish' => 'public'
            ]
        ];

        foreach ($module_access_control as $key => $value) {
            $add_module_access_control = Stones::create($value);
        }

        $id_last_module_access_control = $add_module_access_control->id;
        $order_module_access_control = Stones::where('id', '=', $id_last_module_access_control)->first();
        $order_module_access_control->order = $id_last_module_access_control;
        $order_module_access_control->update();

        $menu_modules_acl = [
            [
                'name_menu' => "access_controls_users",
                'route_link' => "users",
                'id_stone' => $id_last_module_access_control,
                'mb_permission' => $PERMISSION_USER_ACCESS_CONTROL,

            ],
            [
                'name_menu' => "access_controls_roles",
                'route_link' => "roles",
                'id_stone' => $id_last_module_access_control,
                'mb_permission' => $PERMISSION_ROLE_ACCESS_CONTROL,

            ],
            [
                'name_menu' => "access_controls_permissions",
                'route_link' => "permissions",
                'id_stone' => $id_last_module_access_control,
                'mb_permission' => $PERMISSION_PERMISSION_ACCESS_CONTROL,

            ]
        ];

        foreach ($menu_modules_acl as $key => $value) {
            Menuback::create($value);
        }
        /**
         * End Comment
         * Add Module Access Controls
         */


        /**
         * Begin Comment
         * Add Permissions and Roles Manager Space & User Space
         */
        $add_permissions_manager_space = Permission::create([
            'name' => $PERMISSION_SPACE_FULL,
            'id_stone' => $add_stone->id,
            'display_name' => 'Permission Manager Space',
            'description' => 'Permission manager spaces  (Create, Edit, Delete spaces)'
        ]);

        $add_permissions_user_space = Permission::create([
            'name' => $PERMISSION_SPACE_VIEW,
            'id_stone' => $add_stone->id,
            'display_name' => 'Permission User Space',
            'description' => 'Permission user spaces (Switch between spaces)'
        ]);

        $add_roles_manager_space = Role::create([
            'name' => $ROLE_MANAGER_SPACE,
            'display_name' => 'Role Manager Space',
            'description' => 'Manager Space, permissions to create spaces'
        ]);

        $add_roles_user_space = Role::create([
            'name' => $ROLE_USER_SPACE,
            'display_name' => 'Role User Space',
            'description' => 'User Space, permissions to create spaces'
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

        $roles_users_manager_and_user_space = [
            [
                'user_id' => $add_users->id,
                'role_id' => $add_roles_manager_space->id
            ],
            [
                'user_id' => $add_users->id,
                'role_id' => $add_roles_user_space->id
            ]
        ];

        foreach ($roles_users_manager_and_user_space as $key => $value) {
            DB::table("role_user")->insert($value);
        }
        /**
         * End Comment
         * Add Permissions and Roles Manager Space & User Space
         */

        /**
         * Begin Comment
         * Add Permissions and Roles Organizer
         */
        $add_permission_manager_organizer = Permission::create([
            'name' => $PERMISSION_MANAGER_ORGANIZER_FULL,
            'id_stone' => $add_organizer->id,
            'display_name' => 'Permission Organizer Stones',
            'description' => 'Permission organizer stones, Management stones install, uninstall, delete...'
        ]);

        $add_role_organizer = Role::create([
            'name' => $ROLE_MANAGER_ORGANIZER_FULL,
            'display_name' => 'Role Organizer Stones',
            'description' => 'Role Organizer, Management stones install, uninstall, delete...'
        ]);

        DB::table("permission_role")->insert([
            'permission_id' => $add_permission_manager_organizer->id,
            'role_id' => $add_role_organizer->id
        ]);

        $role_access_controls = Role::create([
            'name' => $ROLE_ACCESS_CONTROL_FULL,
            'display_name' => 'Role access control',
            'description' => 'Role access control'
        ]);

        $roles_users = [
            [
                'user_id' => $add_users->id,
                'role_id' => $add_role_organizer->id
            ],
            [
                'user_id' => $add_users->id,
                'role_id' => $role_access_controls->id
            ]
        ];

        foreach ($roles_users as $key => $value) {
            DB::table("role_user")->insert($value);
        }
        /**
         * End Comment
         * Add Permissions and Roles Organizer
         */

        /**
         * Begin Comment
         * Add Permissions and Roles Access Controls
         */
        $permission_user_access_controls = Permission::create([
            'name' => $PERMISSION_USER_ACCESS_CONTROL,
            'id_stone' => $id_last_module_access_control,
            'display_name' => 'Permission Users Access Control',
            'description' => 'Permission users access control, management users create, edit, delete...'
        ]);

         $permission_role_access_controls = Permission::create([
             'name' => $PERMISSION_ROLE_ACCESS_CONTROL,
             'id_stone' => $id_last_module_access_control,
             'display_name' => 'Permission Roles Access Control',
             'description' => 'Permission roles access control, management roles create, edit, delete...'
         ]);


         $permission_permission_access_controls = Permission::create([
             'name' => $PERMISSION_PERMISSION_ACCESS_CONTROL,
             'id_stone' => $id_last_module_access_control,
             'display_name' => 'Permission Permissions Access Control',
             'description' => 'Permission permissions access control, management permissions create, edit, delete...'
         ]);


        $permissions_roles_access_control = [
            [
                'permission_id' => $permission_user_access_controls->id,
                'role_id' => $role_access_controls->id
            ],
            [
                'permission_id' => $permission_role_access_controls->id,
                'role_id' => $role_access_controls->id
            ],
            [
                'permission_id' => $permission_permission_access_controls->id,
                'role_id' => $role_access_controls->id
            ]
        ];

        foreach ($permissions_roles_access_control as $key => $value) {
            DB::table("permission_role")->insert($value);
        }
        /**
         * End Comment
         * Add Permissions and Roles Access Controls
         */

        /**
         * Begin Comment
         * Add Translate Languages
         */
        $languages = [

            [
                'languages' => "English",
                'code_lang' => "en",
            ],
            [
                'languages' => "العربية",
                'code_lang' => "ar",
            ],
            [
                'languages' => "Deutsche",
                'code_lang' => "de",
            ],
            [
                'languages' => "Français",
                'code_lang' => "fr",
            ],
            [
                'languages' => "Italiano",
                'code_lang' => "it",
            ],
            [
                'languages' => "Español",
                'code_lang' => "es",
            ],
            [
                'languages' => "Русский",
                'code_lang' => "ru",
            ],
            [
                'languages' => "中文(简体)",
                'code_lang' => "cn",
            ],
            [
                'languages' => "日本語",
                'code_lang' => "ja",
            ],
            [
                'languages' => "Português",
                'code_lang' => "pt",
            ],
            [
                'languages' => "Türkçe",
                'code_lang' => "tr",
            ],
            [
                'languages' => "हिन्दी",
                'code_lang' => "in",
            ],
            [
                'languages' => "Bahasa Indonesia",
                'code_lang' => "id",
            ],
            [
                'languages' => "বাংলা",
                'code_lang' => "bn",
            ],
            [
                'languages' => "‏فارسی‏",
                'code_lang' => "fa",
            ],
            [
                'languages' => "Українська",
                'code_lang' => "uk",
            ],
            [
                'languages' => "‏اردو‏",
                'code_lang' => "ur",
            ],
            [
                'languages' => "Tiếng Việt",
                'code_lang' => "vi",
            ],
            [
                'languages' => "Svenska",
                'code_lang' => "sv",
            ],
            [
                'languages' => "‏עברית‏",
                'code_lang' => "il",
            ]
        ];

        foreach ($languages as $key => $value) {
            Languages::create($value);
        }
        /**
         * End Comment
         * Add Translate Languages
         */

        /**
         * Begin Comment
         * Load Seeder Create Space and Application
         */
        $seederApplication = new applicationsTableSeeder();
        $seederApplication->run();
        /**
         * End Comment
         * Load Seeder Create Space and Application
         */
    }
}
