<?php
namespace Twedoo\Stone\Modules\Applications\Models\seeder;

use Twedoo\Stone\InstallerModule\Models\modules;
use Illuminate\Database\Seeder;
use Twedoo\Stone\Models\Menuback;
use Twedoo\StoneGuard\Models\Permission;
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
                'name_menu' => "managment_apps",
                'route_link' => "applications",
                'id_module' => $idModule,
                'mb_permission' => 'permissions-applications-view',
            ]
        ];

        foreach ($setMenus as $key => $value) {
            Menuback::create($value);
        }

        // permission cms
        $permission = [
            [
                'name' => 'permissions-applications-view',
                'display_name' => 'View Multi-Applications',
                'description' => 'Permission managment Applications for users',
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

        foreach ($permission as $key => $value) {
            $setPermission = Permission::create($value);
            DB::table("permission_role")->insert([
                'permission_id' => $setPermission->id,
                'role_id' => auth()->user()->setCurrentIdRole()
            ]);
        }
        // end permission cms
    }

}
