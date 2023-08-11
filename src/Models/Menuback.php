<?php

namespace Twedoo\Volcator\Models;

use Illuminate\Database\Eloquent\Model;

class Menuback extends Model
{
    protected $fillable = [
        'name_menu', 'route_link', 'id_volcator', 'mb_permission'
    ];
}
