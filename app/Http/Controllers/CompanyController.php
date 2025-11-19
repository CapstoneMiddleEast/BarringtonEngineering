<?php
namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
class CompanyController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view company', only: ['index', 'show']),
            new Middleware('permission:create company', only: ['create']),
            new Middleware('permission:edit company', only: ['edit']),
            new Middleware('permission:delete company', only: ['delete', 'destroy']),
        ];
    }

    /**
     * Display a listing of the Company.
     */
    public function index()
    {
        $list = Company::where('is_deleted', 0)->latest()->paginate(25);
        return view('company.index', ['list' => $list]);
    }

    //View Company page
    public function show($id)
    {
        $company = Company::where('id', $id)->where('is_deleted', 0)->firstOrFail();
        return view('company.view', ['company' => $company]);
    }
    /**
     * Show the form for creating a new Company
     */
    public function create()
    {
        return view('company.create');
    }
  /**
     * Edit a specified Company.
     */
    public function edit($id)
     {
        return view('company.edit', ['cid' => $id]);

    }
    /**
     * Show the form for delete the Company.
     */
    public function delete(string $id)
    {
        $item = Company::findOrFail($id);
        return view('company.delete', ['item' => $item]);
    }
    /**
     * Remove the a Company.
     */
    public function destroy(string $id)
    {
        $item = Company::findOrFail($id);
        $item->update([
            'is_deleted'  => 1,
            'deleted_by'  => Auth::user()->id
        ]);
        activity()->performedOn($item)->log('Company "' . $item->name . '" has been deleted!');
        session()->flash('type', 'success');
        session()->flash('message', 'Company deleted successfully!');
        return redirect()->route('company.index');
    }
}