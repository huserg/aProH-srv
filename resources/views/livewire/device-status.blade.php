<div wire:poll.{{ $refreshInterval }}ms="updateDeviceStatus">
    @if ($device)
        <span class="px-4 py-2 ml-2 inline-flex text-xs leading-5 font-semibold rounded-full" style="background-color: {{ $device->status_color }}; color: {{ $device->status_text_color }};">
            {{ $device->user->name }}
        </span>
    @else
        <span class="px-4 py-2 ml-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
            {{ __('Device not found') }}
        </span>
    @endif
</div>
