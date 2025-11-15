<?php

namespace App\Http\Controllers;

use App\Models\ItemCode;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class ItemCodeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view item code', only: ['index', 'show']),
            new Middleware('permission:create item code', only: ['create', 'store']),
            new Middleware('permission:edit item code', only: ['edit', 'update']),
            new Middleware('permission:delete item code', only: ['delete', 'destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = ItemCode::latest()->paginate(25);
        return view('item_code.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item_code.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validater = Validator::make($request->all(), [
            'name' => 'required|string|unique:item_codes|min:3',
            'description' => 'nullable|string',
        ]);
        if ($validater->passes()) {
            $item_code = ItemCode::create(['name' => $request->name, 'description' => $request->description]);
            activity()->performedOn($item_code)->log('Item code "' . $request->name . '" has been added!');
            session()->flash('type', 'success');
            session()->flash('message', 'New item code added successfully!');
            return redirect()->route('item_codes.index');
        } else {
            return redirect()->route('item_codes.create')->withInput()->withErrors($validater);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = ItemCode::findOrFail($id);
        return view('item_code.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = ItemCode::findOrFail($id);
        $validater = Validator::make($request->all(), [
            'name' => 'required|string|unique:item_codes,name,' . $id .
                ',id|min:3',
            'description' => 'nullable|string'
        ]);
        if ($validater->passes()) {
            $item->name = $request->name;
            $item->description = $request->description;
            $item->save();
            activity()->performedOn($item)->log('Item code "' . $request->name . '" has been updated!');
            session()->flash('type', 'success');
            session()->flash('message', 'Item code updated successfully!');
            return redirect()->route('item_codes.index');
        } else {
            return redirect()->route('item_codes.edit', $id)->withInput()->withErrors($validater);
        }
    }

    /**
     * Show the form for delete the specified resource.
     */
    public function delete(string $id)
    {
        $item = ItemCode::findOrFail($id);
        return view('item_code.delete', ['item' => $item]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = ItemCode::findOrFail($id);
        $item->delete();
        activity()->performedOn($item)->log('Item code "' . $item->name . '" has been deleted!');
        session()->flash('type', 'success');
        session()->flash('message', 'Item code deleted successfully!');
        return redirect()->route('item_codes.index');
    }

    /**
     * List the specified resources from storage.
     */
    public function search()
    {
        $items = ItemCode::orderBy('name', 'ASC')->get();
        return response()->json($items);
    }
}
