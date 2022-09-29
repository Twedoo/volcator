<?php namespace Twedoo\Stone;

/**
 * This file is part of StoneGuard,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Twedoo\stone
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
    protected $name = 'stone:seeder';

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
     * @return void
     */
    public function handle()
    {
        $this->laravel->view->addNamespace('stone', substr(__DIR__, 0, -8).'views');
        $this->line('');
        $this->info( "Seed: database/seeders/StoneTableSeeder.php");
        $message = "A migration that creates StoneTableSeeder.";
        $this->comment($message);
        $this->line('');

        if ($this->confirm("Proceed with the seeder creation? [Yes|no]", "Yes")) {
            $this->line('');
            Artisan::call('db:seed', ['--class' => "Twedoo\\Stone\\database\\seeders\\StoneTableSeeder"]);
            $this->line('');
        }

        $module = 'Configurations';
        \App::call('Twedoo\\Stone\\Organizer\\Organizer@preBuildingConsole', compact('module'));

        $module = 'Notifications';
        \App::call('Twedoo\\Stone\\Organizer\\Organizer@preBuildingConsole', compact('module'));

        $module = 'Brick';
        \App::call('Twedoo\\Stone\\Organizer\\Organizer@preBuildingConsole', compact('module'));
    }
}
