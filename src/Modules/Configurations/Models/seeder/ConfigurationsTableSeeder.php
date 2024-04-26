<?php
namespace Twedoo\Volcator\Modules\Configurations\Models\seeder;

use Twedoo\Volcator\Models\Menuback;
use Twedoo\Volcator\Modules\Configurations\Models\confsettings;
use Twedoo\Volcator\Modules\Configurations\Models\Theme;
use Twedoo\Volcator\Organizer\Models\Volcators;
use Twedoo\VolcatorGuard\Models\Permission;
use Illuminate\Database\Seeder;
use DB;

class ConfigurationsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $confsettings = [
            [
                'sitename' => "sitename",
                'keyword' => "keyword",
                'descriptionweb' => "descriptionweb",
                'logo' => "",
                'languages' => "",
                'email' => "",
                'maintenanceweb' => "",
                'msgmaintenance' => "msgmaintenance",
                'application' => 'main'
            ]
        ];

        foreach ($confsettings as $key => $value) {
            $createdConfSetting = confsettings::create($value);
            $lastInsertedId = $createdConfSetting->id;
        }

        $is_configurations = Volcators::where('name', 'Configurations')->first();

        // Add default theme
        $themes = [
            [
                'name' => "volcator",
                'scope' => "back",
                'is_public' => 1,
                'is_delete' => 0,
                'volcator_id' => $is_configurations->id
            ],
            [
                'name' => "bluevolcator",
                'scope' => "front",
                'is_public' => 1,
                'is_delete' => 0,
                'volcator_id' => $is_configurations->id
            ]
        ];
        foreach ($themes as $key => $value) {
            Theme::create($value);
        }
    }

}
