<?php

namespace Modules\Vye\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Twedoo\Volcator\Core\VolcatorApplication;
use Twedoo\Volcator\Modules\Applications\Models\Applications;
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

class VyeApi extends Controller
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

    /**
     * @param $current_application_core_id
     * @param $application_vye_id
     * @return array
     */
    public function assignVyeToCurrentApplication($current_application_core_id, $application_vye_id)
    {
        $user = auth('sanctum')->user()->id;
        $isAuthorize = VolcatorApplication::isUserInCurrentApplicationApi($user, (array) $current_application_core_id);

        if ($isAuthorize) {
            $application = Applications::find($current_application_core_id);
            $application->update([
                'active_vye'=> $application_vye_id
            ]);
            $result = true;
        } else {
            $result = false;
        }

        return [
            "status" => $result
        ];
    }
}
