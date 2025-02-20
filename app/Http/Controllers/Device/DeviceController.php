<?php

namespace App\Http\Controllers\Device;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Device;

class DeviceController extends Controller
{

    public function store(Request $request) {
        $validated = $request->validate([
            'mac_address' => 'required|string|max:255|unique:devices,mac_address',
        ]);

        Auth::user()->device()->create($validated);

        return redirect()->route('dashboard');
    }

    public function show()
    {
        $device = Auth::user()->device;
        // all devices that are linked to team members accounts
        $availableDevices = Auth::user()->allTeams()->map(function ($team) use ($device) {
            // Vérification pour s'assurer que chaque équipe a des utilisateurs
            if ($team->users->isEmpty()) {
                return collect();
            }

            return $team->users->map(function ($user) use ($device) {
                // Vérification pour s'assurer que chaque utilisateur a des devices
                if (empty($user->device)) {
                    return collect();
                }
                // Vérification pour s'assurer que l'appareil de l'utilisateur n'est pas déjà lié
                if ($device->relatedDevices?->contains($user->device)) {
                    return collect();
                }
                // Retourner l'appareil de l'utilisateur
                return $user->device;
            });
        })->flatten();
        return view('dashboard', compact('device', 'availableDevices'));
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
        return redirect()->route('dashboard');
    }

    public function disconnect(Request $request)
    {
        // Valider la requête
        $validatedData = $request->validate([
            'device_id' => 'required|integer|exists:devices,id',
        ]);

        // Trouver l'appareil à délier
        $deviceToUnlink = Device::find($validatedData['device_id']);

        // Obtenir l'appareil de l'utilisateur authentifié
        $userDevice = Auth::user()->device;

        // Vérifier si l'utilisateur a un appareil
        if (!$userDevice) {
            return redirect()->route('device.show')->withErrors(['error' => 'User has no device to unlink from.']);
        }

        // Délier l'appareil
        $userDevice->relatedDevices()->detach($deviceToUnlink->id);

        // Rediriger vers la route 'device.show'
        return redirect()->route('dashboard');
    }
}
