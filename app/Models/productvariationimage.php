<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productvariationimage extends Model
{
    protected $table='productvariationimages';

    protected $primaryKey='product_variation_image_id';

    protected $fillable=[
        'product_variation_id',
        'product_variation_image_name',
    ];

    public function variation()
    {
        return $this->belongsTo(productvariation::class, 'product_variation_id');
    }
    
}
