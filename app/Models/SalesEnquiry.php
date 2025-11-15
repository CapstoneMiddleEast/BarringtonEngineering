<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class SalesEnquiry extends Model
{
    use HasFactory, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'inquiry_date_received',
        'author_id',
        'assigned_sales_person_id',
        'client_name',
        'delivery_point',
        'date_sent_quotation_to_client',
        'date_follow_up_to_client',
        'quotation_status', // Pending, Approved, In-Progress, Quotation-Sent,  Rejected, Accomplished, Regret
        'lpo_received',
        'no_of_days_taken_for_preparing_quotation',
        'remark',
        'contact_person',
        'contact_no',
        'email',
        'quotation_no',
        'follow_up',
        'lpo_received_text',
        'lpo_no',
        'lpo_doc',
        'payment_terms',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'inquiry_date_received' => 'datetime',
        'date_sent_quotation_to_client' => 'datetime',
        'date_follow_up_to_client' => 'datetime',
    ];

    /**
     * Relationship with the User model (Author).
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Relationship with the User model (Assigned Sales Person).
     */
    public function assignedSalesPerson()
    {
        return $this->belongsTo(User::class, 'assigned_sales_person_id');
    }

    /**
     * Scope for filtering by quotation status.
     */
    public function scopeByQuotationStatus($query, $status)
    {
        return $query->where('quotation_status', $status);
    }

    /**
     * Scope for filtering enquiries by follow-up date.
     */
    public function scopeNeedsFollowUp($query)
    {
        return $query->whereDate('date_follow_up_to_client', '<=', now());
    }

    /**
     * Relationship with the ItemCode model (Item Code).
     */
    public function itemCodes()
    {
        return $this->belongsToMany(ItemCode::class, 'sales_enquiry_item_code', 'sales_enquiry_id', 'item_code_id')->withPivot('quantity', 'unit', 'buying_price', 'selling_price')
            ->withTimestamps();
    }
}
