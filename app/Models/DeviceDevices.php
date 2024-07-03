<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DeviceDevices extends Pivot
{
    protected $fillable = [
        'device_id',
        'related_device_id',
        'order',
    ];
}
