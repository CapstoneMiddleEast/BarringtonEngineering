<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view invoice', only: ['index', 'show']),
            new Middleware('permission:create invoice', only: ['create']),
            new Middleware('permission:edit invoice', only: ['edit']),
            new Middleware('permission:delete invoice', only: ['delete', 'destroy']),
        ];
    }

    /**
     * Display a listing of the invoices.
     */
    public function index()
    {
        $list = Invoice::latest()->paginate(25);
        return view('invoices.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new invoices.
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Display the specified invoices.
     */
    public function show($id) 
    {
        $item = Invoice::findOrFail($id);
        return view('invoices.view', ['item' => $item]);
    }

    /**
     * Edit a specified invoices.
     */
    public function edit($id)
    {
        return view('invoices.edit', ['invoiceId' => $id]);
    }

    /**
     * Show the form for delete the specified invoices.
     */
    public function delete(string $id)
    {
        $item = Invoice::findOrFail($id);
        return view('invoices.delete', ['item' => $item]);
    }

    /**
     * Remove the specified invoice from resource.
     */
    public function destroy(string $id)
    {
        $item = Invoice::findOrFail($id);
        $item->delete();
        activity()->performedOn($item)->log('Invoice "' . $item->name . '" has been deleted!');
        session()->flash('type', 'success');
        session()->flash('message', 'Invoice deleted successfully!');
        return redirect()->route('invoices.index');
    }

    /**
     * Print preview a resource.
     */
    public function print_preview(string $id)
    {
        $item = Invoice::findOrFail($id);
        return view('invoices.print_preview', ['item' => $item]);
    }

    /**
     * Print a resource.
     */
    public function print(Request $request, string $id)
    {
        //dd($request->all());
        $validater = Validator::make($request->all(), [
            'terms' => 'required|string',
            'po_no' => 'required|string',
            'capcity' => 'nullable|string',
        ]);
        if ($validater->passes()) {
            $item = Invoice::findOrFail($id);
            $item->terms = $request->terms;
            $item->po_no = $request->po_no;
            $item->capcity = $request->capcity;
            $pdf = Pdf::loadView('invoices.print', compact('item'));

            // return $pdf->stream('sales-enquiry' . $item->id . '.pdf'); // Show PDF in browser
            return $pdf->download('invoices' . $item->id . '.pdf'); // Force download
        } else {
            return redirect()->route('invoices.print_preview', $id)->withInput()->withErrors($validater);
        }
    }
}
