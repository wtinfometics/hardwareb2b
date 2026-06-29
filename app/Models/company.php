<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $table='companies';

    protected $primaryKey='company_id';

    protected $fillable=[
        'name',
        'website_name',
        'website_url',
        'trn_number',
        'address',
        'street',
        'city',
        'state',
        'country',
        'pin_code',
        'phone',
        'email',
        'logo',
        'fav_icon'
    ];
}
