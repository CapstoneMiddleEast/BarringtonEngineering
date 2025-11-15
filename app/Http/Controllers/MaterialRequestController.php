<?php

namespace App\Http\Controllers;

use App\Models\MaterialRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Barryvdh\DomPDF\Facade\Pdf;

class MaterialRequestController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view material request', only: ['index', 'show']),
            new Middleware('permission:create material request', only: ['create']),
            new Middleware('permission:edit material request', only: ['edit']),
            new Middleware('permission:delete material request', only: ['delete', 'destroy']),
        ];
    }


    /**
     * Display a listing of the Material Request.
     */
    public function index()
    {
        $list = MaterialRequest::latest()->paginate(25);
        return view('material_requests.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new Material Request.
     */
    public function create()
    {
        return view('material_requests.create');
    }

    /**
     * Display the specified Material Request.
     */
    public function show($id)
    {
        $item = MaterialRequest::findOrFail($id);
        return view('material_requests.view', ['item' => $item]);
    }

    /**
     * Edit a specified Material Request.
     */
    public function edit($id)
    {
        $item = MaterialRequest::findOrFail($id);
        return view('material_requests.edit', [
            'mrId' => $id,
            'reviewedBy' => $item->reviewed_by,
            'approvedBy' => $item->approved_by,
        ]);
    }

    /**
     * Show the form for delete the specified Material Request.
     */
    public function delete(string $id)
    {
        $item = MaterialRequest::findOrFail($id);
        return view('material_requests.delete', ['item' => $item]);
    }

    /**
     * Remove the specified Material request from resource.
     */
    public function destroy(string $id)
    {
        $item = MaterialRequest::findOrFail($id);
        $item->delete();
        activity()->performedOn($item)->log('Material request "' . $item->name . '" has been deleted!');
        session()->flash('type', 'success');
        session()->flash('message', 'Material request deleted successfully!');
        return redirect()->route('material_requests.index');
    }

    /**
     * Print preview a resource.
     */
    public function print_preview(string $id)
    {
        $item = MaterialRequest::with(['items' => function ($query) {
            $query->where('rejected', false);
        }])->findOrFail($id);
        return view('material_requests.print_preview', ['item' => $item]);
    }

    /**
     * Print a resource.
     */
    public function print(string $id)
    {
        $item = MaterialRequest::with(['items' => function ($query) {
            $query->where('rejected', false);
        }])->findOrFail($id);
        $pdf = Pdf::loadView('material_requests.print', compact('item'));
        return $pdf->download('material_request' . $item->id . '.pdf');
    }

    public function markAsDelivered(string $id)
    {
        $item = MaterialRequest::findOrFail($id);
        $item->update(['status' => 'delivered_to_site']);
        session()->flash('type', 'success');
        session()->flash('message', 'Material request marked as Delivered to Site');
        return redirect()->route('material_requests.index');
    }
}
