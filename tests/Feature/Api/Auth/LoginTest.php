<?php
namespace Tests\Feature\Api\Auth;

use Tests\TenantAwareTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TenantAwareTestCase
{
    public function testShouldInvalidateRequest()
    {
        $this->json('POST', 'api/auth/login')
             ->assertJsonValidationErrors([
                'email', 'password'
             ]);

        $this->json('POST', 'api/auth/login', [
            'email' => 'email@test.com',
            'password' => 'secret'
        ])->assertJsonValidationErrors([
            'email'
        ]);
    }

    public function testShouldFailAuthenticating()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\Models\User::class)->create();

        $response = $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(401)->assertJson([
            'success' => false,
            'message' => trans('auth.failed')
        ]);
    }
}
