<?php

namespace Twedoo\Stone\Core\Abstracts;

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
    public $js              = array();
    public $css             = array();
    public $dropTable;
    public $type;
    public $uninstall;

    public function __construct()
    {
        $this->type  = strtolower($this->type);
    }

    abstract public function injectStyle($key, $value);
    abstract public function getStyle();
    abstract public function route();
//    abstract public function goUpload($request);
//    abstract public function goPrepare($module);
//    abstract public function goBuilding($module);
//    abstract public function goReset($module);
//    abstract public function goUninstall($module);
//    abstract public function goStatus($module);
//    abstract public function goRemove($module);

}
