<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category; 
 
class Service extends Model
{

  use HasFactory;
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
 
    // A service belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
 
    // A service has many reviews
   public function reviews()
    {
       return $this->hasMany(Review::class);
    }
 
    // A service can be favourited by many users
   // public function favourites()
  //  {
//        return $this->hasMany(Favourite::class);
  //  }
}