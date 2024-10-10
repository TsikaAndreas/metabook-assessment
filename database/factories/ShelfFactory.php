<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shelf>
 */
class ShelfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(5, true),
            'description' => $this->faker->paragraph(),
            'user_id' => $this->getUser()->id,
        ];
    }

    /**
     * Get a user for the shelf.
     *
     * @return User The user model.
     */
    private function getUser(): User
    {
        return User::firstOr(function () {
            return User::factory()->create();
        });
    }
}
