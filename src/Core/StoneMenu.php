<?php

namespace Twedoo\Stone\Core;

use App;
use Twedoo\Stone\Models\Menuback;
use Twedoo\Stone\Organizer\Models\modules;
use Config;
use DB;
use StoneEngine;

class StoneMenu
{
    //Forms::Input() $input_name=[], $css=[], $type
    public static function FormModules($packageviews, $data = [])
    {
        return view('elements.forms.formmodules', compact('packageviews'))
            ->with($data)
            ->render();
    }

    // return list menu of modules left side backoffice
    public static function getMenuModule()
    {
        $getCategoriesMenu = [];
        $ModuleList = modules::where('im_status', 1)->get();

        foreach ($ModuleList as $key => $value) {
            $setCategory = StoneEngine::getAttributes($value['im_name_modules'], 'categoryMenu');
            if ($value->im_id <= 2)
                $setCategory = 'standar_menu';

            $getCategoriesMenu[$setCategory][] = $value;
        }
        return $getCategoriesMenu;
    }

    // return list sub-menu of modules left side backoffice
    public static function getSubMenuModule()
    {
        $MenuList = Menuback::get();
        return $MenuList;
    }


}
