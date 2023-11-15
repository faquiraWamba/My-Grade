<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['M', 'F']);
        $name = ($gender === 'M') ? $this->faker->firstNameMale : $this->faker->firstNameFemale;
    
        return [
            'last_name' => $this->faker->lastName(),
            'first_name' => $name,
            'gender'=> $gender,
            'phone'=>$this->faker->unique->numberBetween(620000000, 699999999),
            'user_id' => User::factory()
        ];
    }
}
