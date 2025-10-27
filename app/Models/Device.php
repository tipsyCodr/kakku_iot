<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name',
        'serial_no',
        'type',
        'location',
        'last_seen',
        'api_token',
        'status',
    ];
    public function deviceStats(){
        return $this->hasMany(DeviceStat::class);
    }
}
