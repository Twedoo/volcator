<?php

namespace Modules\Vue\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Twedoo\Stone\Organizer\Models\Stones;
use App\Transglobals;
use Artisan;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use StoneEngine;
use StoneLanguage;
use StoneTranslation;
use Route;
use Schema;
use Session;
use Validator;


class Vue extends Controller
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
        return 'Hello Vue';
    }
}
