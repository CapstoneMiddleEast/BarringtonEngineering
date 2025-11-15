<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class InvoiceItemSupplier extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'invoice_item_id',
        'supplier_id',
        'supplier_invoice',
        'supplier_quantity',
        'supplier_unit_price',
        'supplier_total_price',
        'supplier_vat',
        'supplier_total_price_vat'
    ];

    public function invoiceItem()
    {
        return $this->belongsTo(InvoiceItem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
