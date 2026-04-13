<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Category;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // matches categories from the database to category_id values
        $cafes = Category::where('name', 'Cafés & Coffee Shops')->first();
        $libraries = Category::where('name', 'Libraries & Study Spaces')->first();
        $restaurants = Category::where('name', 'Restaurants')->first();

        Service::insert([

            [
                'name' => 'Keoghs Cafe',
                'description' => 'A cozy cafe with quiet corners and friendly staff.',
                'address' => 'South Anne Street, Dublin',
                'category_id' => $cafes->id, // links to Cafés category
                'crowd_level' => 'low',
                'noise_level' => 'low',
                'lighting_level' => 'bright',
                'email' => 'keoghs@example.com',
                'phone' => '01 123 4567',
                'image' => 'cafe.png',
                'autism_friendly_hours' => '08:00-10:00',
            ],

            [
                'name' => 'Green Park Library',
                'description' => 'Quiet library with calm study areas and reading spaces.',
                'address' => 'Dublin City Centre',
                'category_id' => $libraries->id, // links to Libraries category
                'crowd_level' => 'low',
                'noise_level' => 'low',
                'lighting_level' => 'normal',
                'email' => 'library@example.com',
                'phone' => '01 987 6543',
                'image' => 'library.png',
                'autism_friendly_hours' => '09:00-11:00',
            ],

            [
                'name' => 'Blue Ocean Restaurant',
                'description' => 'Relaxed dining with soft music and calm atmosphere.',
                'address' => 'Dublin 2',
                'category_id' => $restaurants->id, // links to Restaurants category
                'crowd_level' => 'medium',
                'noise_level' => 'medium',
                'lighting_level' => 'dim',
                'email' => 'ocean@example.com',
                'phone' => '01 555 1234',
                'image' => 'https://via.placeholder.com/150',
                'autism_friendly_hours' => '14:00-16:00',
            ],
        ]);
    }
}