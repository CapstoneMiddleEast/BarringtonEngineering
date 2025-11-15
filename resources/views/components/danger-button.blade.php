<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-bold uppercase rounded-lg text-xs md:text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800']) }}>
    {{ $slot }}
</button>
