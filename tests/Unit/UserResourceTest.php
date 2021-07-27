<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Http\Request;
use Tests\TenantAwareTestCase;
use App\Http\Resources\User as UserResource;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserResourceTest extends TenantAwareTestCase
{
    public function testResourceShema()
    {
        $user = User::first();
        $resource = new UserResource($user);

        $this->assertIsNotArray($user->getRoleNames());

        $this->assertArraySubset([
            'id' => $user->id,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ], $resource->toArray(Request::create('', 'GET')));
    }
}
