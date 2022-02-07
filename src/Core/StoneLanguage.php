<?php

namespace Twedoo\Stone\Core;

use App;
use Config;
use DB;
use Schema;


class StoneLanguage
{
    public static function displayNotificationProgress($typeAlert, $messageText, $titleText)
    {
        if (in_array(App::getLocale(), Config::get('lang_right'))) {
            \Toastr::$typeAlert($messageText, $titleText, ["positionClass" => "toast-top-left"]);
        } else {
            \Toastr::$typeAlert($messageText, $titleText, ["positionClass" => "toast-top-right"]);
        }

    }

    /**
     * @param $byDefaultLang
     * @return \Illuminate\Config\Repository|mixed|null
     * check default language stocked in table or retrieve the config from file if params True
     */
    public static function getDefaultLanguage($byDefaultLang)
    {

        if (!Schema::hasTable('confsettings'))
            if ($byDefaultLang)
                return Config('defaultLang');
            else
                return null;
        else
            $getLanguage = DB::table('confsettings')->get();
        if ($getLanguage[0]->languages != null)
            return $getLanguage[0]->languages;
        else
            return Config('defaultLang');

    }
}
