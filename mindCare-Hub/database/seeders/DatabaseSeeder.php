<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\User;
use App\Models\Counselor;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Sample Packages
        Package::create([
            'name' => 'Basic Plan',
            'description' => 'Access to mood tracking and chatbot.',
            'price' => 9.99,
            'duration' => 1,
        ]);

        Package::create([
            'name' => 'Premium Plan',
            'description' => 'Full access including counseling sessions.',
            'price' => 29.99,
            'duration' => 3,
        ]);

        $counselorUser = User::create([
            'name' => 'Dr. John Doe',
            'email' => 'john.doe@mindcare.com',
            'password' => Hash::make('password123'),
            'role' => 'counselor',
        ]);

        Counselor::create([
            'user_id' => $counselorUser->id,
            'specialization' => 'Cognitive Behavioral Therapy',
            'bio' => 'Experienced therapist with 10 years of practice.',
        ]);

    }
}
