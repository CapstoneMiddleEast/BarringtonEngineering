<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class MaterialRequestItem extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'material_request_id',
        'material_name',
        'material_description',
        'quantity',
        'unit',
        'remark',
        'date_needed',
        'scope_of_work',
        'project_location',
        'rejected',
        'rejected_reason'
    ];

    public function materialRequest()
    {
        return $this->belongsTo(MaterialRequest::class);
    }
}
