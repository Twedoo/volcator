<?php

namespace Twedoo\Volcator\Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    //
    protected $fillable = [
        'code', 'object', 'internal', 'accepted', 'type', 'space_id', 'application_id', 'identification', 'owner_id', 'collection'
    ];
}
