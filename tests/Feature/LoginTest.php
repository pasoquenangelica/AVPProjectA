<?php

namespace Tests\Feature;

use App\Models\UserAccounts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserAccounts::updateOrCreate(
            ['username' => 'student1'],
            [
                'email' => 'student1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'is_active' => true,
                'must_change_password' => false,
            ]
        );
    }

    public function test_login_shows_error_for_incorrect_credentials(): void
    {
        $response = $this->from('/')->post('/login', [
            'username' => 'student1',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors([
            'username' => 'Incorrect credentials. Please try again.',
        ]);
    }

    public function test_student_login_redirects_to_dashboard(): void
    {
        $response = $this->post('/login', [
            'username' => 'student1',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('success', 'Successful login.');
        $response->assertSessionHas('logged_user', 'student1');
    }
}
