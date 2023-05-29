<?php

namespace Twedoo\Volcator\Modules\Configurations\Models;
use Illuminate\Database\Eloquent\Model;

class confsettings extends Model
{
    //
    protected $fillable = [
        'sitename', 'keyword', 'descriptionweb', 'logo', 'languages', 'email', 'maintenanceweb', 'msgmaintenance', 'application'
    ];
}
