<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $event = Event::inRandomOrder()->first();
        return [
            'event_id' => $event->id,
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'price' => fake()->numberBetween(100000, 2000000),
            'quota' => fake()->numberBetween(10, 50),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
