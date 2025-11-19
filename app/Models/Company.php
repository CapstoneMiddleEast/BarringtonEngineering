<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Company extends Model
{

    use HasFactory;





    protected $fillable = [


        'code',


        'name',


        'description',


        'cmp_trnno',


        'cmp_contact_person',


        'cmp_license_no',


        'cmp_license_document',


        'cmp_logo',


        'cmp_contact_no',


        'cmp_address1',


        'cmp_address2',


        'is_active',


        'created_by',


        'updated_by',


        'deleted_by',


        'is_deleted',


    ];


}