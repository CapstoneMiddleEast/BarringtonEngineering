<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Print preview') }}
                    </x-h1>
                    <div>
                        <x-btn-red-link href="{{ route('material_requests.view', $item->id) }}">
                            <svg class="w-[18px] h-[18px] text-white mr-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2.2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                            Back</x-btn-red-link>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <x-error-alert :errors="$errors" />
            @endif
        </div>
    </div>
    <div class="pb-6 bg-gray-200 dark:bg-gray-800 print-body">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('material_requests.print', $item->id) }}" method="post">
                    @csrf
                    <div class="content-wrapper dark:text-black">
                        <div class="content">
                            <table>
                                <tr>
                                    <td style="width: 60%;">
                                        <img class="logo" style="margin-bottom: 20px;"
                                            src="{{ asset('/images/logoBB.png') }}" alt="" />
                                    </td>
                                </tr>
                            </table>
                            <table style="margin-top: 5px;width:100%;" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="font-size:26px;" class="heading">MATERIAL REQUEST FORM</td>
                                </tr>
                            </table>
                            <table style="margin-top: 15px;margin-bottom: 15px;width:100%;border:none;" cellpadding="5"
                                class="address">
                                <tr>
                                    <td style="width: 50%;padding: 10px;font-weight: bold;font-size:15px;">Request
                                        Number:
                                        BV-REQ-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td style="width: 50%;padding: 10px;font-weight: bold;font-size:15px;"
                                        class="text-r">Date:
                                        {{ formatted_date($item->requested_date) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"
                                        style="width: 100%;padding: 10px;font-weight: bold;font-size:15px;">Purpose of
                                        Use: {{ $item->purpose_of_use }}</td>
                                </tr>
                            </table>
                            <table cellspacing="0" cellpadding="0" class="itemTable">
                                <thead style="background-color: #C0C0C0">
                                    <tr class="address1">
                                        <th>NO</th>
                                        <th>MATERIAL DESCRIPTION</th>
                                        <th>QUANTITY</th>
                                        <th>REMARKS</th>
                                        <th>DATE NEEDED</th>
                                        <th>SCOPE OF WORK TO USE</th>
                                        <th>PROJECT LOCATION</th>
                                    </tr>
                                </thead>
                                @php
                                    $maxRows = 5;
                                    $count = 0;
                                @endphp
                                @foreach ($item->items as $key => $code)
                                    <tr class="address">
                                        <td class="text-c">{{ $key + 1 }}</td>
                                        <td>{{ $code->material_description }}</td>
                                        <td>{{ $code->quantity }} {{ $code->unit }}</td>
                                        <td>{{ $code->remark ?: '--' }}</td>
                                        <td>{{ formatted_date($code->date_needed) }}</td>
                                        <td>{{ $code->scope_of_work }}</td>
                                        <td>{{ $code->project_location }}</td>
                                    </tr>
                                @endforeach
                                {{-- Add empty rows if less than 5 --}}
                                @for ($i = $count + 1; $i <= $maxRows; $i++)
                                    <tr class="address">
                                        <td class="text-c">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="text-c">&nbsp;</td>
                                        <td class="text-c">&nbsp;</td>
                                        <td class="text-r">&nbsp;</td>
                                        <td class="text-r">&nbsp;</td>
                                        <td class="text-r">&nbsp;</td>
                                    </tr>
                                @endfor
                            </table>
                            <table style="margin-top: 30px;" cellspacing="0" cellpadding="0" class="itemTable">
                                <thead style="background-color: #C0C0C0">
                                    <tr class="address1">
                                        <th></th>
                                        <th>REQUESTED BY</th>
                                        <th>REVIEWED BY</th>
                                        <th>APPROVED BY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="address" style="text-align: center;">
                                        <th style="background-color: #C0C0C0;padding:5px;">NAME</th>
                                        <td>{{ $item->requester->name }}</td>
                                        <td>
                                            @if ($item->reviewer)
                                                {{ $item->reviewer->name }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->approver)
                                                {{ $item->approver->name }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="address" style="text-align: center;">
                                        <th style="background-color: #C0C0C0;padding:5px;">JOB TITLE</th>
                                        <td>{{ $item->requester->job_title }}</td>
                                        <td>
                                            @if ($item->reviewer)
                                                {{ $item->reviewer->job_title }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->approver)
                                                {{ $item->approver->job_title }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="address" style="text-align: center;">
                                        <th style="background-color: #C0C0C0;padding:5px;">DATE</th>
                                        <td>{{ formatted_date($item->requested_date) }}</td>
                                        <td>
                                            @if ($item->reviewer)
                                                {{ formatted_date($item->reviewed_date) }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->approver)
                                                {{ formatted_date($item->approved_date) }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p style="padding: 10px;text-align:center;">This is a system-generated document and does not
                                require a signature.</p>
                        </div>
                    </div>
                    <div class="p-6 text-white text-center">
                        <x-primary-button>{{ __('Print') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .print-body {
            font-family: "Century Gothic", sans-serif;
            font-style: italic;
            font-size: 15px;
        }

        .print-body .content-wrapper {
            max-width: 1010px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            font-family: Century Gothic, sans-serif;
            overflow: scroll;
        }

        .print-body .content {
            margin: 50px 0px 20px;
            width: 950px
        }

        .print-body .logo {
            width: 250px;
            height: auto;
        }

        p {
            margin: 0;
            font-family: "Century Gothic", sans-serif;
            font-style: italic;
        }

        .p-5 {
            padding: 2px;
        }

        .address {
            font-size: 13px;
        }

        .address1 {
            font-size: 15px;
        }

        .heading {
            padding: 3px;
            font-size: 16px;
            background-color: #C0C0C0;
            color: #000;
            font-weight: bold;
            text-align: center;
        }

        .itemTable {
            margin-top: 10px;
            width: 100%;
            border-top: 1px solid #000;
            border-left: 1px solid #000;
        }

        .itemTable th,
        .itemTable td {
            padding: 5px;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }

        .text-c {
            text-align: center;
        }

        .text-r {
            text-align: right;
        }
    </style>
</x-app-layout>
