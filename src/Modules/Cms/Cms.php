<?php

namespace Twedoo\Stone\Cms;

use Artisan;
use StonePath;
use StoneStructure;
use StoneEngine;
use StoneTranslation;
use Route;
use Schema;
use Session;
use Validation;

class Cms extends StoneStructure
{
    /**
     * Configurations constructor.
     */
    public function __construct()
    {
        $this->name = 'Cms';
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
        $this->categoryMenu = 'cms_menu';
    }

    /**
     * @param $model
     * @return mixed
     */
    public function building($module)
    {

        if (!StoneEngine::isInstallModule($module)) {
            Artisan::call('db:seed', [
                '--class' => 'Twedoo\\Stone\\Modules\\'.$module.'\\Models\\seeder\\cmsTableSeeder'
            ]);
        }

        StoneTranslation::setTranslateModules($this->name, $this->menuTranslate);
    }

    public function js()
    {

    }


    public function getParameters($idModule, $statusModule)
    {
        return StoneEngine::displayParameters(
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
