<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class attributevariation extends Model
{
    //
    protected $table='attributevariations';

    protected $primaryKey='attribute_variation_id';

    protected $fillable=[
        'attribute_id',
        'attribute_variation_name',
    ];
    


     public function attributes()
    {
        return $this->belongsTo(attribute::class, 'attribute_id', 'attribute_id');
    }
}
