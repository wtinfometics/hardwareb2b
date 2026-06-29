<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderproduct extends Model
{
    //
    protected $table='orderproducts';

    protected $primaryKey='order_product_id';

    protected $fillable=[
        'order_id',
        'product_id',
        'product_variation_id',
        'quantity',
        'price',
        'total' 
    ];

    public function variation(){
        return $this->belongsTo(productvariation::class,'product_variation_id','product_variation_id');
    }

    public function product(){
        return $this->belongsTo(product::class,'product_id','product_id');
    }
    
}
