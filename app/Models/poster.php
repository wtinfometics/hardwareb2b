<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class poster extends Model
{
    //
    protected $table='posters';

    protected $primaryKey='poster_id';

    protected $fillable=[
        'poster_name',
        'poster_image',
        'poster_header',
        'featured_message',
        'link',
        'button_text',
        'status',
    ];
}
