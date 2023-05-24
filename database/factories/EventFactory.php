<?php

namespace Database\Factories;

use App\Models\NumberOfParticipants;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Structure;
use App\Models\Partner;
use App\Models\Status;
use App\Models\User;
use NunoMaduro\Collision\Adapters\Phpunit\State;

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
            'location' => $this->faker->sentence,
            'date_start' => $this->faker->date(),
            'date_end' => $this->faker->date(),
            'is_Fix' => true || false,
            'hours' => $this->faker->time(),
            'organizer_needs' => $this->faker->text,
            'structure_id' => Structure::pluck('id')->random(),
            'status_id' => Status::pluck('id')->random(),
            'number_of_participants_id' => NumberOfParticipants::pluck('id')->random(),
            'user_id' => User::pluck('id')->random(),
        ];
    }
}
