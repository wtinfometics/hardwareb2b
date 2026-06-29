<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productmeta extends Model
{
    protected $table='productmetas';

    protected $primaryKey='product_meta_id';

    protected $fillable=[
        'product_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
    
     public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
