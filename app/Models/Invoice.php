<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Invoice extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = ['invoice_no', 'client_id', 'invoice_date', 'client_invoice', 'lpo_no'];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getPaidAmountAttribute(): string
    {
        return (string) $this->payments()->sum('amount');
    }
}
