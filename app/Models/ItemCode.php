<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class ItemCode extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = ['name', 'description'];

    /**
     * Relationship with the SalesEnquiry model (Item Code).
     */
    public function salesEnquiries()
    {
        return $this->belongsToMany(SalesEnquiry::class, 'sales_enquiry_item_code', 'item_code_id', 'sales_enquiry_id')->withPivot('quantity', 'unit', 'buying_price', 'selling_price')
            ->withTimestamps();
    }
}
