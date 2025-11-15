<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view client', only: ['index', 'show']),
            new Middleware('permission:create client', only: ['create', 'store']),
            new Middleware('permission:edit client', only: ['edit', 'update']),
            new Middleware('permission:delete client', only: ['delete', 'destroy']),
        ];
    }

    /**
     * Display a listing of the clients.
     */
    public function index()
    {
        $list = Client::latest()->paginate(25);
        return view('client.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(Request $request)
    {
        $validater = Validator::make($request->all(), [
            'name' => 'required|string|unique:clients|min:3',
            'place' => 'nullable|string',
            'tel' => 'nullable|string',
            'fax' => 'nullable|string',
            'trn' => 'nullable|string',
        ]);
        if ($validater->passes()) {
            $client = Client::create([
                'name' => $request->name,
                'place' => $request->place,
                'tel' => $request->tel,
                'fax' => $request->fax,
                'trn' => $request->trn
            ]);
            activity()->performedOn($client)->log('Client "' . $request->name . '" has been added!');
            session()->flash('type', 'success');
            session()->flash('message', 'New client added successfully!');
            return redirect()->route('clients.index');
        } else {
            return redirect()->route('clients.create')->withInput()->withErrors($validater);
        }
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(string $id)
    {
        $item = Client::findOrFail($id);
        return view('client.edit', ['item' => $item]);
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Client::findOrFail($id);
        $validater = Validator::make($request->all(), [
            'name' => 'required|string|unique:clients,name,' . $id .
                ',id|min:3',
            'place' => 'nullable|string',
            'tel' => 'nullable|string',
            'fax' => 'nullable|string',
            'trn' => 'nullable|string',
        ]);
        if ($validater->passes()) {
            $item->name = $request->name;
            $item->place = $request->place;
            $item->tel = $request->tel;
            $item->fax = $request->fax;
            $item->trn = $request->trn;
            $item->save();
            activity()->performedOn($item)->log('Client "' . $request->name . '" has been updated!');
            session()->flash('type', 'success');
            session()->flash('message', 'Client updated successfully!');
            return redirect()->route('clients.index');
        } else {
            return redirect()->route('clients.edit', $id)->withInput()->withErrors($validater);
        }
    }

    /**
     * Show the form for delete the specified client.
     */
    public function delete(string $id)
    {
        $item = Client::findOrFail($id);
        return view('client.delete', ['item' => $item]);
    }

    /**
     * Remove the specified Client from storage.
     */
    public function destroy(string $id)
    {
        $item = Client::findOrFail($id);
        $item->delete();
        activity()->performedOn($item)->log('Client "' . $item->name . '" has been deleted!');
        session()->flash('type', 'success');
        session()->flash('message', 'Client deleted successfully!');
        return redirect()->route('clients.index');
    }
}
