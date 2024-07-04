@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-yellow-400 dark:border-yellow-600 text-start text-base font-medium text-yellow-700 dark:text-yellow-300 bg-yellow-50 dark:bg-yellow-900/50 focus:outline-none focus:text-yellow-800 dark:focus:text-yellow-200 focus:bg-yellow-100 dark:focus:bg-yellow-900 focus:border-yellow-700 dark:focus:border-yellow-300 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-200 hover:bg-black-50 dark:hover:bg-black-700 hover:border-black-300 dark:hover:border-black-600 focus:outline-none focus:text-yellow-800 dark:focus:text-yellow-200 focus:bg-black-50 dark:focus:bg-black-700 focus:border-black-300 dark:focus:border-black-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
