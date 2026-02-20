<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
       
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Cafe', 'description' => 'Coffee shops and cafes'],
            ['id' => 2, 'name' => 'Library', 'description' => 'Libraries and reading spaces'],
            ['id' => 3, 'name' => 'Restaurant', 'description' => 'Restaurants and eateries'],
        ]);
    }
}