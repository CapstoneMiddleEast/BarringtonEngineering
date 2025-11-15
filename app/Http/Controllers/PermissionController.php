<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view permission', only: ['index']),
            new Middleware('permission:create permission', only: ['create']),
            new Middleware('permission:edit permission', only: ['edit']),
            new Middleware('permission:delete permission', only: ['delete']),
        ];
    }

    // List permission page
    public function index()
    {
        $list = Permission::orderBy('created_at', 'DESC')->paginate(25);
        return view('permissions.index', ['list' => $list]);
    }

    // Create permission page
    public function create()
    {
        return view('permissions.create');
    }

    // Store permission method
    public function store(Request $request)
    {
        $validater = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);
        if ($validater->passes()) {
            $permission = Permission::create(['name' => $request->name]);
            activity()->performedOn($permission)->log('Permission "' . $request->name . '" has been added!');
            session()->flash('type', 'success');
            session()->flash('message', 'New permission added successfully!');
            return redirect()->route('permissions.index');
        } else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validater);
        }
    }

    // Edit permission page
    public function edit($id)
    {
        $item = Permission::findOrFail($id);
        return view('permissions.edit', ['item' => $item]);
    }

    // Update permission method
    public function update($id, Request $request)
    {
        $item = Permission::findOrFail($id);
        $validater = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,' . $id . ',id|min:3'
        ]);
        if ($validater->passes()) {
            $item->name = $request->name;
            $item->save();
            activity()->performedOn($item)->log('Permission "' . $request->name . '" has been updated!');
            session()->flash('type', 'success');
            session()->flash('message', 'Permission updated successfully!');
            return redirect()->route('permissions.index');
        } else {
            return redirect()->route('permissions.edit', $id)->withInput()->withErrors($validater);
        }
    }

    // Delete permission page
    public function delete($id)
    {
        $item = Permission::findOrFail($id);
        return view('permissions.delete', ['item' => $item]);
    }

    // Delete permission method
    public function destroy($id)
    {
        $item = Permission::find($id);
        if ($item == null) {
            session()->flash('type', 'error');
            session()->flash('message', 'Permission not found!');
            return redirect()->route('permissions.delete', $id);
        } else {
            $item->delete();
            activity()->performedOn($item)->log('Permission "' . $item->name . '" has been deleted!');
            session()->flash('type', 'success');
            session()->flash('message', 'Permission deleted successfully!');
            return redirect()->route('permissions.index');
        }
    }
}
