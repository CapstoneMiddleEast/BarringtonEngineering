<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class InvoiceItem extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'invoice_id',
        'delivery_date',
        'item_id',
        'unit',
        'do_no',
        'ticket_no',
        'vehicle_no',
        'delivery_point',
        'quantity',
        'client_unit_price',
        'client_total_price',
        'client_vat',
        'client_total_price_vat'
    ];

    public function suppliers()
    {
        return $this->hasMany(InvoiceItemSupplier::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function item()
    {
        return $this->belongsTo(ItemCode::class);
    }
}
