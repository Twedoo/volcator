<?php

namespace Twedoo\Stone\Models;

use Twedoo\StoneGuard\StoneGuardRole;
use Config;

class Role extends StoneGuardRole
{

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, Config::get('stoneGuard::permission_role_table'));
    }

}
