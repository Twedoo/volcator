<?php

namespace Modules\Vye\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Twedoo\Volcator\Organizer\Models\Volcators;
use App\Transglobals;
use Artisan;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use VolcatorEngine;
use VolcatorLanguage;
use VolcatorTranslation;
use Route;
use Schema;
use Session;
use Validator;

class Vye extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Vue constructor.
     */

    public function __construct()
    {
        //
    }


    public function index()
    {
        return view('Vye::Builder.builder');
    }

    public function preview($volcator_application = null, $application = null)
    {
        return view('Vye::Builder.preview');
    }
}
