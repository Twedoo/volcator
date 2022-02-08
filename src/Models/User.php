<?php

namespace Twedoo\Stone\Models;

use Twedoo\Stone\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Laravel\Sanctum\HasApiTokens;
use Twedoo\StoneGuard\Traits\StoneGuardUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use StoneGuardUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, Config::get('stoneGuard::assigned_roles_table'));
    }

    /**
     * @return mixed
     */
    public function setCurrentIdRole()
    {
        return $this->roles->pluck('id', 'id')->first();
    }
}
