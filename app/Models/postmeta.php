<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class postmeta extends Model
{
    protected $table='postmetas';

    protected $primaryKey='post_meta_id';

    protected $fillable=[
        'post_id',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];
}
