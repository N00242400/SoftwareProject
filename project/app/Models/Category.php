<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Category extends Model

{

    protected $fillable = [

        'name',

        'description'

    ];
 
    // One category has many services

    public function services()

    {

        return $this->hasMany(Service::class);

    }

}
 