<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    /** @use HasFactory<\Database\Factories\InvitationFactory> */
    use HasFactory;
    protected $fillable = [
        'shared_accommodation_id', 
        'email', 
        'token', 
        'status'
    ];

    public function sharedAccommodation()
    {
        return $this->belongsTo(SharedAccommodation::class);
    }  
}
