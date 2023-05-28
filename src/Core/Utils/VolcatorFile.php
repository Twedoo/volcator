<?php

namespace Twedoo\Volcator\Core\Utils;

use App;

class VolcatorFile
{
    public static $itemsFile = [];
    public static $pathInside = [];

    /**
     * @param $path
     * @return string
     */
    public static function getFilerByType($path, $type, $eliminate = [])
    {
        $files = array_diff(scandir($path, 1), $eliminate);
        foreach ($files as $key => $file) {
            $fileStr = explode('.', $file);
            if (end($fileStr) == $type) {
                self::$itemsFile[] = $file;
            }
        }
        return self::$itemsFile;
    }

    /**
     * @param $data
     * @param $lang
     * @return array
     */
    public static function getFilesResources($data, $lang)
    {
        foreach ($data as $key => $value) {
            $new_path = resource_path() . '/lang/' . $lang . '/' . $value;
            if (!is_file($new_path) && is_dir($new_path)) {
                unset($data[$key]);
                $parseUrl = explode('lang/', $new_path)[1];
                $parseDir = array_diff(scandir(resource_path() . '/lang/' . $parseUrl . '/', 1), array('..', '.'));
                foreach ($parseDir as $fKey => $fValue) {
                    self::$pathInside[] = $value . '/' . $fValue;
                }
            }
        }
        return self::$pathInside;
    }
}
