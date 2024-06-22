<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Highlight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Highlight>
 */
class HighlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Highlight::class;

    public function definition(): array
    {
        $event = Event::inRandomOrder()->first();
        return [
            'event_id' => $event->id,
            'highlight' => $this->faker->sentence(5),
        ];
    }
}
