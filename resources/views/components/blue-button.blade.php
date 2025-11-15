<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-white font-bold text-sm focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900']) }}>
    {{ $slot }}
</button>
