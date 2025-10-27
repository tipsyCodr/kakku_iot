<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceStat extends Model
{
    //
    protected $fillable = [
        'device_id',
        'serial_no',
        'key',
        'value',
        'serial_id',
        'ip_address'
    ];
}
