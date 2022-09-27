<?php

namespace Twedoo\Stone\Vue;

use StoneStructure;

class Vue extends StoneStructure
{
    /**
     * Configurations constructor.
     */
    public function __construct()
    {
        $this->name = 'Vue';
        $this->nameDisplay = 'Stone Vue CMS Drag & Drop';
        $this->description = 'Builder front website with zero code';
        $this->author = 'Houssem Maamria';
        $this->menuTranslate = 'sidebar/sidebar.php';
        $this->typeModule = 'back';
        $this->btnParameters = true;
        $this->btnEnable = true;
        $this->btnReset = true;
        $this->btnUninstall = true;
        $this->btnRemove = true;
        $this->categoryMenu = 'CMS_MENU';
    }

    /**
     * Void
     */
    public function bootStone() : void
    {
        //
    }

    /**
     * @return array
     */
    public function js()
    {
        $js[] = null;
        return $js;
    }

    /**
     * @return array
     */
    public function css()
    {
        $css[] = null;
        return $css;
    }

    /**
     * @param $idModule
     * @param $statusModule
     * @return mixed
     */
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
