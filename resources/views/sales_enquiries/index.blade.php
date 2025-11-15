<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Sales enquiries') }}
                    </x-h1>
                    <div class="flex items-center gap-2">
                        <x-btn-red-link href="{{ route('sales_enquiries.export') }}">Export</x-btn-red-link>
                        @can('create sales enquiry')
                            <x-btn-add href="{{ route('sales_enquiries.create') }}"></x-btn-add>
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
                    <form action="{{ route('sales_enquiries.index') }}" method="get">
                        <div class="md:grid grid-cols-4 gap-5 mb-5">
                            <div class="mb-5">
                                <x-input-label for="client_name" :value="__('Search By Client name')" />
                                <x-text-input id="client_name" name="client_name" type="text"
                                    class="mt-1 block w-full" autocomplete="client_name" />
                            </div>
                            <div class="mb-5 relative col-span-2">
                                <x-input-label for="date_sent_quotation_to_client" :value="__('Search By Date Received')" />
                                <x-date-range-input />
                            </div>
                            <div class="mb-5 relative">
                                <x-input-label for="client_name" :value="__('Search')" class="invisible" />
                                <x-primary-button class="mt-1">{{ __('Search') }}</x-primary-button>
                                <a href="{{ route('sales_enquiries.index') }}"
                                    class="focus:outline-none text-gray-900 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-500 font-bold rounded-lg text-sm px-5 py-2.5 mb-2 uppercase">Reset</a>
                            </div>
                        </div>
                    </form>
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table
                            class="w-full text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium">
                            <thead class="text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-nowrap">ID</th>
                                    <th scope="col" class="px-6 py-3">Client Name</th>
                                    <th scope="col" class="px-6 py-3">Location</th>
                                    <th scope="col" class="px-6 py-3 text-nowrap">Created By</th>
                                    <th scope="col" class="px-6 py-3 text-nowrap">Date Received</th>
                                    <th scope="col" class="px-6 py-3">Assigned Status</th>
                                    <th scope="col" class="px-6 py-3 text-nowrap">Quotation Status</th>
                                    <th scope="col" class="px-6 py-3 text-nowrap">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $item)
                                        <tr
                                            class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">

                                            <td class="max-w-sm px-6 py-4 text-nowrap">
                                                <a title="View sales enquiry"
                                                    href="{{ route('sales_enquiries.view', $item->id) }}">{{ $item->id }}</a>
                                            </td>

                                            <td class="max-w-sm px-6 py-4">
                                                <a title="View sales enquiry"
                                                    href="{{ route('sales_enquiries.view', $item->id) }}">{{ $item->client_name }}</a>
                                            </td>
                                            <td class="max-w-sm px-6 py-4">
                                                <a title="View sales enquiry"
                                                    href="{{ route('sales_enquiries.view', $item->id) }}">{{ $item->delivery_point }}</a>
                                            </td>
                                            <td class="px-6 py-4 text-nowrap">
                                                @if ($item->author)
                                                    <x-link
                                                        href="{{ route('users.view', $item->author->id) }}">{{ $item->author->name }}</x-link>
                                                @else
                                                    User not found!
                                                @endif

                                            </td>
                                            <td class="max-w-sm px-6 py-4 text-nowrap">
                                                {{ formatted_date($item->inquiry_date_received) }}
                                            </td>
                                            <td class="max-w-sm px-6 py-4">
                                                @if ($item->assigned_status == 'assigned')
                                                    @if ($item->author)
                                                        <x-link
                                                            href="{{ route('users.view', $item->author->id) }}">{{ $item->author->name }}</x-link>
                                                    @endif
                                                    <span class="text-nowrap"">assigned to</span>
                                                    @if ($item->assignedSalesPerson)
                                                        <x-link
                                                            href="{{ route('users.view', $item->assignedSalesPerson->id) }}">{{ $item->assignedSalesPerson->name }}</x-link>
                                                    @endif
                                                @endif
                                                @if ($item->assigned_status == 'reassigned')
                                                    @if ($item->assignedSalesPerson)
                                                        <x-link
                                                            href="{{ route('users.view', $item->assignedSalesPerson->id) }}">{{ $item->assignedSalesPerson->name }}</x-link>
                                                    @endif
                                                    <span class="text-nowrap"">reassigned to</span>
                                                    @if ($item->author)
                                                        <x-link
                                                            href="{{ route('users.view', $item->author->id) }}">{{ $item->author->name }}</x-link>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-nowrap">
                                                @if ($item->quotation_status == 'Pending')
                                                    <x-badge.pink>{{ $item->quotation_status }}</x-badge>
                                                @endif
                                                @if ($item->quotation_status == 'Approved')
                                                    <x-badge.green>{{ $item->quotation_status }}</x-badge>
                                                @endif
                                                @if ($item->quotation_status == 'In-Progress')
                                                    <x-badge.blue>{{ $item->quotation_status }}</x-badge>
                                                @endif
                                                @if ($item->quotation_status == 'Quotation-Sent')
                                                    <x-badge.purple>{{ $item->quotation_status }}</x-badge>
                                                @endif
                                                @if ($item->quotation_status == 'Rejected')
                                                    <x-badge.red>{{ $item->quotation_status }}</x-badge>
                                                @endif
                                                @if ($item->quotation_status == 'Accomplished')
                                                    <x-badge.green>{{ $item->quotation_status }}</x-badge>
                                                @endif
                                                @if ($item->quotation_status == 'Regret')
                                                    <x-badge.red>{{ $item->quotation_status }}</x-badge>
                                                @endif
                                                @if ($item->follow_up)
                                                    <button type="button"
                                                        data-tooltip-target="tooltip-click-{{ $item->id }}"
                                                        data-tooltip-trigger="click"
                                                        class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-full text-sm p-1 text-center inline-flex items-center me-1 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                                                        <svg class="w-4 h-4" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                    </button>
                                                    <div id="tooltip-click-{{ $item->id }}" role="tooltip"
                                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-600 text-wrap">
                                                        {{ $item->follow_up }}
                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-nowrap">
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
                                                            @php
                                                                $phone = $item->assignedSalesPerson->whatsapp_number;
                                                                $text = urlencode(
                                                                    'Sales Enquiry #' .
                                                                        $item->id .
                                                                        ' - ' .
                                                                        $item->client_name .
                                                                        '  is now assigned to you ',
                                                                );
                                                                $whatsappUrl = "https://wa.me/$phone?text=$text";
                                                            @endphp
                                                            <a href="{{ $whatsappUrl }}" target="_blank">
                                                                <x-badge.whatsapp-icon /></a>
                                                        </li>
                                                        <li class="pb-2">
                                                            @can('view sales enquiry')
                                                                <a title="View sales enquiry"
                                                                    href="{{ route('sales_enquiries.view', $item->id) }}">
                                                                    <x-badge.view-icon />
                                                                </a>
                                                            @endcan
                                                        </li>
                                                        <li class="pb-2">
                                                            @can('edit sales enquiry')
                                                                <a title="Edit sales enquiry"
                                                                    href="{{ route('sales_enquiries.edit', $item->id) }}">
                                                                    <x-badge.edit-icon />
                                                                </a>
                                                            @endcan
                                                        </li>
                                                        <li class="pb-2">
                                                            @can('delete sales enquiry')
                                                                <a title="Delete sales enquiry"
                                                                    href="{{ route('sales_enquiries.delete', $item->id) }}">
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
