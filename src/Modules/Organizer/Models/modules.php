<?php

namespace Twedoo\Stone\Organizer\Models;

use Illuminate\Database\Eloquent\Model;
use Twedoo\StoneGuard\Models\Permission;

class modules extends Model
{
    //
    protected $primaryKey = "im_id";
    protected $table = "modules";

    protected $fillable = ['im_id', 'im_name_modules', 'im_name_modules_display', 'im_menu_icon', 'im_permission', 'im_status', 'im_order', 'application'];


    public function getPermissions()
    {
        return $this->belongsTo(Permission::class,  'im_id', 'id_module');
    }


}
