<a
    {{ $attributes->merge(['class' => 'inline-flex items-center text-white font-bold bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 uppercase rounded-lg text-xs md:text-sm px-5 py-2.5  dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800']) }}>
    {{ $slot }}
</a>
