<?php

namespace App\Http\Controllers;
use App\Models\Company_master;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Http\Request;

class CompanyMasterController extends Controller
{

        public function index()
    {
        $list = Company_master::latest()->paginate(25);
        return view('company.index', ['list' => $list]);
    }


     //View company page
    public function view($id)
    {
        $company  = Company_master::findOrFail($id);
        return view('company.view', ['company' => $company ]);
    }

    public function create()
    {
        return view('company.create');
    }



public function store(Request $request)
    {
      
        $validated = $request->validate([
            'code'              => 'required|string|max:20|unique:company_masters,code',
            'name'              => 'required|string|max:100',
            'description'       => 'nullable|string',

            'cmp_trn_no'        => 'nullable|string|max:100',
            'cmp_licence_no'    => 'nullable|string|max:100',
            'cmp_contact_person'=> 'nullable|string|max:100',
            'cmp_contact_no'    => 'nullable|string|max:100',

            'cmp_logo'          => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'cmp_doc'           => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',

            'cmp_address1'      => 'nullable|string|max:200',
            'cmp_address2'      => 'nullable|string|max:200',

            'is_active'         => 'nullable|boolean',
        ]);

$path = $request->file('cmp_logo')->store('company_logo', 'public');
$pathdoc = $request->file('cmp_doc')->store('company_doc', 'public');
$user_id = Auth::user()->id;
Auth::user()->id;
$Company_master = Company_master::create([
           'code'              => $request-> code,
            'name'              =>$request-> name,
            'description'       => $request-> company_description,

            'cmp_trn_no'        =>  $request-> cmp_trn_no,
            'cmp_licence_no'    => $request-> cmp_licence_no,
            'cmp_contact_person'=> $request-> cmp_contact_person,
            'cmp_contact_no'    => $request-> cmp_contact_no,

            'cmp_logo'          => $path,
            'cmp_doc'           => $pathdoc,

            'cmp_address1'      => $request-> cmp_address1,
            'cmp_address2'      => $request-> cmp_address2,
            'created_by'        => $user_id


]);

       
        // Flags & audit
        $validated['is_active']  = $request->boolean('is_active', true);
        $validated['is_deleted'] = false;
        return redirect()->route('company.create')
            ->with('success', 'Company created successfully.');
    }

 

}
