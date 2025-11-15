@props(['disabled' => false])
<div id="date-range-picker" date-rangepicker datepicker-autohide datepicker-format="dd-mm-yyyy" class="flex items-center">
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
        </div>
        <input id="datepicker-range-start" name="start_date" type="text" value="{{ request('start_date') }}"
            class="text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm pl-10 mt-1 block w-full"
            placeholder="dd-mm-yyyy">
    </div>
    <span class="mx-4 text-gray-500 dark:text-gray-100">to</span>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
        </div>
        <input id="datepicker-range-end" name="end_date" type="text" value="{{ request('end_date') }}"
            class="text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm pl-10 mt-1 block w-full"
            placeholder="dd-mm-yyyy">
    </div>
</div>
