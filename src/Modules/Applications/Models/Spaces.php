<?php

namespace Twedoo\Stone\Modules\Applications\Models;

use Illuminate\Database\Eloquent\Model;
use Twedoo\Stone\Organizer\Models\modules;
use Twedoo\StoneGuard\Models\User;

class Spaces extends Model
{
    protected $fillable = [
        'unique_identity', 'name', 'owner_id' , 'type', 'enable', 'image', 'image'
    ];

    protected $table = "spaces";

    public function applications()
    {
        return $this->hasMany(Applications::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
