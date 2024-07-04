<?php

namespace App\Http\Controllers\Device;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{

    public function create() {
        return view('device.create');
    }

    public function store(Request $request) {
        $device = Auth::user()->device()->create($request->all());
        return redirect()->route('device.show');
    }

    public function show()
    {
        $device = Auth::user()->device;
        // all devices that are linked to team members accounts
$availableDevices = Auth::user()->allTeams()?->flatMap(function ($team) {
    return $team->users->flatMap(function ($user) {
        return $user->device;
    });
})->flatten();
        return view('device.show', compact('device', 'availableDevices'));
    }

    public function connect(Request $request)
    {
        $device = Auth::user()->device;
        $device->devices()->attach($request->device_id);
        return redirect()->route('device.show');
    }
}
