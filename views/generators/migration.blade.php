<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class VolcatorSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('{{ $volcatorsTable }}')) {
            Schema::create('{{ $volcatorsTable }}', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('display_name');
                $table->text('permission_name')->nullable();
                $table->string('menu_type')->nullable();
                $table->string('menu_icon')->nullable();
                $table->string('order')->nullable();
                $table->string('enable');
                $table->string('application')->nullable();
                $table->string('publish')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('{{ $parametersTable }}')) {
            Schema::create('{{ $parametersTable }}', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('value');
                $table->string('application')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('{{ $menuBackTable }}')) {
            Schema::create('{{ $menuBackTable }}', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name_menu');
                $table->string('route_link');
                $table->string('menu_icon')->nullable();
                $table->string('id_volcator')->nullable();
                $table->string('mb_permission')->nullable();
                $table->integer('parent_id')->nullable();
                $table->integer('lft')->nullable();
                $table->integer('rgt')->nullable();
                $table->integer('depth')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('{{ $languagesTable }}')) {
            Schema::create('{{ $languagesTable }}', function (Blueprint $table) {
                $table->increments('id');
                $table->string('languages');
                $table->string('code_lang');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('{{ $usersTable }}')) {
            Schema::create('{{ $usersTable }}', function (Blueprint $table) {
                $table->increments('id');
                $table->string('code');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('genre')->nullable();
                $table->string('avatar')->nullable();
                $table->boolean('status')->default(1);
                $table->string('type')->nullable();
                $table->boolean('depend')->default(0);
                $table->rememberToken();
                $table->timestamps();
            });
        }

        // Create table for storing roles
        if (!Schema::hasTable('{{ $rolesTable }}')) {
            Schema::create('{{ $rolesTable }}', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('display_name')->nullable();
                $table->string('description')->nullable();
                $table->string('type')->nullable();
                $table->timestamps();
            });
        }

        // Create table for associating roles to users (Many-to-Many)
        if (!Schema::hasTable('{{ $roleUserTable }}')) {
            Schema::create('{{ $roleUserTable }}', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->integer('role_id')->unsigned();
                $table->integer('application_id')->nullable();

                $table->foreign('user_id')->references('{{ $userKeyName }}')->on('{{ $usersTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('{{ $rolesTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
            });
        }

        // Create table for storing permissions
        if (!Schema::hasTable('{{ $permissionsTable }}')) {
            Schema::create('{{ $permissionsTable }}', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('id_volcator')->nullable();
                $table->string('display_name')->nullable();
                $table->string('description')->nullable();
                $table->timestamps();
            });
        }

        // Create table for associating permissions to roles (Many-to-Many)
        if (!Schema::hasTable('{{ $permissionRoleTable }}')) {
            Schema::create('{{ $permissionRoleTable }}', function (Blueprint $table) {
                $table->integer('permission_id')->unsigned();
                $table->integer('role_id')->unsigned();

                $table->foreign('permission_id')->references('id')->on('{{ $permissionsTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('{{ $rolesTable }}')
                ->onUpdate('cascade')->onDelete('cascade');

                $table->primary(['permission_id', 'role_id']);
            });
        }

        if (!Schema::hasTable('{{ $spacesTable }}')) {
            Schema::create('{{ $spacesTable }}', function (Blueprint $table) {
                $table->increments('id');
                $table->string('unique_identity')->unique();
                $table->string('name');
                $table->unsignedInteger('owner_id');
                $table->text('type')->nullable();
                $table->tinyInteger('enable')->default('1');
                $table->text('image')->nullable();
                $table->text('created_by')->nullable();
                $table->timestamps();
                });
            Schema::table('{{ $spacesTable }}', function (Blueprint $table) {
                $table->foreign('owner_id')->references('id')->on('{{ $usersTable }}');
            });
        };

        if (!Schema::hasTable('{{ $applicationsTable }}')) {
            Schema::create('{{ $applicationsTable }}', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('display_name')->nullable();
                $table->string('unique_identity')->unique();
                $table->string('type');
                $table->tinyInteger('enable')->default('1');
                $table->unsignedInteger('space_id');
                $table->text('image')->nullable();
                $table->text('created_by')->nullable();
                $table->timestamps();
            });
            Schema::table('{{ $applicationsTable }}', function (Blueprint $table) {
                $table->foreign('space_id')->references('id')->on('{{ $spacesTable }}');
            });
        };

        if (!Schema::hasTable('{{ $applicationsUserTable }}')) {
            Schema::create('{{ $applicationsUserTable }}', function (Blueprint $table) {
                $table->integer('application_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->integer('space_id')->nullable();
                $table->foreign('user_id')->references('id')->on('{{ $usersTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('application_id')->references('id')->on('{{ $applicationsTable }}')
                ->onUpdate('cascade')->onDelete('cascade');

                $table->primary(['application_id', 'user_id']);
            });
        }

        if (!Schema::hasTable('{{ $applicationsVolcatorTable }}')) {
            Schema::create('{{ $applicationsVolcatorTable }}', function (Blueprint $table) {
                $table->integer('application_id')->unsigned();
                $table->integer('volcator_id')->unsigned();
                $table->integer('space_id')->nullable();

                $table->foreign('volcator_id')->references('id')->on('{{ $volcatorsTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('application_id')->references('id')->on('{{ $applicationsTable }}');

                $table->primary(['application_id', 'volcator_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('{{ $parametersTable }}')) {
            Schema::drop('{{ $parametersTable }}');
        }
        if (Schema::hasTable('{{ $menuBackTable }}')) {
            Schema::drop('{{ $menuBackTable }}');
        }
        if (Schema::hasTable('{{ $languagesTable }}')) {
            Schema::drop('{{ $languagesTable }}');
        }
        if (Schema::hasTable('{{ $permissionRoleTable }}')) {
            Schema::drop('{{ $permissionRoleTable }}');
        }
        if (Schema::hasTable('{{ $permissionsTable }}')) {
            Schema::drop('{{ $permissionsTable }}');
        }
        if (Schema::hasTable('{{ $roleUserTable }}')) {
            Schema::drop('{{ $roleUserTable }}');
        }
        if (Schema::hasTable('{{ $rolesTable }}')) {
            Schema::drop('{{ $rolesTable }}');
        }
        if (Schema::hasTable('{{ $applicationsVolcatorTable }}')) {
            Schema::drop('{{ $applicationsVolcatorTable }}');
        }
        if (Schema::hasTable('{{ $applicationsUserTable }}')) {
            Schema::drop('{{ $applicationsUserTable }}');
        }
        if (Schema::hasTable('{{ $spacesTable }}')) {
            Schema::drop('{{ $spacesTable }}');
        }
        if (Schema::hasTable('{{ $applicationsTable }}')) {
            Schema::drop('{{ $applicationsTable }}');
        }
        if (Schema::hasTable('{{ $usersTable }}')) {
            Schema::drop('{{ $usersTable }}');
        }
    }
}
