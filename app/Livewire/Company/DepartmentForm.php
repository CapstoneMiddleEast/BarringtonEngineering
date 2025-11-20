<?php






namespace App\Livewire\Company;





use Livewire\Component;


use App\Models\Company;


use App\Models\Department;


use Illuminate\Support\Facades\Auth;





class DepartmentForm extends Component


{


    public $dId;


    public $code;


    public $name;


    public $description;


    public $company_id;


    public $is_active = true;


    public $mode = 'create';





    protected function rules()


    {


        return [


            'code' => 'required|string|max:20|unique:departments,code,' . $this->dId . ',id',


            'name' => 'required|string|max:100',


            'description' => 'nullable|string',


            'company_id' => 'required|exists:companies,id',


            'is_active' => 'boolean',


        ];


    }





    public function mount($dId = null)


    {


        if ($dId) {


            $this->mode = 'update';


            $dept = Department::where('id', $dId)->where('is_deleted', false)->first();


            $this->dId = $dept->id;


            $this->code = $dept->code;


            $this->name = $dept->name;


            $this->description = $dept->description;


            $this->company_id = $dept->company_id;


            $this->is_active = (bool) $dept->is_active;


        } else {


            $nextId = (Department::max('id') ?? 0) + 1;


            $this->code = 'DEP-' . str_pad((string)$nextId, 4, '0', STR_PAD_LEFT);


        }


    }





    public function save()


    {


        $this->validate();





        if ($this->mode === 'update') {


            $dept = Department::findOrFail($this->dId);


            $dept->updated_by = Auth::user()->id;


        } else {


            $dept = new Department();


            $dept->created_by = Auth::user()->id;


        }





        $dept->fill([


            'code' => $this->code,


            'name' => $this->name,


            'description' => $this->description,


            'company_id' => $this->company_id,


            'is_active' => $this->is_active,


        ]);





        $dept->save();


        session()->flash('type', 'success');


        session()->flash('message', 'Department saved successfully!');


        return redirect()->route('department.index');


    }





    public function render()


    {


        return view('livewire.company.department-form', [


            'companies' => Company::where('is_deleted', false)->get(),


        ]);


    }


}