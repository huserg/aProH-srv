<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if($device){{ $device->mac }}@else{{ __('Device') }}@endif
        </h2>
    </x-slot>

    @if($device)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
    {{--                Display device with status (status is a hex color) in a pill --}}
                    <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $device->name }}</h1>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $device->status }}-100 text-{{ $device->status }}-800 dark:bg-{{ $device->status }}-800 dark:text-{{ $device->status }}-100">
                                    {{ $device->status }}
                                </span>
                            </div>
{{--                            <div class="flex items-center">--}}
{{--                                <a href="{{ route('device.edit', $device) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>--}}
{{--                                <form action="{{ route('device.destroy', $device) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
                        </div>
                    </div>
    {{--                Display device connected devices status with usernames --}}
                    <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ __('Connected Devices') }}</h2>

                        @if($availableDevices && $availableDevices->count())
                            <form action="{{ route('device.connect', $device) }}" method="POST">
                                @csrf
                                <div class="flex items-center mt-4">
                                        <label for="device_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Select device') }}</label>
                                        <select name="device_id" id="device_id" class="ml-4 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200">
                                            @foreach($availableDevices as $availableDevice)
                                                <option value="{{ $availableDevice->id }}">{{ $availableDevice->user->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                        {{ __('Connect') }}
                                    </button>
                                </div>
                            </form>
                        @else
                            <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ __('No available devices, add people to your team or join one to see more devices to add') }}</span>
                        @endif

                        <ul class="space-y-4">
                            @forelse($device->relatedDevices as $relatedDevice)
                                <li class="py-4 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center">
                                        @if ($relatedDevice->user->profile_photo_url)
                                            <img class="h-10 w-10 rounded-full" src="{{ $relatedDevice->user->profile_photo_url }}" alt="{{ $relatedDevice->user->name }}">
                                        @else
                                            <div class="bg-{{ $relatedDevice->status ?? 'gray' }}-500 rounded-full h-10 w-10 flex items-center justify-center text-white">
                                                <span class="text-xl font-bold">{{ strtoupper(substr($relatedDevice->user->name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $relatedDevice->user->name }}</span>
                                            <span class="px-2 ml-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $relatedDevice->status ?? 'gray' }}-100 text-{{ $relatedDevice->status ?? 'gray' }}-800 dark:bg-{{ $relatedDevice->status ?? 'gray' }}-800 dark:text-{{ $relatedDevice->status ?? 'gray' }}-100">
                                                {{ ucfirst($relatedDevice->status ?? 'unknown') }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="py-4 flex justify-center items-center text-gray-500 dark:text-gray-400">
                                    No related devices found.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ __('Please insert device MAC address') }}</h1>
                        <form action="{{ route('device.store') }}" method="POST">
                            @csrf
                            <div class="flex items-center mt-4">
                                <label for="mac" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('MAC Address') }}</label>
                                <input type="text" name="mac" id="mac" class="ml-4 block w-full shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
