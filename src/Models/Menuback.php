<?php

namespace Twedoo\Stone\Models;

use Illuminate\Database\Eloquent\Model;

class Menuback extends Model
{
    protected $fillable = [
        'name_menu', 'route_link', 'id_stone', 'mb_permission'
    ];
}
