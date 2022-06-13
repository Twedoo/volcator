<?php

namespace Twedoo\Stone\Modules\Applications\Models;
use Illuminate\Database\Eloquent\Model;
use Twedoo\Stone\Organizer\Models\modules;
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
    public function modules()
    {
        return $this->belongsToMany(modules::class, 'applications_module', 'application_id', 'module_id');
    }
}
