<?php

namespace App\Http\Controllers\Device;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Device;

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
        $availableDevices = Auth::user()->allTeams()->map(function ($team) {
            // Vérification pour s'assurer que chaque équipe a des utilisateurs
            if ($team->users->isEmpty()) {
                return collect();
            }

            return $team->users->map(function ($user) {
                // Vérification pour s'assurer que chaque utilisateur a des devices
                if (empty($user->device)) {
                    return collect();
                }

                return $user->device;
            });
        })->flatten();
        return view('device.show', compact('device', 'availableDevices'));
    }

    public function connect(Request $request)
    {
        // Valider la requête
        $validatedData = $request->validate([
            'device_id' => 'required|integer|exists:devices,id',
        ]);
    
        // Trouver l'appareil à lier
        $deviceToLink = Device::find($validatedData['device_id']);
    
        // Obtenir l'appareil de l'utilisateur authentifié
        $userDevice = Auth::user()->device;
    
        // Vérifier si l'utilisateur a un appareil
        if (!$userDevice) {
            return redirect()->route('device.show')->withErrors(['error' => 'User has no device to link to.']);
        }
    
        // Lier l'appareil
        $userDevice->relatedDevices()->attach($deviceToLink->id);
    
        // Rediriger vers la route 'device.show'
        return redirect()->route('device.show');
    }
}
