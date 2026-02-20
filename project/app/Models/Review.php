<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Review extends Model

{

    protected $fillable = [

        'service_id',
        'user_id',
        'description',
        'noise_rating',
        'lighting_rating',
        'crowd_rating'

    ];
 
    // A review belongs to a service

    public function service()

    {

        return $this->belongsTo(Service::class);

    }
 
    // A review belongs to a user

    public function user()

    {

        return $this->belongsTo(User::class);

    }

}
 