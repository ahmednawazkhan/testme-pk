<?php

namespace Tests\Feature\Api;

use Tests\TenantAwareTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TenantAwareTestCase
{
    public function testShouldRetrieveTags()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\Models\User::class)->create();

        $response = $this->json('POST', '/api/auth/login', [
            'email' => $user->email,
            'password' => 'secret'
        ])->assertOk()->decodeResponseJson();

        $this->withHeaders([
            'Authorization' => "Bearer {$response['token']}"
        ])
             ->json('GET', '/api/agency/tags')
             ->assertOk()
             ->assertJsonStructure([
                'success', 'tags'
             ]);
    }
}
