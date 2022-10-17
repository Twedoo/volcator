<?php

namespace Twedoo\Stone\Notifications;

use Artisan;
use getPath;
use StoneStructure;
use StoneEngine;
use StoneTranslation;
use Route;
use Schema;
use Session;
use Validation;

class Notifications extends StoneStructure
{
    /**
     * Configurations constructor.
     */
    public function __construct()
    {
        $this->name = 'Notifications';
        $this->nameDisplay = 'Notifications global';
        $this->description = 'Notifications Generale System Stone';
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
    public function bootStone() : void
    {
        //
    }

    public function js()
    {
        //
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
