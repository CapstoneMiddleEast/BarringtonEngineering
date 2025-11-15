<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap p-4 lg:px-8 flex-row-reverse">
        <div class="flex">
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse gap-2 md:gap-5">
                <button id="theme-toggle" type="button"
                    class="text-gray-500 ml-5 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                        </path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <button type="button"
                    class="flex mt-1 text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 ml-5"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    @if (Auth::user()->profile_picture)
                        <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                            alt="avatar" />
                    @else
                        <img class="w-8 h-8 rounded-full" src="{{ asset('/images/profile.jpg') }}" alt="avatar" />
                    @endif
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                        <span
                            class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-2 px-3 text-sm" aria-labelledby="user-menu-button">
                        <li class="mb-2">
                            <x-nav-link href="{{ route('profile.view') }}" :active="request()->is('profile')">
                                View My Profile
                            </x-nav-link>
                        </li>
                        <li class="mb-2">
                            <x-nav-link href="{{ route('profile.edit') }}" :active="request()->is('profile/edit')">
                                Update Profile Info
                            </x-nav-link>
                        </li>
                        <li class="mb-2">
                            <x-nav-link href="{{ route('profile.password') }}" :active="request()->is('profile/password')">
                                Update Password
                            </x-nav-link>
                        </li>
                        <li class="mb-2">
                            <x-nav-link href="{{ route('profile.picture') }}" :active="request()->is('profile/picture')">
                                Update Profile Pic
                            </x-nav-link>
                        </li>
                        <li class="mb-3">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Log
                                    Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
                {{-- <button data-collapse-toggle="navbar-user" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button> --}}
            </div>
        </div>
    </div>
</nav>
