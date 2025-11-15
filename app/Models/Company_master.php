<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Company_master extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'company_id';
    public $incrementing = true;
    protected $keyType = 'int';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';

    protected $fillable = [
        'code', 'name', 'description',
        'cmp_trn_no', 'cmp_licence_no',
        'cmp_contact_person', 'cmp_contact_no',
        'cmp_logo', 'cmp_doc',
        'cmp_address1', 'cmp_address2',
        'is_active', 'is_deleted',
        'created_by', 'modified_by', 'deleted_by',
        'created_at', 'modified_at', 'deleted_at',
    ];
}
