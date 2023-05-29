<?php

namespace Twedoo\Volcator\Core;

use App;
use Twedoo\Volcator\Models\Menuback;
use Twedoo\Volcator\Organizer\Models\Volcators;
use Config;
use DB;
use VolcatorEngine;

class VolcatorMenu
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
        $ModuleList = Volcators::where('volcators.enable', 1)
            ->join('applications_volcator', 'applications_volcator.volcator_id', '=', 'volcators.id')
            ->join('applications', 'applications.id', '=', 'applications_volcator.application_id')
            ->where('applications_volcator.application_id', VolcatorApplication::getCurrentApplicationId())
            ->where('applications.space_id', VolcatorSpace::getCurrentSpaceId())
            ->get(['volcators.*']);

        foreach ($ModuleList as $key => $value) {
            if ($value->menu_type == "hidden") {
                continue;
            }

            $setCategory = VolcatorEngine::getAttributes($value['name'], 'categoryMenu', $value->application);
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
     * @param $id_volcator
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
