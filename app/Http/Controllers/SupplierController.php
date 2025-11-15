<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view supplier', only: ['index', 'show']),
            new Middleware('permission:create supplier', only: ['create', 'store']),
            new Middleware('permission:edit supplier', only: ['edit', 'update']),
            new Middleware('permission:delete supplier', only: ['delete', 'destroy']),
        ];
    }

    /**
     * Display a listing of the suppliers.
     */
    public function index()
    {
        $list = Supplier::latest()->paginate(25);
        return view('supplier.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new supplier.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store(Request $request)
    {
        $validater = Validator::make($request->all(), [
            'name' => 'required|string|unique:suppliers|min:3',
            'place' => 'nullable|string',
            'tel' => 'nullable|string',
            // 'fax' => 'nullable|string',
            'trn' => 'nullable|string',
        ]);
        if ($validater->passes()) {
            $supplier = Supplier::create([
                'name' => $request->name,
                'place' => $request->place,
                'tel' => $request->tel,
                // 'fax' => $request->fax,
                'trn' => $request->trn
            ]);
            activity()->performedOn($supplier)->log('Supplier "' . $request->name . '" has been added!');
            session()->flash('type', 'success');
            session()->flash('message', 'New supplier added successfully!');
            return redirect()->route('suppliers.index');
        } else {
            return redirect()->route('suppliers.create')->withInput()->withErrors($validater);
        }
    }

    /**
     * Show the form for editing the specified supplier.
     */
    public function edit(string $id)
    {
        $item = Supplier::findOrFail($id);
        return view('supplier.edit', ['item' => $item]);
    }

    /**
     * Update the specified supplier in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Supplier::findOrFail($id);
        $validater = Validator::make($request->all(), [
            'name' => 'required|string|unique:suppliers,name,' . $id .
                ',id|min:3',
            'place' => 'nullable|string',
            'tel' => 'nullable|string',
            // 'fax' => 'nullable|string',
            'trn' => 'nullable|string',
        ]);
        if ($validater->passes()) {
            $item->name = $request->name;
            $item->place = $request->place;
            $item->tel = $request->tel;
            // $item->fax = $request->fax;
            $item->trn = $request->trn;
            $item->save();
            activity()->performedOn($item)->log('Supplier "' . $request->name . '" has been updated!');
            session()->flash('type', 'success');
            session()->flash('message', 'Supplier updated successfully!');
            return redirect()->route('suppliers.index');
        } else {
            return redirect()->route('suppliers.edit', $id)->withInput()->withErrors($validater);
        }
    }

    /**
     * Show the form for delete the specified supplier.
     */
    public function delete(string $id)
    {
        $item = Supplier::findOrFail($id);
        return view('supplier.delete', ['item' => $item]);
    }

    /**
     * Remove the specified supplier from storage.
     */
    public function destroy(string $id)
    {
        $item = Supplier::findOrFail($id);
        $item->delete();
        activity()->performedOn($item)->log('Supplier "' . $item->name . '" has been deleted!');
        session()->flash('type', 'success');
        session()->flash('message', 'Supplier deleted successfully!');
        return redirect()->route('suppliers.index');
    }
}
