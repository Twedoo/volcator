<?php

namespace Twedoo\Volcator\Organizer;

use Config;
use Twedoo\Volcator\Core\VolcatorApplication;
use Twedoo\Volcator\Modules\Configurations\Models\Theme;
use Twedoo\Volcator\Organizer\Models\Volcators;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Http\Request;
use VolcatorPath;
use VolcatorStructure;
use VolcatorEngine;
use VolcatorLanguage;
use Route;
use Schema;
use Session;
use Validator;
use ZipArchive;

// TODO: pagination
class Organizer extends VolcatorStructure
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->name = 'Organizer';
        $this->typeModule = 'back';
    }

    /**
     * @return $this
     */
    public function index()
    {
        $modules = Volcators::where('menu_type', '!=', 'hidden-organizer')->orwhere('menu_type', null)->get();
        $modules_volcator_hidden_organizer = Volcators::whereIn('application', ['main'])->get()->pluck('name')->toArray();

        $customModules = glob(base_path() . '/app/Modules/*', GLOB_ONLYDIR);
        $defaultModules = glob(__DIR__ . '/../../Modules/*', GLOB_ONLYDIR);
        $GetArrayModules[] = null;
        foreach (array_merge($defaultModules, $customModules) as $key => $value) {
            $volcator_name = substr($value, strrpos($value, '/') + 1);
            if (!in_array($volcator_name, $modules_volcator_hidden_organizer)) {
                $GetArrayModules[] = $volcator_name;
            }
        }

        return view('Organizer::Organizer.Organizer')
            ->with('GetArrayModules', $GetArrayModules)
            ->with('modules', $modules);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function uploadzip(Request $request)
    {
        $zipper = new ZipArchive;
        $rules = [
            "filezipupload" => 'mimes:zip|required',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);

        } else {
            $file = $request->file('filezipupload');
            $path = app_path('Modules/');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            if ($file->move($path, $filename)) {
                if ($zipper->open($path . $filename, ZipArchive::CREATE) == true) {
                    $zipper->extractTo($path);
                    unlink($path . $filename);


                    // Check if template folder exists and is not empty
                    $templatePath = $path . 'template/';
                    if (File::exists($templatePath) && File::isDirectory($templatePath)) {
                        // Check for front template folder
                        $frontTemplatePath = $templatePath . 'front/';
                        if (File::exists($frontTemplatePath) && File::isDirectory($frontTemplatePath)) {
                            // Copy contents of front template folder to Laravel resources/views/front folder
                            $laravelFrontPath = resource_path('views/front/');
                            File::copyDirectory($frontTemplatePath, $laravelFrontPath);
                        }

                        // Check for back template folder
                        $backTemplatePath = $templatePath . 'back/';
                        if (File::exists($backTemplatePath) && File::isDirectory($backTemplatePath)) {
                            // Copy contents of back template folder to Laravel resources/views/back folder
                            $laravelBackPath = resource_path('views/back/');
                            File::copyDirectory($backTemplatePath, $laravelBackPath);
                        }
                    }

                    if (\App::getLocale() == 'ar' || \App::getLocale() == 'ur') {
                        \Toastr::success(trans('Organizer::Organizer/Organizer.success_add_modules'), trans('Organizer::Organizer/Organizer.success'), ["positionClass" => "toast-top-left"]);
                    } else {
                        \Toastr::success(trans('Organizer::Organizer/Organizer.success_add_modules'), trans('Organizer::Organizer/Organizer.success'), ["positionClass" => "toast-top-right"]);
                    }
                    return redirect()->route(app('urlBack') . '.super.modules.index');
                }
            }

        }

    }

    /**
     * @param $module
     * @param null $isInstallAsMain
     * @return \Illuminate\Http\RedirectResponse
     */
    public function preBuilding($module, $isInstallAsMain = null)
    {
        if ($isInstallAsMain) {
            $this->setActive($module);
        } else {
            $this->setBuilding($module);
        }
        return redirect()->route(app('urlBack') . '.super.modules.index');
    }

    /**
     * @param $module
     * @param bool $console
     * @return void
     */
    public function preBuildingConsole($module, $console = true) :void
    {
        $isInstalled = Volcators::where('name', $module)->first();
        if (!$isInstalled) {
            $this->setBuilding($module, $console);
        }
    }

    /**
     * @param $module
     * @return mixed
     */
    public function isMainInstalled($module)
    {
        return Volcators::where('name', $module)->whereIn('application', ['main'])->first();
    }

    /**
     * @param $volcator
     */
    public function setActive($volcator)
    {
        VolcatorApplication::activeVolcatorInCurrentApplication($volcator);
        return redirect()->route(app('urlBack') . '.super.modules.index');
    }

    /**
     * @param $module
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setBuilding($module, $console = false)
    {

        $OrganizerDB = Volcators::where('name', $module)->first();
        if ($OrganizerDB) {
            return redirect()->route(app('urlBack') . '.super.modules.index');
        } else {
            return VolcatorEngine::setModule($module, false, $console);
        }
    }

    /**
     * @param $id
     * @param $module
     * @return mixed
     */
    public function parametres($id, $module)
    {
        return VolcatorEngine::pageParameters($module, $id);
    }


    /**
     * @param $id
     * @param $module
     * @param $dropTable
     * @return mixed
     */
    public function resetModule($module)
    {
        if ($this->isMainInstalled($module) == null) {
            if (VolcatorEngine::uninstallVolcator($module)) {
                VolcatorEngine::setModule($module, true);
            }
        }
        return redirect()->route(app('urlBack') . '.super.modules.index');
    }

    /**
     * @param $id
     * @param $module
     * @param $dropTable
     * @return $this
     */
    public function uninstallModule($module)
    {
        if ($this->isMainInstalled($module) == null) {
            $module_id = Volcators::where('name', $module)->first()->id;
            if (VolcatorEngine::uninstallVolcator($module)) {
                $theme = Theme::where('volcator_id', $module_id)->first();
                if ($theme && $theme->is_delete) {
                    $volcatorTemplatePath = resource_path("views/$theme->scoupe");
                    File::deleteDirectory($volcatorTemplatePath . '/' . $theme->name);
                }
                VolcatorLanguage::displayNotificationProgress(
                    'success',
                    trans('Organizer::Organizer/Organizer.success_uninstallmodule'),
                    trans('Organizer::Organizer/Organizer.success')
                );
                Session::flash('message', trans('Organizer::Organizer/Organizer.success_uninstallmodule'));
            }
        }

        return redirect()->route(app('urlBack') . '.super.modules.index');
    }

    public function statusModule($id, $module)
    {
        $isMainInstalled = Volcators::where('id', $id)->whereIn('application', ['main'])->first();
        if ($isMainInstalled == null) {
            $status = Volcators::find($id);
            if ($status->enable == 1) {
                $status->enable = 0;
                $status->update();
                VolcatorLanguage::displayNotificationProgress(
                    'success',
                    trans('Organizer::Organizer/Organizer.disablem'),
                    trans('Organizer::Organizer/Organizer.success')
                );
                $status = '_d';
            } else {
                $status->enable = 1;
                $status->update();
                VolcatorLanguage::displayNotificationProgress(
                    'success',
                    trans('Organizer::Organizer/Organizer.enablem'),
                    trans('Organizer::Organizer/Organizer.success')
                );
                $status = '_e';
            }
            Session::flash('message', trans('Organizer::Organizer/Organizer.status_module' . $status));
        }

        return redirect()->route(app('urlBack') . '.super.modules.index');
    }

    public function removeModule($module)
    {
        if ($this->isMainInstalled($module) == null) {
            $isExist = VolcatorEngine::isActiveVolcatorInCurrentApplication($module);
            if (!$isExist) {
                VolcatorEngine::deleteDirModule(app_path('Modules/' . $module), $module);
                VolcatorLanguage::displayNotificationProgress(
                    'success',
                    trans('Organizer::Organizer/Organizer.success_remove_modules'),
                    trans('Organizer::Organizer/Organizer.success')
                );
                Session::flash('message', trans('Organizer::Organizer/Organizer.success_uninstallmodule'));
                return redirect()->route(app('urlBack') . '.super.modules.index');
            }
        }
        return redirect()->route(app('urlBack') . '.super.modules.index');
    }
}
