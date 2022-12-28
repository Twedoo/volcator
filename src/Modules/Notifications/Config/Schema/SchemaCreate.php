<?php
namespace Modules\Notifications\Config\Schema;

use Illuminate\Support\Facades\Schema;

class SchemaCreate
{

    public function runSchemas() {
        if (!Schema::hasTable(strtolower('notifications'))) {
            Schema::create('notifications', function ($table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->longtext('notification')->nullable();
                $table->string('route')->nullable();
                $table->integer('open')->nullable();
                $table->integer('space_id')->nullable();
                $table->integer('application_id')->nullable();
                $table->integer('user_id')->nullable();
                $table->integer('owner_id')->nullable();
                $table->longtext('collection')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable(strtolower('invitations'))) {
            Schema::create('invitations', function ($table) {
                $table->increments('id');
                $table->string('code')->nullable();
                $table->string('object')->nullable();
                $table->string('internal')->nullable();
                $table->string('accepted')->nullable();
                $table->string('type')->nullable(); //full-space 'space' or full-application 'application' or single-user 'user'
                $table->string('space_id')->nullable();
                $table->string('application_id')->nullable();
                $table->string('identification')->nullable();
                $table->integer('owner_id')->nullable();
                $table->longtext('collection')->nullable();
                $table->timestamps();
            });
        }
    }
}
