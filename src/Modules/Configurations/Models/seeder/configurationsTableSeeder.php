<?php
namespace Twedoo\Stone\Modules\Configurations\Models\seeder;

use Twedoo\Stone\Models\Menuback;
use Twedoo\Stone\Modules\Configurations\Models\confsettings;
use Twedoo\Stone\InstallerModule\Models\modules;
use Twedoo\StoneGuard\Models\Permission;
use Illuminate\Database\Seeder;
use DB;

class configurationsTableSeeder extends Seeder

{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $installmodulesok = [
            [
                'im_name_modules' => 'Configurations',
                'im_name_modules_display' => 'tmod_conf',
                'im_menu_icon' => '<i class="main-icon fa fa-gears"></i>',
                'im_permission' => 'role-access-configuration',
                'im_status' => '1'
            ]
        ];

        foreach ($installmodulesok as $key => $value) {
            $insert = modules::create($value);
        }

        $idlast = $insert->im_id;

        $insertOrder = modules::where('im_id', '=', $idlast)->first();

        $insertOrder->im_order = $idlast;

        $insertOrder->update();

        $menumodules = [
            [
                'name_menu' => "menugenerale_settings",
                'route_link' => "settings",
                'id_module' => $idlast,
                'mb_permission' => 'role-access-settings',
            ],
            [
                'name_menu' => "menugenerale_language",
                'route_link' => "languages",
                'id_module' => $idlast,
                'mb_permission' => 'role-access-languages',
            ],
            [
                'name_menu' => "menugenerale_templates",
                'route_link' => "templates",
                'id_module' => $idlast,
                'mb_permission' => 'role-access-templates',
            ]
        ];


        foreach ($menumodules as $key => $value) {
            Menuback::create($value);
        }

        // permission languages
        $permission = [
            [
                'name' => 'role-access-languages',
                'display_name' => 'Access Langugaes ',
                'description' => 'Permission managment languages',
                'id_module' => $idlast
            ],
            [
                'name' => 'role-access-templates',
                'display_name' => 'Access Templates ',
                'description' => 'Permission managment templates',
                'id_module' => $idlast
            ],
            [
                'name' => 'role-access-settings',
                'display_name' => 'Access Settings ',
                'description' => 'Permission managment settings',
                'id_module' => $idlast
            ],
            [
                'name' => 'role-access-configuration',
                'display_name' => 'Module configuration',
                'description' => 'Managment settings, languages and templates of CMS',
                'id_module' => $idlast
            ]
        ];

        foreach ($permission as $key => $value) {
            $setPermission = Permission::create($value);
            DB::table("permission_role")->insert([
                'permission_id' => $setPermission->id,
                'role_id' => '1'
            ]);
        }
        // end permission languages


        // all settings website "confsettings"

        $confsettings = [
            [
                'sitename' => "sitename",
                'keyword' => "keyword",
                'descriptionweb' => "descriptionweb",
                'logo' => "",
                'languages' => "",
                'email' => "",
                'maintenanceweb' => "",
                'msgmaintenance' => "msgmaintenance",
            ]


        ];

        foreach ($confsettings as $key => $value) {
            confsettings::create($value);
        }
        // settings website "confsettings"

    }

}
