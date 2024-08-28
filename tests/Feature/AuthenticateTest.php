<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthenticateTest extends TestCase
{

    public function testLoginFormCanBeRender(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function testUserCanLogin(): void
    {
        $response = $this->post(route('login'), [
            'email' => 'rezaparsian76@gmail.com',
            'password' => '12345678'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route("dashboard"));
    }

    public function testUserCanNotLoggedInWithWrongCredentials(): void
    {
        $response = $this->post(route('login'), [
            'email' => 'rezaparsian76@gmail.com',
            'password' => '123456'
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function testUserCanLogout(): void
    {
        $this->post(route('login'));

        $this->assertGuest();
    }
}
