<?php
namespace Twedoo\Stone\Modules\Cms\Models\seeder;

use Twedoo\Stone\InstallerModule\Models\modules;
use Twedoo\Stone\Models\Menuback;
use Illuminate\Database\Seeder;
use Twedoo\StoneGuard\Models\Permission;
use DB;

class cmsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $setModule = [
            [
                'im_name_modules' => 'Cms',
                'im_name_modules_display' => 'cms_module',
                'im_menu_icon' => '<i class="main-icon fa fa-list-alt"></i>',
                'im_permission' => 'role-access-cms',
                'im_status' => '1'
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
                'name_menu' => "cms_pages",
                'route_link' => "cms-pages",
                'id_module' => $idModule,
                'mb_permission' => 'role-access-cms-pages',
            ],
            [
                'name_menu' => "cms_templates",
                'route_link' => "cms-templates",
                'id_module' => $idModule,
                'mb_permission' => 'role-access-cms-templates',
            ]
        ];

        foreach ($setMenus as $key => $value) {
            Menuback::create($value);
        }

        // permission cms
        $permission = [
            [
                'name' => 'role-access-cms',
                'display_name' => 'Module Cms ',
                'description' => 'Permission managment cms',
                'id_module' => $idModule
            ],
            [
                'name' => 'role-access-cms-pages',
                'display_name' => 'Access pages cms',
                'description' => 'Permission managment pages',
                'id_module' => $idModule
            ],
            [
                'name' => 'role-access-cms-templates',
                'display_name' => 'Access Templates cms',
                'description' => 'Permission managment templates',
                'id_module' => $idModule
            ]
        ];

        foreach ($permission as $key => $value) {
            $setPermission = Permission::create($value);
            DB::table("permission_role")->insert([
                'permission_id' => $setPermission->id,
                'role_id' => '1'
            ]);
        }
        // end permission cms

    }

}
