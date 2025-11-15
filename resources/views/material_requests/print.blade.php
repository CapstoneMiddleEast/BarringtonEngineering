<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Century Gothic, sans-serif;
            font-style: italic;
        }

        .content {
            margin: 50px 0px 20px;
            margin-top: 30px;
            font-family: Century Gothic, sans-serif;
            font-style: italic;
        }

        .logo {
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

        .pb-5 {
            padding-bottom: 5px;
        }

        .pb-10 {
            padding-bottom: 10px;
        }

        .pb-20 {
            padding-bottom: 20px;
        }

        .pb-30 {
            padding-bottom: 30px;
        }

        .address {
            font-size: 13px;
            font-family: Century Gothic, sans-serif;
            font-style: italic;
        }

        .address1 {
            font-size: 13px;
            font-style: italic;
        }

        .heading {
            padding: 3px;
            font-size: 17px;
            background-color: #C0C0C0;
            font-weight: bold;
            text-align: center;
            font-style: italic;
        }

        .itemTable {
            margin-top: 10px;
            width: 100%;
            border-top: 1px solid #000;
            border-left: 1px solid #000;
            font-family: Century Gothic, sans-serif;
            font-style: italic;
        }

        .itemTable th,
        .itemTable td {
            padding: 5px;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            font-family: Century Gothic, sans-serif;
            font-style: italic;
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
@endphp
<body>
    <div class="content">
        <table>
            <tr>
                <td style="width: 350px;">
                    <img src="data:image/png;base64,{{ $logo }}" alt="Company Logo" style="width: 200px;">
                </td>
            </tr>
        </table>
        <table style="margin-top: 5px;width:100%;" cellspacing="0" cellpadding="0">
            <tr>
                <td style="font-size:26px;" class="heading">MATERIAL REQUEST FORM</td>
            </tr>
        </table>
        <table style="margin-top: 15px;margin-bottom: 15px;width:100%;border:none;" cellpadding="5" class="address">
            <tr>
                <td style="width: 50%;padding: 10px;font-weight: bold;font-size:15px;">Request
                    Number:
                    BV-REQ-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</td>
                <td style="width: 50%;padding: 10px;font-weight: bold;font-size:15px;" class="text-r">Date:
                    {{ formatted_date($item->requested_date) }}</td>
            </tr>
            <tr>
                <td colspan="2" style="width: 100%;padding: 10px;font-weight: bold;font-size:15px;">Purpose of
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
</body>

</html>
