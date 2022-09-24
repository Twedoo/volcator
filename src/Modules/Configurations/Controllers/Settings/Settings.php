<?php

namespace Modules\Configurations\Controllers\Settings;

use App\Http\Controllers\Controller;
use Twedoo\Stone\Models\Languages;
use Twedoo\Stone\Modules\Configurations\Models\confsettings;
use Twedoo\Stone\Modules\Configurations\Models\confsettings_langs;
use Twedoo\Stone\Modules\Configurations\Models\invitation;
use Artisan;
use DB;
use Illuminate\Http\Request;
use Input;
use StoneLanguage;
use Route;
use Schema;
use Session;
use Validator;
use App;

class Settings extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $classModule;

    public function __construct()
    {
        //
    }

    public function index()
    {
        $setbase = confsettings::all()->first();
        $settings = confsettings_langs::where('id_ref', $setbase->id)->get();
        $languages = Languages::all();
        return view('Configurations::Settings.Settings', compact('setbase', 'languages', 'settings'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $alang = App::getLocale();
        $setbase = confsettings::all()->first();
        $settingsbase = confsettings_langs::where('id_ref', $setbase->id)->get();

        if (count($settingsbase) > 0) {

            $rules = [
                "sitename" . "_" . App::getLocale() => "required ",
                "keyword" . "_" . App::getLocale() => "required ",
                "descriptionweb" . "_" . App::getLocale() => "required ",
                "email" => "required ",
                "languages" => "required ",
                "msgmaintenance" . "_" . App::getLocale() => "required_with:maintenanceweb,on ",
            ];

            $validate = Validator::make($request->all(), $rules);
            $validate->SetAttributeNames([
                "sitename" . "_" . App::getLocale() => trans('Configurations::Configurations/Settings.sitename'),
                "keyword" . "_" . App::getLocale() => trans('Configurations::Configurations/Settings.keyword'),
                "descriptionweb" . "_" . App::getLocale() => trans('Configurations::Configurations/Settings.descriptionweb'),
                "msgmaintenance" . "_" . App::getLocale() => trans('Configurations::Configurations/Settings.msgmaintenance'),
                "maintenanceweb" => trans('Configurations::Configurations/Settings.maintenanceweb'),
                "languages" => trans('Configurations::Configurations/Settings.languages'),
                "email" => trans('Configurations::Configurations/Settings.email'),
                "email" => trans('Configurations::Configurations/Settings.email')
            ]);

            if ($validate->fails()) {
                StoneLanguage::displayNotificationProgress(
                    'error',
                    trans('Configurations::Configurations/Settings.errors_add'),
                    trans('Configurations::Configurations/Settings.errors')
                );
                return back()->withInput()->withErrors($validate);
            } else {

                $file = $request->file('logo');
                if ($file != "") {
                    $path = public_path() . '/images/upload/img';
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    if ($file->move($path, $filename)) {
                        $setbase->logo = $filename;
                    }
                }

                $setbase->email = $request->input('email');
                $setbase->languages = $request->input('languages');
                $setbase->maintenanceweb = $request->input('maintenanceweb');
                $setbase->update();

                $input = $request->except('_token', 'email', 'logo', 'languages');
                $titconfig = ["sitename", "keyword", "descriptionweb", "msgmaintenance"];

                foreach ($titconfig as $key => $value) {
                    foreach ($input as $key1 => $value1) {
                        $l3 = substr($key1, -3);
                        if (strpos($l3, '_') !== false) {
                            $rowlang = substr($key1, -2) . '_trans';
                        }
                        if ($key1 == $value . $l3 && !empty($value1)) {
                            $setinsert = confsettings_langs::where('title_trans', $value)->where('id_ref', $setbase->id)->first();
                            $varset = $setinsert;
                            $setinsert->$rowlang = $value1;
                            $setinsert->update();
                        }
                    }
                }//end foreach insert input in table confsettings_langs

                switch (App::getLocale()) {
                    case "ar":
                        \Toastr::success(trans('Configurations::Configurations/Settings.success_add'), trans('Configurations::Configurations/Settings.success'), ["positionClass" => "toast-top-left"]);
                        break;
                    case "fa":
                        \Toastr::success(trans('Configurations::Configurations/Settings.success_add'), trans('Configurations::Configurations/Settings.success'), ["positionClass" => "toast-top-left"]);
                        break;
                    case "ur":
                        \Toastr::success(trans('Configurations::Configurations/Settings.success_add'), trans('Configurations::Configurations/Settings.success'), ["positionClass" => "toast-top-left"]);
                        break;
                    default:
                        \Toastr::success(trans('Configurations::Configurations/Settings.success_add'), trans('Configurations::Configurations/Settings.success'), ["positionClass" => "toast-top-right"]);
                }
                return redirect()->route(app('urlBack') . '.config.settings.index');
            }//end else validator rules
        }// end check if not null $settingsbase != null
        else {

            $rules = [
                "sitename" . "_" . App::getLocale() => "required ",
                "keyword" . "_" . App::getLocale() => "required ",
                "descriptionweb" . "_" . App::getLocale() => "required ",
                "email" => "required ",
                "languages" => "required ",
                "msgmaintenance" . "_" . App::getLocale() => "required_with:maintenanceweb,on ",
            ];


            $validate = Validator::make($request->all(), $rules);
            $validate->SetAttributeNames([
                "sitename" . "_" . App::getLocale() => trans('Configurations::Configurations/Settings.sitename'),
                "keyword" . "_" . App::getLocale() => trans('Configurations::Configurations/Settings.keyword'),
                "descriptionweb" . "_" . App::getLocale() => trans('Configurations::Configurations/Settings.descriptionweb'),
                "msgmaintenance" . "_" . App::getLocale() => trans('Configurations::Configurations/Settings.msgmaintenance'),
                "maintenanceweb" => trans('Configurations::Configurations/Settings.maintenanceweb'),
                "languages" => trans('Configurations::Configurations/Settings.languages'),
                "email" => trans('Configurations::Configurations/Settings.email'),
                "email" => trans('Configurations::Configurations/Settings.email')
            ]);

            if ($validate->fails()) {
//                StoneLanguage::displayNotificationProgress(
//                    'error',
//                    trans('Configurations::Configurations/Settings.errors_add'),
//                    trans('Configurations::Configurations/Settings.errors')
//                );
                dd($validate->fails());
                return back()->withInput()->withErrors($validate);
            }

            $setbase->email = $request->input('email');
            $file = $request->file('logo');


            if ($file != "") {
                $path = public_path() . '/images/upload/img';
                $filename = time() . '.' . $file->getClientOriginalExtension();
                if ($file->move($path, $filename)) {
                    $setbase->logo = $filename;
                }
            }

            $setbase->languages = $request->input('languages');
            $setbase->maintenanceweb = $request->input('maintenanceweb');
            $setbase->update();
            $titconfig = ["sitename", "keyword", "descriptionweb", "msgmaintenance"];

            foreach ($titconfig as $key => $value) {
                $setbasevar = new \App\Modules\Configurations\Models\confsettings_langs;
                $setbasevar->title_trans = $value;
                $setbasevar->id_ref = $setbase->id;
                $setbasevar->save();
            }

            $setbasevar->save();

            $input = $request->except('_token', 'email', 'logo', 'languages');
            $titconfig = ["sitename", "keyword", "descriptionweb", "msgmaintenance"];
            foreach ($titconfig as $key => $value) {
                foreach ($input as $key1 => $value1) {
                    $l3 = substr($key1, -3);
                    if (strpos($l3, '_') !== false) {
                        $rowlang = substr($key1, -2) . '_trans';
                    }
                    if ($key1 == $value . $l3) {
                        $setinsert = confsettings_langs::where('title_trans', $value)->where('id_ref', $setbase->id)->first();
                        $varset = $setinsert;
                        $setinsert->$rowlang = $value1;
                        $setinsert->update();
                    }
                }
            }//end foreach insert input in table confsettings_langs

            switch (App::getLocale()) {
                case "ar":
                    \Toastr::success(trans('Configurations::Configurations/Settings.success_add'), trans('Configurations::Configurations/Settings.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "fa":
                    \Toastr::success(trans('Configurations::Configurations/Settings.success_add'), trans('Configurations::Configurations/Settings.success'), ["positionClass" => "toast-top-left"]);
                    break;
                case "ur":
                    \Toastr::success(trans('Configurations::Configurations/Settings.success_add'), trans('Configurations::Configurations/Settings.success'), ["positionClass" => "toast-top-left"]);
                    break;
                default:
                    \Toastr::success(trans('Configurations::Configurations/Settings.success_add'), trans('Configurations::Configurations/Settings.success'), ["positionClass" => "toast-top-right"]);
            }
            return redirect()->route(app('urlBack') . '.config.settings.create');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
