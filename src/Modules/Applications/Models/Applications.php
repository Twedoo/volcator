<?php

namespace Twedoo\Stone\Modules\Applications\Models;
use Illuminate\Database\Eloquent\Model;
use Twedoo\Stone\Organizer\Models\Stones;
use Twedoo\StoneGuard\Models\User;

class Applications extends Model
{
    protected $fillable = [
        'name', 'display_name', 'unique_identity', 'type', 'space_id', 'enable', 'image'
    ];

    protected $table = "applications";

    public function space()
    {
        return $this->belongsTo(Spaces::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'applications_user',
            'application_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stones()
    {
        return $this->belongsToMany(Stones::class, 'applications_stone', 'application_id', 'stone_id');
    }
}
