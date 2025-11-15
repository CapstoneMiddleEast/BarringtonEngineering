<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Print preview') }}
                    </x-h1>
                    <div>
                        <x-btn-red-link href="{{ route('invoices.view', $item->id) }}">
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
    <div class="pb-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('invoices.print', $item->id) }}" method="post">
                    @csrf
                    <div class="content-wrapper dark:text-black">
                        <div class="content">
                            <table>
                                <tr>
                                    <td style="width: 50%;">
                                        <img class="logo" src="{{ asset('/images/logoBB.png') }}"
                                            alt="" />
                                        <table class="address mt-5">
                                            <tr>
                                                <td class="p-5 mt-0 block" style="width: 100px;font-weight: bold;">
                                                    Address:</td>
                                                <td class="p-5" style="font-weight: bold;">Office No. 201, 2nd floor,
                                                    P1809 ADCP Tower Hamdan
                                                    Street,
                                                    Abu Dhabi, UAE
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-5" style="width: 100px;font-weight: bold;">Contact No:
                                                </td>
                                                <td class="p-5">02-5860774/050 142 2807</td>
                                            </tr>
                                            <tr>
                                                <td class="p-5 mt-0 block" style="width: 100px;font-weight: bold;">
                                                    Email:
                                                </td>
                                                <td class="p-5">
                                                    <p style="color:#063dd4;"><a style="text-decoration:underline;"
                                                            href="mailto:contacts@csme.ae"
                                                            target="_blank">contacts@csme.ae</a> / <a
                                                            style="text-decoration:underline;"
                                                            href="mailto:capstonemiddleast@gmail.com"
                                                            target="_blank">capstonemiddleast@gmail.com</a>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-5" style="width: 100px;font-weight: bold;">TRN No:</td>
                                                <td class="p-5"><strong>105102106900003</strong></td>
                                            </tr>
                                        </table>
                                        <table class="address mt-5">
                                            <tr>
                                                <td class="p-5 headingbg" style="width: 100px;font-weight: bold;">
                                                    Invoice
                                                    No:
                                                </td>
                                                <td class="p-5"><strong>{{ $item->invoice_no }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="p-5" style="width: 100px;font-weight: bold;">Invoice Date:
                                                </td>
                                                <td class="p-5">
                                                    <strong>{{ formatted_date($item->invoice_date) }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-5" style="width: 100px;font-weight: bold;">Terms:
                                                </td>
                                                <td class="p-5">
                                                    <x-text-input name="terms" type="text"
                                                        class="mt-1 items-center text-xs" required
                                                        value="CASH ON DELIVERY" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-5" style="width: 100px;font-weight: bold;">PO No:
                                                </td>
                                                <td class="p-5">
                                                    <x-text-input name="po_no" type="text"
                                                        class="mt-1 items-center text-xs" required
                                                        value="VERBAL CONFIRMATION" />
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="vertical-align: top;">
                                        <table style="margin-top: 5px;width:100%;" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="font-size:26px; font-weight: bold;" class="heading">TAX
                                                    INVOICE</td>
                                            </tr>
                                        </table>
                                        <table class="address mt-5">
                                            <tr>
                                                <td class="p-5 headingbg" style="width: 150px;font-weight: bold;">
                                                    Bill To:
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-5" style="width: 100px;font-weight: bold;">Company Name:
                                                </td>
                                                <td class="p-5" style="text-align: center;">
                                                    <strong>{{ $item->client->name }}</strong>
                                                </td>
                                            </tr>
                                            @if ($item->client->place)
                                                <tr>
                                                    <td class="p-5" style="width: 100px;font-weight: bold;">Address:
                                                    </td>
                                                    <td class="p-5" style="text-align: center;">
                                                        <strong>{{ $item->client->place }}</strong>
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($item->client->tel)
                                                <tr>
                                                    <td class="p-5" style="width: 100px;font-weight: bold;">
                                                        Phone/Email:
                                                    </td>
                                                    <td class="p-5" style="text-align: center;"><strong>Tel No:
                                                            {{ $item->client->tel }}</strong>
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($item->client->fax)
                                                <tr>
                                                    <td class="p-5" style="width: 100px;font-weight: bold;">Fax:
                                                    </td>
                                                    <td class="p-5" style="text-align: center;">
                                                        <strong>{{ $item->client->fax }}</strong>
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($item->client->trn)
                                                <tr>
                                                    <td class="p-5" style="width: 100px;font-weight: bold;">TRN No:
                                                    </td>
                                                    <td class="p-5" style="text-align: center;">
                                                        <strong>{{ $item->client->trn }}</strong>
                                                    </td>
                                                </tr>
                                            @endif
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table cellspacing="0" cellpadding="0" class="itemTable">
                                <tr class="address1 headingbg">
                                    <th>SN</th>
                                    <th>GOODS/SERVICES DESCRIPTION</th>
                                    <th>UNIT</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                </tr>
                                @php
                                    $grossAmount = 0;
                                    $maxRows = 5;
                                    $count = 0;
                                @endphp
                                @foreach ($item->items as $key => $code)
                                    @php
                                        $amount = $code->quantity * $code->client_unit_price;
                                        $grossAmount += $amount;
                                        $count++;
                                    @endphp
                                    <tr class="address">
                                        <td class="text-c">{{ $key + 1 }}</td>
                                        <td>
                                            <p>
                                                @if ($code->description != 'Transportation')
                                                    Supply of
                                                @endif{{ $code->item->description }}
                                            </p>
                                            <p class="text-xs">Location: {{ $code->delivery_point }}</p>
                                        </td>
                                        <td class="text-c">{{ strtoupper($code->unit) }}</td>
                                        <td class="text-c">{{ number_format($code->quantity, 2) }}</td>
                                        <td class="text-r">{{ number_format($code->client_unit_price, 2) }}</td>
                                        <td class="text-r">{{ number_format($amount, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" style="height: 50px;" class="address1">
                                        <x-text-input name="capcity" type="text"
                                            class="mt-1 items-center text-xs w-full" value="" />
                                    </td>
                                </tr>
                                {{-- Add empty rows if less than 5 --}}
                                @for ($i = $count + 1; $i <= $maxRows; $i++)
                                    <tr class="address">
                                        <td class="text-c">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="text-c">&nbsp;</td>
                                        <td class="text-c">&nbsp;</td>
                                        <td class="text-r">&nbsp;</td>
                                        <td class="text-r">&nbsp;</td>
                                    </tr>
                                @endfor
                                <tr class="total address text-r">
                                    <td colspan="4" rowspan="2">
                                        <p class="address1 mt-2 text-left"><strong>REMARKS</strong>
                                        </p>
                                    </td>
                                    <td style="text-align: left">GROSS AMOUNT</td>
                                    <td>{{ number_format($grossAmount, 2) }}</td>
                                </tr>
                                <tr class="address text-r">
                                    <td style="text-align: left">DISCOUNT</td>
                                    <td>-</td>
                                </tr>
                                @php
                                    $vat = $grossAmount * 0.05;
                                    $netAmount = $grossAmount + $vat;
                                @endphp
                                <tr class="address text-r">
                                    <td colspan="4"></td>
                                    <td style="text-align: left">TAXABLE AMOUNT</td>
                                    <td>{{ number_format($grossAmount, 2) }}</td>
                                </tr>
                                <tr class="address text-r">
                                    <td colspan="4" style="text-align: left;font-weight:bold">AMOUNT DUE
                                        IN WORDS:</td>
                                    <td style="text-align: left">VAT 5%</td>
                                    <td>{{ number_format($vat, 2) }}</td>

                                </tr>
                                <tr class="address text-r">
                                    <td colspan="4"
                                        style="text-transform: uppercase;text-align: left;font-weight:bold">
                                        @numToWords($netAmount) ONLY</td>
                                    <td style="text-align: left" class="headingbg"><strong>NET AMOUNT DUE</strong>
                                    </td>
                                    <td class="headingbg"><strong>{{ number_format($netAmount, 2) }}</strong></td>
                                </tr>
                            </table>
                            <table cellspacing="0" cellpadding="0" class="address1"
                                style="margin-top: 30px;width:100%;">
                                <tr>
                                    <td>
                                        <p class="address1"><strong>Please make Cheque payable to:</strong></p>
                                        <p class="address1 mt-2"><strong>Account Name:
                                                BARRINGTON VENTURES GENERAL CONT. AND TRANSPORTATION - L.L.C. -
                                                S.P.C.</strong></p>
                                        <table style="width:80%;" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td>
                                                    <p class="address1"><strong>Bank Name: Abu Dhabi Commercial Bank
                                                            PJSC</strong>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="address1"><strong>Swift Code: ADCBAEAA</strong>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="address1"><strong>Account No.: 14305421920001</strong>
                                                    </p>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <p class="address1"><strong>IBAN :
                                                                        AE750030014305421920001</strong>
                                                                <p class="address1"
                                                                    style="margin-top: 30px;text-align:center;">
                                                                    <strong>PREPARED BY:</strong>
                                                                </p>
                                                                <p class="address1" style="text-align: center">
                                                                    Accounts Department </p>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <img width="85" height="74"
                                                                    src="{{ asset('/images/barringtonSeal.jpg') }}" />
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </td>
                                                <td>
                                                    <p class="address1" style="margin-top: 30px;text-align:center;">
                                                        <strong>RECEIVED BY:</strong>
                                                    </p>
                                                    <p class="address1" style="text-align: center">
                                                        Client Signature</p>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
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
        .content-wrapper {
            font-family: "Century Gothic", sans-serif;
        }

        .content-wrapper {
            max-width: 1010px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            font-family: Century Gothic, sans-serif;
            overflow: scroll;
        }

        .content-wrapper .content {
            margin: 50px 0px 20px;
            width: 950px
        }

        .content-wrapper .logo {
            width: 250px;
            height: auto;
        }

        p {
            margin: 0;
            font-family: "Century Gothic", sans-serif;
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

        .headingbg {
            background-color: #C0C0C0;
        }

        .heading {
            padding: 3px;
            font-size: 16px;
            background-color: #C0C0C0;
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
