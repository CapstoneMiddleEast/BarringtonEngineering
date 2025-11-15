<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8 mb-6">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-h1>
                    {{ __('User') }} - {{ $user->name }}
                </h2>
            </x-h1>
        </div>
    </div>
    <div class="pb-6">
        <div class="sm:px-6 lg:px-8">
            <div class="md:grid grid-cols-5 gap-8">
                <div class="text-white col-span-2">
                    <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="avatar flex justify-center">
                            <div class="size-32 rounded-full overflow-hidden">
                                @if ($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="avatar" />
                                @else
                                    <img src="{{ asset('/images/profile.jpg') }}" alt="avatar" />
                                @endif
                            </div>
                        </div>
                        <h2 class="text-xl font-bold dark:text-white my-3 text-center text-gray-900">
                            {{ $user->name }}
                        </h2>
                        <dl
                            class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                            <div class="flex flex-col pb-3">
                                <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Email address</dt>
                                <dd class="text-base font-semibold">{{ $user->email }}</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Availability status</dt>
                                <dd class="text-base font-semibold uppercase">{{ $user->availability_status }}</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Phone number</dt>
                                <dd class="text-base font-semibold">{{ $user->phone_number }}</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Whatsapp number</dt>
                                <dd class="text-base font-semibold">{{ $user->whatsapp_number }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="col-span-3">
                    <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                            <div class="flex flex-col pb-3">
                                <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Info</dt>
                                <dd class="text-base font-semibold">{{ $user->about }}</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Home address</dt>
                                <dd class="text-base font-semibold">{{ $user->address }}</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Job title</dt>
                                <dd class="text-base font-semibold">{{ $user->job_title }}</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Department</dt>
                                <dd class="text-base font-semibold">{{ $user->department }}</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Join date</dt>
                                <dd class="text-base font-semibold">{{ formatted_date($user->join_date) }}
                                </dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Employee id</dt>
                                <dd class="text-base font-semibold">{{ $user->employee_id }}</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Languages spoken</dt>
                                <dd class="text-base font-semibold">{{ $user->languages_spoken }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
