<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Define aquí los atributos ficticios para la generación de datos
            'name' => $this->faker->firstName,
            'lastnamefather' => $this->faker->lastName,
            'lastnamemother' => $this->faker->lastName,
            'cedula' => $this->faker->unique()->randomNumber(),
            'birthdate' => $this->faker->date(),
        ];
    }
}
