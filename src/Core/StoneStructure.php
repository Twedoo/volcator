<?php

/**
 * Created by Twedoo.
 * User: Houssem Maamria
 * Email: mail.houssem@gmail.com
 * Site: https://www.stonez.io
 * Desc: Twedoo ERP
 */

namespace Twedoo\Stone\Core;

use Twedoo\Stone\Core\Abstracts\AbstractModule;
use File;
use DB;
use App;
use StonePath;
use StoneEngine;
use Route;
use Session;
use Validator;
use Schema;


class StoneStructure extends AbstractModule
{

    /**
     * StoneStructure constructor.
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
        return StoneEngine::getRouteLinkByCurrentUrlStone();
    }
}
