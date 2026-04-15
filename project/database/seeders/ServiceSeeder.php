<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Category;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
      
        $cafes = Category::where('name', 'Coffee Shops')->first();
        $libraries = Category::where('name', 'Libraries and Study Spaces')->first();
        $restaurants = Category::where('name', 'Restaurants')->first();
        $pubs = Category::where('name', 'Pubs and Social Spots')->first();
        $parks = Category::where('name', 'Parks and Outdoor Spaces')->first();
        $museums = Category::where('name', 'Museums and Culture')->first();
        $cowork = Category::where('name', 'Coworking Spaces')->first();

        Service::insert([

           
            [
                'name' => 'Keoghs Cafe',
                'description' => 'A cozy cafe with quiet corners and friendly staff.',
                'address' => 'South Anne Street, Dublin',
                'category_id' => $cafes->id,
                'crowd_level' => 'low',
                'noise_level' => 'low',
                'lighting_level' => 'bright',
                'email' => 'keoghs@example.com',
                'phone' => '01 123 4567',
                'image' => 'cafe1.jpg',
                'autism_friendly_hours' => '08:00-10:00',
            ],
            [
                'name' => 'Brother Hubbard',
                'description' => 'Popular brunch spot with a relaxed vibe.',
                'address' => 'Capel Street, Dublin',
                'category_id' => $cafes->id,
                'crowd_level' => 'high',
                'noise_level' => 'high',
                'lighting_level' => 'bright',
                'email' => 'info@brotherhubbard.ie',
                'phone' => '01 441 1112',
                'image' => 'cafe5.jpg',
                'autism_friendly_hours' => '08:00-09:30',
            ],
            [
                'name' => 'Elm & Stone Café',
                'description' => 'Minimal, calm café with soft music and spacious seating.',
                'address' => 'Ranelagh Village, Dublin',
                'category_id' => $cafes->id,
                'crowd_level' => 'low',
                'noise_level' => 'low',
                'lighting_level' => 'bright',
                'email' => 'hello@elmstone.ie',
                'phone' => '01 555 1122',
                'image' => 'cafe3.jpg',
                'autism_friendly_hours' => '08:00-10:00',
            ],
            [
                'name' => 'Morning Light Coffee',
                'description' => 'Bright and quiet morning café ideal for reading or working.',
                'address' => 'Camden Street, Dublin',
                'category_id' => $cafes->id,
                'crowd_level' => 'medium',
                'noise_level' => 'low',
                'lighting_level' => 'bright',
                'email' => 'info@morninglight.ie',
                'phone' => '01 555 3344',
                'image' => 'cafe4.jpg',
                'autism_friendly_hours' => '07:30-09:30',
            ],

           
            [
                'name' => 'Green Park Library',
                'description' => 'Quiet library with calm study areas and reading spaces.',
                'address' => 'Dublin City Centre',
                'category_id' => $libraries->id,
                'crowd_level' => 'low',
                'noise_level' => 'low',
                'lighting_level' => 'normal',
                'email' => 'library@example.com',
                'phone' => '01 987 6543',
                'image' => 'library.jpg',
                'autism_friendly_hours' => '09:00-11:00',
            ],
            [
                'name' => 'Trinity Library',
                'description' => 'Historic quiet study space.',
                'address' => 'Trinity College Dublin',
                'category_id' => $libraries->id,
                'crowd_level' => 'medium',
                'noise_level' => 'low',
                'lighting_level' => 'dim',
                'email' => 'library@tcd.ie',
                'phone' => '01 896 1000',
                'image' => 'library4.jpg',
                'autism_friendly_hours' => '09:00-11:00',
            ],

            
            [
                'name' => 'Blue Ocean Restaurant',
                'description' => 'Relaxed dining with soft music and calm atmosphere.',
                'address' => 'Dublin 2',
                'category_id' => $restaurants->id,
                'crowd_level' => 'medium',
                'noise_level' => 'medium',
                'lighting_level' => 'dim',
                'email' => 'ocean@example.com',
                'phone' => '01 555 1234',
                'image' => 'restuarant.jpg',
                'autism_friendly_hours' => '14:00-16:00',
            ],
            [
                'name' => 'Willow Dining',
                'description' => 'Relaxed restaurant with soft lighting and low noise levels.',
                'address' => 'South William Street, Dublin',
                'category_id' => $restaurants->id,
                'crowd_level' => 'medium',
                'noise_level' => 'low',
                'lighting_level' => 'dim',
                'email' => 'hello@willowdining.ie',
                'phone' => '01 555 9911',
                'image' => 'restuarant2.jpg',
                'autism_friendly_hours' => '13:00-15:00',
            ],

           
            [
                'name' => 'The Quiet Pint',
                'description' => 'Laid-back pub with quieter daytime atmosphere.',
                'address' => 'Baggot Street, Dublin',
                'category_id' => $pubs->id,
                'crowd_level' => 'medium',
                'noise_level' => 'medium',
                'lighting_level' => 'dim',
                'email' => 'hello@quietpint.ie',
                'phone' => '01 555 4455',
                'image' => 'pub.jpg',
                'autism_friendly_hours' => '12:00-15:00',
            ],
            [
                'name' => 'Harbour Social',
                'description' => 'Modern pub space with quieter weekday afternoons.',
                'address' => 'Grand Canal Dock, Dublin',
                'category_id' => $pubs->id,
                'crowd_level' => 'high',
                'noise_level' => 'high',
                'lighting_level' => 'normal',
                'email' => 'info@harboursocial.ie',
                'phone' => '01 555 7789',
                'image' => 'pub2.jpg',
                'autism_friendly_hours' => '13:00-16:00',
            ],

         
            [
                'name' => 'Willow Walk Gardens',
                'description' => 'Peaceful garden with shaded seating.',
                'address' => 'Rathmines, Dublin',
                'category_id' => $parks->id,
                'crowd_level' => 'low',
                'noise_level' => 'low',
                'lighting_level' => 'normal',
                'email' => 'info@willowwalk.ie',
                'phone' => '01 555 8899',
                'image' => 'park1.jpg',
                'autism_friendly_hours' => '08:00-11:00',
            ],
            [
                'name' => 'Canal Side Green',
                'description' => 'Open green space along the canal, ideal for quiet walks.',
                'address' => 'Portobello, Dublin',
                'category_id' => $parks->id,
                'crowd_level' => 'medium',
                'noise_level' => 'low',
                'lighting_level' => 'normal',
                'email' => 'hello@canalside.ie',
                'phone' => '01 555 9900',
                'image' => 'park2.jpg',
                'autism_friendly_hours' => '07:00-10:00',
            ],

       
            [
                'name' => 'City Art Space',
                'description' => 'Contemporary gallery with quiet viewing areas.',
                'address' => 'Temple Bar, Dublin',
                'category_id' => $museums->id,
                'crowd_level' => 'medium',
                'noise_level' => 'low',
                'lighting_level' => 'dim',
                'email' => 'info@cityartspace.ie',
                'phone' => '01 555 2234',
                'image' => 'musuem1.jpg',
                'autism_friendly_hours' => '10:00-12:00',
            ],
            [
                'name' => 'Heritage House Dublin',
                'description' => 'Small museum with calm exhibitions.',
                'address' => 'Dublin 1',
                'category_id' => $museums->id,
                'crowd_level' => 'low',
                'noise_level' => 'low',
                'lighting_level' => 'normal',
                'email' => 'hello@heritagehouse.ie',
                'phone' => '01 555 6678',
                'image' => 'musuem2.jpg',
                'autism_friendly_hours' => '09:30-11:30',
            ],

        
            [
                'name' => 'QuietWorks Studio',
                'description' => 'Coworking space with silent zones and focus pods.',
                'address' => 'Dublin 8',
                'category_id' => $cowork->id,
                'crowd_level' => 'low',
                'noise_level' => 'low',
                'lighting_level' => 'bright',
                'email' => 'info@quietworks.ie',
                'phone' => '01 555 3345',
                'image' => 'office1.jpg',
                'autism_friendly_hours' => '09:00-12:00',
            ],
        ]);
    }
}