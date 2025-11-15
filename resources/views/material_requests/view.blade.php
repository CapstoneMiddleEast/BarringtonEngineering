<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Material request ') }} - {{ $item->id }}
                    </x-h1>
                    <div class="flex gap-2">
                        @can('edit material request')
                            <x-btn-red-link href="{{ route('material_requests.edit', $item->id) }}">
                                Edit</x-btn-red-link>
                        @endcan
                        <x-btn-red-link href="{{ route('material_requests.print_preview', $item->id) }}">
                            Print preview</x-btn-red-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-session-message :type="session('type', 'info')" />
    <div class="sm:px-6 lg:px-8">
        <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
            <div class="md:grid grid-cols-3 gap-5">
                <dl>
                    <x-dt>Request Number</x-dt>
                    <x-dd class="mb-5">BV-REQ-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</x-dd>
                    <x-dt>Project</x-dt>
                    <x-dd class="mb-5">{{ $item->project }}</x-dd>
                </dl>
                <dl>
                    <x-dt>Date</x-dt>
                    <x-dd class="mb-5">{{ formatted_date($item->requested_date) }}</x-dd>
                    <x-dt>Purpose of Use</x-dt>
                    <x-dd class="mb-5">{{ $item->purpose_of_use }}</x-dd>
                </dl>
                <dl>
                    <x-dt>Status</x-dt>
                    <x-dd class="mb-5">
                        @if ($item->status === 'inprogress')
                            In Progress
                        @elseif($item->status === 'delivered_to_site')
                            Delivered to Site
                        @elseif($allRejected)
                            Rejected
                        @elseif($isApproved)
                            Approved
                        @else
                            Pending
                        @endif
                    </x-dd>
                </dl>
            </div>
            <div class="relative overflow-x-auto sm:rounded-lg mt-6">
                @if ($item->items->isNotEmpty())
                    <table class="w-full text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium">
                        <thead class="text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Material Name</th>
                                <th scope="col" class="px-6 py-3">Description</th>
                                <th scope="col" class="px-6 py-3">Quantity</th>
                                <th scope="col" class="px-6 py-3">Remarks</th>
                                <th scope="col" class="px-6 py-3">Date Needed</th>
                                <th scope="col" class="px-6 py-3">Scope of Work</th>
                                <th scope="col" class="px-6 py-3">Project Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->items as $index => $mr)
                                <tr
                                    class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700 @if ($mr->rejected) bg-red-200 dark:bg-red-300 text-red-700 line-through @endif">
                                    <td class="px-6 py-4 text-nowrap"><span class="mr-2">{{ $index + 1 }}</span>
                                        @if ($mr->rejected)
                                            <button type="button"
                                                data-tooltip-target="tooltip-click-{{ $mr->id }}"
                                                data-tooltip-trigger="click"
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-1 text-center inline-flex items-center me-1 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 no-underline">
                                                <svg class="w-4 h-4" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </button>
                                            <div id="tooltip-click-{{ $mr->id }}" role="tooltip"
                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-600 text-wrap no-underline">
                                                {{ $mr->rejected_reason }}
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-nowrap">{{ $mr->material_name }}</td>
                                    <td class="px-6 py-4">{{ $mr->material_description }}</td>
                                    <td class="px-6 py-4 text-nowrap">{{ $mr->quantity }} {{ $mr->unit }}</td>
                                    <td class="px-6 py-4">{{ $mr->remark ?: '--' }}</td>
                                    <td class="px-6 py-4 text-nowrap">{{ formatted_date($mr->date_needed) }}</td>
                                    <td class="px-6 py-4 text-nowrap">{{ $mr->scope_of_work }}</td>
                                    <td class="px-6 py-4 text-nowrap">{{ $mr->project_location }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="relative overflow-x-auto sm:rounded-lg mt-6">
                <table class="w-full text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium">
                    <thead class="text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">Requested By</th>
                            <th scope="col" class="px-6 py-3">Reviewed By</th>
                            <th scope="col" class="px-6 py-3">Approved By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                            <th class="px-6 py-4 text-nowrap text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                                Name</th>
                            <td class="px-6 py-4 text-nowrap">{{ $item->requester->name }}</td>
                            <td class="px-6 py-4 text-nowrap">
                                @if ($item->reviewer)
                                    {{ $item->reviewer->name }}
                                @else
                                    --
                                @endif
                            </td>
                            <td class="px-6 py-4 text-nowrap">
                                @if ($item->approver)
                                    {{ $item->approver->name }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                            <th class="px-6 py-4 text-nowrap text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                                Job title</th>
                            <td class="px-6 py-4 text-nowrap">{{ $item->requester->job_title }}</td>
                            <td class="px-6 py-4 text-nowrap">
                                @if ($item->reviewer)
                                    {{ $item->reviewer->job_title }}
                                @else
                                    --
                                @endif
                            </td>
                            <td class="px-6 py-4 text-nowrap">
                                @if ($item->approver)
                                    {{ $item->approver->job_title }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        <tr class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                            <th class="px-6 py-4 text-nowrap text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                                Date</th>
                            <td class="px-6 py-4 text-nowrap">{{ formatted_date($item->requested_date) }}</td>
                            <td class="px-6 py-4 text-nowrap">
                                @if ($item->reviewer)
                                    {{ formatted_date($item->reviewed_date) }}
                                @else
                                    --
                                @endif
                            </td>
                            <td class="px-6 py-4 text-nowrap">
                                @if ($item->approver)
                                    {{ formatted_date($item->approved_date) }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-6 flex gap-2 justify-center">
                    @can('status material request')
                        @if ($item->status == 'inprogress')
                            <form action="{{ route('material_requests.deliver', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <x-blue-button type="submit">Mark Delivered</x-blue-button>
                            </form>
                        @endif
                    @endcan
                    @can('reject material request')
                        <livewire:material-request.reject-action-form :materialRequestId="$item->id" />
                    @endcan
                    @can('remark material request')
                        <livewire:material-request.remark-action-form :materialRequestId="$item->id" />
                    @endcan
                    @if (!$item->reviewer || !$item->approver)
                        <livewire:material-request.material-request-action-form :mrId="$item->id" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
