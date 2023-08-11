<?php
/**
 * Created by PhpStorm.
 * User: proox
 * Date: 16/09/18
 * Time: 22:46
 */

namespace Twedoo\Volcator\Applications;

use Illuminate\Database\Schema\Blueprint;
use Artisan;
use VolcatorPath;
use VolcatorStructure;
use VolcatorEngine;
use VolcatorTranslation;
use Route;
use Schema;
use Session;
use Validation;

class Applications extends VolcatorStructure
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
        $this->categoryMenu = 'standard_menu';
        $this->dropTable = "applications_user, applications";
    }

    /**
     * Void
     */
    public function bootVolcator() : void
    {
        //
    }

    /**
     * @param $model
     * @return mixed
     */
    public function building($module)
    {

        if (!VolcatorEngine::isActiveVolcatorInCurrentApplication($module)) {

            if (!Schema::hasTable(strtolower('spaces'))) {
                Schema::create('spaces', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('unique_identity')->unique();
                    $table->string('name');
                    $table->unsignedInteger('owner_id');
                    $table->text('image')->nullable();
                    $table->timestamps();
                });
                Schema::table('users', function (Blueprint $table) {
                    $table->foreign('owner_id')->references('id')->on('users');
                });
            };

            if (!Schema::hasTable(strtolower('applications'))) {
                Schema::create('applications', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('name');
                    $table->string('display_name')->nullable();
                    $table->string('unique_identity')->unique();
                    $table->string('type');
                    $table->unsignedInteger('space_id');
                    $table->text('image')->nullable();
                    $table->timestamps();
                });
                Schema::table('applications', function (Blueprint $table) {
                    $table->foreign('space_id')->references('id')->on('spaces');
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

            if (!Schema::hasTable(strtolower('applications_module'))) {
                // Create table for associating roles to users (Many-to-Many)
                Schema::create('applications_module', function (Blueprint $table) {
                    $table->integer('application_id')->unsigned();
                    $table->integer('module_id')->unsigned();

                    $table->foreign('module_id')->references('im_id')->on('modules')
                        ->onUpdate('cascade')->onDelete('cascade');
                    $table->foreign('application_id')->references('id')->on('applications');

                    $table->primary(['application_id', 'module_id']);
                });
            }


            //Artisan::call('db:seed');
            Artisan::call('db:seed', [
                '--class' => 'Twedoo\\Volcator\\Modules\\'.$module.'\\Models\\seeder\\applicationsTableSeeder'
            ]);
        }
        VolcatorTranslation::setTranslateModules($this->name, $this->menuTranslate);
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
