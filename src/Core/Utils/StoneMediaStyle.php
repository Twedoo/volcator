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
    public static function jsMediaHook()
    {
        $stone = StoneEngine::getStoneNameByCurrentUrl();
        $namespace = StoneEngine::stoneResolveNamespace($stone);
        if (!$namespace) {
            return null;
        }
        $path = StoneEngine::pathConfigStoneResolve($namespace, $stone);
        if (method_exists($namespace . $stone . '\\' . $stone, 'js')) {
            $pathJs = \App::call($namespace . $stone . '\\' . $stone . '@js');
            if (!is_null($pathJs)) {
                foreach (array_filter($pathJs) as $key => $js) {
                    $js = preg_replace('~'.base_path().'~', '', $path.'/Media/'.$js);
                    echo '<script type="text/javascript" src="' . $js . '"></script>' . "\n" . ' ';
                }
            }
        }
    }

    /**
     *
     */
    public static function cssMediaHook()
    {
        $stone = StoneEngine::getStoneNameByCurrentUrl();
        $namespace = StoneEngine::stoneResolveNamespace($stone);
        if (!$namespace) {
            return null;
        }
        $path = StoneEngine::pathConfigStoneResolve($namespace, $stone);

        if (method_exists($namespace . $stone . '\\' . $stone, 'css')) {
            $pathCss = \App::call($namespace . $stone . '\\' . $stone . '@css');
            if (!is_null($pathCss)) {
                foreach (array_filter($pathCss) as $key => $css) {
                    $css = preg_replace('~'.base_path().'~', '', $path.'/Media/'.$css);
                    echo '<link href="' . $css . '" rel="stylesheet" type="text/css"  />' . "\n" . ' ';
                }
            }
        }
    }
}
