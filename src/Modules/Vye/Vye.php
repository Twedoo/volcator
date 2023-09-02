<?php

namespace Twedoo\Volcator\Vye;

use Twedoo\Volcator\Core\VolcatorStructure;

class Vye extends VolcatorStructure
{
    /**
     * Configurations constructor.
     */
    public function __construct()
    {
        $this->name = 'Vye';
        $this->nameDisplay = 'Volcator Vye application builder';
        $this->description = 'Build your application easy by Drag & Drop with ready modules';
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
    public function bootVolcator(): void
    {
        //
    }

    /**
     * @return array
     */
    public function js()
    {
        $js = null;
        $jsModule['module-1'] = self::route() == 'builder/vye' || self::route() == null ? 'dist/app.js' : '';
        $jsModule['module-2'] = self::route() == 'builder/vye' || self::route() == null ?
            preg_filter('/^/', 'dist/assets/', preg_grep('~\.(js)$~', scandir(__DIR__ . "/Media/dist/assets/")))
            : '';
        $jsModule = array_merge((array)$jsModule['module-1'], $jsModule['module-2']);
        foreach ($jsModule as $key => $jsFile) {
            $js['module-' . $key] = $jsFile;
        }
        return $js;
    }

    /**
     * @return array
     */
    public function css()
    {
        return self::route() == 'builder/vye' || self::route() == null ?
            preg_filter('/^/', 'dist/assets/', preg_grep('~\.(css)$~', scandir(__DIR__ . "/Media/dist/assets/")))
            : '';
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
