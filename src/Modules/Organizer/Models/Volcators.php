<?php

namespace Twedoo\Volcator\Organizer\Models;

use Illuminate\Database\Eloquent\Model;
use Twedoo\VolcatorGuard\Models\Permission;

class Volcators extends Model
{
    protected $primaryKey = "id";
    protected $table = "volcators";

    protected $fillable = ['id', 'name', 'display_name', 'permission_name', 'menu_type', 'menu_icon', 'order', 'enable', 'application', 'publish'];

    public function getPermissions()
    {
        return $this->belongsTo(Permission::class,  'id', 'id_volcator');
    }
}
