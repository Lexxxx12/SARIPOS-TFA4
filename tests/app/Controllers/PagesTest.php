<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Database\Seeds\SariposSeeder;

class PagesTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use DatabaseTestTrait;

    protected $seed = SariposSeeder::class;

    public function testAllPublicPagesLoad(): void
    {
        foreach (['/', '/about', '/login'] as $path) {
            $this->get($path)->assertOK();
        }
    }

    public function testProtectedPagesRedirectGuestsToLogin(): void
    {
        foreach (['/customers', '/customers/new', '/users', '/users/new'] as $path) {
            $this->get($path)->assertRedirectTo('/login');
        }
    }

    public function testCustomerDirectoryRendersDatabaseRecords(): void
    {
        $result = $this->withSession(['isLoggedIn' => true])->get('/customers');

        $result->assertSee('Andrea Santos');
        $result->assertSee('rafael.lim@example.com');
    }

    public function testUserDirectoryRendersDatabaseRecords(): void
    {
        $result = $this->withSession(['isLoggedIn' => true])->get('/users');

        $result->assertSee('admin');
        $result->assertSee('Samuel Aquino');
    }

    public function testValidLoginStartsSessionAndRedirects(): void
    {
        $result = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $result->assertRedirectTo('/customers');
        $result->assertSessionHas('isLoggedIn', true);
        $result->assertSessionHas('username', 'admin');
    }

    public function testInvalidLoginDoesNotAuthenticate(): void
    {
        $result = $this->post('/login', [
            'username' => 'admin',
            'password' => 'wrong-password',
        ]);

        $result->assertRedirect();
        $result->assertSessionMissing('isLoggedIn');
        $result->assertSessionHas('error');
    }
}
