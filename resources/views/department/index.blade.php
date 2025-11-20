<x-app-layout>



    <div class="py-6 bg-gray-200 dark:bg-gray-800">


        <div class="sm:px-6 lg:px-8">


            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">


                <div class="flex justify-between items-center">


                    <x-h1>{{ __('Departments') }}</x-h1>


                    <div>


                        @can('create department')


                            <x-btn-add href="{{ route('department.create') }}"></x-btn-add>


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


                                    <th scope="col" class="px-6 py-3">Code</th>


                                    <th scope="col" class="px-6 py-3">Name</th>


                                    <th scope="col" class="px-6 py-3">Description</th>


                                    <th scope="col" class="px-6 py-3">Company</th>


                                    <th scope="col" class="px-6 py-3">Status</th>


                                    <th scope="col" class="px-6 py-3">Actions</th>


                                </tr>


                            </thead>


                            <tbody>


                                @if ($list->isNotEmpty())


                                    @foreach ($list as $item)


                                        <tr


                                            class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">


                                            <td


                                                class="items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">


                                                {{ $item->code }}


                                            </td>


                                            <td class="px-6 py-4">{{ $item->name }}</td>


                                            <td class="px-6 py-4"> {{ $item->description }} </td>


                                            <td class="px-6 py-4"> {{ $item->company_id }} </td>


                                            <td class="px-6 py-4">


                                                @if ($item->is_active)


                                                    <x-badge.green>Active</x-badge.green>


                                                @else


                                                    <x-badge.red>Inactive</x-badge.red>


                                                @endif


                                            </td>


                                            <td class="px-6 py-4 inline-flex">


                                                @can('edit department')


                                                    <a title="Edit department"


                                                        href="{{ route('department.edit', $item->id) }}">


                                                        <x-badge.edit-icon />


                                                    </a>


                                                @endcan


                                                @can('delete department')


                                                    <a title="Delete department"


                                                        href="{{ route('department.delete', $item->id) }}">


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