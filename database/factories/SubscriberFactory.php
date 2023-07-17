<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriber>
 */
class SubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subscriber_id' => $this->faker->unique()->sha256(),
            'subscriber_email' => $this->faker->unique()->safeEmail(),
            'subscribed' => rand(0,1),
            'created_at' => now(),
        ];
    }
}
