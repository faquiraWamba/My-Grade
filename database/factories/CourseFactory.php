<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'code'=> $this->faker->unique()->regexify('UE23[0-9][0-9][0-9]'),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'credit' => $this->faker->numberBetween(2,8),
        ];
    }
}
