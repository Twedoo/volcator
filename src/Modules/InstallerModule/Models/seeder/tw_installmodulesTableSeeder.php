<?php

use App\Menuback;
use App\Modules\InstallerModule\Models\modules;
use Illuminate\Database\Seeder;


class tw_InstallerModuleTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // seeder modules default with menu to table
        $Moduledefault = [
            [
                'im_name_modules' => 'InstallerModule',
                'im_name_modules_display' => 'tmod_mod',
                'im_menu_icon' => '<i class="main-icon fa fa-cubes"></i>',
                'im_permission' => 'role-access-modules'
            ]
        ];

        foreach ($Moduledefault as $key => $value) {
            $insert = modules::create($value);
        }

        $idlast = $insert->id;
        $insertOrder = modules::where('id', '=', $idlast)->first();
        $insertOrder->order = $idlast;
        $insertOrder->update();

        $menumodules = [
            [
                'name_menu' => "menuinstall_module",
                'route_link' => "install/modules",
                'id_module' => $idlast,
            ]
        ];

        foreach ($menumodules as $key => $value) {
            Menuback::create($value);
        }

    }

}
