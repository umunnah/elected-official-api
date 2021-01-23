<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
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
    public function fetch_all_users()
    {
        User::factory(100)->create();

        $response = $this->get('/api/v1/users?paginate=50');

        $response->assertOk();
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function fetch_user()
    {
        $user = User::factory()->create();
        $response = $this->get('/api/v1/users/'.$user->id);

        $response->assertOk();
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function create_a_new_user()
    {
        $response = $this->post('/api/v1/register', $this->userData());
        dd($response->getContent());
        $response->assertCreated();
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function create_a_new_user_without_validation()
    {
        $response = $this->post('/api/v1/register', []);

        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function userData()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->userName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'password' => $this->faker->password(8,20),
        ];
    }
}
