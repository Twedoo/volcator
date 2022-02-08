<?php

namespace Twedoo\Stone\Models;

use Twedoo\StoneGuard\StoneGuardPermission;
use Twedoo\Stone\InstallerModule\Models\modules;


class Permission extends StoneGuardPermission
{

    protected $fillable = [
        'name', 'display_name', 'description', 'id_module'
    ];

    protected $table = "permissions";

    public function getModule()
    {
        return $this->hasMany(modules::class, 'im_id', 'id_module');

    }
}
