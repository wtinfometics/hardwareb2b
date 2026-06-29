<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    //
    protected $table='contacts';

    protected $primaryKey='contact_id';

    protected $fillable=[
        'first_name',
        'last_name',
        'phone',
        'email',
        'subject',
        'message',
    ];
}
