<?php
namespace Twedoo\Stone\database\seeders;

use Twedoo\Stone\InstallerModule\Models\modules;
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
                'value' => 'default'
            ],
            [
                'name' => 'TW_APP_TEMPLATE_FRONT',
                'value' => 'default'
            ],
            [
                'name' => 'TW_APP_PREFIX',
                'value' => 'atw'
            ],
            [
                'name' => 'TW_APP_MODULE',
                'value' => 'module+'
            ]
        ];

        foreach ($default_parameters_app as $key => $value) {
            Parameters::create($value);
        }

        // seed Module Installer
        $DefaultModule = [

            [
                'im_name_modules' => 'InstallModules',
                'im_name_modules_display' => 'tmod_mod',
                'im_menu_icon' => '<i class="main-icon fa fa-cubes"></i>',
                'im_permission' => 'role-access-modules',
                'im_status' => '1'
            ]
        ];

        foreach ($DefaultModule as $key => $value) {
            $insert = modules::create($value);
        }

        $last_id = $insert->im_id;
        $insertOrder = modules::where('im_id', '=', $last_id)->first();
        $insertOrder->im_order = $last_id;
        $insertOrder->update();

        $menumodules = [
            [
                'name_menu' => "menuinstall_module",
                'route_link' => "install/modules",
                'id_module' => $last_id,
                'mb_permission' => 'role-access-modules',
            ]
        ];

        foreach ($menumodules as $key => $value) {
            Menuback::create($value);
        }

        $permission = [
            [
                'name' => 'role-access-modules',
                'id_module' => $last_id,
                'display_name' => 'Module install module',
                'description' => 'Managment install modules'
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
                'im_menu_icon' => '<i class="main-icon fa fa-shield"></i>',
                'im_permission' => 'role-access-controle',
                'im_status' => '1'
            ]
        ];

        foreach ($default_module_acl as $key => $value) {
            $insertACL = modules::create($value);
        }

        $id_last_acl = $insertACL->im_id;
        $insertOrderACL = modules::where('im_id', '=', $id_last_acl)->first();
        $insertOrderACL->im_order = $id_last_acl;
        $insertOrderACL->update();

        $menumodulesACL = [
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

        foreach ($menumodulesACL as $key => $value) {
            Menuback::create($value);
        }

        $permission = [
            [
                'name' => 'role-access-controle',
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
            ],
            [
                'name' => 'permissions-applications',
                'id_module' => $id_last_acl,
                'display_name' => 'Applications Full',
                'description' => 'Add, edit and delete applications'
            ],
            [
                'name' => 'permissions-applications-create',
                'id_module' => $id_last_acl,
                'display_name' => 'Applications create',
                'description' => 'create applications'
            ],
            [
                'name' => 'permissions-applications-view',
                'id_module' => $id_last_acl,
                'display_name' => 'Applications view',
                'description' => 'view applications'
            ],
            [
                'name' => 'permissions-applications-delete',
                'id_module' => $id_last_acl,
                'display_name' => 'Applications delete',
                'description' => 'delete applications'
            ]
        ];


        foreach ($permission as $key => $value) {
            Permission::create($value);
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
                'statut' => '0',
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
                'display_name' => 'Administrator',
                'description' => 'Full permission, System Administrator'
            ]
        ];


        foreach ($roles as $key => $value) {
            Role::create($value);
        }

        $permissionsroles = [
            [
                'permission_id' => '1',
                'role_id' => '1'
            ],
            [
                'permission_id' => '2',
                'role_id' => '1'
            ],
            [
                'permission_id' => '3',
                'role_id' => '1'
            ],
            [
                'permission_id' => '4',
                'role_id' => '1'
            ],
            [
                'permission_id' => '5',
                'role_id' => '1'
            ],
            [
                'permission_id' => '6',
                'role_id' => '1'
            ],
            [
                'permission_id' => '7',
                'role_id' => '1'
            ],
            [
                'permission_id' => '8',
                'role_id' => '1'
            ],
            [
                'permission_id' => '9',
                'role_id' => '1'
            ]

        ];

        foreach ($permissionsroles as $key => $value) {
            DB::table("permission_role")->insert($value);
        }

        $rolesusers = [
            [
                'user_id' => '1',
                'role_id' => '1'
            ]
        ];

        foreach ($rolesusers as $key => $value) {
            DB::table("role_user")->insert($value);
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
        //end Languages globals
    }
}
