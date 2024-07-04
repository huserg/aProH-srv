<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-black-800 dark:bg-black-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-yellow-800 uppercase tracking-widest hover:bg-black-700 dark:hover:bg-white focus:bg-black-700 dark:focus:bg-white active:bg-black-900 dark:active:bg-black-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-black-800 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
