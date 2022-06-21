<?php

namespace Twedoo\Stone\Core\Utils;

use App;
use Twedoo\Stone\Organizer\Models\Stones;
use Config;
use DB;
use StoneEngine;
use Schema;


class StoneMediaStyle
{
    /**
     *
     */
    public static function addJQUERY()
    {
        $getModule = Stones::where('enable', 1)->get();
//        dump($getModule);die;
        foreach ($getModule as $key => $module) {
            if (!in_array($module->name, StoneEngine::getModuleList()))
                continue;
            if (method_exists('Modules\\' . $module->name . '\\' . $module->name, 'js')) {
                $function = \App::call('Modules\\' . $module->name . '\\' . $module->name . '@js');
                if (!is_null($function)) {
                    ksort($function);
                    foreach ($function as $key => $js) {
                        echo '<script type="text/javascript" src="' . asset($js) . '"></script>' . "\n" . ' ';
                    }
                }
            }
        }
    }

    /**
     *
     */
    public static function addSTYLE()
    {
        $getModule = Stones::where('enable', 1)->get();

        foreach ($getModule as $key => $module) {
            if (!in_array($module->name, StoneEngine::getModuleList()))
                continue;
            if (method_exists('Modules\\' . $module->name . '\\' . $module->name, 'css')) {
                $function = \App::call('Modules\\' . $module->name . '\\' . $module->name . '@css');
                if (!is_null($function)) {
                    ksort($function);
                    foreach ($function as $key => $css) {
                        echo '<link href="' . asset($css) . '" rel="stylesheet" type="text/css"  />' . "\n" . ' ';
                    }
                }
            }

        }
    }


}
