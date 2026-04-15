<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Coffee Shops', 'description' => 'Coffee shops, brunch spots, and cafés'],
            ['name' => 'Libraries and Study Spaces', 'description' => 'Quiet places to study or read'],
            ['name' => 'Restaurants', 'description' => 'Dining restaurants and eateries'],
            ['name' => 'Coworking Spaces', 'description' => 'Work-friendly shared offices'],
            ['name' => 'Pubs and Social Spots', 'description' => 'Casual meeting and social venues'],
            ['name' => 'Parks and Outdoor Spaces', 'description' => 'Outdoor relaxation and green spaces'],
            ['name' => 'Museums and Culture', 'description' => 'Cultural and educational locations'],
        ]);
    }
}