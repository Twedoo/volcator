<?php

namespace Twedoo\Stone\Modules\Notifications\Models;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $fillable = [
        'notification', 'open', 'type', 'space_id', 'application_id', 'user_id', 'owner_id', 'collection'
    ];
}
