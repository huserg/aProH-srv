<?php

namespace App\Http\Controllers\Api\Devices;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function get_status(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->checkDeviceAuthorization($request);
        if ($response->getData()->code !== 0) {
            return $response;
        }

        // get all devices configured on the device
        $device = Device::where('mac', $request->mac)->first();
        if ($device) {
            // get all devices configured on the device
            $related_devices = $device->relatedDevices()?->orderBy('order')->get()->only(['id', 'status']);
            return response()->json([
                'code' => 0,
                'message' => 'success',
                'related_devices' => $related_devices,
            ]);
        }
        return $this->response([
            'code' => 11,
            'message' => 'mac_not_found',
        ]);
    }

    public function update_status(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->checkDeviceAuthorization($request);
        if ($response->getData()->code !== 0) {
            return $response;
        }

        $device = Device::where('mac', $request->mac)->first();
        if ($device) {
            $device->status = $request->status;
            $device->save();
            return $response;
        }
        return $this->response([
            'code' => 11,
            'message' => 'mac_not_found',
        ]);
    }


    private function checkDeviceAuthorization(Request $request): \Illuminate\Http\JsonResponse
    {
        if(empty($request->all())) {
            return $this->response([
                'code' => 9,
                'message' => 'invalid_payload',
            ]);
        }

        if(!$request->has('mac')) {
            return $this->response([
                'code' => 10,
                'message' => 'mac_missing',
            ]);
        }

        return $this->response([
            'code' => 0,
            'message' => 'success',
        ]);
    }

    private function response($response): \Illuminate\Http\JsonResponse
    {
        return response()->json($response);
    }
}
