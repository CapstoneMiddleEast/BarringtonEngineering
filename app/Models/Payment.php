<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'client_id',
        'invoice_id',
        'amount',
        'method',
        'reference',
        'paid_at',
        'notes',
        'created_by'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
