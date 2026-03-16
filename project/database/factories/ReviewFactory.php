<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Review;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            // Descriptive review text
            'description' => $this->faker->randomElement([
                'The lighting was perfect and the noise was very low.',
                'Staff were helpful, and the place was quiet.',
                'A bit crowded at peak times, but still enjoyable.',
                'Loved the calm environment during autism-friendly hours.',
                'Great atmosphere, very bright and cheerful.',
                'Perfect for working or reading in peace.',
            ]),

      
            'noise_rating' => $this->faker->randomElement(['low','medium','high']),
            'lighting_rating' => $this->faker->randomElement(['dim','normal','bright']), 
            'crowd_rating' => $this->faker->randomElement(['low','medium','high']), 

            // IDs will be attached in the seeder
            'user_id' => null,
            'service_id' => null,
        ];
    }
}