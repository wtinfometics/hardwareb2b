<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class policy extends Model
{
    protected $table='policies';

    protected $primaryKey='policy_id';

    protected $fillable=[
        'policy_name',
        'slug',
        'description',
        'status',
    ];
}
