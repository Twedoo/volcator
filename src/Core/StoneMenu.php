<?php

namespace Twedoo\Stone\Core;

use App;
use Twedoo\Stone\Models\Menuback;
use Twedoo\Stone\Organizer\Models\Stones;
use Config;
use DB;
use StoneEngine;

class StoneMenu
{
    /**
     * @param $packageviews
     * @param array $data
     * @return string
     * Usage Forms::Input() $input_name=[], $css=[], $type
     */
    public static function FormModules($packageviews, $data = [])
    {
        return view('elements.forms.formmodules', compact('packageviews'))
            ->with($data)
            ->render();
    }

    /**
     * @return array
     * Usage return list menu of modules left side backoffice
     */
    public static function getMenuModule()
    {
        $getCategoriesMenu = [];
        $ModuleList = Stones::where('enable', 1)->get();

        foreach ($ModuleList as $key => $value) {
            if ($value->menu_type == "hidden") {
                continue;
            }
            $setCategory = StoneEngine::getAttributes($value['name'], 'categoryMenu');
            if ($value->application == "main")
                $setCategory = 'standard_menu';

            $getCategoriesMenu[$setCategory][] = $value;
        }

        return $getCategoriesMenu;
    }

    /**
     * @return mixed
     * Usage return list sub-menu of modules left side backoffice
     */
    public static function getSubMenuModule()
    {
        return Menuback::get();
    }

    /**
     * @param $id_stone
     * @return mixed
     * Usage return list sub-menu of modules left side backoffice
     */
    public static function hasPermissionsMenu($permissions_menu)
    {
        $hasRole = false;
        $user = auth()->user();
        foreach ($permissions_menu as $permission) {
            if ($user->can($permission)) {
                $hasRole = true;
                break;
            }
        }
        return $hasRole;
    }
}
