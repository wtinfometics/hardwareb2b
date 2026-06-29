<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productvariationattribute extends Model
{
    protected $table='productvariationattributes';

    protected $primaryKey='product_variation_attribute_id';

    protected $fillable=[
        'product_variation_id',
        'attribute_id',
        'attribute_variation_id',
    ];

     public function attribute()
    {
        return $this->belongsTo(attribute::class, 'attribute_id', 'attribute_id');
    }

    public function attributeVariation()
    {
        return $this->belongsTo(attributevariation::class, 'attribute_variation_id', 'attribute_variation_id');
    }

    public function variation()
    {
        return $this->belongsTo(productvariation::class,'product_variation_id','product_variation_id');
    }
}
