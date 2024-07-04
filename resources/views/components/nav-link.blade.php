@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-yellow-400 dark:border-yellow-600 text-sm font-medium leading-5 text-yellow-900 dark:text-yellow-100 focus:outline-none focus:border-yellow-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-yellow-500 dark:text-yellow-400 hover:text-yellow-700 dark:hover:text-yellow-300 hover:border-black-300 dark:hover:border-black-700 focus:outline-none focus:text-yellow-700 dark:focus:text-yellow-300 focus:border-black-300 dark:focus:border-black-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
