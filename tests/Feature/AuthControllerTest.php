<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function login_with_wrong_crendentials()
    {
        User::factory()->create();
        $data = ['username' => 'tesing', 'password' => 'deS#ert10'];

        $response = $this->post('/api/v1/login',$data);

        $response->assertStatus(JsonResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function login_with_unverified_account()
    {
        $user = User::factory(['email_verified_at' => null])->create();

        $data = ['username' => $user->email, 'password' => 'deS#ert10'];

        $response = $this->post('/api/v1/login',$data);

        $response->assertStatus(JsonResponse::HTTP_FORBIDDEN);
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function login_with_verified_account_without_personal_access_client()
    {
        $user = User::factory()->create();

        $data = ['username' => $user->email, 'password' => 'deS#ert10'];

        $response = $this->post('/api/v1/login',$data);

        $response->assertStatus(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function login_with_verified()
    {
        $this->artisan('passport:install');
        $user = User::factory()->create();

        $data = ['username' => $user->email, 'password' => 'deS#ert10'];

        $response = $this->post('/api/v1/login',$data);

        $response->assertStatus(JsonResponse::HTTP_OK);
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function login_with_an_invalid_password()
    {
      $data = ['username' => 'test@gmail.com', 'password' => '123456'];

      $response = $this->post('/api/v1/login',$data);

      $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function login_without_validation()
    {
        $response = $this->post('/api/v1/login', []);

        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

}
