<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Counselor;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'counselor_id' => Counselor::factory(),
            'user_name' => $this->faker->name(),
            'user_email' => $this->faker->safeEmail(),
            'mobile_no' => $this->faker->phoneNumber(),
            'appointment_date' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'appointment_time' => $this->faker->time('H:i'),
            'current_situation' => $this->faker->sentence(),
            'reason' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
        ];
    }
}
