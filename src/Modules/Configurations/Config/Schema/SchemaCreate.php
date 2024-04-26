<?php
namespace Modules\Configurations\Config\Schema;

use Illuminate\Support\Facades\Schema;
use Twedoo\Volcator\Modules\Configurations\Models\seeder\ConfigurationsTableSeeder;
class SchemaCreate
{

    public function runSchemas() {
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
                $table->string('application')->nullable();
                $table->timestamps();
            });
        }

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
                $table->string('application')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable(strtolower('themes'))) {
            Schema::create('themes', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->string('scope');
                $table->boolean('is_public')->default(true);
                $table->boolean('is_delete')->nullable()->default(false);
                $table->integer('volcator_id');
                $table->timestamps();
            });
        }


        $seeder = new ConfigurationsTableSeeder();
        $seeder->run();
    }
}
