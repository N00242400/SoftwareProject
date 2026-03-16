<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Service;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        // Define category types
        $categoryTypes = [
            'cafe' => ['nameSuffix' => 'Cafe', 'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=640&q=80'],
            'library' => ['nameSuffix' => 'Library', 'image' => 'https://images.unsplash.com/photo-1516979187457-637abb4f9353?auto=format&fit=crop&w=640&q=80'],
            'restaurant' => ['nameSuffix' => 'Restaurant', 'image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=640&q=80'],
        ];

        // Pick a random category type
        $categoryKey = $this->faker->randomElement(array_keys($categoryTypes));
        $categoryInfo = $categoryTypes[$categoryKey];

        return [
            'name' => ucfirst($this->faker->words(2, true)) . ' ' . $categoryInfo['nameSuffix'],
            'description' => $this->faker->randomElement([
                'A cozy spot with friendly staff and calm ambiance.',
                'Quiet and peaceful, perfect for reading or studying.',
                'Enjoy delicious food with a relaxing atmosphere.',
                'Ideal place for families looking for low-stimulation hours.',
                'A bright and cheerful place with welcoming staff.',
            ]),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'category_id' => null, // attach later in seeder
            'image' => $categoryInfo['image'], // guaranteed URL
            'noise_level' => $this->faker->randomElement(['low','medium','high']),
            'lighting_level' => $this->faker->randomElement(['dim','normal','bright']),
            'crowd_level' => $this->faker->randomElement(['low','medium','high']),
            'autism_friendly_hours' => $this->faker->time('H:i') . '-' . $this->faker->time('H:i'),
        ];
    }
}