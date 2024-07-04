<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-800 dark:text-yellow-200 leading-tight">
            @if($device)
                {{ $device->mac }}
            @else
                {{ __('No Device configured') }}
            @endif
        </h2>
    </x-slot>

    @if($device)
        <div class="py-12">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white dark:bg-black-800 overflow-hidden shadow-xl sm:rounded-lg">
                    {{--                Display device with status (status is a hex color) in a pill --}}
                    <div class="p-6 sm:px-20 bg-white dark:bg-black-800 border-b border-black-200 dark:border-black-700">
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <span class="px-4 py-2 ml-2 inline-flex text-xs leading-5 font-semibold rounded-full" style="background-color: {{ $device->status_color }}; color: {{ $device->status_text_color }};">
                                    {{ $device->user->name }}
                                </span>
                            </div>
                        </div>
                    </div>
                    {{--                Display device connected devices status with usernames --}}
                    <div class="p-6 sm:px-20 bg-white dark:bg-black-800 border-b border-black-200 dark:border-black-700">

                        @if($availableDevices && $availableDevices->count())
                            <form action="{{ route('device.connect', $device) }}" method="POST">
                                @csrf
                                <div class="flex items-center mt-4">
                                    <label for="device_id" class="block text-sm font-medium text-yellow-700 dark:text-yellow-200">{{ __('Select device') }}</label>
                                    <select name="device_id" id="device_id" class="ml-4 block w-full shadow-sm sm:text-sm focus:ring-yellow-500 focus:border-yellow-500 border-black-300 rounded-md dark:bg-black-700 dark:text-yellow-200">
                                        @foreach($availableDevices as $availableDevice)
                                            <option value="{{ $availableDevice->id }}">{{ $availableDevice->user->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-700 transition duration-150 ease-in-out">
                                        {{ __('Connect') }}
                                    </button>
                                </div>
                                <div class="mt-4">
                                </div>
                            </form>
                        @else
                            <span class="text-lg font-semibold text-yellow-800 dark:text-yellow-200">{{ __('No new devices to add, add people to your team or join one to see more devices to add') }}</span>
                        @endif

                    </div>
                    {{--                Display device connected devices status with usernames --}}
                    <div class="p-6 sm:px-20 bg-white dark:bg-black-800 border-b border-black-200 dark:border-black-700">
                        <h2 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200">{{ __('Connected Devices') }}</h2>

                        <ul class="space-y-4">
                            @forelse($device->relatedDevices as $relatedDevice)
                                <li class="py-4 flex justify-between items-center border-b border-black-200 dark:border-black-700">
                                    <div class="flex items-center">
                                        @if ($relatedDevice->user->profile_photo_url)
                                            <img class="h-10 w-10 rounded-full" src="{{ $relatedDevice->user->profile_photo_url }}" alt="{{ $relatedDevice->user->name }}">
                                        @else
                                            <div class="rounded-full h-10 w-10 flex items-center justify-center text-white" style="background-color: {{ $relatedDevice->status_color }};">
                                                <span class="text-xl font-bold">{{ strtoupper(substr($relatedDevice->user->name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <span class="px-4 py-2 ml-2 inline-flex text-xs leading-5 font-semibold rounded-full" style="background-color: {{ $relatedDevice->status_color }}; color: {{ $relatedDevice->status_text_color }};">
                                                {{ $relatedDevice->user->name }}
                                            </span>
                                        </div>
                                    </div>
                                    <form action="{{ route('device.disconnect') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="device_id" value="{{ $relatedDevice->id }}">
                                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:bg-red-700 transition duration-150 ease-in-out">
                                            {{ __('Disconnect') }}
                                        </button>
                                    </form>
                                </li>
                            @empty
                                <li class="py-4 flex justify-center items-center text-yellow-500 dark:text-yellow-400">
                                    {{__('No related devices found')}}
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white dark:bg-black-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white dark:bg-black-800 border-b border-black-200 dark:border-black-700">
                        <h1 class="text-2xl font-bold text-yellow-800 dark:text-yellow-200">{{ __('Please insert device MAC address') }}</h1>
                        <form action="{{ route('device.store') }}" method="POST">
                            @csrf
                            <div class="flex items-center mt-4">
                                <label for="mac" class="block text-sm font-medium text-yellow-700 dark:text-yellow-200">{{ __('MAC Address') }}</label>
                                <input type="text" name="mac" id="mac" class="ml-4 block w-full shadow-sm sm:text-sm focus:ring-yellow-500 focus:border-yellow-500 border-black-300 rounded-md dark:bg-black-700 dark:text-yellow-200">
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
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
