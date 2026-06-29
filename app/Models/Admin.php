<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    protected $table='admins';

    protected $primaryKey='admin_id';

    protected $fillable=[
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'password'
    ];
}
