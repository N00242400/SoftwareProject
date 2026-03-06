<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable; // ✅ Correct Scout trait
use App\Models\Category;
use App\Models\Review;

class Service extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image',
        'email',
        'phone',
        'address',
        'noise_level',
        'lighting_level',
        'crowd_level',
        'autism_friendly_hours'
    ];

    // Scout will index these fields
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}