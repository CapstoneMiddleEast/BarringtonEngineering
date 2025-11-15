<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Invoice ') }} - {{ $item->id }}
                    </x-h1>
                    <div>
                        <x-btn-red-link href="{{ route('invoices.edit', $item->id) }}">
                            Edit</x-btn-red-link>
                        <x-btn-red-link href="{{ route('invoices.print_preview', $item->id) }}">
                            Print preview</x-btn-red-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sm:px-6 lg:px-8">
        <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
            <div class="md:grid grid-cols-4 gap-5">
                <dl class="col-span-3">
                    <x-dt>Client</x-dt>
                    <x-dd class="mb-1">{{ $item->client->name }}</x-dd>
                    <x-dd class="mb-1">{{ $item->client->place }}</x-dd>
                    @if ($item->client->tel)
                        <x-dd class="mb-1"><x-span1>Tel:</x-span1> {{ $item->client->tel }}</x-dd>
                    @endif
                    @if ($item->client->fax)
                        <x-dd class="mb-1"><x-span1>Fax:</x-span1> {{ $item->client->fax }}</x-dd>
                    @endif
                    @if ($item->client->trn)
                        <x-dd class="mb-5"><x-span1>TRN No:</x-span1> {{ $item->client->trn }}</x-dd>
                    @endif
                </dl>
                <dl>
                    <x-dt>Invoice No</x-dt>
                    <x-dd class="mb-5">{{ $item->invoice_no }}</x-dd>
                    <x-dt>Invoice Date</x-dt>
                    <x-dd class="mb-5">{{ formatted_date($item->invoice_date) }}</x-dd>
                    <x-dt>Invoice No</x-dt>
                    <x-dd class="mb-5">{{ $item->client_invoice }}</x-dd>
                    <x-dt>LPO No</x-dt>
                    <x-dd class="mb-5">{{ $item->lpo_no }}</x-dd>
                </dl>
            </div>
            <div class="relative overflow-x-auto sm:rounded-lg">
                @if ($item->items->isNotEmpty())
                    <table
                        class="w-full text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium border-l border-gray-300 dark:border-gray-700 mb-10">
                        <thead class="text-white uppercase bg-gray-400 dark:bg-gray-800">
                            <tr class="border-b border-t border-gray-300 dark:border-gray-700">
                                <th class="px-6 py-3 border-r border-gray-300 dark:border-gray-700 min-w-[230px]">Item
                                    Name
                                </th>
                                <th class="px-6 py-3 border-r border-gray-300 dark:border-gray-700 min-w-[150px]">
                                    Quantity
                                    (Unit)</th>
                                <th class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">Price</th>
                                <th class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">Sub Total</th>
                                <th class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">VAT</th>
                                <th class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->items as $index => $code)
                                <tr class="border-b border-t border-gray-300 dark:border-gray-700">
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">
                                        <p class="font-bold">{{ $code->item->name }} - {{ $code->item->description }}
                                        </p>
                                        <ul class="list-disc list-inside text-nowrap mt-2 space-y-1 italic">
                                            @if ($code->delivery_date)
                                                <li>Delivery Date: {{ formatted_date($code->delivery_date) }}</li>
                                            @endif
                                            @if ($code->delivery_point)
                                                <li>Delivery Point: {{ $code->delivery_point }}</li>
                                            @endif
                                            @if ($code->ticket_no)
                                                <li>Ticket No: {{ $code->ticket_no }}</li>
                                            @endif
                                            @if ($code->vehicle_no)
                                                <li>Vehicle No: {{ $code->vehicle_no }}</li>
                                            @endif
                                            @if ($code->do_no)
                                                <li>DO No: {{ $code->do_no }}</li>
                                            @endif
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">
                                        {{ number_format($code->quantity, 2) }} ( {{ strtoupper($code->unit) }} )</td>
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">
                                        {{ number_format($code->client_unit_price, 2) }}</td>
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">
                                        {{ number_format($code->client_total_price, 2) }}</td>
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">
                                        {{ number_format($code->client_vat, 2) }}</td>
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">
                                        {{ number_format($code->client_total_price_vat, 2) }}</td>
                                </tr>
                                @if (count($code->suppliers) > 0)
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">
                                            <div x-data="{ open: false }">
                                                <div x-show="open">
                                                    <table
                                                        class="w-full text-xs text-left rtl:text-right dark:text-white text-gray-900 font-medium border-l border-gray-300 dark:border-gray-700 mb-10">
                                                        <thead
                                                            class="text-white uppercase bg-gray-400 dark:bg-gray-800">
                                                            <tr
                                                                class="border-b border-t border-gray-300 dark:border-gray-700">
                                                                <th
                                                                    class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">
                                                                    Supplier Name
                                                                </th>
                                                                <th
                                                                    class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">
                                                                    Invoice No</th>
                                                                <th
                                                                    class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">
                                                                    Quantity</th>
                                                                <th
                                                                    class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">
                                                                    Price</th>
                                                                <th
                                                                    class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">
                                                                    Sub Total</th>
                                                                <th
                                                                    class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">
                                                                    VAT</th>
                                                                <th
                                                                    class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">
                                                                    Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($code->suppliers as $sup)
                                                                <tr
                                                                    class="border-b border-gray-300 dark:border-gray-700">
                                                                    <td
                                                                        class="px-6 py-2 border-r border-gray-300 dark:border-gray-700">
                                                                        {{ $sup->supplier->name }}</td>
                                                                    <td
                                                                        class="px-6 py-2 border-r border-gray-300 dark:border-gray-700">
                                                                        {{ $sup->supplier_invoice }}</td>
                                                                    <td
                                                                        class="px-6 py-2 border-r border-gray-300 dark:border-gray-700">
                                                                        {{ number_format($sup->supplier_quantity, 2) }}
                                                                    </td>
                                                                    <td
                                                                        class="px-6 py-2 border-r border-gray-300 dark:border-gray-700">
                                                                        AED
                                                                        {{ number_format($sup->supplier_unit_price, 2) }}
                                                                    </td>
                                                                    <td
                                                                        class="px-6 py-2 border-r border-gray-300 dark:border-gray-700">
                                                                        AED
                                                                        {{ number_format($sup->supplier_total_price, 2) }}
                                                                    </td>
                                                                    <td
                                                                        class="px-6 py-2 border-r border-gray-300 dark:border-gray-700">
                                                                        AED {{ number_format($sup->supplier_vat, 2) }}
                                                                    </td>
                                                                    <td
                                                                        class="px-6 py-2 border-r border-gray-300 dark:border-gray-700">
                                                                        AED
                                                                        {{ number_format($sup->supplier_total_price_vat, 2) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <x-green-button x-on:click="open = ! open"
                                                    x-text="open ? 'Hide Suppliers' : 'View Suppliers'"></x-green-button>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
