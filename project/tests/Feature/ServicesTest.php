<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServicesTest extends TestCase
{
    use RefreshDatabase; // resets DB after each test

    /**
     * Test that a user can view the services index page
     */
    public function test_user_can_view_services_index()
    {
        $response = $this->get(route('services.index'));

        $response->assertStatus(200); // page loads successfully
    }

    /**
     * Test that a service can be created using factory
     */
    public function test_service_factory_creates_service()
    {
        $category = Category::factory()->create();

        $service = Service::factory()->create([
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'category_id' => $category->id,
        ]);
    }

    /**
     * Test that a logged-in user can add a service to favourites
     */
    public function test_user_can_add_service_to_favourites()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $service = Service::factory()->create(['category_id' => $category->id]);

        // Simulate user adding the service to favourites
        $this->actingAs($user)
             ->post(route('favourites.store'), [
                 'service_id' => $service->id, // IMPORTANT: send service_id in POST body
             ])
             ->assertStatus(302); // expect redirect after adding

        // Check the pivot/favourites table has the entry
        $this->assertDatabaseHas('favourites', [
            'user_id' => $user->id,
            'service_id' => $service->id,
        ]);
    }

    /**
     * Test that a logged-in user can remove a service from favourites
     */
    public function test_user_can_remove_service_from_favourites()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $service = Service::factory()->create(['category_id' => $category->id]);

        // Add favourite first
        $user->favourites()->create(['service_id' => $service->id]);

        // Then remove it
        $this->actingAs($user)
             ->delete(route('favourites.destroy', $service->id))
             ->assertStatus(302);

        $this->assertDatabaseMissing('favourites', [
            'user_id' => $user->id,
            'service_id' => $service->id,
        ]);
    }

    /**
     * Test that a user can create a review for a service
     */
    public function test_user_can_create_review()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $service = Service::factory()->create(['category_id' => $category->id]);

        // Send POST request to create review
        $response = $this->actingAs($user)
            ->post(route('reviews.store'), [
                'service_id' => $service->id, // IMPORTANT: send service_id
                'description' => 'Great place!',
                'noise_rating' => 'medium',
                'lighting_rating' => 'bright',
                'crowd_rating' => 'low',
            ]);

        $response->assertStatus(302); // expect redirect after submitting

        // Check reviews table contains the review
        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'service_id' => $service->id,
            'description' => 'Great place!',
        ]);
    }

    /**
     * Test that a user can view a single service page
     */
    public function test_user_can_view_single_service()
    {
        $category = Category::factory()->create();
        $service = Service::factory()->create(['category_id' => $category->id]);

        $response = $this->get(route('services.show', $service->id));

        $response->assertStatus(200); // page loads successfully
    }
}