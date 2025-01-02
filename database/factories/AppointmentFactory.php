<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::inRandomOrder()->first()->id,
            'appointment_time' => $this->faker->dateTimeBetween('now', '+1 year'),
            'description' => $this->faker->sentence(),
            'notification_method' => $this->faker->randomElement(['SMS', 'Email']),
        ];
    }
}
