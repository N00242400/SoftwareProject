<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Cafés & Coffee Shops', 'description' => 'Coffee shops, brunch spots, and cafés'],
            ['name' => 'Libraries & Study Spaces', 'description' => 'Quiet places to study or read'],
            ['name' => 'Restaurants', 'description' => 'Dining restaurants and eateries'],
            ['name' => 'Coworking Spaces', 'description' => 'Work-friendly shared offices'],
            ['name' => 'Pubs & Social Spots', 'description' => 'Casual meeting and social venues'],
            ['name' => 'Parks & Outdoor Spaces', 'description' => 'Outdoor relaxation and green spaces'],
            ['name' => 'Museums & Culture', 'description' => 'Cultural and educational locations'],
        ]);
    }
}