<?php

namespace Twedoo\Stone\Organizer\Models;

use Illuminate\Database\Eloquent\Model;
use Twedoo\StoneGuard\Models\Permission;

class Stones extends Model
{
    protected $primaryKey = "id";
    protected $table = "stones";

    protected $fillable = ['id', 'name', 'display_name', 'permission_name', 'menu_type', 'menu_icon', 'order', 'enable', 'application', 'publish'];

    public function getPermissions()
    {
        return $this->belongsTo(Permission::class,  'id', 'id_stone');
    }
}
