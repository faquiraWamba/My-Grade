<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $p=$this->faker->file(database_path('seeders\students\pictures'),
        storage_path('app\public\students\pictures'));
        $p=explode(storage_path('app\public'),$p)[1];
        $p=str_replace('\\','/',$p);
        $p=substr($p,1);
        return [
            //
            'person_id' => Person::factory(),
            'registration_number' => $this->faker->unique()->regexify('MAT-[0-9]{2}[0-9A-Z]-[0-9]{1,3}'),
            'birthday'=> $this->faker->date('2008-01-01'),
            'birth_town' => $this->faker->city(),
            'picture'=>$p
        ];
    }
}
