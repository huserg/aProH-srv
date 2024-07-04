<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-black-800 border border-black-300 dark:border-black-500 rounded-md font-semibold text-xs text-yellow-700 dark:text-yellow-300 uppercase tracking-widest shadow-sm hover:bg-black-50 dark:hover:bg-black-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-black-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
