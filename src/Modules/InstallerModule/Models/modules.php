<?php

namespace Twedoo\Stone\InstallerModule\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class modules extends Model
{
    //
    protected $primaryKey = "im_id";
    protected $table = "modules";

    protected $fillable = ['im_id', 'im_name_modules', 'im_name_modules_display', 'im_menu_icon', 'im_permission', 'im_status', 'im_order'];


    public function getPermissions()
    {
        return $this->belongsTo(Permission::class,  'im_id', 'id_module');
    }


}
