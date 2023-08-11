<?php
namespace Twedoo\Volcator\Modules\Configurations\Models\seeder;

use Twedoo\Volcator\Models\Menuback;
use Twedoo\Volcator\Modules\Configurations\Models\confsettings;
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
            confsettings::create($value);
        }
    }

}
