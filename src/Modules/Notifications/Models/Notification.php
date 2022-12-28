<?php

namespace Twedoo\Stone\Modules\Notifications\Models;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title', 'notification', 'route', 'open', 'space_id', 'application_id', 'user_id', 'owner_id', 'collection'
    ];
}
