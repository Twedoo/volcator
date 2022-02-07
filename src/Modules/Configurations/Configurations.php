<?php

namespace Twedoo\Stone\Configurations;

use App\Modules\InstallModules\Models\toconfigurations;
use Artisan;
use getPath;
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
     * @param $model
     * @return mixed
     */
    public function building($module)
    {

        if (!StoneEngine::isInstallModule($module)) {

            if (!Schema::hasTable(strtolower('confsettings'))) {
                Schema::create('confsettings', function ($table) {
                    $table->increments('id');
                    $table->string('sitename');
                    $table->string('keyword');
                    $table->longtext('descriptionweb');
                    $table->string('logo')->nullable();
                    $table->string('languages');
                    $table->string('email');
                    $table->string('maintenanceweb')->nullable();
                    $table->longtext('msgmaintenance')->nullable();
                    $table->timestamps();
                });
            };

            if (!Schema::hasTable(strtolower('confsettings_langs'))) {
                Schema::create('confsettings_langs', function ($table) {
                    $table->increments('id');
                    $table->string('title_trans');
                    $table->string('id_ref');
                    $table->string('en_trans')->nullable();
                    $table->string('ar_trans')->nullable();
                    $table->string('de_trans')->nullable();
                    $table->string('fr_trans')->nullable();
                    $table->string('it_trans')->nullable();
                    $table->string('es_trans')->nullable();
                    $table->string('ru_trans')->nullable();
                    $table->string('cn_trans')->nullable();
                    $table->string('ja_trans')->nullable();
                    $table->string('pt_trans')->nullable();
                    $table->string('tr_trans')->nullable();
                    $table->string('in_trans')->nullable();
                    $table->string('id_trans')->nullable();
                    $table->string('bn_trans')->nullable();
                    $table->string('fa_trans')->nullable();
                    $table->string('uk_trans')->nullable();
                    $table->string('ur_trans')->nullable();
                    $table->string('vi_trans')->nullable();
                    $table->string('sv_trans')->nullable();
                    $table->timestamps();
                });
            }

            //Artisan::call('db:seed');
            Artisan::call('db:seed', [
                '--class' => 'Twedoo\\Stone\\Modules\\'.$module.'\\Models\\seeder\\configurationsTableSeeder'
            ]);
        }

        StoneTranslation::setTranslateModules($this->name, $this->menuTranslate);
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
