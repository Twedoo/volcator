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

            $nameModelClass = explode(Config('prefix.urlBack') . '/', $getPath);
            $flight = Menuback::where('route_link', strtolower(explode('/', $nameModelClass[1])[1]))
                ->orwhere('route_link', ucfirst(explode('/', $nameModelClass[1])[1]))->first();

            if (!$flight) {
                switch (App::getLocale()) {
                    case "ar":
                        \Toastr::error(trans('Organizer::Organizer/installmodules.notfound_modules_install'), trans('Organizer::Organizer/installmodules.notfound_modules_install'), ["positionClass" => "toast-top-left"]);
                        break;
                    case "fa":
                        \Toastr::error(trans('Organizer::Organizer/installmodules.notfound_modules_install'), trans('Organizer::Organizer/installmodules.notfound_modules_install'), ["positionClass" => "toast-top-left"]);
                        break;
                    case "ur":
                        \Toastr::error(trans('Organizer::Organizer/installmodules.notfound_modules_install'), trans('Organizer::Organizer/installmodules.notfound_modules_install'), ["positionClass" => "toast-top-left"]);
                        break;
                    default:
                }
                return abort(404);
            }
        }

        return $next($request);
    }
}
