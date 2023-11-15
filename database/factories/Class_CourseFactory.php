<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Class_Course>
 */
class Class_CourseFactory extends Factory
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
            'class_id' => 13,
            'course_id' => rand(1,38),
            'semester' => rand(1,2),
            'school_year' => 2023,
        ];
    }
}
