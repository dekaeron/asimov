<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookingFactory extends Factory
{
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('today','+2 weeks'),
            'hour' => $this->faker->numberBetween(9, 18),
            'contact_name' => $this->faker->name(),
            'contact_email' => $this->faker->safeEmail(),          
        ];
    }
}
