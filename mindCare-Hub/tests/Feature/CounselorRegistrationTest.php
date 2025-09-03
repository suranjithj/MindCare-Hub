<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Counselor;

class CounselorRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function counselor_can_register_successfully()
    {
        $response = $this->postJson(route('register.post'), [
            'name' => 'Test Counselor',
            'email' => 'counselor@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'specialization' => 'Psychology',
            'experience' => 5,
            'qualifications' => 'PhD in Clinical Psychology',
            'consultation_fee' => 75,
            'bio' => 'Experienced in counseling for 10+ years',
            'location' => 'Colombo',
            'languages' => 'English, Sinhala',

        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Counselor registered successfully',
                 ]);

        $response->dump();

        $this->assertDatabaseHas('counselors', [
            'email' => 'counselor@example.com',
            'name' => 'Test Counselor',
        ]);
    }

    /** @test */
    public function counselor_registration_fails_with_invalid_email()
    {
        $response = $this->postJson(route('register.post'), [
            'name' => 'Test Counselor',
            'email' => 'counselor-at-example.com', // Invalid email
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'specialization' => 'Psychology',
            'experience' => 2,
            'qualifications' => 'MSc',
            'consultation_fee' => 50,
            'bio' => 'Testing invalid email',
            'location' => 'Kandy',
            'languages' => 'English',

        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
        $response->dump();
    }

    /** @test */
    public function counselor_registration_fails_with_empty_required_field()
    {
        $response = $this->postJson(route('register.post'), [
            'name' => ' ',
            'email' => 'missingname@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'specialization' => 'Psychology',
            'experience' => 3,
            'qualifications' => 'MA',
            'consultation_fee' => 60,
            'bio' => 'Testing missing name',
            'location' => 'Galle',
            'languages' => 'Sinhala',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
        $response->dump();
    }

    /** @test */
    public function counselor_registration_fails_with_password_mismatch()
    {
        $response = $this->postJson(route('register.post'), [
            'name' => 'Test Counselor',
            'email' => 'counselor@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password456', // Mismatched confirmation
            'specialization' => 'Psychology',
            'experience' => 1,
            'qualifications' => 'BSc',
            'consultation_fee' => 30,
            'bio' => 'Testing password mismatch',
            'location' => 'Matara',
            'languages' => 'Sinhala',

        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);
        $response->dump();
    }
}
