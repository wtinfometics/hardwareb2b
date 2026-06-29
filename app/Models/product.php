<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table='products';

    protected $primaryKey='product_id';

    protected $fillable=[
        'product_name',
        'product_slug',
        'category_id',
        'subcategory_id',
        'brand_id',
        'min_order',
        'promoted',
        'featured',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(subcategory::class, 'subcategory_id', 'subcategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(brand::class, 'brand_id', 'brand_id');
    }

     public function meta()
    {
        return $this->hasOne(productmeta::class, 'product_id', 'product_id');
    }

    public function variations()
    {
        return $this->hasMany(productvariation::class, 'product_id', 'product_id');
    }
}
