<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Material requests') }}
                    </x-h1>
                    <div>
                        @can('create material request')
                            <x-btn-add href="{{ route('material_requests.create') }}"></x-btn-add>
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
                            class="w-full text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium min-h-40">
                            <thead class="text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Request No</th>
                                    <th scope="col" class="px-6 py-3">Project Name</th>
                                    <th scope="col" class="px-6 py-3">Purpose of Use</th>
                                    <th scope="col" class="px-6 py-3">Requested By</th>
                                    <th scope="col" class="px-6 py-3">Reviewed By</th>
                                    <th scope="col" class="px-6 py-3">Approved By</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $request)
                                        @php
                                            $allRejected =
                                                $request->items->isNotEmpty() &&
                                                $request->items->every(fn($item) => $item->rejected);
                                            $isApproved = $request->approver;

                                            $rowClass = 'bg-gray-200 dark:bg-gray-700'; // Default
                                            if ($allRejected) {
                                                $rowClass = 'bg-red-300 dark:bg-red-500';
                                            } elseif ($request->status === 'delivered_to_site') {
                                                $rowClass = 'bg-blue-300 dark:bg-blue-500';
                                            } elseif ($isApproved) {
                                                $rowClass = 'bg-green-300 dark:bg-green-500';
                                            }
                                        @endphp
                                        <tr class="border-b border-gray-300 dark:border-gray-900 {{ $rowClass }}">
                                            <td class="px-6 py-4">
                                                <a title="View material request"
                                                    href="{{ route('material_requests.view', $request->id) }}">BV-REQ-{{ \Carbon\Carbon::parse($request->date)->format('ym') }}-{{ str_pad($request->id, 3, '0', STR_PAD_LEFT) }}</a>
                                            </td>
                                            <td class="px-6 py-4 text-nowrap"><a title="View material request"
                                                    href="{{ route('material_requests.view', $request->id) }}">{{ $request->project }}</a>
                                            </td>
                                            <td class="px-6 py-4 text-nowrap">{{ $request->purpose_of_use }}</td>
                                            <td class="px-6 py-4 text-nowrap">{{ $request->requester->name }} <br>
                                                {{ formatted_date($request->requested_date) }}</td>
                                            <td class="px-6 py-4 text-nowrap">
                                                @if ($request->reviewer)
                                                    {{ $request->reviewer->name }}<br>
                                                    {{ formatted_date($request->reviewed_date) }}
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-nowrap">
                                                @if ($request->approver)
                                                    {{ $request->approver->name }}<br>
                                                    {{ formatted_date($request->approved_date) }}
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 flex">
                                                <button id="dropdownMenuIconHorizontalButton-{{ $request->id }}"
                                                    data-dropdown-toggle="dropdownDotsHorizontal-{{ $request->id }}"
                                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                                    type="button">
                                                    <svg class="w-5 h-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 16 3">
                                                        <path
                                                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                                    </svg>
                                                </button>
                                                <div id="dropdownDotsHorizontal-{{ $request->id }}"
                                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-800 dark:divide-gray-600">
                                                    <ul class="py-2 pl-2 text-sm text-gray-700 dark:text-gray-200"
                                                        aria-labelledby="dropdownMenuIconHorizontalButton-{{ $request->id }}">
                                                        <li class="pb-2">
                                                         @php
                                                                $text = urlencode(
                                                                    'Material Request form, BV-REQ-' .
                                                                    \Carbon\Carbon::parse($request->date)->format('ym') . '-' .
                                                                    str_pad($request->id, 3, '0', STR_PAD_LEFT) . ' - ' .
                                                                    $request->project .
                                                                    ' has been added. Please check, review, and approve'
                                                                );

                                                                $whatsappUrl = "https://wa.me/?text={$text}";
                                                            @endphp

                                                            <a href="{{ $whatsappUrl }}" target="_blank">
                                                                <x-badge.whatsapp-icon />
                                                            </a>
                                                        </li>
                                                        <li class="pb-2">
                                                            @can('view material request')
                                                                <a title="View material request"
                                                                    href="{{ route('material_requests.view', $request->id) }}">
                                                                    <x-badge.view-icon />
                                                                </a>
                                                            @endcan
                                                        </li>
                                                        <li class="pb-2">
                                                            @can('edit material request')
                                                                <a title="Edit material request"
                                                                    href="{{ route('material_requests.edit', $request->id) }}">
                                                                    <x-badge.edit-icon />
                                                                </a>
                                                            @endcan
                                                        </li>
                                                        <li class="pb-2">
                                                            @can('delete material request')
                                                                <a title="Delete material request"
                                                                    href="{{ route('material_requests.delete', $request->id) }}">
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
