<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Service;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);
    
        // Small number of users 
        User::factory(10)->create();
    
        // categories
        $this->call(CategorySeeder::class);
    
        //  services
        $this->call(ServiceSeeder::class);
    
        // small number of reviews
        $users = User::all();
        $services = Service::all();
    
        foreach ($services as $service) {
            $reviewCount = rand(1, 5); // smaller number
    
            Review::factory($reviewCount)->create([
                'service_id' => $service->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}