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
        // 1️Create admin user first
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'), 
        ]);

        // 2️Generate additional fake users
        User::factory(100)->create(); // 100 users for testing

        // 3️Generate categories (only if none exist)
        if (Category::count() === 0) {
            Category::factory(10)->create(); // 10 categories
        }

        $categories = Category::all();

        // 4️ Generate services (500 services)
        $services = Service::factory(500)->make()->each(function ($service) use ($categories) {
            // Attach a random category
            $service->category_id = $categories->random()->id;
            $service->save();
        });

        // 5️ Generate 5–20 reviews per service
        $users = User::all();

        foreach ($services as $service) {
            $reviewCount = rand(5, 20);
            Review::factory($reviewCount)->make()->each(function ($review) use ($service, $users) {
                $review->service_id = $service->id;
                $review->user_id = $users->random()->id;
                $review->save();
            });
        }
    }
}