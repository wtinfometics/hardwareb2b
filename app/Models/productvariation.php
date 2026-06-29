<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productvariation extends Model
{
    //
    protected $table='productvariations';

    protected $primaryKey='product_variation_id';

    protected $fillable=[
        'sku',
        'variation_name',
        'product_id',
        'short_description',
        'price',
        'discount_price',
        'stock',
    ];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id', 'product_id');
    }

    public function images()
    {
        return $this->hasMany(productvariationimage::class, 'product_variation_id', 'product_variation_id');
    }

    public function attributes()
    {
        return $this->hasMany(productvariationattribute::class, 'product_variation_id', 'product_variation_id');
    }
}
