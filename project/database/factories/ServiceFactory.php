<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Service;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        // Define category types with realistic name suffix and sample images
        $categoryTypes = [
            'cafe' => [
                'nameSuffix' => 'Cafe',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=640&q=80',
                'prefixes' => ['Sunny', 'Blue', 'Golden', 'Corner', 'Brewed', 'Daily'],
                'nameOptions' => ['Bean', 'Brew', 'House', 'Roaster', 'Cup', 'Blend'],
                'descriptions' => [
                    'Enjoy freshly brewed coffee and homemade pastries.',
                    'Cozy atmosphere with comfy seating and free Wi-Fi.',
                    'Perfect for casual meetings or a quiet morning coffee.',
                    'Friendly staff and relaxing environment for all visitors.',
                ],
            ],
            'library' => [
                'nameSuffix' => 'Library',
                'image' => 'https://images.unsplash.com/photo-1516979187457-637abb4f9353?auto=format&fit=crop&w=640&q=80',
                'prefixes' => ['Central', 'City', 'Knowledge', 'Quiet', 'Harmony', 'Oak'],
                'nameOptions' => ['Hall', 'Archives', 'Collection', 'Reading', 'Branch', 'Study'],
                'descriptions' => [
                    'A peaceful library with a wide selection of books and magazines.',
                    'Study rooms available for students and professionals.',
                    'Perfect environment for research or quiet reading.',
                    'Friendly staff and organized spaces for all visitors.',
                ],
            ],
            'restaurant' => [
                'nameSuffix' => 'Restaurant',
                'image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=640&q=80',
                'prefixes' => ['Red', 'Spice', 'Garden', 'Harvest', 'Delight', 'Table'],
                'nameOptions' => ['Grill', 'Kitchen', 'Bistro', 'House', 'Table', 'Corner'],
                'descriptions' => [
                    'Serves seasonal dishes made with locally sourced ingredients.',
                    'Family-friendly restaurant with a warm, welcoming atmosphere.',
                    'Fine dining experience with excellent service and ambiance.',
                    'Casual spot with delicious meals and cozy seating.',
                ],
            ],
        ];

        // Pick a random category type
        $categoryKey = $this->faker->randomElement(array_keys($categoryTypes));
        $categoryInfo = $categoryTypes[$categoryKey];

        // Generate a realistic name
        $name = $this->faker->randomElement($categoryInfo['prefixes'])
                . ' ' 
                . $this->faker->randomElement($categoryInfo['nameOptions'])
                . ' ' 
                . $categoryInfo['nameSuffix'];

        // Generate realistic autism-friendly hours (start before end)
        $startHour = $this->faker->numberBetween(7, 12);
        $endHour = $this->faker->numberBetween(13, 22);
        $autismHours = sprintf('%02d:00-%02d:00', $startHour, $endHour);

        return [
            'name' => $name,
            'description' => $this->faker->sentence(6) 
                             . ' ' 
                             . $this->faker->randomElement($categoryInfo['descriptions']),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'category_id' => null, // attach later in seeder
            'image' => $categoryInfo['image'],
            'noise_level' => $this->faker->randomElement(['low','medium','high']),
            'lighting_level' => $this->faker->randomElement(['dim','normal','bright']),
            'crowd_level' => $this->faker->randomElement(['low','medium','high']),
            'autism_friendly_hours' => $autismHours,
        ];
    }
}