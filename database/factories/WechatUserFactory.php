<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WechatUser>
 */
class WechatUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'openid'=>fake()->unique()->uuid,
            'subscribe'=>1,
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
