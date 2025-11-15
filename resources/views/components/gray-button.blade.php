<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-white font-bold text-sm focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 rounded-lg px-5 py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-900']) }}>
    {{ $slot }}
</button>