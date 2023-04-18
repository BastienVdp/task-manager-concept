<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'priority' => $this->faker->randomElement(['high' ,'normal', 'low']),
            'deadline' => $this->faker->date(),
            'user_id' => $this->faker->randomElement(User::pluck('id'))
        ];
    }
}
