<?php
namespace Twedoo\Stone\Modules\Configurations\Models\seeder;

use Twedoo\Stone\Models\Menuback;
use Twedoo\Stone\Modules\Configurations\Models\confsettings;
use Twedoo\Stone\Organizer\Models\Stones;
use Twedoo\StoneGuard\Models\Permission;
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
