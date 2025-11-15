<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Roles') }}
                    </x-h1>
                    <div>
                        @can('create role')
                            <x-btn-add href="{{ route('roles.create') }}"></x-btn-add>
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
                            class="w-full text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium">
                            <thead class="text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3">ID</th>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Permissions</th>
                                    <th scope="col" class="px-6 py-3">Created</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $role)
                                        <tr
                                            class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                                            <td class="px-6 py-4">{{ $role->id }}</td>
                                            <td class="px-6 py-4 text-nowrap">{{ $role->name }}</td>
                                            <td class="px-6 py-4 inline-flex flex-wrap">
                                                @if ($role->permissions->isNotEmpty())
                                                    @foreach ($role->permissions as $item)
                                                        <span
                                                            class="bg-green-500 text-green-100 text-nowrap text-xs md:text-sm font-medium me-1 px-2.5 py-0.5 rounded-full mb-1 inline-block">{{ $item->name }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">{{ formatted_date($role->created_at) }}</td>
                                            <td class="px-6 py-4 flex">
                                                @can('edit role')
                                                    <a href="{{ route('roles.edit', $role->id) }}">
                                                        <x-badge.edit-icon />
                                                    </a>
                                                @endcan
                                                @can('delete role')
                                                    <a class="btn btn-circle btn-text btn-sm text-error"
                                                        href="{{ route('roles.delete', $role->id) }}">
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
