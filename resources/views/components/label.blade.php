@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-yellow-700 dark:text-yellow-300']) }}>
    {{ $value ?? $slot }}
</label>
