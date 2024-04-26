<?php

namespace Modules\Configurations\Controllers\Languages;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Twedoo\Volcator\Core\VolcatorTranslation;
use Twedoo\Volcator\Organizer\Models\Volcators;
use App\Transglobals;
use Artisan;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use VolcatorEngine;
use VolcatorLanguage;
use Route;
use Schema;
use Session;
use Validator;

class Languages extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Languages constructor.
     */

    public function __construct()
    {
        //
    }

    /**+
     * @return $this
     */
    public function index()
    {
        $moduleBack = [];
        $moduleFront = [];
        $getModuleType = VolcatorEngine::getAttributesEnable('typeModule');
        foreach ($getModuleType as $key => $value) {
            if ($value == 'back')
                $moduleBack[] = $key;

            if ($value == 'front')
                $moduleFront[] = $key;
        }

        $getFileBase = VolcatorTranslation::getFileBase(VolcatorLanguage::getDefaultLanguage(true));
        return view('Configurations::Languages.Languages')
            ->with('moduleBack', $moduleBack)
            ->with('getFileBase', $getFileBase)
            ->with('moduleFront', $moduleFront);
    }

    public function getTranslate(Request $request)
    {
        if (!$request->file)
            $file = null;
        else
            $file = $request->file;

        $getPath = URL::current();
        $getLanguages = VolcatorTranslation::getLanguages();
        $wordsToTrans = VolcatorTranslation::getFile($request->moduleTranslate, $request->lang, $file);
        $getFiles = VolcatorTranslation::getFiles($request->moduleTranslate, $request->lang, $file);
        $getKeyWord = VolcatorTranslation::getKeyFile($request->moduleTranslate, $request->lang, $file);
        $getModuleName = Volcators::where('id', $request->moduleTranslate)->first();

        return view('Configurations::Languages.Backend.transbackend', compact('getModuleName', $getModuleName))
            ->with('currentPath', $getPath)
            ->with('moduleTranslate', $request->moduleTranslate)
            ->with('wordsToTrans', $wordsToTrans)
            ->with('getLanguages', $getLanguages)
            ->with('getFiles', $getFiles)
            ->with('isLanaguage', $request->lang)
            ->with('isFile', $file)
            ->with('getKeyWord', $getKeyWord);
    }

    /**
     * @return $this
     */
    public function setWrod(Request $request)
    {

        $rules = [
            "file_twedoo" => "required ",
            "lang_twedoo" => "required ",
        ];

        $validate = Validator::make($request->all(), $rules);
        $validate->SetAttributeNames([
            "file_twedoo" => trans('Configurations::Configurations/Languages.nofile_select'),
            "lang_twedoo" => trans('Configurations::Configurations/Languages.nofile_select')
        ]);

        if ($validate->fails()) {
            VolcatorLanguage::displayNotificationProgress(
                'error',
                trans('Configurations::Configurations/Languages.data_empty'),
                trans('Configurations::Configurations/Languages.errors')
            );
            return back()->withInput()->withErrors($validate);
        }


        $data = '';
        if ($request->module_twedoo == 'langRresources')
            $path = resource_path() . '/lang/' . $request->lang_twedoo . '/' . $request->file_twedoo;
        else
            $path = app_path() . '/Modules/' . $request->module_twedoo . '/lang/' . $request->lang_twedoo . '/' . $request->module_twedoo . '/' . $request->file_twedoo;

        foreach ($request->all() as $key => $value) {

            if (!in_array($key, ['_token', 'module_twedoo', 'file_twedoo', 'lang_twedoo', 'value_word'])) {
                if ($key === 'keys_word') {
                    foreach ($value as $id_key => $value_key) {
                        foreach ($request->all()['value_word'] as $id_word => $value_word) {
                            if (isset($value_key) && $id_key == $id_word)
                                $data .= "         '" . $value_key . "'" . ' => ' . "'" . str_replace("'", "\'", $value_word) . "'," . PHP_EOL;
                        }
                    }
                } else {
                    $data .= "         '" . $key . "'" . ' => ' . "'" . str_replace("'", "\'", $value) . "'," . PHP_EOL;
                }
            }
        }
        return VolcatorTranslation::writeInFile($path, $data);
    }

    public function backlang()
    {
        $getModuleEnable = VolcatorEngine::getModuleEnable();
//        return view('Configurations::Languages.Backend.transbackend')->with('getModuleEnable',$getModuleEnable);
    }

    /**
     * @param Request $request
     * @param $table
     * @return $this
     */
    public function translate(Request $request, $table)
    {
        $rules = [
            "lang" => "required ",
        ];
        $validate = Validator::make($request->all(), $rules);
        $validate->SetAttributeNames([
            "lang" => PackagesHoolm::HoolmTRans('languages', 'transglobals')
        ]);
        if ($validate->fails()) {
            if (App::getLocale() == 'ar' || App::getLocale() == 'he') {
                \Toastr::error(PackagesHoolm::HoolmTRans('errors_lang', 'transglobals'), PackagesHoolm::HoolmTRans('errors', 'transglobals'), ["positionClass" => "toast-top-left"]);
            } else {
                \Toastr::error(PackagesHoolm::HoolmTRans('errors_lang', 'transglobals'), PackagesHoolm::HoolmTRans('errors', 'transglobals'), ["positionClass" => "toast-top-right"]);
            }
            Session::flash('messageErr', PackagesHoolm::HoolmTRans('errors_select_lang', 'transconfigurations'));
            return back()->withInput()->withErrors($validate);
        } else {
            $lang = $request->input('lang');
            $Rowtrans = DB::table(strtolower($table))->get();
            return view('Configurations::Languages.Backend.index', compact('lang', 'table'))->with('Rowtrans', $Rowtrans);
        }
    }

    /**
     * @param Request $request
     * @param $table
     * @param $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function intranslate(Request $request, $table, $lang)
    {
        $input = $request->all();
        foreach ($input as $key => $value) {
            if ($value == null) {
                Session::flash('messageErr', PackagesHoolm::HoolmTRans('erreur_translate_msg', 'transconfigurations'));
                if (App::getLocale() == 'ar' || App::getLocale() == 'he') {
                    \Toastr::error(PackagesHoolm::HoolmTRans('errors_add', 'transglobals'), PackagesHoolm::HoolmTRans('errors', 'transglobals'), ["positionClass" => "toast-top-left"]);
                } else {
                    \Toastr::error(PackagesHoolm::HoolmTRans('errors_add', 'transglobals'), PackagesHoolm::HoolmTRans('errors', 'transglobals'), ["positionClass" => "toast-top-right"]);
                }
                return back();
            } else {
                DB::table(strtolower($table))->where('title_trans', $key)->update(array($lang => $value));
            }
        }
        Session::flash('message', PackagesHoolm::HoolmTRans('succes_translate_msg', 'transconfigurations'));
        if (App::getLocale() == 'ar' || App::getLocale() == 'he') {
            \Toastr::success(PackagesHoolm::HoolmTRans('success_add', 'transglobals'), PackagesHoolm::HoolmTRans('success', 'transglobals'), ["positionClass" => "toast-top-left"]);
        } else {
            \Toastr::success(PackagesHoolm::HoolmTRans('success_add', 'transglobals'), PackagesHoolm::HoolmTRans('success', 'transglobals'), ["positionClass" => "toast-top-right"]);
        }
        return back();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function frontlang()
    {

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
