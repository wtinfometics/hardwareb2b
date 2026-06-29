<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    //
    protected $table='subcategories';

    protected $primaryKey='subcategory_id';

    protected $fillable=[
        'subcategory_name',
        'category_id',
        'subcategory_slug',
        'subcategory_image',
    ];

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'category_id');
    }
}
