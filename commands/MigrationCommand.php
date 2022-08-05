<?php namespace Twedoo\Stone;

/**
 * This file is part of StoneGuard,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Twedoo\stone
 */

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Session;
use Artisan;

class MigrationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'stone:migration {--p|--purge-database=false : delete all tables and launch new migration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration following the stone specifications.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->handle();
    }

    /**
     * Execute the console command for Laravel 5.5+.
     *
     * @return false
     */
    public function handle()
    {
        $this->laravel->view->addNamespace('stone', substr(__DIR__, 0, -8) . 'views');
        $purge = $this->options()['purge-database'];
        $spacesTable = Config::get('stone.spaces_table');
        $applicationsTable = Config::get('stone.applications_table');
        $applicationsStoneTable = Config::get('stone.applications_stone_table');
        $applicationsUserTable = Config::get('stone.applications_user_table');
        $stonesTable = Config::get('stone.stones_table');
        $parametersTable = Config::get('stone.parameters_table');
        $menuBackTable = Config::get('stone.menuBacks_table');
        $languagesTable = Config::get('stone.languages_table');
        $rolesTable = Config::get('stone.roles_table');
        $roleUserTable = Config::get('stone.role_user_table');
        $permissionsTable = Config::get('stone.permissions_table');
        $permissionRoleTable = Config::get('stone.permission_role_table');

        $this->line('');
        $this->info("Tables: $spacesTable, $applicationsTable, $applicationsStoneTable, $applicationsUserTable, $rolesTable, $roleUserTable, $permissionsTable, $permissionRoleTable, $stonesTable, $parametersTable, $menuBackTable, $languagesTable");

        $message = "A migration that creates '$spacesTable', '$applicationsTable', '$applicationsStoneTable', '$applicationsUserTable', '$rolesTable', '$roleUserTable', '$permissionsTable', '$permissionRoleTable', '$stonesTable', '$parametersTable', '$menuBackTable', '$languagesTable'" .
            " tables will be created in database/migrations directory";

        $this->comment($message);
        $this->line('');

        if ($this->confirm("Proceed with the migration creation? [Yes|no]", "Yes")) {

            $this->line('');
            if ($purge) {
                $this->clearMigration("_stone_setup_tables", true, true);
            }
            $this->info("Creating migration...");
            if ($this->createMigration($spacesTable, $applicationsTable, $applicationsStoneTable, $applicationsUserTable, $rolesTable, $roleUserTable, $permissionsTable, $permissionRoleTable, $stonesTable, $parametersTable, $menuBackTable, $languagesTable)) {
                $this->info("Migration successfully created!");
                $this->clearMigration("_create_users_table"); 
            } else {
                $this->error(
                    "Couldn't create migration.\n Check the write permissions" .
                    " within the database/migrations directory."
                );
            }

            $this->line('');

        }
        $this->callSilent('vendor:publish', ['--provider' => 'Twedoo\Stone\StoneServiceProvider']);
        $this->info('Twedoo\Stone was installed successfully.');
        Session::flush();
    }

    /**
     * Create the migration.
     *
     * @param string $name
     *
     * @return bool
     */
    protected function createMigration($spacesTable, $applicationsTable, $applicationsStoneTable, $applicationsUserTable, $rolesTable, $roleUserTable, $permissionsTable, $permissionRoleTable, $stonesTable, $parametersTable, $menuBackTable, $languagesTable)
    {
        $migrationFile = base_path("/database/migrations") . "/" . date('Y_m_d_His') . "_stone_setup_tables.php";

        $userModelName = Config::get('auth.providers.users.model');
        $userModel = new $userModelName();
        $usersTable = $userModel->getTable();
        $userKeyName = $userModel->getKeyName();

        $data = compact('spacesTable', 'applicationsTable', 'applicationsStoneTable', 'applicationsUserTable', 'rolesTable', 'roleUserTable', 'permissionsTable', 'permissionRoleTable', 'parametersTable', 'stonesTable', 'menuBackTable', 'languagesTable', 'usersTable', 'userKeyName');

        $output = $this->laravel->view->make('stone::generators.migration')->with($data)->render();

        if (!file_exists($migrationFile) && $fs = fopen($migrationFile, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            return true;
        }

        return false;
    }

    protected function clearMigration($pattern, $force = false, $debug = false)
    {
        if ($force) {
            Artisan::call('db:wipe', ['--force' => true]);
        }

        $dir = base_path("/database/migrations") . "/";
        $files = scandir(base_path("/database/migrations") . "/");
        if (is_array($files)) {
            foreach ($files as $file) {
                if (is_file($dir . $file) && strpos($file, $pattern) !== false) {
                    unlink($dir . $file);
                }
            }
        }
        if ($debug) {
            $this->info("Stone successfully purge all tables!");
        }
    }
}
