<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class StoneSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('{{ $modulesTable }}', function (Blueprint $table) {
            $table->increments('im_id');
            $table->string('im_name_modules');
            $table->string('im_name_modules_display');
            $table->string('im_menu_icon');
            $table->string('im_permission');
            $table->string('im_status');
            $table->string('im_order')->nullable();
            $table->timestamps();
        });

        Schema::create('{{ $parametersTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('{{ $menubackTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_menu');
            $table->string('route_link');
            $table->string('menu_icon')->nullable();
            $table->string('id_module')->nullable();
            $table->string('mb_permission')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();
            $table->timestamps();
        });

        Schema::create('{{ $languagesTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('languages');
            $table->string('code_lang');
            $table->timestamps();
        });

        Schema::create('{{ $usersTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('genre')->nullable();
            $table->string('date')->nullable();
            $table->string('avatar')->nullable();
            $table->string('statut')->nullable();
            $table->string('type')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Create table for storing roles
        Schema::create('{{ $rolesTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->string('id_creator')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('{{ $roleUserTable }}', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('{{ $userKeyName }}')->on('{{ $usersTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('{{ $rolesTable }}')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('{{ $permissionsTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('id_module')->nullable();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('{{ $permissionRoleTable }}', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('{{ $permissionsTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('{{ $rolesTable }}')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('{{ $parametersTable }}');
        Schema::drop('{{ $menubackTable }}');
        Schema::drop('{{ $languagesTable }}');
        Schema::drop('{{ $permissionRoleTable }}');
        Schema::drop('{{ $permissionsTable }}');
        Schema::drop('{{ $roleUserTable }}');
        Schema::drop('{{ $rolesTable }}');
        Schema::drop('{{ $usersTable }}');
    }
}
