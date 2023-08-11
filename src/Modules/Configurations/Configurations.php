<?php

namespace Twedoo\Volcator\Configurations;

use App\Modules\InstallModules\Models\toconfigurations;
use Artisan;
use getPath;
use Modules\Configurations\Component\Schema\SchemaCreate;
use VolcatorStructure;
use VolcatorEngine;
use VolcatorTranslation;
use Route;
use Schema;
use Session;
use Validation;

class Configurations extends VolcatorStructure
{
    /**
     * @var string
     */
    public $nameDisplay;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $author;
    /**
     * @var string
     */
    public $menuTranslate;
    /**
     * @var string
     */
    public $typeModule;
    /**
     * @var bool
     */
    public $btnParameters;
    /**
     * @var bool
     */
    public $btnEnable;
    /**
     * @var bool
     */
    public $btnReset;
    /**
     * @var bool
     */
    public $btnUninstall;
    /**
     * @var bool
     */
    public $btnRemove;
    /**
     * @var string
     */
    public $dropTable;
    /**
     * @var string
     */
    public $categoryMenu;
    /**
     * @var string
     */
    public $type;

    /**
     * Configurations constructor.
     */
    public function __construct()
    {
        $this->name = 'Configurations';
        $this->nameDisplay = 'Configurations global';
        $this->description = 'Managment settings generale cms';
        $this->author = 'Houssem Maamria';
        $this->menuTranslate = 'sidebar/sidebar.php';
        $this->typeModule = 'back';
        $this->btnParameters = true;
        $this->btnEnable = true;
        $this->btnReset = true;
        $this->btnUninstall = true;
        $this->btnRemove = true;
        $this->dropTable = "confsettings, confsettings_langs";
        $this->categoryMenu = 'configuration_menu';
    }

    /**
     * Void
     */
    public function bootVolcator() : void
    {
        //
    }

    /**
     * @return array
     */
    public function js()
    {
        $js[] = self::route() == 'settings' ? 'js/settings.js' : '';
        return $js;
    }

    /**
     * @return array
     */
    public function css()
    {
        $css[] = self::route() == 'settings' ? 'css/style.css' : '';
        return $css;
    }

    /**
     * @param $idModule
     * @param $statusModule
     * @return mixed
     */
    public function getParameters($idModule, $statusModule)
    {
        return VolcatorEngine::displayParameters(
            $idModule,
            $statusModule,
            $this->name,
            $this->btnParameters,
            $this->btnEnable,
            $this->btnReset,
            $this->btnUninstall,
            $this->btnRemove
        );
    }

    /**
     * @param $id
     * @param $module
     * @return string
     */
    public function parameters($id, $module)
    {
        return view($this->name . "::Parameters.parameters",
            compact(
                'id',
                'module'
            )
        );
    }
}
