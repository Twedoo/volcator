<?php
/**
 * Created by PhpStorm.
 * User: proox
 * Date: 16/09/18
 * Time: 22:46
 */

namespace Twedoo\Stone\Applications;

use Illuminate\Database\Schema\Blueprint;
use Artisan;
use StonePath;
use StoneStructure;
use StoneEngine;
use StoneTranslation;
use Route;
use Schema;
use Session;
use Validation;

class Applications extends StoneStructure
{
    /**
     * Configurations constructor.
     */
    public function __construct()
    {
        $this->name = 'Applications';
        $this->nameDisplay = 'Multi Applications';
        $this->description = 'Managment Multi applications for each users';
        $this->author = 'Houssem Maamria';
        $this->menuTranslate = 'sidebar/sidebar.php';
        $this->typeModule = 'back';
        $this->btnParameters = true;
        $this->btnEnable = true;
        $this->dropTable = "";
        $this->btnReset = true;
        $this->btnUninstall = true;
        $this->btnRemove = true;
        $this->categoryMenu = 'standar_menu';
        $this->dropTable = "applications_user, applications";
    }

    /**
     * @param $model
     * @return mixed
     */
    public function building($module)
    {

        if (!StoneEngine::isInstallModule($module)) {


            if (!Schema::hasTable(strtolower('applications'))) {
                Schema::create('applications', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('name')->unique();
                    $table->string('display_name')->nullable();
                    $table->string('type')->nullable();
                    $table->timestamps();
                });
            };

            if (!Schema::hasTable(strtolower('applications_user'))) {
                // Create table for associating roles to users (Many-to-Many)
                Schema::create('applications_user', function (Blueprint $table) {
                    $table->integer('application_id')->unsigned();
                    $table->integer('user_id')->unsigned();

                    $table->foreign('user_id')->references('id')->on('users')
                        ->onUpdate('cascade')->onDelete('cascade');
                    $table->foreign('application_id')->references('id')->on('applications')
                        ->onUpdate('cascade')->onDelete('cascade');

                    $table->primary(['application_id', 'user_id']);
                });
            }

            //Artisan::call('db:seed');
            Artisan::call('db:seed', [
                '--class' => 'Twedoo\\Stone\\Modules\\'.$module.'\\Models\\seeder\\applicationsTableSeeder'
            ]);
        }
        StoneTranslation::setTranslateModules($this->name, $this->menuTranslate);
    }

    public function js()
    {

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
