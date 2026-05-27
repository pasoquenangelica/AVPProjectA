<?php

namespace Tests\Feature;

use App\Models\Degree;
use App\Models\Student;
use App\Models\UserAccounts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class StudentCrudTest extends TestCase
{
    use RefreshDatabase;

    protected UserAccounts $admin;
    protected Degree $degree;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = UserAccounts::create([
            'username' => 'admin1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
            'must_change_password' => false,
        ]);

        $this->degree = Degree::create([
            'degree_title' => 'BS Information Technology',
        ]);

        $this->withSession([
            'logged_id' => $this->admin->id,
            'logged_user' => $this->admin->username,
            'logged_role' => $this->admin->role,
        ]);
    }

    public function test_admin_can_create_a_student_with_linked_account(): void
    {
        $response = $this->postJson('/students', [
            'fname' => 'Angelica',
            'lname' => 'Pasoquen',
            'mname' => 'Rey',
            'contactno' => '09123456789',
            'degree_id' => $this->degree->id,
            'email' => 'angelica@example.com',
            'username' => 'angelica.student',
            'password' => 'password123',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'success' => true,
                'message' => 'Student added successfully.',
            ]);

        $this->assertDatabaseHas('user_accounts', [
            'username' => 'angelica.student',
            'email' => 'angelica@example.com',
            'role' => 'student',
        ]);

        $this->assertDatabaseHas('students', [
            'fname' => 'Angelica',
            'lname' => 'Pasoquen',
            'degree_id' => $this->degree->id,
        ]);
    }

    public function test_admin_can_update_a_student_and_linked_account(): void
    {
        $account = UserAccounts::create([
            'username' => 'student.old',
            'email' => 'student.old@example.com',
            'password' => Hash::make('password123'),
            'role' => 'student',
            'is_active' => true,
            'must_change_password' => false,
        ]);

        $student = Student::create([
            'fname' => 'Old',
            'lname' => 'Name',
            'mname' => 'M',
            'contactno' => '09123456789',
            'degree_id' => $this->degree->id,
            'user_account_id' => $account->id,
        ]);

        $response = $this->putJson('/students/'.$student->id, [
            'fname' => 'New',
            'lname' => 'Name',
            'mname' => 'Middle',
            'contactno' => '09999999999',
            'degree_id' => $this->degree->id,
            'email' => 'student.new@example.com',
            'username' => 'student.new',
            'password' => 'newpassword123',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'success' => true,
                'message' => 'Student updated successfully.',
            ]);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'fname' => 'New',
            'mname' => 'Middle',
            'contactno' => '09999999999',
        ]);

        $this->assertDatabaseHas('user_accounts', [
            'id' => $account->id,
            'email' => 'student.new@example.com',
            'username' => 'student.new',
        ]);
    }

    public function test_admin_can_delete_student_and_linked_account(): void
    {
        $account = UserAccounts::create([
            'username' => 'student.delete',
            'email' => 'student.delete@example.com',
            'password' => Hash::make('password123'),
            'role' => 'student',
            'is_active' => true,
            'must_change_password' => false,
        ]);

        $student = Student::create([
            'fname' => 'Delete',
            'lname' => 'Me',
            'mname' => null,
            'contactno' => '09123456789',
            'degree_id' => $this->degree->id,
            'user_account_id' => $account->id,
        ]);

        $response = $this->deleteJson('/students/'.$student->id);

        $response
            ->assertOk()
            ->assertJson([
                'success' => true,
                'message' => 'Student deleted successfully.',
            ]);

        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]);

        $this->assertDatabaseMissing('user_accounts', [
            'id' => $account->id,
        ]);
    }
}
