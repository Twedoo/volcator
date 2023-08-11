<?php

namespace Twedoo\Volcator\Modules\Applications\Models;

use Illuminate\Database\Eloquent\Model;
use Twedoo\Volcator\Organizer\Models\Volcators;
use Twedoo\VolcatorGuard\Models\User;

class Spaces extends Model
{
    protected $fillable = [
        'unique_identity', 'name', 'owner_id', 'type', 'enable', 'image', 'created_by'
    ];

    protected $casts = [
        'permission_name' => 'array'
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
