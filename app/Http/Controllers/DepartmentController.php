<?php
namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
class DepartmentController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view department', only: ['index', 'show']),
            new Middleware('permission:create department', only: ['create']),
            new Middleware('permission:edit department', only: ['edit']),
            new Middleware('permission:delete department', only: ['delete', 'destroy']),
        ];
    }
    /**
     * Display a listing of the department.
     */
    public function index()
    {
        $list = Department::where('is_deleted', 0)->latest()->paginate(25);
        return view('department.index', ['list' => $list]);
    }

    /** * Show the form for creating a new department
     */
    public function create()
    {
        return view('department.create');

    }
    /**
   * Edit a specified department   */
    public function edit($id)
    {
        return view('department.edit', ['did' => $id]);
    }
    /**
   * Show the form for delete the department.
     */
    public function delete(string $id)
    {
        $item = Department::findOrFail($id);
        return view('department.delete', ['item' => $item]);
    }

    /**
     * Remove the a department.
     */
    public function destroy(string $id)
    {
        $item = Department::findOrFail($id);
        $item->update([
            'is_deleted'  => 1,
            'deleted_by'  => Auth::user()->id
        ]);
        activity()->performedOn($item)->log('Department "' . $item->name . '" has been deleted!');
        session()->flash('type', 'success');
        session()->flash('message', 'Department deleted successfully!');
        return redirect()->route('department.index');
    }
}