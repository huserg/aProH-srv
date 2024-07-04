<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Device;

class DeviceStatus extends Component
{
    public $deviceId;
    public $device;
    public $refreshInterval;

    public function mount($deviceId, $refreshInterval)
    {
        $this->deviceId = $deviceId;

        $this->refreshInterval = $refreshInterval;
        $this->updateDeviceStatus();
    }

    public function updateDeviceStatus()
    {
        $this->device = Device::find($this->deviceId);
    }

    public function render()
    {
        return view('livewire.device-status');
    }
}
