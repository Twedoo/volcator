<?php

namespace Twedoo\Stone\Configurations;

use App\Modules\InstallModules\Models\toconfigurations;
use Artisan;
use getPath;
use Modules\Configurations\Component\Schema\SchemaCreate;
use StoneStructure;
use StoneEngine;
use StoneTranslation;
use Route;
use Schema;
use Session;
use Validation;

class Configurations extends StoneStructure
{
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
    public function bootStone() : void
    {
        //
    }

    public function js()
    {
        $this->type = __FUNCTION__;
        $this->{'1'} = $this->route() == 'settings' ? 'js/settings.js' : '';
        $this->{'1'} = $this->route() == 'languages' ? 'js/languages.js' : '';
        return $this->getStyle();
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
