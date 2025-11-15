<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\ValidUAEPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view user', only: ['index', 'view']),
            new Middleware('permission:create user', only: ['create']),
            new Middleware('permission:edit user', only: ['edit']),
            new Middleware('permission:assign role', only: ['roles']),
            new Middleware('permission:delete user', only: ['delete']),
        ];
    }
    
    // List All user page
    public function list()
    {
        $list = User::orderBy('employee_id', 'asc')->paginate(25);
        
        return view('users.list', ['list' => $list]);
    }

    // List user page
    public function index()
    {
        $list = User::latest()->paginate(25);
        return view('users.index', ['list' => $list]);
    }

    //View user page
    public function view($id)
    {
        $user = User::findOrFail($id);
        return view('users.view', ['user' => $user]);
    }

    //Create user page

    public function create()
    {
        return view('users.create');
    }

    //Create user method
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'about' => ['nullable', 'string'],
            'phone_number' => ['nullable', 'string', new ValidUAEPhone],
            'whatsapp_number' => ['nullable', 'string', new ValidUAEPhone],
            'address' => ['nullable', 'string'],
            'job_title' => ['nullable', 'string'],
            'department' => ['nullable', 'string'],
            'join_date' => ['nullable', 'date'],
            'employee_id' => ['nullable', 'string', 'unique:' . User::class],
            'availability_status' => ['nullable', 'string'],
            'languages_spoken' => ['nullable', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'about' => $request->about,
            'phone_number' => $request->phone_number,
            'whatsapp_number' => $request->whatsapp_number,
            'address' => $request->address,
            'job_title' => $request->job_title,
            'department' => $request->department,
            'join_date' => $request->join_date,
            'employee_id' => $request->employee_id,
            'availability_status' => $request->availability_status,
            'languages_spoken' => $request->languages_spoken,
        ]);
        activity()->performedOn($user)->log('User "' . $request->name . '" has been added!');
        session()->flash('type', 'success');
        session()->flash('message', 'New user added successfully!');
        return redirect()->route('users.index');
    }

    //Edit user page
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if ($user->hasRole('Super Admin')) {
            session()->flash('type', 'error');
            session()->flash('message', 'Cannot change/modify Super Admin details!');
            return redirect()->route('users.index');
        } else {
            return view('users.edit', ['user' => $user]);
        }
    }

    //Update user method
    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $validater = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id . 'id',
            'about' => 'nullable|string',
            'phone_number' => ['nullable', 'string', new ValidUAEPhone],
            'whatsapp_number' => ['nullable', 'string', new ValidUAEPhone],
            'address' => 'nullable|string',
            'job_title' => 'nullable|string',
            'department' => 'nullable|string',
            'join_date' => 'nullable|date',
            'employee_id' =>
            'nullable|string|unique:users,employee_id,' . $id . 'id',
            'availability_status' => 'nullable|string',
            'languages_spoken' => 'nullable|string',
        ]);

        if ($validater->passes()) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->about = $request->about;
            $user->phone_number = $request->phone_number;
            $user->whatsapp_number = $request->whatsapp_number;
            $user->address = $request->address;
            $user->job_title = $request->job_title;
            $user->department = $request->department;
            $user->join_date = $request->join_date;
            $user->employee_id = $request->employee_id;
            $user->availability_status = $request->availability_status;
            $user->languages_spoken = $request->languages_spoken;
            $user->save();
            activity()->performedOn($user)->log('User "' . $request->name . '" has been updated!');
            session()->flash('type', 'success');
            session()->flash('message', 'User updated successfully!');
            return redirect()->route('users.index');
        } else {
            return redirect()->route('users.edit', $id)->withInput()->withErrors($validater);
        }
    }

    //Assign role page
    public function roles($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::where('name', '!=', 'Super Admin')->orderBy('name', 'ASC')->get();
        $hasRoles = $user->roles->pluck('id');
        if ($user->hasRole('Super Admin')) {
            session()->flash('type', 'error');
            session()->flash('message', 'Cannot change/modify Super Admin roles!');
            return redirect()->route('users.index');
        } else {
            return view('users.roles', ['user' => $user, 'roles' => $roles, 'hasRoles' => $hasRoles]);
        }
    }

    //Assign role method
    public function designate($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->syncRoles($request->role);
        activity()->performedOn($user)->log('User "' . $user->name . '" has been updated with new roles!');
        session()->flash('type', 'success');
        session()->flash('message', 'Roles updated successfully!');
        return redirect()->route('users.index');
    }

    //Delete page
    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->hasRole('Super Admin')) {
            session()->flash('type', 'error');
            session()->flash('message', 'Cannot delete Super Admin user!');
            return redirect()->route('users.index');
        } else {
            return view('users.delete', ['user' => $user]);
        }
    }

    //Delete method
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        activity()->performedOn($user)->log('User "' . $user->name . '" has been deleted!');
        session()->flash('type', 'success');
        session()->flash('message', 'User deleted successfully!');
        return redirect()->route('users.index');
    }
}
