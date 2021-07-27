<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TenantAwareTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TenantAwareTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSeededDbData()
    {
        // Check default user
        $user = User::first();

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertArraySubset(['email' => 'admin@testme.pk'], $user->toArray());

        $roles = $user->getRoleNames();
        $this->assertNotEmpty($roles);

        $this->assertContains('Super admin', $roles);
    }

    public function testShouldRetrieveUserPermissions()
    {
        $user = User::first();

        $this->assertNotNull($user);

        $roles = $user->getRoleNames();
        $this->assertNotEmpty($roles);

        $perms = $user->getAllPermissions();
        $this->assertNotNull($perms);
    }
}
