<?php

namespace Twedoo\Volcator\Core\Utils;

use App;
use Twedoo\Volcator\Organizer\Models\Volcators;
use Config;
use DB;
use VolcatorEngine;
use Schema;


class VolcatorMediaStyle
{
    public static function jsMediaHook()
    {
        $volcator = VolcatorEngine::getVolcatorNameByCurrentUrl();
        $namespace = VolcatorEngine::volcatorResolveNamespace($volcator);
        if (!$namespace) {
            return null;
        }
        $path = VolcatorEngine::pathConfigVolcatorResolve($namespace, $volcator);
        if (method_exists($namespace . $volcator . '\\' . $volcator, 'js')) {
            $pathJs = \App::call($namespace . $volcator . '\\' . $volcator . '@js');
            if (!is_null($pathJs)) {
                foreach (array_filter($pathJs) as $key => $js) {
                    $js = preg_replace('~'.base_path().'~', '', $path.'/Media/'.$js);
                    $key = strpos($key, 'module') !== false ? "module" : "text/javascript";
                    echo '<script type="'.$key.'" src="' . $js . '"></script>' . "\n" . ' ';
                }
            }
        }
    }

    /**
     *
     */
    public static function cssMediaHook()
    {
        $volcator = VolcatorEngine::getVolcatorNameByCurrentUrl();
        $namespace = VolcatorEngine::volcatorResolveNamespace($volcator);
        if (!$namespace) {
            return null;
        }
        $path = VolcatorEngine::pathConfigVolcatorResolve($namespace, $volcator);
        if (method_exists($namespace . $volcator . '\\' . $volcator, 'css')) {
            $pathCss = \App::call($namespace . $volcator . '\\' . $volcator . '@css');

            if (!is_null($pathCss)) {
                foreach (array_filter($pathCss) as $key => $css) {
                    $css = preg_replace('~'.base_path().'~', '', $path.'/Media/'.$css);
                    echo '<link href="' . $css . '" rel="stylesheet" type="text/css"  />' . "\n" . ' ';
                }
            }
        }
    }
}
