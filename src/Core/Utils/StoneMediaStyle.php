<?php

namespace Twedoo\Stone\Core\Utils;

use App;
use Twedoo\Stone\InstallerModule\Models\modules;
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
        $getModule = modules::where('im_status', 1)->get();
        foreach ($getModule as $key => $module) {
            if (!in_array($module->im_name_modules, StoneEngine::getModuleList()))
                continue;
            if (method_exists('Modules\\' . $module->im_name_modules . '\\' . $module->im_name_modules, 'js')) {
                $function = \App::call('Modules\\' . $module->im_name_modules . '\\' . $module->im_name_modules . '@js');
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
        $getModule = modules::where('im_status', 1)->get();

        foreach ($getModule as $key => $module) {
            if (!in_array($module->im_name_modules, StoneEngine::getModuleList()))
                continue;
            if (method_exists('Modules\\' . $module->im_name_modules . '\\' . $module->im_name_modules, 'css')) {
                $function = \App::call('Modules\\' . $module->im_name_modules . '\\' . $module->im_name_modules . '@css');
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
