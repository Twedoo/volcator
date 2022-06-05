<?php
namespace Twedoo\Stone\database\seeders;

use Twedoo\Stone\Modules\Applications\Models\seeder\applicationsTableSeeder;
use Twedoo\Stone\Organizer\Models\modules;
use Illuminate\Database\Seeder;
use Twedoo\Stone\Models\Parameters;
use Twedoo\Stone\Models\Languages;
use Twedoo\Stone\Models\Menuback;
use Twedoo\StoneGuard\Models\Permission;
use Twedoo\StoneGuard\Models\Role;
use App\Models\User;
use DB;

class StoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert parameters global
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

        // seed Module Installer
        $default_module = [

            [
                'im_name_modules' => 'Organizer',
                'im_name_modules_display' => 'tmod_mod',
                'im_menu_icon' => 'fe fe-box',
                'im_permission' => 'role-organizer-stones',
                'im_status' => '1',
                'application' => 'main'
            ]
        ];

        foreach ($default_module as $key => $value) {
            $insert = modules::create($value);
        }

        $last_id = $insert->im_id;
        $insertOrder = modules::where('im_id', '=', $last_id)->first();
        $insertOrder->im_order = $last_id;
        $insertOrder->update();

        $menu_modules = [
            [
                'name_menu' => "menuinstall_module",
                'route_link' => "organizer/modules",
                'id_module' => $last_id,
                'mb_permission' => 'role-organizer-stones',
            ]
        ];

        foreach ($menu_modules as $key => $value) {
            Menuback::create($value);
        }

        $permission = [
            [
                'name' => 'role-majestic-stone',
                'id_module' => null,
                'display_name' => 'Majestic manager stone',
                'description' => 'Super administrator of all stone'
            ]
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }

        // seed Module Installer
        // seeder modules access controller
        $default_module_acl = [
            [
                'im_name_modules' => 'ManagmentACL',
                'im_name_modules_display' => 'acl_mod',
                'im_menu_icon' => 'fe fe-shield',
                'im_permission' => 'role-access-control',
                'im_status' => '1',
                'application' => 'main'
            ]
        ];

        foreach ($default_module_acl as $key => $value) {
            $insertACL = modules::create($value);
        }

        $id_last_acl = $insertACL->im_id;
        $insertOrderACL = modules::where('im_id', '=', $id_last_acl)->first();
        $insertOrderACL->im_order = $id_last_acl;
        $insertOrderACL->update();

        $menu_modules_acl = [
            [
                'name_menu' => "managment_acl_users",
                'route_link' => "users",
                'id_module' => $id_last_acl,
                'mb_permission' => 'users-access',

            ],
            [
                'name_menu' => "managment_acl_roles",
                'route_link' => "roles",
                'id_module' => $id_last_acl,
                'mb_permission' => 'roles-access',

            ],
            [
                'name_menu' => "managment_acl_permissions",
                'route_link' => "permissions",
                'id_module' => $id_last_acl,
                'mb_permission' => 'permissions-access',

            ]
        ];

        foreach ($menu_modules_acl as $key => $value) {
            Menuback::create($value);
        }

        // seeder modules access controller
        // seeder users to table
        $Users = [
            [
                'code' => time(),
                'name' => 'Administrator',
                'email' => 'admin@mail.com',
                'password' => '$2y$10$TcrbiAk0sonoDHCuZGnHluiNzsw7uF9cr5E.hWqGK7bP31dWVTikW',
                'date' => '',
                'genre' => '',
                'avatar' => '',
                'status' => '0',
                'type' => 'back'
            ]
        ];


        foreach ($Users as $key => $value) {
            User::create($value);
        }
        // end seeder users to table
        // seeder roles and roles permission users to table
        $roles = [
            [
                'name' => 'Root',
                'display_name' => 'Majestic',
                'description' => 'Full permission, System Administrator'
            ],
            [
                'name' => 'Access-control-users',
                'display_name' => 'Access control users',
                'description' => 'Access control, management users'
            ],
            [
                'name' => 'Role-organizer-stones',
                'display_name' => 'Organizer manager Stones',
                'description' => 'Full permission Organizer, Management install Stones (modules)'
            ]
        ];

        foreach ($roles as $key => $value) {
            Role::create($value);
        }

        $roles_users = [
            [
                'user_id' => '1',
                'role_id' => '1'
            ],
            [
                'user_id' => '1',
                'role_id' => '2'
            ],
            [
                'user_id' => '1',
                'role_id' => '3'
            ]
        ];

        foreach ($roles_users as $key => $value) {
            DB::table("role_user")->insert($value);
        }

        $permission_sroles = [
            [
                'permission_id' => '1',
                'role_id' => '1'
            ]
        ];

        foreach ($permission_sroles as $key => $value) {
            DB::table("permission_role")->insert($value);
        }

        // Insert permissions access control user
        $permission_access_control = [
            [
                'name' => 'role-access-control',
                'id_module' => $id_last_acl,
                'display_name' => 'Module Access',
                'description' => 'Managment users, roles and permissions of cms'
            ],
            [
                'name' => 'users-access',
                'id_module' => $id_last_acl,
                'display_name' => 'Managment Users',
                'description' => 'Add, edit and delete users of CMS'
            ],
            [
                'name' => 'roles-access',
                'id_module' => $id_last_acl,
                'display_name' => 'Managment Roles',
                'description' => 'Add, edit and delete roles of CMS'
            ],
            [
                'name' => 'permissions-access',
                'id_module' => $id_last_acl,
                'display_name' => 'Managment Permissions',
                'description' => 'Add, edit and delete permissions of CMS'
            ]
        ];

        foreach ($permission_access_control as $key => $value) {
            Permission::create($value);
        }

        $permissions_roles_access_control = [
            [
                'permission_id' => '2',
                'role_id' => '2'
            ],
            [
                'permission_id' => '3',
                'role_id' => '2'
            ],
            [
                'permission_id' => '4',
                'role_id' => '2'
            ],
            [
                'permission_id' => '5',
                'role_id' => '2'
            ]
        ];

        foreach ($permissions_roles_access_control as $key => $value) {
            DB::table("permission_role")->insert($value);
        }

        // insert permissions access Organize installer

        $permission_organizer = [
            [
                'name' => 'role-organizer-stones',
                'id_module' => $last_id,
                'display_name' => 'Organizer manager Stones',
                'description' => 'Full permission Organizer, Management install Stones (modules)'
            ]
        ];

        foreach ($permission_organizer as $key => $value) {
            Permission::create($value);
        }

        $permissions_roles_organizer = [
            [
                'permission_id' => '6',
                'role_id' => '3'
            ]
        ];

        foreach ($permissions_roles_organizer as $key => $value) {
            DB::table("permission_role")->insert($value);
        }

        // end seeder roles and roles permission users to table
        //languages globals name

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

        $seederApplication = new applicationsTableSeeder();
        $seederApplication->run();
        //end Languages globals
    }
}
