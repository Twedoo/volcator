<?php

namespace Twedoo\Volcator\Core\Abstracts;

/**
 * Created by Twedoo.
 * User: Houssem Maamria
 * Email: mail.houssem@gmail.com
 * Site: https://www.twedoo.com
 * Desc: Twedoo ERP
 */

abstract class AbstractModule
{
    public $name;
    public $nameDisplay;
    public $description;
    public $author;
    public $marketplace = true;
    public $categoryMenu    = 'all_menu';
    public $menuTranslate;
    public $typeModule;
    public $btnParameters   = false;
    public $btnRemove       = false;
    public $btnUninstall    = false;
    public $btnReset        = false;
    public $btnEnable       = false;
    public $js              = [];
    public $css             = [];
    public $dropTable;
    public $uninstall;

    public function __construct()
    {
        //
    }

    abstract public function route();
}
