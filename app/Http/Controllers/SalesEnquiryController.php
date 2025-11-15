<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ItemCode;
use App\Models\SalesEnquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Exports\SalesEnquiryExport;
use Maatwebsite\Excel\Facades\Excel;

class SalesEnquiryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view sales enquiry', only: ['index', 'show']),
            new Middleware('permission:create sales enquiry', only: ['create', 'store']),
            new Middleware('permission:edit sales enquiry', only: ['edit', 'update']),
            new Middleware('permission:delete sales enquiry', only: ['delete', 'destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->can('view all sales enquiry')) {
            $query = SalesEnquiry::latest();

            // Search by Client Name
            if ($request->filled('client_name')) {
                $query->where('client_name', 'like', '%' . $request->client_name . '%');
            }

            // Search by Date Range
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $fromDate = Carbon::parse($request->start_date)->startOfDay();
                $toDate = Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('inquiry_date_received', [$fromDate, $toDate]);
            } elseif ($request->filled('start_date')) {
                $fromDate = Carbon::parse($request->start_date)->startOfDay();
                $query->whereDate('inquiry_date_received', '>=', $fromDate);
            } elseif ($request->filled('end_date')) {
                $toDate = Carbon::parse($request->end_date)->endOfDay();
                $query->whereDate('inquiry_date_received', '<=', $toDate);
            }

            $list = $query->paginate(25);
        } else {
            $list = SalesEnquiry::latest()->where('assigned_sales_person_id', $user->id)->where('assigned_status', 'assigned')->paginate(25);
        }


        return view('sales_enquiries.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sales_enquiries.create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = SalesEnquiry::findOrFail($id);
        return view('sales_enquiries.view', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('sales_enquiries.edit', ['id' => $id]);
    }

    /**
     * Show the form for delete the specified resource.
     */
    public function delete(string $id)
    {
        $item = SalesEnquiry::findOrFail($id);
        return view('sales_enquiries.delete', ['item' => $item]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sales = SalesEnquiry::findOrFail($id);
        $sales->delete();
        activity()->performedOn($sales)->log('Sales enquiry "' . $sales->id . '" has been deleted!');
        session()->flash('type', 'success');
        session()->flash('message', 'Sales enquiry deleted successfully!');
        return redirect()->route('sales_enquiries.index');
    }

    /**
     * Print preview a resource.
     */
    public function print_preview(string $id)
    {
        $item = SalesEnquiry::findOrFail($id);
        return view('sales_enquiries.print_preview', ['item' => $item]);
    }

    /**
     * Print a resource.
     */
    public function print(Request $request, string $id)
    {
        //dd($request->all());
        $validater = Validator::make($request->all(), [
            'notes' => 'nullable|string',
            'price_validity' => 'required|date',
            'delivery_validity' => 'required|date',
            'contact1' => 'required|string',
            'contact2' => 'nullable|string',
        ]);
        if ($validater->passes()) {
            $item = SalesEnquiry::findOrFail($id);
            $item->notes = $request->notes;
            $item->price_validity = $request->price_validity;
            $item->delivery_validity = $request->delivery_validity;
            $item->foocontact1 = $request->contact1;
            $item->foocontact2 = $request->contact2;
            $pdf = Pdf::loadView('sales_enquiries.print', compact('item'));

            // return $pdf->stream('sales-enquiry' . $item->id . '.pdf'); // Show PDF in browser
            return $pdf->download('sales-enquiry' . $item->id . '.pdf'); // Force download
        } else {
            return redirect()->route('sales_enquiries.print_preview', $id)->withInput()->withErrors($validater);
        }
    }

    /**
     * Dashboard graph resources.
     */
    public function chart_data(): JsonResponse
    {
        $salesData = SalesEnquiry::select(
            DB::raw("YEAR(inquiry_date_received) as year"),
            DB::raw("MONTH(inquiry_date_received) as month"),
            'quotation_status',
            DB::raw("COUNT(*) as total")
        )
            ->groupBy('year', 'month', 'quotation_status')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Define statuses with corresponding colors
        $statuses = [
            'Pending' => ['#f1c40f', '#d4ac0d'],
            'Approved' => ['#2ecc71', '#27ae60'],
            'In-Progress' => ['#3498db', '#2980b9'],
            'Quotation-Sent' => ['#9b59b6', '#8e44ad'],
            'Rejected' => ['#e74c3c', '#c0392b'],
            'Accomplished' => ['#1abc9c', '#16a085'],
            'Regret' => ['#95a5a6', '#7f8c8d']
        ];

        $formattedData = [
            'labels' => [],
            'datasets' => []
        ];

        $datasets = [];
        $monthlyLabels = [];

        // Initialize dataset structure with empty data
        foreach ($statuses as $status => $colors) {
            $datasets[$status] = [
                'label' => $status,
                'data' => [],
                'backgroundColor' => $colors[0],
                'borderColor' => $colors[1],
                'borderWidth' => 1
            ];
        }

        // Process data and ensure unique month-year labels
        foreach ($salesData as $sale) {
            $monthLabel = "{$sale->year}-" . str_pad($sale->month, 2, '0', STR_PAD_LEFT);

            if (!in_array($monthLabel, $monthlyLabels)) {
                $monthlyLabels[] = $monthLabel;
            }

            // Store sales count per status for each month
            if (!isset($datasets[$sale->quotation_status]['data'][$monthLabel])) {
                $datasets[$sale->quotation_status]['data'][$monthLabel] = 0;
            }
            $datasets[$sale->quotation_status]['data'][$monthLabel] += $sale->total;
        }

        // Convert data structure to match Chart.js format
        foreach ($datasets as &$dataset) {
            $dataset['data'] = array_map(fn($label) => $dataset['data'][$label] ?? 0, $monthlyLabels);
        }

        $formattedData['labels'] = $monthlyLabels;
        $formattedData['datasets'] = array_values($datasets);

        return response()->json($formattedData);
    }

    /**
     * Excel all resource.
     */
    public function export()
    {
        return Excel::download(new SalesEnquiryExport, 'sales_enquiries.xlsx');
    }
}
