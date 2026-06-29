<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class backup extends Model
{
    //
    protected $table='backups';

    protected $primaryKey='backup_id';

    protected $fillable=[
        'backup_name',
        'backup_file',
        'file_size',
        'backup_date',
    ];
}
