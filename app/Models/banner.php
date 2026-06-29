<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    protected $table='banners';

    protected $primaryKey='banner_id';

    protected $fillable=[
        'banner_name',
        'banner_header',
        'featured_message',
        'banner_image',
        'link',
        'button_text',
        'status',
    ];
}
