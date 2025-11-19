<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>{{ __('Company') }}</x-h1>
                    <div>
                        @can('Add new company')
                            <x-btn-add href="{{ route('company.create') }}"></x-btn-add>
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
                                    <th scope="col" class="px-6 py-3">Company Code</th>
                                    <th scope="col" class="px-6 py-3">Company Name</th>
                                    <th scope="col" class="px-6 py-3">TRN Number</th>
                                    <th scope="col" class="px-6 py-3">Licence Number</th>
                                    <th scope="col" class="px-6 py-3">Contact Person</th>
                                    <th scope="col" class="px-6 py-3">Contact Number</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                     <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $company)
                                        <tr
                                            class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                                            <td
                                              class="items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $company->code }}
                                            </td>
                                            <td class="px-6 py-4"> <span
                                            class="text-xs md:text-base font-semibold block">
                                                    <a href="{{ route('company.view', $company->id) }}"
                                                        class="flex items-center">
                                                        @if ($company->cmp_logo)
                                                            <img src="{{ Storage::url($company->cmp_logo) }}"
                                                                alt="Logo" class="h-12 w-12 object-cover rounded">
                                                        @endif
                                                        <span class="ps-3">{{ $company->name }}</span>
                                                    </a>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4"> {{ $company->cmp_trnno }} </td>
                                            <td class="px-6 py-4"> {{ $company->cmp_license_no }} </td>
                                            <td class="px-6 py-4"> {{ $company->cmp_contact_person }} </td>
                                            <td class="px-6 py-4"> {{ $company->cmp_contact_no }} </td>
                                            <td class="px-6 py-4">
                                                @if ($company->is_active)
                                                    <x-badge.green>Active</x-badge.green>
                                                @else
                                                    <x-badge.red>Inactive</x-badge.red>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 inline-flex">
                                                @can('view company')
                                                    <a title="View company"
                                                        href="{{ route('company.view', $company->id) }}">
                                                        <x-badge.view-icon />
                                                    </a>
                                                @endcan
                                                 @can('edit company')
                                                    <a title="Edit company"
                                                        href="{{ route('company.edit', $company->id) }}">
                                                        <x-badge.edit-icon />
                                                    </a>
                                                @endcan
                                                 @can('delete company')
                                                    <a title="Delete company"
                                                        href="{{ route('company.delete', $company->id) }}">
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