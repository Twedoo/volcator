<?php

namespace Twedoo\Volcator\Modules\Applications\Models;
use Illuminate\Database\Eloquent\Model;
use Twedoo\Volcator\Organizer\Models\Volcators;
use Twedoo\VolcatorGuard\Models\User;

class Applications extends Model
{
    protected $fillable = [
        'name', 'display_name', 'unique_identity', 'active_vye', 'type', 'space_id', 'enable', 'image', 'created_by'
    ];

    protected $table = "applications";

    public function space()
    {
        return $this->belongsTo(Spaces::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'applications_user',
            'application_id', 'user_id')->withPivot('space_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function volcators()
    {
        return $this->belongsToMany(Volcators::class, 'applications_volcator', 'application_id', 'volcator_id')->withPivot('space_id');
    }
}
