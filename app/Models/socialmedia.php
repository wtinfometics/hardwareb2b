<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class socialmedia extends Model
{
    protected $table='socialmedia';

    protected $primaryKey='sm_id';

    protected $fillable=[
        'facebook',
        'instagram',
        'x',
        'linkedin',
        'youtube',
        'whatsapp'
    ];
}
