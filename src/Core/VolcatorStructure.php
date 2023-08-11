<?php

/**
 * Created by Twedoo.
 * User: Houssem Maamria
 * Email: mail.houssem@gmail.com
 * Site: https://www.volcatorz.io
 * Desc: Twedoo ERP
 */

namespace Twedoo\Volcator\Core;

use Twedoo\Volcator\Core\Abstracts\AbstractModule;
use File;
use DB;
use App;
use VolcatorPath;
use VolcatorEngine;
use Route;
use Session;
use Validator;
use Schema;


class VolcatorStructure extends AbstractModule
{

    /**
     * VolcatorStructure constructor.
     */
    public function __construct()
    {
        Session()->forget('message');
        Session()->forget('messageErr');
    }

    /**
     * @return mixed
     */
    public function route()
    {
        return VolcatorEngine::getRouteLinkByCurrentUrlVolcator();
    }
}
