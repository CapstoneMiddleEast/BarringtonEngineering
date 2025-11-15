<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Accounts Receivable') }}
                    </x-h1>
                    <div>
                        @can('create payment')
                            <x-btn-add href="{{ route('payments.create') }}"></x-btn-add>
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
                    <div class="relative overflow-x-auto sm:rounded-lg min-h-40">
                        <table
                            class="w-full text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium">
                            <thead class="text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Invoice No</th>
                                    <th scope="col" class="px-6 py-3">Client Name</th>
                                    <th scope="col" class="px-6 py-3">Paid Date</th>
                                    <th scope="col" class="px-6 py-3">Method</th>
                                    <th scope="col" class="px-6 py-3">Txn/Ref No</th>
                                    <th scope="col" class="px-6 py-3">Amount</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $payment)
                                        <tr
                                            class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                                            <td class="px-6 py-4">
                                                <a title="View material request"
                                                    href="{{ route('invoices.view', $payment->invoice_id) }}">
                                                    {{ $payment->invoice->invoice_no }}</a>
                                            </td>
                                            <td class="px-6 py-4 text-nowrap"><a title="View material request"
                                                    href="{{ route('invoices.view', $payment->invoice_id) }}">{{ $payment->client->name }}</a>
                                            </td>
                                            <td class="px-6 py-4 text-nowrap">{{ formatted_date($payment->paid_at) }}
                                            </td>
                                            <td class="px-6 py-4 text-nowrap">{{ $payment->method }}</td>
                                            <td class="px-6 py-4 text-nowrap">
                                                <span class="mr-1">{{ $payment->reference }}</span>
                                                @if ($payment->notes)
                                                    <button type="button"
                                                        data-tooltip-target="tooltip-click-{{ $payment->id }}"
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
                                                    <div id="tooltip-click-{{ $payment->id }}" role="tooltip"
                                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-600 text-wrap">
                                                        {{ $payment->notes }}
                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-nowrap">AED {{ $payment->amount }} </td>
                                            <td class="px-6 py-4 flex">
                                                <button id="dropdownMenuIconHorizontalButton-{{ $payment->id }}"
                                                    data-dropdown-toggle="dropdownDotsHorizontal-{{ $payment->id }}"
                                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                                    type="button">
                                                    <svg class="w-5 h-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 16 3">
                                                        <path
                                                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                                    </svg>
                                                </button>
                                                <div id="dropdownDotsHorizontal-{{ $payment->id }}"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-800 dark:divide-gray-600">
                                                    <ul class="py-2 pl-2 text-sm text-gray-700 dark:text-gray-200"
                                                        aria-labelledby="dropdownMenuIconHorizontalButton-{{ $payment->id }}">
                                                        <li class="pb-2">
                                                            @can('edit payment')
                                                                <a title="Edit payment"
                                                                    href="{{ route('payments.edit', $payment->id) }}">
                                                                    <x-badge.edit-icon />
                                                                </a>
                                                            @endcan
                                                        </li>
                                                        <li class="pb-2">
                                                            @can('delete payment')
                                                                <a title="Delete payment"
                                                                    href="{{ route('payments.delete', $payment->id) }}">
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
