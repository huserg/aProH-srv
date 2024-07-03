<?php

namespace App\Http\Controllers\Api\Devices;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function get_status(Request $request)
    {
        $device = Device::where('mac', $request->mac)->first();
        if ($device) {
            return response()->json([
                'status' => $device->status,
            ]);
        }
        return response()->json([
            'status' => 'offline',
        ]);
    }

    public function update_status(Request $request)
    {
        // get all devices configured on the device
        $device = Device::where('mac', $request->mac)->first();
        if ($device) {
            // get all devices configured on the device
            $related_devices = $device->devices->sortBy('order', 'asc');
            return response()->json([
                'status' => 'success',
                'related_devices' => $related_devices,
            ]);
        }
        return response()->json([
            'status' => 'error',
        ]);
    }


}
