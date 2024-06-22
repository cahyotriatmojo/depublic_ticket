<?php

namespace Database\Factories;

use App\Models\Event;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Event::class;
    public function definition(): array
    {
        $start_date = (new DateTime())->modify('+3 days')->format('Y-m-d');
        $end_date = $this->faker->dateTimeBetween($start_date, $start_date . ' +3 days')->format('Y-m-d');
        $name = $this->faker->sentence(2);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => $this->faker->imageUrl(),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'city' => $this->faker->city,
            'description' => $this->faker->sentence(10),
            'location' => $this->faker->address,
            'gmap_link' => 'https://maps.google.com/?q=' . urlencode($this->faker->address),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
