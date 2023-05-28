<?php

namespace Twedoo\Volcator\Notifications;

use Artisan;
use getPath;
use VolcatorStructure;
use VolcatorEngine;
use VolcatorTranslation;
use Route;
use Schema;
use Session;
use Validation;

class Notifications extends VolcatorStructure
{
    /**
     * Configurations constructor.
     */
    public function __construct()
    {
        $this->name = 'Notifications';
        $this->nameDisplay = 'Notifications global';
        $this->description = 'Notifications Generale System Volcator';
        $this->author = 'Houssem Maamria';
        $this->menuTranslate = 'sidebar/sidebar.php';
        $this->typeModule = 'back';
        $this->btnParameters = true;
        $this->btnEnable = true;
        $this->btnReset = true;
        $this->btnUninstall = true;
        $this->btnRemove = true;
        $this->dropTable = "notifications, invitations";
        $this->categoryMenu = 'notifications_menu';
    }

    /**
     * Void
     */
    public function bootVolcator() : void
    {
        //
    }

    public function js()
    {
        //
    }


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
