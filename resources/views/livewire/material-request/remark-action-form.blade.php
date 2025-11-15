<div>
    <x-blue-button data-modal-target="remark-modal" data-modal-toggle="remark-modal">Update Remarks</x-blue-button>
    <div id="remark-modal" tabindex="-1" data-modal-backdrop="static"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800">
                <div class="p-4 md:p-5 text-center">
                    <form wire:submit.prevent="saveRemarks">
                        <table
                            class="w-full text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium">
                            <thead
                                class="text-xs text-white uppercase bg-gray-400 dark:bg-gray-800 border border-gray-300 dark:border-gray-900">
                                <tr>
                                    <th class="px-6 py-3">Material</th>
                                    <th class="px-6 py-3">Remark (leave empty if no remarks)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $item)
                                    <tr
                                        class="bg-gray-200 border-b border-r border-l border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                                        <td class="px-6 py-4">{{ $item['material_description'] }}</td>
                                        <td class="px-6 py-4">
                                            <x-text-area wire:model="items.{{ $index }}.remark"
                                                class="mt-1 block w-full" placeholder="Enter remark"
                                                rows="1"></x-text-area>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 text-right">
                            <x-primary-button data-modal-hide="remark-modal"
                                class="ml-2">{{ __('Save Remark') }}</x-primary-button>
                            <button data-modal-hide="remark-modal" type="button"
                                class="py-2.5 px-5 text-base font-bold text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
