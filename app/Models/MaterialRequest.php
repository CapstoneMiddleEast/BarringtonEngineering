<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class MaterialRequest extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'project',
        'purpose_of_use',
        'requested_by',
        'requested_date',
        'reviewed_by',
        'reviewed_date',
        'approved_by',
        'approved_date',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(MaterialRequestItem::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
