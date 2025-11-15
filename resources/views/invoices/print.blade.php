<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Century Gothic, sans-serif;
        }

        .content {
            margin: 50px 0px 20px;
            margin-top: 30px;
            font-family: Century Gothic, sans-serif;
        }

        .logo {
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

        .pb-5 {
            padding-bottom: 5px;
        }

        .pb-10 {
            padding-bottom: 10px;
        }

        .pb-20 {
            padding-bottom: 20px;
        }

        .mt-5 {
            margin-top: 20px;
        }

        .pb-30 {
            padding-bottom: 30px;
        }

        .address {
            font-size: 13px;
            font-family: Century Gothic, sans-serif;
        }

        .address1 {
            font-size: 13px;
        }

        .headingbg {
            background-color: #C0C0C0;
        }

        .heading {
            padding: 3px;
            font-size: 17px;
            background-color: #C0C0C0;
            font-weight: bold;
            text-align: center;
        }

        .itemTable {
            margin-top: 10px;
            width: 100%;
            border-top: 1px solid #000;
            border-left: 1px solid #000;
            font-family: Century Gothic, sans-serif;
        }

        .itemTable th,
        .itemTable td {
            padding: 5px;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            font-family: Century Gothic, sans-serif;
        }

        .text-c {
            text-align: center;
        }

        .text-r {
            text-align: right;
        }

        .text-l {
            text-align: left;
        }
    </style>
</head>
@php
    $logo = base64_encode(file_get_contents(public_path('images/logoBB.png')));
    $seal = base64_encode(file_get_contents(public_path('images/barringtonSeal.jpg')));
@endphp

<body>
    <div class="content">
        <table>
            <tr>
                <td style="width: 60%">
                    <img src="data:image/png;base64,{{ $logo }}" alt="Company Logo" style="width: 200px;">
                    <table class="address mt-5" cellspacing="0" cellpadding="0">
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
                            <td class="p-5" style="width: 100px;font-weight: bold;">Website:
                            </td>
                            <td class="p-5">https://www.barrington.ae</td>
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
                                        href="mailto:contacts@csme.ae" target="_blank">contacts@csme.ae</a> / <a
                                        style="text-decoration:underline;" href="mailto:capstonemiddleast@gmail.com"
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
                            <td class="p-5"><strong>{{ $item->terms }}</strong></td>
                        </tr>
                        <tr>
                            <td class="p-5" style="width: 100px;font-weight: bold;">PO No:
                            </td>
                            <td class="p-5"><strong>{{ $item->po_no }}</strong></td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table style="margin-top: 5px;width:100%;" cellspacing="0" cellpadding="0" class="mt-5">
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
        <table cellspacing="0" cellpadding="0" class="itemTable mt-5">
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
                        <p style="font-size: 11px;">Location: {{ $code->delivery_point }}</p>
                    </td>
                    <td class="text-c">{{ strtoupper($code->unit) }}</td>
                    <td class="text-c">{{ number_format($code->quantity, 2) }}</td>
                    <td class="text-r">{{ number_format($code->client_unit_price, 2) }}</td>
                    <td class="text-r">{{ number_format($amount, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="height: 50px;" class="address1">
                    <div class="flex">
                        <p class="address1 mt-2 w-24 text-nowrap"><strong>{{ $item->capcity }}</strong>
                        </p>
                    </div>
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
                    <div class="flex text-l">
                        <p class="address1 mt-2 w-24 text-nowrap"><strong>REMARKS</strong>
                        </p>
                    </div>
                </td>
                <td style="text-align:left">GROSS AMOUNT</td>
                <td>{{ number_format($grossAmount, 2) }}</td>
            </tr>
            <tr class="address text-r">
                <td style="text-align:left">DISCOUNT</td>
                <td>-</td>
            </tr>
            @php
                $vat = $grossAmount * 0.05;
                $netAmount = $grossAmount + $vat;
            @endphp
            <tr class="address text-r">
                <td colspan="4"></td>
                <td style="text-align:left">TAXABLE AMOUNT</td>
                <td>{{ number_format($grossAmount, 2) }}</td>
            </tr>
            <tr class="address text-r">
                <td colspan="4" style="text-align: left;font-weight:bold">AMOUNT DUE
                    IN WORDS:</td>
                <td style="text-align:left">VAT 5%</td>
                <td>{{ number_format($vat, 2) }}</td>
            </tr>
            <tr class="address text-r">
                <td colspan="4" style="text-transform: uppercase;text-align: left;font-weight:bold">
                    @numToWords($netAmount) ONLY</td>
                <td style="text-align:left" class="headingbg"><strong>NET AMOUNT DUE</strong></td>
                <td class="headingbg"><strong>{{ number_format($netAmount, 2) }}</strong></td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" class="address1" style="margin-top: 30px;width:100%;">
            <tr>
                <td>
                    <p class="address1 pb-5"><strong>Please make Cheque payable to:</strong></p>
                    <p class="address1 pb-5"><strong>Account Name: BARRINGTON VENTURES GENERAL
                            CONT. AND TRANSPORTATION - L.L.C. -
                            S.P.C.</strong></p>
                    <table style="width:100%;border-spacing: 0px;" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <p class="address1"><strong>Bank Name: Abu Dhabi Commercial Bank PJSC</strong>
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
                        </tr>
                        <tr>
                            <td>
                                <table style="border-spacing: 0px;" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <p class="address1"><strong>IBAN :
                                                    AE750030014305421920001</strong>
                                            <p class="address1" style="margin-top: 30px;text-align:center;">
                                                <strong>PREPARED BY:</strong>
                                            </p>
                                            <p class="address1" style="text-align: center">
                                                Accounts Department </p>
                                            </p>
                                        </td>
                                        <td>
                                            <img src="data:image/png;base64,{{ $seal }}" alt="Company Seal"
                                                width="75" height="75">
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
</body>

</html>
