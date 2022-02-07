<?php

namespace App\Modules\Applications\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Applications extends Model
{
    protected $fillable = [
        'name', 'display_name', 'type',
    ];

    protected $table = "applications";

    public function users()
    {
        return $this->belongsToMany(User::class, 'applications_user',
            'application_id', 'user_id');
    }
}
