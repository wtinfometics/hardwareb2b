<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    protected $table='coupons';

    protected $primaryKey='coupon_id';

    protected $fillable=[
        'coupon_name',
        'coupon_code',
        'discount_type',
        'discount',
        'expiry_date',
        'max_discount',
        'status'
    ];
}
