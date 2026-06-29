<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class attribute extends Model
{
    protected $table='attributes';

    protected $primaryKey='attribute_id';

    protected $fillable=[
        "attribute_name"
    ];
    

      // Relationship
    public function attributevariations()
    {
        return $this->hasMany(AttributeVariation::class, 'attribute_id', 'attribute_id');
    }
}
