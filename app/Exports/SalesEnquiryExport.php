<?php

namespace App\Exports;

use App\Models\SalesEnquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesEnquiryExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $rows = [];

        $enquiries = SalesEnquiry::with(['assignedSalesPerson', 'itemCodes'])->get();

        foreach ($enquiries as $enquiry) {
            foreach ($enquiry->itemCodes as $item) {
                $rows[] = [
                    'enquiry_id' => $enquiry->id,
                    'assigned_sales_person' => optional($enquiry->assignedSalesPerson)->name,
                    'inquiry_date_received' => \Carbon\Carbon::parse($enquiry->inquiry_date_received)->format('d-m-Y'),
                    'quotation_no' => $enquiry->quotation_no,
                    'client_name' => $enquiry->client_name,
                    'contact_person' => $enquiry->contact_person,
                    'contact_no' => $enquiry->contact_no,
                    'email' => $enquiry->email,
                    'delivery_point' => $enquiry->delivery_point,
                    'quotation_status' => $enquiry->quotation_status,
                    'lpo_no' => $enquiry->lpo_received,
                    'remark' => $enquiry->remark,
                    'item_description' => $item->description,
                    'selling_price' => $item->pivot->selling_price . " / " . $item->pivot->unit,
                    'buying_price' => $item->pivot->buying_price . " / " . $item->pivot->unit,
                ];
            }
        }

        return collect($rows);
    }

    public function headings(): array
    {
        return [
            'Enquiry ID',
            'Sales Person',
            'Date Received',
            'Quotation No',
            'Client Name',
            'Contact Person',
            'Contact Number',
            'Contact Email',
            'Delivery Point',
            'Quotation Status',
            'LPO No',
            'Remark',
            'Item Description',
            'Selling Price',
            'Buying Price',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $sheet->getHighestRow();
        $styles = [];

        // Define color palette (first 10 sales persons)
        $colorPalette = [
            'FFCDD2', // red
            'F8BBD0', // pink
            'E1BEE7', // purple
            'D1C4E9', // deep purple
            'C5CAE9', // indigo
            'BBDEFB', // blue
            'B3E5FC', // light blue
            'B2EBF2', // cyan
            'B2DFDB', // teal
            'C8E6C9', // green
        ];

        $salesPersonColors = [];
        $colorIndex = 0;

        for ($row = 2; $row <= $rowCount; $row++) {
            $salesPersonName = $sheet->getCell('B' . $row)->getValue();

            if (!isset($salesPersonColors[$salesPersonName])) {
                if ($colorIndex < count($colorPalette)) {
                    $salesPersonColors[$salesPersonName] = $colorPalette[$colorIndex];
                    $colorIndex++;
                } else {
                    $salesPersonColors[$salesPersonName] = 'FFFFFF'; // white for others
                }
            }

            $color = $salesPersonColors[$salesPersonName];

            $highestColumn = $sheet->getHighestColumn();
            $styles["A{$row}:{$highestColumn}{$row}"] = [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => $color],
                ],
            ];
        }

        return $styles;
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $currentRow = 2;
                $enquiries = SalesEnquiry::with(['assignedSalesPerson', 'itemCodes'])->get();

                foreach ($enquiries as $enquiry) {
                    $itemCount = $enquiry->itemCodes->count();

                    if ($itemCount > 1) {
                        $startRow = $currentRow;
                        $endRow = $currentRow + $itemCount - 1;

                        // Merge columns A, B, C, D, J, H, I, J, K, L (Status)
                        $sheet->mergeCells("A{$startRow}:A{$endRow}");
                        $sheet->mergeCells("B{$startRow}:B{$endRow}");
                        $sheet->mergeCells("C{$startRow}:C{$endRow}");
                        $sheet->mergeCells("D{$startRow}:D{$endRow}");
                        $sheet->mergeCells("E{$startRow}:E{$endRow}");
                        $sheet->mergeCells("F{$startRow}:F{$endRow}");
                        $sheet->mergeCells("G{$startRow}:G{$endRow}");
                        $sheet->mergeCells("H{$startRow}:H{$endRow}");
                        $sheet->mergeCells("I{$startRow}:I{$endRow}");
                        $sheet->mergeCells("J{$startRow}:J{$endRow}");
                        $sheet->mergeCells("K{$startRow}:K{$endRow}");
                        $sheet->mergeCells("L{$startRow}:L{$endRow}");

                        $currentRow += $itemCount;
                    } else {
                        $currentRow++;
                    }
                }
            }
        ];
    }
}
