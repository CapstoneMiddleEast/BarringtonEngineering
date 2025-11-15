<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view role', only: ['index']),
            new Middleware('permission:create role', only: ['create']),
            new Middleware('permission:edit role', only: ['edit']),
            new Middleware('permission:delete role', only: ['delete']),
        ];
    }

    // List role page
    public function index()
    {
        $list = Role::orderBy('created_at', 'DESC')->paginate(25);
        return view('roles.index', ['list' => $list]);
    }

    // Create role page
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.create', [
            'permissions' => $permissions
        ]);
    }

    // Store role method
    public function store(Request $request)
    {
        $validater = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3'
        ]);
        if ($validater->passes()) {
            $role = Role::create(['name' => $request->name]);
            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
            activity()->performedOn($role)->log('Role "' . $request->name . '" has been added!');
            session()->flash('type', 'success');
            session()->flash('message', 'New role added successfully!');
            return redirect()->route('roles.index');
        } else {
            return redirect()->route('roles.create')->withInput()->withErrors($validater);
        }
    }

    // Edit role page
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        if ($role->name == 'Super Admin') {
            session()->flash('type', 'error');
            session()->flash('message', 'Cannot change/modify Super Admin details!');
            return redirect()->route('roles.index');
        } else {
            $hasPermissions = $role->permissions->pluck('name');
            $permissions = Permission::orderBy('name', 'ASC')->get();
            return view('roles.edit', ['role' => $role, 'hasPermissions' => $hasPermissions, 'permissions' => $permissions]);
        }
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.edit', ['role' => $role, 'hasPermissions' => $hasPermissions, 'permissions' => $permissions]);
    }

    // Update role method
    public function update($id, Request $request)
    {
        $item = Role::findOrFail($id);
        $validater = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id . ',id|min:3'
        ]);
        if ($validater->passes()) {
            $item->name = $request->name;
            $item->save();
            if (!empty($request->permission)) {
                $item->syncPermissions($request->permission);
            } else {
                $item->syncPermissions([]);
            }
            activity()->performedOn($item)->log('Role "' . $request->name . '" has been updated!');
            session()->flash('type', 'success');
            session()->flash('message', 'Role updated successfully!');
            return redirect()->route('roles.index');
        } else {
            return redirect()->route('roles.edit', $id)->withInput()->withErrors($validater);
        }
    }

    // Delete role page
    public function delete($id)
    {
        $item = Role::findOrFail($id);
        if ($item->name == 'Super Admin') {
            session()->flash('type', 'error');
            session()->flash('message', 'Cannot delete Super Admin details!');
            return redirect()->route('roles.index');
        } else {
            return view('roles.delete', ['item' => $item]);
        }
    }

    // Delete role method
    public function destroy($id)
    {
        $item = Role::find($id);
        if ($item == null) {
            session()->flash('type', 'error');
            session()->flash('message', 'Role not found!');
            return redirect()->route('roles.delete', $id);
        } else {
            $item->delete();
            activity()->performedOn($item)->log('Role "' . $item->name . '" has been daleted!');
            session()->flash('type', 'success');
            session()->flash('message', 'Role deleted successfully!');
            return redirect()->route('roles.index');
        }
    }
}
