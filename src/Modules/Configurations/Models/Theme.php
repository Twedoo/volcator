<?php

namespace Twedoo\Volcator\Modules\Configurations\Models;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    //
    protected $fillable = [
        'name', 'scope', 'is_public', 'is_delete', 'volcator_id'
    ];

    protected $table = "themes";

}
