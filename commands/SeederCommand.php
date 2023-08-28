<?php namespace Twedoo\Volcator;

/**
 * This file is part of VolcatorGuard,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Twedoo\volcator
 */

use Illuminate\Console\Command;
use Artisan;
use Illuminate\Support\Facades\Config;

class SeederCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'volcator:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration following the volcator specifications.';

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
     * @return void
     */
    public function handle()
    {
        $this->laravel->view->addNamespace('volcator', substr(__DIR__, 0, -8).'views');
        $this->line('');
        $this->info( "Seed: database/seeders/VolcatorTableSeeder.php");
        $message = "A migration that creates VolcatorTableSeeder.";
        $this->comment($message);
        $this->line('');

        if ($this->confirm("Proceed with the seeder creation? [Yes|no]", "Yes")) {
            $this->line('');
            Artisan::call('db:seed', ['--class' => "Twedoo\\Volcator\\database\\seeders\\VolcatorTableSeeder"]);
            $this->line('');
        }

        $module = 'Configurations';
        \App::call('Twedoo\\Volcator\\Organizer\\Organizer@preBuildingConsole', compact('module'));

        $module = 'Notifications';
        \App::call('Twedoo\\Volcator\\Organizer\\Organizer@preBuildingConsole', compact('module'));

        if (file_exists(__DIR__ . '/../src/Modules/Vye/Vye.php')) {
            $module = 'Vye';
            \App::call('Twedoo\\Volcator\\Organizer\\Organizer@preBuildingConsole', compact('module'));
        }
    }
}
