<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedAccommodation extends Model
{
    /** @use HasFactory<\Database\Factories\SharedAccommodationFactory> */
    use HasFactory;
    protected $fillable = [
        'name', 
        'status', 
        'cancelled_at'
    ];

    protected $casts = [
        'cancelled_at' => 'datetime',
    ];

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
        public function activeMemberships()
    {
        return $this->hasMany(\App\Models\Membership::class)->where('is_active', true);
    }

    public function ownerMembership()
    {
        return $this->hasOne(\App\Models\Membership::class)->where('role', 'owner');
    }
}
