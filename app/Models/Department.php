<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
        'company_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_deleted',
    ];
}
