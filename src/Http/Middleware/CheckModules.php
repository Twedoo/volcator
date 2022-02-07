<?php

namespace Twedoo\Stone\Http\Middleware;

use App;
use Twedoo\Stone\Models\Menuback;
use Closure;
use Config;
use StoneEngine;
use StoneLanguage;
use Schema;
use Session;


class CheckModules
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $getPath = $request->path();

        if (strpos($getPath, Config('prefix.urlBack')) !== false && strpos($getPath, Config('prefix.module')) !== false) {

            $nameModelClass = explode(Config('prefix.urlBack') . '/', $getPath);// explode for get the name of controller and folder module
            $flight = Menuback::where('route_link', strtolower(explode('/', $nameModelClass[1])[1]))
                ->orwhere('route_link', ucfirst(explode('/', $nameModelClass[1])[1]))->first();
            if (!$flight) {

                switch (App::getLocale()) {
                    case "ar":
                        \Toastr::error(trans('InstallerModule::InstallerModule/installmodules.notfound_modules_install'), trans('InstallerModule::InstallerModule/installmodules.notfound_modules_install'), ["positionClass" => "toast-top-left"]);
                        break;
                    case "fa":
                        \Toastr::error(trans('InstallerModule::InstallerModule/installmodules.notfound_modules_install'), trans('InstallerModule::InstallerModule/installmodules.notfound_modules_install'), ["positionClass" => "toast-top-left"]);
                        break;
                    case "ur":
                        \Toastr::error(trans('InstallerModule::InstallerModule/installmodules.notfound_modules_install'), trans('InstallerModule::InstallerModule/installmodules.notfound_modules_install'), ["positionClass" => "toast-top-left"]);
                        break;
                    default:
//                        \Toastr::error(trans('InstallerModule::InstallerModule/installmodules.notfound_modules_install'),trans('InstallerModule::InstallerModule/installmodules.notfound_modules_install'), ["positionClass" => "toast-top-left"]);
                }
//                return redirect()->route(app('urlBack') . '.super.modules.index')->with('',  $next($request));
                return abort(404);
//                ->with('',  $next($request))
            }
        }

        return $next($request);
    }
}
