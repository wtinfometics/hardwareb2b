<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //
    protected $table='orders';

    protected $primaryKey='order_id';

    protected $fillable=[
        'subtotal',
        'tax',
        'discount',
        'grand_total',
        'order_number',
        'delivery_date',
        'first_name',
        'last_name',
        'company_name',
        'wat_number',
        'address',
        'street',
        'city',
        'state',
        'country',
        'pin_code',
        'landmark',
        'phone',
        'email',
        'status'
    ];

    public function orderProduct(){
        return $this->hasMany(orderproduct::class,'order_id','order_id');
    }
    
}
