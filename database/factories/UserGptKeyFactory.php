<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserGptKey>
 */
class UserGptKeyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key'=>fake()->unique()->uuid,
            'start_at'=>now(),
            'end_at'=>now()->addMonths(),
        ];
    }
}
