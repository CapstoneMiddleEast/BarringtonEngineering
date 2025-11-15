<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-white font-bold text-sm focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-lg px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900']) }}>
    {{ $slot }}
</button>
