<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile_picture',
        'password',
        'about',
        'phone_number',
        'whatsapp_number',
        'address',
        'job_title',
        'department',
        'join_date',
        'employee_id',
        'availability_status',
        'languages_spoken',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * ALTER TABLE `users` DROP FOREIGN KEY `users_manager_id_foreign`; 
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'join_date' => 'datetime',
        ];
    }

    /**
     * Relationship with the SalesEnquiry model (Assigned Sales Person).
     */
    public function salesEnquiries()
    {
        return $this->hasMany(SalesEnquiry::class, 'assigned_sales_person_id');
    }
}
