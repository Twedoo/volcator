<?php

namespace Twedoo\Stone\Models;

use Illuminate\Database\Eloquent\Model;

class Parameters extends Model
{
    //
    protected $fillable = [
        'name', 'value', 'application'
    ];

    protected $table = "parameters";
}
