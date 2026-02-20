<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::insert([
            [
                'name' => 'Keoghs Cafe',
                'description' => 'A cozy cafe with quiet corners and friendly staff.',
                'address' => '123 Main St, Cityville',
                'category_id' => 1, // Cafe
                'crowd_level' => 'low',
                'noise_level' => 'low',
                'lighting_level' => 'bright',
                'email' => 'sunny@example.com',
                'phone' => '123-456-7890',
                'image' => 'cafe.png',
                'autism_friendly_hours' => '08:00-10:00',
            ],
            [
                'name' => 'Green Park Library',
                'description' => 'Quiet library with autism-friendly reading hours.',
                'address' => '456 Park Ave, Townsville',
                'category_id' => 2, // Library
                'crowd_level' => 'low',
                'noise_level' => 'low',
                'lighting_level' => 'normal',
                'email' => 'library@example.com',
                'phone' => '987-654-3210',
                'image' => 'library.png',
                'autism_friendly_hours' => '09:00-11:00',
            ],
            [
                'name' => 'Blue Ocean Restaurant',
                'description' => 'Seafood restaurant with calm music and dim lighting.',
                'address' => '789 Ocean Blvd, Seaside',
                'category_id' => 3, // Restaurant
                'crowd_level' => 'medium',
                'noise_level' => 'medium',
                'lighting_level' => 'dim',
                'email' => 'ocean@example.com',
                'phone' => '555-123-4567',
                'image' => 'https://via.placeholder.com/150',
                'autism_friendly_hours' => '14:00-16:00',
            ],
        ]);
    }
}