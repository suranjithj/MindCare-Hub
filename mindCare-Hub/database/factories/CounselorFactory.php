<?php

namespace Database\Factories;

use App\Models\Counselor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CounselorFactory extends Factory
{
    protected $model = Counselor::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'specialization' => $this->faker->randomElement(['Psychology', 'Therapy', 'Counseling']),
            'experience' => $this->faker->numberBetween(1, 15),
            'qualifications' => $this->faker->sentence(3),
            'consultation_fee' => $this->faker->randomFloat(2, 500, 5000),
            'bio' => $this->faker->paragraph(),
            'location' => $this->faker->city(),
            'languages' => json_encode([$this->faker->randomElement(['English', 'Sinhala', 'Tamil'])]),
            'availability' => json_encode([
                'Monday' => '9AM - 5PM',
                'Wednesday' => '10AM - 4PM',
            ]),
        ];
    }
}
