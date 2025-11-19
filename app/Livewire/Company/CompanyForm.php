<?php
namespace App\Livewire\Company;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class CompanyForm extends Component
{

    use WithFileUploads;
    public $cId;
    public $code;
    public $name;
    public $description;
    public $cmp_trnno;
    public $cmp_contact_person;
    public $cmp_license_no;
    public $cmp_license_document;
    public $cmp_logo;
    public $cmp_contact_no;
    public $cmp_address1;
    public $cmp_address2;
    public $is_active = true;
    public $originalLicensePath;
    public $originalLogoPath;
    public $mode = 'create';
    protected function rules()

    {
        return [
            'code' => 'required|string|max:20|unique:companies,code,' . $this->cId,
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'cmp_trnno' => 'nullable|string|max:100',
            'cmp_contact_person' => 'nullable|string|max:100',
            'cmp_license_no' => 'nullable|string|max:100',
            'cmp_license_document' => 'nullable|file|max:5120',
            'cmp_logo' => 'nullable|image|max:5120',
            'cmp_contact_no' => 'nullable|string|max:100',
            'cmp_address1' => 'nullable|string|max:200',
            'cmp_address2' => 'nullable|string|max:200',
            'is_active' => 'boolean',
        ];
    }
    protected function validationAttributes()
    {
        return [
            'code' => 'company code',
            'name' => 'company name',
            'description' => 'description',
            'cmp_trnno' => 'TRN number',
            'cmp_contact_person' => 'contact person',
            'cmp_license_no' => 'license number',
            'cmp_license_document' => 'license document',
            'cmp_logo' => 'company logo',
            'cmp_contact_no' => 'contact number',
            'cmp_address1' => 'address line 1',
            'cmp_address2' => 'address line 2',
            'is_active' => 'status',
        ];
    }

    public function mount($cId = null)
    {
        if ($cId) {
            $this->mode = 'update';
            $company = Company::where('id', $cId)->where('is_deleted', false)->first();
            $this->cId = $company->id;
            $this->code = $company->code;
            $this->name = $company->name;
            $this->description = $company->description;
            $this->cmp_trnno = $company->cmp_trnno;
            $this->cmp_contact_person = $company->cmp_contact_person;
            $this->cmp_license_no = $company->cmp_license_no;
            $this->cmp_contact_no = $company->cmp_contact_no;
            $this->cmp_address1 = $company->cmp_address1;
            $this->cmp_address2 = $company->cmp_address2;
            $this->is_active = (bool) $company->is_active;
            $this->originalLicensePath = $company->cmp_license_document;
            $this->originalLogoPath = $company->cmp_logo;
        } else {
            $nextId = (Company::max('id') ?? 0) + 1;
            $this->code = 'CMP-' . str_pad((string) $nextId, 4, '0', STR_PAD_LEFT);
        }
    }

    public function save()
    {
        $this->validate();
        if ($this->mode === 'update') {
            $company = Company::findOrFail($this->cId);
            $company->updated_by = Auth::user()->id;
        } else {
            $company = new Company();
            $company->created_by = Auth::user()->id;
        }

        if ($this->cmp_logo) {

           // Delete old file
            if ($company->cmp_logo && Storage::disk('public')->exists($company->cmp_logo)) {
                Storage::disk('public')->delete($company->cmp_logo);
            }
            $company->cmp_logo = $this->cmp_logo->store('company\logo', 'public');

        }

        if ($this->cmp_license_document) {
            // Delete old file
            if ($company->cmp_license_document && Storage::disk('public')->exists($company->cmp_license_document)) {
                Storage::disk('public')->delete($company->cmp_license_document);
            }

            $company->cmp_license_document = $this->cmp_license_document->store('company\license_document', 'public');
        }

        $company->fill([
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'cmp_trnno' => $this->cmp_trnno,
            'cmp_contact_person' => $this->cmp_contact_person,
            'cmp_license_no' => $this->cmp_license_no,
            'cmp_contact_no' => $this->cmp_contact_no,
            'cmp_address1' => $this->cmp_address1,
            'cmp_address2' => $this->cmp_address2,
            'is_active' => $this->is_active,
        ]);

        $company->save();
        session()->flash('type', 'success');
        session()->flash('message', 'Company saved successfully!');
        return redirect()->route('company.index');
    }


    public function render()
    {
        return view('livewire.company.company-form');
    }


}