<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'shared_accommodation_id',
    ];
    public function sharedAccommodation()
    {
        return $this->belongsTo(SharedAccommodation::class, 'shared_accommodation_id');
    }
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'category_id');
    }
}
