<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function create_a_new_user()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/v1/register', $this->userData());

        $response->assertOk();
    }

    private function userData()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->userName,
            'email' => $this->faker->email
        ];
    }
}
