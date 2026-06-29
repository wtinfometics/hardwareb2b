<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class otp extends Model
{
    //
    protected $table='otps';

    protected $fillable=[
        'otp',
        'email',
        'expires_at'
    ];

    protected $primaryKey='otp_id';
}
