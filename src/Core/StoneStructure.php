<?php

/**
 * Created by Twedoo.
 * User: Houssem Maamria
 * Email: mail.houssem@gmail.com
 * Site: https://www.twedoo.com
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


    public function __construct()
    {
        Session()->forget('message');
        Session()->forget('messageErr');
    }

    public function __set($key, $value)
    {
        $this->injectStyle($key, $value);// TODO: Implement __set() method.
    }

    public function injectStyle($key, $value)
    {
        if($value)
            $this->{$this->type}["'".$key."'"] = StonePath::pathMedia($this->name) . $value;
    }

    public function getStyle()
    {
        return $this->{strtolower($this->type)};
    }

    public function route()
    {
        return StoneEngine::getRouteModule();
    }
}
