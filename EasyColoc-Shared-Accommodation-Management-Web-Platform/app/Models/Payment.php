<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'shared_accommodation_id',
        'expense_id',
        'receiver_user_id',
        'amount',
        'is_paid',
        'payment_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_paid' => 'boolean',
        'payment_date' => 'date',
    ];

    public function sharedAccommodation()
    {
        return $this->belongsTo(SharedAccommodation::class);
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_user_id');
    }
}
