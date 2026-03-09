<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use scout to search instead of sql code
use Laravel\Scout\Searchable; 
use App\Models\Category;
use App\Models\Review;

class Service extends Model
{
    //makes model searchable 
    // has factory generates fake data for seeding
    use HasFactory, Searchable;

    //mass assignable fields
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
    //function returns an array
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
// favourite for the logged in user (or null if none)
    public function favouriteForUser()
    {
        return $this->favourites()->where('user_id', auth()->id())->first();
    }
    //all favourites for this service
    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }
}