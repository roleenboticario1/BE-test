<?php

namespace Tests\Unit\User;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_if_user_required_fields()
    {
        $response = $this->json(self::HTTP_METHOD_POST, '/api/users/add', ['Accept' => 'application/json']);
        $response->assertStatus(self::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => [
                        "The name field is required."
                    ],
                    "email" => [
                        "The email field is required."
                    ],
                    "ip_address" => [
                        "The ip address field is required."
                    ],
                ]
            ]);
    } 

    public function test_if_new_user_successfully_saved()
    {   
        $data = [
            "name" => "Roleen",
            "email" => "emailRoleen100000@gmail.com",
            "ip_address" => "27.109.95.255"
        ];

        $response = $this->json(self::HTTP_METHOD_POST, '/api/users/add', $data, ['Accept' => 'application/json']);
        $response->assertStatus(self::HTTP_CREATED)
            ->assertJson([
                "message" => "User successfully saved.",
            ]);
    } 

    public function test_if_user_successfully_fetch()
    {   
        $response = $this->json(self::HTTP_METHOD_GET, '/api/users', ['Accept' => 'application/json']);
        $response->assertStatus(self::HTTP_OK);
    }

    public function test_if_user_successfully_fetch_by_id()
    {   
        $response = $this->json(self::HTTP_METHOD_GET, '/api/users/1', ['Accept' => 'application/json']);
        $response->assertStatus(self::HTTP_OK);
    }

}
