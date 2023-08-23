<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CarrierControllerTest extends TestCase
{
    use  WithFaker;
    /**
     * @test
     * @return void
     */
    public function create_new_carrier_with_valid_data(): void
    {
        // Simulamos una solicitud HTTP POST con los datos necesarios para crear un transportista
        $postData = [
            'name' => $this->faker->firstName,
            'lastnamefather' => $this->faker->lastName,
            'lastnamemother' => $this->faker->lastName,
            'cedula' =>(string) $this->faker->randomNumber(9),
            'birthdate' => $this->faker->date('Y-m-d'),
            'license' => (string)$this->faker->randomNumber(8),
        ];
        $response = $this->postJson('/api/carriers/store', $postData);

        // Verificamos que la respuesta sea la esperada (por ejemplo, estado 201 y JSON de respuesta)
        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Se ha creado el transportista correctamente',
                'type_message' => 'success',
                'data' => $response['data'],
            ]);

        // Verificamos que los registros de Person y Carrier se hayan creado en la base de datos
        $this->assertDatabaseHas('persons', [
            'name' => $postData['name'],
            'lastnamefather' => $postData['lastnamefather'],
            'lastnamemother' => $postData['lastnamemother'],
            'cedula' => $postData['cedula'],
            'birthdate' => $postData['birthdate'],
        ]);

        $this->assertDatabaseHas('carriers', [
            'license' => $postData['license'],
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function create_new_carrier_with_field_birthdate_invalid(): void
    {
        // Simulamos una solicitud HTTP POST con los datos necesarios para crear un transportista
        $postData = [
            'name' => $this->faker->firstName,
            'lastnamefather' => $this->faker->lastName,
            'lastnamemother' => $this->faker->lastName,
            'cedula' =>(string) $this->faker->randomNumber(9),
            'birthdate' => 'invalid-date',
            'license' => (string)$this->faker->randomNumber(8),
        ];
        $response = $this->postJson('/api/carriers/store', $postData);

        // Verificamos que la respuesta sea la esperada (por ejemplo, estado 422 y JSON de respuesta)
            $response->assertStatus(422)
                ->assertJson([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'type_message' => 'danger',
                    'data' => [
                        'code_error' => 300,
                        'errors_validations_fields' => [
                            'birthdate' => [
                                "El fecha de nacimiento debe ser una fecha",
                                "El fecha de nacimiento debe tener el formato Y-m-d",
                            ],
                        ],
                    ],
                ]);
        $this->assertArrayHasKey('birthdate', $response['data']['errors_validations_fields']);
    }

    /**
     * @test
     * @return void
     */
    public function create_new_carrier_with_required_all_fields():void
    {
            // Simulamos una solicitud HTTP POST con los datos necesarios para crear un transportista
        $postData = [
            'name' => '',
            'lastnamefather' => '',
            'lastnamemother' => '',
            'cedula' =>'',
            'birthdate' => '',
            'license' => '',
        ];
        $response = $this->postJson('/api/carriers/store', $postData);

        // Verificamos que la respuesta sea la esperada (por ejemplo, estado 422 y JSON de respuesta)
        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'type_message' => 'danger',
                'data' => [
                    'code_error' => 300,
                    'errors_validations_fields' => [
                        'name' => [
                            "El campo nombre es requerido",
                        ],
                        'lastnamefather' => [
                            "El campo apellido paterno es requerido",
                        ],
                        'lastnamemother' => [
                            "El campo apellido materno es requerido",
                        ],
                        'cedula' => [
                            "El campo cedula es requerido",
                        ],
                        'birthdate' => [
                            "El campo fecha de nacimiento es requerido",
                        ],
                        'license' => [
                            "El campo licencia es requerido",
                        ],
                    ],
                ],
            ]);
        $this->assertArrayHasKey('name', $response['data']['errors_validations_fields']);
        $this->assertArrayHasKey('lastnamefather', $response['data']['errors_validations_fields']);
        $this->assertArrayHasKey('lastnamemother', $response['data']['errors_validations_fields']);
        $this->assertArrayHasKey('cedula', $response['data']['errors_validations_fields']);
        $this->assertArrayHasKey('birthdate', $response['data']['errors_validations_fields']);
        $this->assertArrayHasKey('license', $response['data']['errors_validations_fields']); }


}
