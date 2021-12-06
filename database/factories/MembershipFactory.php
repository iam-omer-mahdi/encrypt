<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Factories\Factory;

class MembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Crypt::encrypt($this->faker->name()),
            'age' => Crypt::encrypt($this->faker->numberBetween(18,100)),
            'sex' => Crypt::encrypt($this->faker->randomElement(['male','female'])),
            'phone' => Crypt::encrypt($this->faker->phoneNumber()),
            'national_number' => Crypt::encrypt($this->faker->numberBetween(1000000,1000000000)),
            'state_id' => Crypt::encrypt($this->faker->numberBetween(1,5)),
            'district' => Crypt::encrypt($this->faker->city()),
            'qualification_id' => Crypt::encrypt($this->faker->numberBetween(1,5)),
            'joining_date' => Crypt::encrypt($this->faker->date('Y-m-d','now')),
            'form_number' => Crypt::encrypt($this->faker->numberBetween(1000000,1000000000)),
        ];
    }
}
