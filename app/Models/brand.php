<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $table='brands';

    protected $primaryKey='brand_id';

    protected $fillable=[
        'brand_name',
        'brand_image',
    ];

    public function product()
    {
        return $this->hasMany(product::class, 'brand_id', 'brand_id');
    }
  
}
