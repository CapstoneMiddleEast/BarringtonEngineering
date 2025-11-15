<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Invoices') }}
                    </x-h1>
                    <div>
                        @can('create invoice')
                            <x-btn-add href="{{ route('invoices.create') }}"></x-btn-add>
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
                                    <th scope="col" class="px-6 py-3">Invoice No</th>
                                    <th scope="col" class="px-6 py-3">Client Name</th>
                                    <th scope="col" class="px-6 py-3">Items</th>
                                    <th scope="col" class="px-6 py-3">Delivery Date</th>
                                    <th scope="col" class="px-6 py-3">Client Invoice</th>
                                    <th scope="col" class="px-6 py-3">IPO No</th>
                                    <th scope="col" class="px-6 py-3">Actions</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $item)
                                        <tr
                                            class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                                            <td class="px-6 py-4 text-nowrap">
                                                <a title="View invoice"
                                                    href="{{ route('invoices.view', $item->id) }}">{{ $item->invoice_no }}</a>
                                            </td>
                                            <td class="px-6 py-4"><a title="View invoice"
                                                    href="{{ route('invoices.view', $item->id) }}">{{ $item->client->name }}</a>
                                            </td>
                                            <td class="px-6 py-4">
                                                @foreach ($item->items as $i)
                                                    <x-badge.purple>{{ $i->item->name }}</x-badge>
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4 text-nowrap">{{ formatted_date($item->invoice_date) }}
                                            </td>
                                            <td class="px-6 py-4 text-nowrap">{{ $item->client_invoice }}</td>
                                            <td class="px-6 py-4 text-nowrap">{{ $item->lpo_no }}</td>
                                            <td class="px-6 py-4 flex">
                                                <button id="dropdownMenuIconHorizontalButton-{{ $item->id }}"
                                                    data-dropdown-toggle="dropdownDotsHorizontal-{{ $item->id }}"
                                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                                    type="button">
                                                    <svg class="w-5 h-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 16 3">
                                                        <path
                                                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                                    </svg>
                                                </button>
                                                <div id="dropdownDotsHorizontal-{{ $item->id }}"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-800 dark:divide-gray-600">
                                                    <ul class="py-2 pl-2 text-sm text-gray-700 dark:text-gray-200"
                                                        aria-labelledby="dropdownMenuIconHorizontalButton-{{ $item->id }}">
                                                        <li class="pb-2">
                                                            @can('view invoice')
                                                                <a title="View invoice"
                                                                    href="{{ route('invoices.view', $item->id) }}">
                                                                    <x-badge.view-icon />
                                                                </a>
                                                            @endcan
                                                        </li>
                                                        <li class="pb-2">
                                                            @can('edit invoice')
                                                                <a title="Edit invoice"
                                                                    href="{{ route('invoices.edit', $item->id) }}">
                                                                    <x-badge.edit-icon />
                                                                </a>
                                                            @endcan
                                                        </li>
                                                        <li class="pb-2">
                                                            @can('delete invoice')
                                                                <a title="Delete invoice"
                                                                    href="{{ route('invoices.delete', $item->id) }}">
                                                                    <x-badge.trash-icon />
                                                                </a>
                                                            @endcan
                                                        </li>
                                                    </ul>
                                                </div>
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
