<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $table='posts';

    protected $primaryKey='post_id';

    protected $fillable=[
        'post_name',
        'post_slug',
        'category_id',
        'short_description',
        'description',
        'featured_image',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'category_id');
    }

    public function meta()
    {
        return $this->hasMany(postmeta::class, 'post_id', 'post_id');
    }
}
