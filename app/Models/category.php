<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table='categories';

    protected $primaryKey='category_id';

    protected $fillable=[
        'category_name',
        'category_slug',
        'category_image',
    ];

    public function products()
    {
        return $this->hasMany(product::class, 'category_id', 'category_id');
    }

    public function post()
    {
        return $this->hasMany(post::class, 'category_id', 'category_id');
    }

}
