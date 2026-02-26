<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    /** @use HasFactory<\Database\Factories\MembershipFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'shared_accommodation_id', 
        'role', 
        'joined_at', 
        'left_at', 
        'is_active', 
        'has_debt'
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'left_at' => 'datetime',
        'is_active' => 'boolean',
        'has_debt' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sharedAccommodation()
    {
        return $this->belongsTo(SharedAccommodation::class);
    }
}
