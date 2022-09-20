<?php

namespace Twedoo\Stone\Core;

use App;
use Twedoo\Stone\Models\Languages;
use Config;
use DB;
use File;
use StoneFile;
use Session;

class StoneTranslation
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getLanguages()
    {
        return Languages::All();
    }

    /**
     * @param $lang
     * @return array
     * Get list files of language (resources/lang/...)
     */
    public static function getFileBase($lang)
    {
        return array_merge(StoneFile::getFilesResources(
            array_diff(scandir(
                resource_path() . '/lang/' . $lang . '/', 1),
                [
                    '..',
                    '.',
                    'validation.php'
                ]),
            $lang),
            array_filter(
                array_diff(
                    scandir(
                        resource_path() . '/lang/' . $lang . '/', 1),
                    [
                        '..',
                        '.',
                        'validation.php'
                    ]),
                function ($item) {
                    return !is_dir(resource_path() . '/lang/' . 'en' . '/' . $item);
        })
        );
    }

    /**
     * @param $module
     * @param $language
     * @param null $file
     * @return mixed
     */
    public static function getFile($module, $language, $file)
    {
        if ($module == 'langRresources') {
            $globalPath = resource_path() . '/lang/' . $language . '/';
            $folder = resource_path() . '/lang/';
        } else {
            $globalPath = app_path() . '/Modules/' . $module . '/lang/' . $language . '/' . $module . '/';
            $folder = app_path() . '/Modules/' . $module . '/lang' . '/';
        }

        if ($file && (!is_file($globalPath . '/' . $file) || self::dirIsEmpty($globalPath . '/') || !is_dir($globalPath . '/'))) {
            self::createFile($file, $globalPath, $folder);
        }

        $pathToFile = $globalPath . '/';
        $getAllTranslate = array_diff(scandir($globalPath, 1), array('..', '.'));

        if ($file)
            return include $pathToFile . $file;
        else
            return include $pathToFile . $getAllTranslate[0];
    }

    /**
     * @param $dirname
     * @return bool
     */
    public static function dirIsEmpty($dirname)
    {
        if (!is_dir($dirname)) return false;
        foreach (scandir($dirname) as $file) {
            if (!in_array($file, array('.', '..', '.svn', '.git'))) return false;
        }
        return true;
    }

    /**
     * @param $path
     * @param $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function createFile($file, $globalPath, $folder)
    {
        $path_generate = explode('lang', $globalPath . $file);
        $explode_folder = explode('/', $path_generate[1]);
        unset($explode_folder[count($explode_folder) - 1]);

        foreach (array_filter($explode_folder) as $key => $one) {
            $folder = $folder . $one . '/';
            if (!is_dir($folder)) {
                @mkdir($folder, 0777, true);
                @chmod($folder, 0777);
            }
        }

        if (is_dir($folder)) {
            $pathToFile = $globalPath . $file;
            $openFile = fopen($pathToFile, 'w+');
            @chmod($pathToFile, 0777);
            if (file_exists($globalPath . $file)) {
                file_put_contents($pathToFile, '<?php ' . PHP_EOL . '   return [' . PHP_EOL . '    ];');
            }
            if (ob_get_contents()) ob_end_clean();
            flush();
            fclose($openFile);
        }
    }

    public static function writeInFile($path, $data)
    {
        $isFalse = false;
        if (file_exists($path)) {
            @chmod($path, 0755);
            $openFile = fopen($path, 'w+');
            if (file_put_contents($path, '<?php ' . PHP_EOL . '   return [' . PHP_EOL . '' . $data . '' . PHP_EOL . '  ];'))
                $isFalse = true;
            fclose($openFile);
        }
        return redirect()->back();
    }

    /**
     * @param $module
     * @param $language
     * @param $file
     * @return array
     */
    public static function getFiles($module, $language, $file)
    {
        if ($module == 'langRresources') {
            $globalPath = resource_path() . '/lang/' . $language . '/';
            if (self::dirIsEmpty($globalPath) || !is_dir($globalPath)) $language = 'en';
            $globalPath = $globalPath . '/';
            $data = array_merge(
                StoneFile::getFilesResources(array_diff(scandir($globalPath, 1), ['..', '.', 'validation.php']), $language),
                StoneFile::getFilerByType($globalPath, 'php', ['..', '.', 'validation.php'])
            );
        } else {
            $globalPath = app_path() . '/Modules/' . $module . '/lang/' . $language . '/' . $module;
            $data = StoneFile::getFilerByType($globalPath, 'php', ['..', '.', 'validation.php']);
        }
        return $data;
    }

    /**
     * @param $dirname
     * @return bool
     */
    public static function getKeyFile($module, $language, $file)
    {
        if ($module == 'langRresources') {
            if (is_file(resource_path() . '/lang/' . $language . '/' . $file))
                $language = 'en';

            $globalPath = resource_path() . '/lang/' . $language . '/';
        } else {
            if (is_file(app_path() . '/Modules/' . $module . '/lang/en/' . $module . '/' . $file))
                $language = 'en';

            $globalPath = app_path() . '/Modules/' . $module . '/lang/' . $language . '/' . $module . '/';
        }

        $getAllTranslate = array_diff(scandir($globalPath, 1), array('..', '.'));

        if ($file)
            return include $globalPath . $file;
        else
            return include $globalPath . $getAllTranslate[0];
    }

    /**
     * @param $nameModule
     * @param $pathFileTranslate
     */
    public static function setTranslateModules($nameModule, $pathFileTranslate)
    {
        $DirTransDefault = glob(base_path() . '/resources/lang' . '/*', GLOB_ONLYDIR);
        //path module content folder lang for override in resources / lang / your folder !!
        $NameModule = "Modules/" . $nameModule;

        // your folder content path file translate word lang to put in resources / lang / !!
        $TransWrite = $pathFileTranslate;

        //get all name of module from folder translatels
        foreach ($DirTransDefault as $key => $value) {
            $data = '';
            list(, $GetDirTrans) = explode('lang/', $value);
            $DirPathDefault = base_path() . ('/resources/lang/') . $GetDirTrans . '/';
            $getResourceTrans =  $DirPathDefault . $TransWrite;
            $getNewTrans =  str_replace("\\", "/", app_path() . '/' . $NameModule . '/lang/' . $GetDirTrans . '/' . $TransWrite);

            if (file_exists($getNewTrans)) {
                if (!file_exists($getResourceTrans)) {
                    $explode_folder = explode('/', $TransWrite);
                    foreach ($explode_folder as $key => $one) {
                        if (!is_dir($DirPathDefault)) {
                            @mkdir($DirPathDefault);
                            @chmod($DirPathDefault, 0777);
                        }
                        $DirPathDefault = $DirPathDefault . $one++ . '/';
                    }
                    fopen($getResourceTrans, 'w+');
                    if (!file_exists($getResourceTrans)) {
                        @chmod($getResourceTrans, 0777);
                    }
                }

                $getDiff = array_diff(include $getNewTrans, (array) include $getResourceTrans);
                $setWordFiltred = array_merge((array) include $getResourceTrans, $getDiff);

                foreach ($setWordFiltred as $keyWord => $valueWord) {
                    if (!$keyWord) {
                        continue;
                    }
                    $data .= "         '" . $keyWord .
                        "'" . ' => ' . "'" .
                        str_replace("'", "\'", $valueWord) . "'," .
                        PHP_EOL;
                }
                @chmod($getResourceTrans, 0777);
                file_put_contents($getResourceTrans,
                    '<?php '
                    . PHP_EOL .
                    '   return ['
                    . PHP_EOL . '' .
                    $data .
                    '' . PHP_EOL .
                    '  ];'
                );
            }
        }
    }

    /**
     * @param $textTRans
     * @param $tableTRans
     * @param $langtrans
     * @return mixed
     */
    public static function transDynTable($textTRans, $tableTRans, $langtrans)
    {
        $word = array();
        for ($i = 0; $i < strlen($tableTRans); $i++) {
            $word[] = $tableTRans[$i];
        }

        $lang = $langtrans;
        $language = $lang . '_trans';
        $table = implode("", $word);
        $TransPass = DB::table($table)->where('title_trans', $textTRans)->first();
        if ($TransPass != null) {
            return $TransPass->$language;
        }
        return true;
    }

    /**
     * @param $notification
     * @param null $local
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function translateNotificationPusher($notification, $local = null)
    {
        $notification = json_decode(json_encode($notification), true);
        if ($notification == null) {
            $translate = self::translateNotification($notification, $local);
        } else {
            if (is_array($notification)) {
                if (count($notification) >= 2) {
                    $translate = trans($notification[0], $notification[1], $local);
                }
            } else {
                $translate = trans($notification, [], $local);
            }
        }

        return $translate;
    }

    /**
     * @param $notification
     * @param null $local
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function translateNotification($notification, $local = null)
    {
        $parserNotification = json_decode($notification, true);
        if ($parserNotification != null) {
            if (is_array($parserNotification)) {
                $translate = trans($parserNotification[0], $parserNotification[1], $local);
            } else {
                $translate = trans(json_decode($notification), [], $local);
            }
        }  else {
            $translate = trans($notification, [], $local);
        }

        return $translate;
    }

    public static function currentLocalByUSerId($id)
    {
        return Session::get('language-user-'.$id);
    }
}
