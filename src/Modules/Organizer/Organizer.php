<?php

namespace Twedoo\Stone\Organizer;

use Config;
use Twedoo\Stone\Organizer\Models\Stones;
use DB;
use File;
use Illuminate\Http\Request;
use StonePath;
use StoneStructure;
use StoneEngine;
use StoneLanguage;
use Route;
use Schema;
use Session;
use Validator;
use ZipArchive;

// TODO: pagination
class Organizer extends StoneStructure
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
        $modules = Stones::where('menu_type', '!=', 'hidden-organizer')->orwhere('menu_type', null)->get();
        $modules_stone_hidden_organizer = Stones::whereIn('application', ['main'])->get()->pluck('name')->toArray();

        $customModules = glob(base_path() . '/app/Modules/*', GLOB_ONLYDIR);
        $defaultModules = glob(__DIR__ . '/../../Modules/*', GLOB_ONLYDIR);

        foreach (array_merge($defaultModules, $customModules) as $key => $value) {
            $stone_name = substr($value, strrpos($value, '/') + 1);
            if (!in_array($stone_name, $modules_stone_hidden_organizer)) {
                $GetArrayModules[] = $stone_name;
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

    public function preBuilding($module)
    {
//        StoneEngine::isTrueModule($module);
//        $line = '';
//        $DirectoryModules = base_path() . ('/config/module.php');
//        $file = fopen($DirectoryModules, "r+") or exit("Unable to open file!");
//        $newmodules = "       '" . $module . "'" . ',' . "\n"; // I added new line after new user
//        $insertPos = 0;  // variable for saving //Users position
//        while (!feof($file)) {
//            $line = fgets($file);
//            if (strpos($line, "return['Modules'=>[") !== false) {
//                $insertPos = ftell($file);    // ftell will tell the position where the pointer moved, here is the new line after //Users.
//                $newline = $newmodules;
//            } else {
//                $newline .= $line;   // append existing data with new data of user
//            }
//        }
//        fseek($file, $insertPos);   // move pointer to the file position where we saved above
//        fwrite($file, $newline);
//        fclose($file);
//

        $this->setBuilding($module);
        return redirect()->route(app('urlBack') . '.super.modules.index');

    }

    /**
     * @param $module
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setBuilding($module)
    {

        $OrganizerDB = Stones::where('name', $module)->first();
        if ($OrganizerDB) {
            return redirect()->route(app('urlBack') . '.super.modules.index');
        } else {
            return StoneEngine::setModule($module, false);
        }
    }

    /**
     * @param $id
     * @param $module
     * @return mixed
     */
    public function parametres($id, $module)
    {
        return StoneEngine::pageParameters($module, $id);
    }


    /**
     * @param $id
     * @param $module
     * @param $dropTable
     * @return mixed
     */
    public function resetModule($module)
    {
        $OrganizerDB = Stones::where('name', $module)->first();
        if ($OrganizerDB) {
            DB::table('permissions')->where('permissions.id_stone', $OrganizerDB->id)->delete();
            DB::table('stones')->where('id', $OrganizerDB->id)->delete();
            DB::table('menubacks')->where('id_stone', $OrganizerDB->id)->delete();
            $table = explode(',', StoneEngine::getAttributes($module, 'dropTable'));
            foreach ($table as $value) {
                Schema::dropIfExists(preg_replace('/[^_A-Za-z0-9\-]/', '', strtolower($value)));
            }
            return StoneEngine::setModule($module, true);
        }
    }

    /**
     * @param $id
     * @param $module
     * @param $dropTable
     * @return $this
     */
    public function uninstallModule($module)
    {
        $getModule = Stones::where('name', $module)->first();
        if ($getModule) {
            DB::table('permissions')->where('permissions.id_stone', $getModule->id)->delete();
            DB::table('stones')->where('id', $getModule->id)->delete();
            DB::table('menubacks')->where('id_stone', $getModule->id)->delete();
            $table = explode(',', StoneEngine::getAttributes($module, 'dropTable'));
            foreach ($table as $value) {
                Schema::dropIfExists(preg_replace('/[^_A-Za-z0-9\-]/', '', strtolower($value)));
            }
            StoneLanguage::displayNotificationProgress(
                'success',
                trans('Organizer::Organizer/Organizer.success_uninstallmodule'),
                trans('Organizer::Organizer/Organizer.success')
            );
            Session::flash('message', trans('Organizer::Organizer/Organizer.success_uninstallmodule'));
        }
        return redirect()->route(app('urlBack') . '.super.modules.index');

    }

    public function statusModule($id, $module)
    {
        $status = Stones::find($id);
        if ($status->enable == 1) {
            $status->enable = 0;
            $status->update();
            StoneLanguage::displayNotificationProgress(
                'success',
                trans('Organizer::Organizer/Organizer.disablem'),
                trans('Organizer::Organizer/Organizer.success')
            );
            $status = '_d';
        } else {
            $status->enable = 1;
            $status->update();
            StoneLanguage::displayNotificationProgress(
                'success',
                trans('Organizer::Organizer/Organizer.enablem'),
                trans('Organizer::Organizer/Organizer.success')
            );
            $status = '_e';
        }
        Session::flash('message', trans('Organizer::Organizer/Organizer.status_module' . $status));
        return redirect()->route(app('urlBack') . '.super.modules.index');
    }

    public function removeModule($module)
    {
        $isExist = StoneEngine::isInstallModule($module);
        if (!$isExist) {
            StoneEngine::deleteDirModule(app_path('Modules/' . $module), $module);
            StoneLanguage::displayNotificationProgress(
                'success',
                trans('Organizer::Organizer/Organizer.success_remove_modules'),
                trans('Organizer::Organizer/Organizer.success')
            );
            Session::flash('message', trans('Organizer::Organizer/Organizer.success_uninstallmodule'));
            return redirect()->route(app('urlBack') . '.super.modules.index');
        }
    }
}
