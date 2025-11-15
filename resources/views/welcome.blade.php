<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CAPSTONE</title>

    <!-- Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');
    </style>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-200 dark:bg-gray-800 dark:text-white/50">
    <header class="shadow bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="container mx-auto max-w-screen-xl">
            <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <a href="/">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                    <div class="flex w-auto items-center" id="navbar-dropdown">
                        <button id="theme-toggle" type="button"
                            class="mr-5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                                </path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        @guest
                            <x-btn-red-link href="/login">Login</x-btn-red-link>
                        @endguest
                        @auth
                            <x-btn-red-link href="/dashboard">Dashboard</x-btn-red-link>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <div>
            <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-32 lg:px-8">
                <div
                    class="relative isolate overflow-hidden bg-white dark:bg-gray-900 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                    <svg viewBox="0 0 1024 1024"
                        class="absolute left-1/2 top-1/2 -z-10 size-[64rem] -translate-y-1/2 [mask-image:radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0"
                        aria-hidden="true">
                        <circle cx="512" cy="512" r="512" fill="url(#759c1415-0410-454c-8f7c-9a820de03641)"
                            fill-opacity="0.7" />
                        <defs>
                            <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
                                <stop stop-color="#7775D6" />
                                <stop offset="1" stop-color="#E935C1" />
                            </radialGradient>
                        </defs>
                    </svg>
                    <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                        <x-h1 class="tracking-tight dark:text-white text-gray-900">Empower Your Business Relationships</x-h1>
                        <p class="mt-6 text-pretty text-lg/8 dark:text-white text-gray-900">At CAPSTONE, we understand that your success
                            relies on meaningful customer relationships. Our CRM solution is designed to simplify your
                            customer management and help you stay connected, organized, and productive.</p>
                        <div class="mt-10 mb-10 flex items-center justify-center gap-x-6 lg:justify-start">
                            @guest
                                <x-btn-red-link href="/login">Login</x-btn-red-link>
                            @endguest
                            @auth
                                <x-btn-red-link href="/dashboard">Dashboard</x-btn-red-link>
                            @endauth
                        </div>
                    </div>
                    <div class="relative mt-16 h-80 lg:mt-8 hidden md:block">
                        <img class="absolute left-0 top-0 w-[57rem] max-w-none rounded-md bg-white/5"
                            src="{{ asset('/images/crm.jpg') }}" alt="App screenshot" width="1824" height="1080">
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
