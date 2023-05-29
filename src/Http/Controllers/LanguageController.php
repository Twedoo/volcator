<?php

namespace Twedoo\Volcator\Http\Controllers;

use App\Http\Requests;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LanguageController extends Controller
{
    /**
     * @param Request $request
     * @param $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLang(Request $request, $lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
            if (isset(Auth::user()->id)) {
                $current_user = Auth::user()->id;
                Cache::put('language-user-'.$current_user, $lang);
            }
        }
        return Redirect::back();
    }
}

