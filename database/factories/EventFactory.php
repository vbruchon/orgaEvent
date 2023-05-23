<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Structure;
use App\Models\Partner;

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
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'partners' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'approved', 'cancelled']),
            'number_of_participants' => $this->faker->numberBetween(1, 100),
            'date_start' => $this->faker->date(),
            'date_end' => $this->faker->date(),
            'expected_date_start' => $this->faker->date(),
            'expected_date_end' => $this->faker->date(),
            'hours_start' => $this->faker->time(),
            'hours_end' => $this->faker->time(),
            'organizer_needs' => $this->faker->text,
            'structures_id' => Structure::pluck('id')->random(),
        ];
    }
}
