<x-app-layout>



    <div class="py-6 bg-gray-200 dark:bg-gray-800">


        <div class="sm:px-6 lg:px-8 mb-6">


            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">


                <x-h1>


                    {{ __('Company') }} - {{ $company->name }}


                    </h2>


                </x-h1>


            </div>


        </div>


        <div class="pb-6">


            <div class="sm:px-6 lg:px-8">


                <div class="md:grid grid-cols-5 gap-8">


                    <div class="text-white col-span-2">


                        <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">


                            <div class="avatar flex justify-center">


                                <div class="size-32 rounded-lg overflow-hidden">


                                    @if ($company->cmp_logo)


                                        <img src="{{ asset('storage/' . $company->cmp_logo) }}" alt="avatar" />


                                    @endif


                                </div>


                            </div>


                            <h2 class="text-xl font-bold dark:text-white my-3 text-center text-gray-900">


                                {{ $company->name }}


                            </h2>


                            <dl


                                class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">


                                <div class="flex flex-col pb-3">


                                    <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Code</dt>


                                    <dd class="text-base font-semibold">{{ $company->code }}</dd>


                                </div>


                                <div class="flex flex-col py-3">


                                    <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Status</dt>


                                    <dd class="text-base font-semibold uppercase">


                                        @if ($company->is_active)


                                            <x-badge.green>Active</x-badge.green>


                                        @else


                                            <x-badge.red>Inactive</x-badge.red>


                                        @endif


                                    </dd>


                                </div>


                                <div class="flex flex-col py-3">


                                    <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">TRN No</dt>


                                    <dd class="text-base font-semibold">{{ $company->cmp_trnno }}</dd>


                                </div>


                                <div class="flex flex-col py-3">


                                    <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">License No</dt>


                                    <dd class="text-base font-semibold">{{ $company->cmp_license_no }}</dd>


                                </div>


                                <div class="flex flex-col py-3">


                                    <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">License document</dt>


                                    <dd class="text-base font-semibold">


                                        <a href="{{ Storage::url($company->cmp_license_document) }}" target="_blank"


                                            rel="noopener noreferrer">


                                            Show document


                                        </a>


                                    </dd>


                                </div>


                            </dl>


                        </div>


                    </div>


                    <div class="col-span-3">


                        <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">


                            <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">


                                <div class="flex flex-col pb-3">


                                    <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Description</dt>


                                    <dd class="text-base font-semibold">{{ $company->description }}</dd>


                                </div>


                                <div class="flex flex-col py-3">


                                    <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Address</dt>


                                    <dd class="text-base font-semibold">{{ $company->cmp_address1 }}</dd>


                                    <dd class="text-base font-semibold">{{ $company->cmp_address2 }}</dd>


                                </div>


                                <div class="flex flex-col py-3">


                                    <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Contact Person</dt>


                                    <dd class="text-base font-semibold">{{ $company->cmp_contact_person }}</dd>


                                </div>


                                <div class="flex flex-col py-3">


                                    <dt class="mb-1 text-gray-500 text-base dark:text-gray-400">Contact No</dt>


                                    <dd class="text-base font-semibold">{{ $company->cmp_contact_no }}</dd>


                                </div>


                            </dl>


                        </div>


                    </div>


                </div>


            </div>


        </div>


</x-app-layout>