<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Sales Enquiry ') }} - {{ $item->id }}
                    </x-h1>
                    <div>
                        <x-btn-red-link href="{{ route('sales_enquiries.edit', $item->id) }}">
                            Edit</x-btn-red-link>
                        <x-btn-red-link href="{{ route('sales_enquiries.print_preview', $item->id) }}">
                            Print preview</x-btn-red-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sm:px-6 lg:px-8">
        <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
            <div class="md:grid grid-cols-4 gap-8">
                <dl class="col-span-2">
                    <x-dt>Client name</x-dt>
                    <x-dd class="mb-5">{{ $item->client_name }}</x-dd>
                    <x-dt>Contact person</x-dt>
                    <x-dd class="mb-1">{{ $item->contact_person }}</x-dd>
                    <x-dd class="mb-1">{{ $item->contact_no }}</x-dd>
                    <x-dd class="mb-5"><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></x-dd>
                    <x-dt>Delivery point</x-dt>
                    <x-dd class="mb-5">{{ $item->delivery_point }}</x-dd>
                    <x-dt>Payment terms</x-dt>
                    <x-dd class="mb-5">{{ $item->payment_terms }}</x-dd>
                </dl>
                <dl>
                    <x-dt>Quotation no</x-dt>
                    <x-dd class="mb-5">{{ $item->quotation_no }}</x-dd>
                    <x-dt>Date received</x-dt>
                    <x-dd class="mb-5">{{ formatted_date($item->inquiry_date_received) }}</x-dd>
                    <x-dt>Created By</x-dt>
                    <x-dd class="mb-5">
                        @if ($item->author)
                            <x-link
                                href="{{ route('users.view', $item->author->id) }}">{{ $item->author->name }}</x-link>
                        @else
                            User not found!
                        @endif
                    </x-dd>
                    <x-dt>Assigned Status</x-dt>
                    <x-dd class="mb-5">
                        @if ($item->assigned_status == 'assigned')
                            @if ($item->author)
                                <x-link
                                    href="{{ route('users.view', $item->author->id) }}">{{ $item->author->name }}</x-link>
                            @endif
                            assigned to
                            @if ($item->assignedSalesPerson)
                                <x-link
                                    href="{{ route('users.view', $item->assignedSalesPerson->id) }}">{{ $item->assignedSalesPerson->name }}</x-link>
                            @endif
                            @if (Auth::user()->id == $item->assignedSalesPerson->id)
                                <livewire:sales-enquiry.reassign-sales-model :salesId="$item->id" />
                            @endif
                        @endif
                        @if ($item->assigned_status == 'reassigned')
                            @if ($item->assignedSalesPerson)
                                <x-link
                                    href="{{ route('users.view', $item->assignedSalesPerson->id) }}">{{ $item->assignedSalesPerson->name }}</x-link>
                            @endif
                            reassigned to
                            @if ($item->author)
                                <x-link
                                    href="{{ route('users.view', $item->author->id) }}">{{ $item->author->name }}</x-link>
                            @endif
                        @endif
                    </x-dd>
                </dl>
                <dl>
                    <x-dt>Quotation status</x-dt>
                    <x-dd class="mb-5">{{ $item->quotation_status }}</x-dd>
                    <x-dt>Date quotation sent</x-dt>
                    <x-dd class="mb-5">{{ formatted_date($item->date_sent_quotation_to_client) }}</x-dd>
                    <x-dt>No of days taken for preparing quotation</x-dt>
                    <x-dd class="mb-5">{{ $item->no_of_days_taken_for_preparing_quotation }}</x-dd>
                </dl>
            </div>
            <div class="relative overflow-x-auto sm:rounded-lg">
                <table
                    class="w-full text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium border-l border-gray-300 dark:border-gray-700 mb-6">
                    <thead
                        class="text-xs text-white uppercase bg-gray-400 dark:bg-gray-800 border-t border-gray-300 dark:border-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">Item Code
                            </th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">Quantity
                            </th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">Unit
                            </th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">Buying
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 border-r border-gray-300 dark:border-gray-700">Selling
                                Price
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($item->itemCodes->isNotEmpty())
                            @foreach ($item->itemCodes as $code)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">
                                        {{ $code->name }}
                                    </td>
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">
                                        {{ $code->description }}</td>
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">
                                        {{ number_format($code->pivot->quantity, 2) }}</td>
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">
                                        {{ strtoupper($code->pivot->unit) }}</td>
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">AED
                                        {{ number_format($code->pivot->buying_price, 2) }}</td>
                                    <td class="px-6 py-4 border-r border-gray-300 dark:border-gray-700">AED
                                        {{ number_format($code->pivot->selling_price, 2) }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <dl>
                @if ($item->remark)
                    <x-dt>Remark</x-dt>
                    <x-dd class="mb-5">{{ $item->remark }}</x-dd>
                @endif
                @if ($item->date_follow_up_to_client)
                    <x-dt>Follow up date</x-dt>
                    <x-dd class="mb-5">{{ formatted_date($item->date_follow_up_to_client) }}</x-dd>
                @endif
                @if ($item->follow_up)
                    <x-dt>Follow up</x-dt>
                    <x-dd class="mb-5">{{ $item->follow_up }}</x-dd>
                @endif
                @if ($item->lpo_received)
                    <x-dt>LPO received</x-dt>
                    <x-dd class="mb-5">{{ $item->lpo_received }}</x-dd>
                @endif
                @if ($item->lpo_received_text)
                    <x-dt>LPO received remark</x-dt>
                    <x-dd class="mb-5">{{ $item->lpo_received_text }}</x-dd>
                @endif
                @if ($item->lpo_no)
                    <x-dt>LPO Number</x-dt>
                    <x-dd class="mb-5">{{ $item->lpo_no }}</x-dd>
                @endif
                @if ($item->lpo_doc)
                    <x-dt>LPO Document</x-dt>
                    <x-dd><x-link href="{{ Storage::url($item->lpo_doc) }}" target="_blank">Show
                            Document</x-link></x-dd>
                @endif
            </dl>
        </div>
    </div>
</x-app-layout>
