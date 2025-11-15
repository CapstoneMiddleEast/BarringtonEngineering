<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Suppliers') }}
                    </x-h1>
                    <div>
                        @can('create supplier')
                            <x-btn-add href="{{ route('suppliers.create') }}"></x-btn-add>
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
                                    <th scope="col" class="px-6 py-3">Place</th>
                                    <th scope="col" class="px-6 py-3">Tel</th>
                                    {{-- <th scope="col" class="px-6 py-3">Fax</th> --}}
                                    <th scope="col" class="px-6 py-3">TRN No</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $item)
                                        <tr
                                            class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                                            <td class="px-6 py-4">{{ $item->id }}</td>
                                            <td class="px-6 py-4 text-nowrap">{{ $item->name }}</td>
                                            <td class="px-6 py-4 text-nowrap">{{ $item->place }}</td>
                                            <td class="px-6 py-4 text-nowrap">{{ $item->tel }}</td>
                                            {{-- <td class="px-6 py-4 text-nowrap">{{ $item->fax }}</td> --}}
                                            <td class="px-6 py-4 text-nowrap">{{ $item->trn }}</td>
                                            <td class="px-6 py-4 flex">
                                                @can('edit supplier')
                                                    <a href="{{ route('suppliers.edit', $item->id) }}">
                                                        <x-badge.edit-icon />
                                                    </a>
                                                @endcan
                                                @can('delete supplier')
                                                    <a class="btn btn-circle btn-text btn-sm text-error"
                                                        href="{{ route('suppliers.delete', $item->id) }}">
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
