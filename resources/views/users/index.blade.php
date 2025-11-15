<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>{{ __('Users') }}</x-h1>
                    <div>
                        @can('create user')
                            <x-btn-add href="{{ route('users.create') }}"></x-btn-add>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-session-message :type="session('type', 'info')" />
    <div class="pb-8">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table
                            class="w-full text-xs md:text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium">
                            <thead class="text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Job Title</th>
                                    <th scope="col" class="px-6 py-3">Roles</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $user)
                                        <tr
                                            class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                                            <td
                                                class="items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                <a href="{{ route('users.view', $user->id) }}"
                                                    class="flex items-center">
                                                    @if ($user->profile_picture)
                                                        <img class="w-10 h-10 rounded-full"
                                                            src="{{ asset('storage/' . $user->profile_picture) }}"
                                                            alt="avatar" />
                                                    @else
                                                        <img class="w-10 h-10 rounded-full"
                                                            src="{{ asset('/images/profile.jpg') }}" alt="avatar" />
                                                    @endif
                                                    <span class="ps-3">
                                                        <span
                                                            class="text-xs md:text-base font-semibold block">{{ $user->name }}</span>
                                                        <span
                                                            class="font-normal text-gray-600 dark:text-gray-200 block">
                                                            {{ $user->email }}</span>
                                                    </span>
                                                </a>
                                            </td>
                                            <td class="px-6 py-4">{{ $user->job_title }}</td>
                                            <td class="min-w-fit px-6 py-4">
                                                @if ($user->roles->isNotEmpty())
                                                    @foreach ($user->roles as $item)
                                                        <span
                                                            class="bg-green-500 text-green-100 text-xs text-nowrap md:text-sm font-medium m-1 inline-block px-2.5 py-0.5 rounded-full">{{ $item->name }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($user->availability_status == 'active')
                                                    <x-badge.green>{{ $user->availability_status }}</x-badge>
                                                @endif
                                                @if ($user->availability_status == 'leave')
                                                    <x-badge.yellow>{{ $user->availability_status }}</x-badge>
                                                @endif
                                                @if ($user->availability_status == 'blocked')
                                                    <x-badge.red>{{ $user->availability_status }}</x-badge>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 inline-flex">
                                                @can('view user')
                                                    <a title="View user" href="{{ route('users.view', $user->id) }}">
                                                        <x-badge.view-icon />
                                                    </a>
                                                @endcan
                                                @can('edit user')
                                                    <a title="Edit user" href="{{ route('users.edit', $user->id) }}">
                                                        <x-badge.edit-icon />
                                                    </a>
                                                @endcan
                                                @can('assign role')
                                                    <a title="Assign roles" href="{{ route('users.roles', $user->id) }}">
                                                        <x-badge.cog-icon />
                                                    </a>
                                                @endcan
                                                @can('delete user')
                                                    <a title="Delete user" href="{{ route('users.delete', $user->id) }}">
                                                        <x-badge.trash-icon />
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="pt-8"></div>
                    {{ $list->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
