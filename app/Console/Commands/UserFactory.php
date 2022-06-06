<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'name' => $this->faker->name(),
            'name' => '管理员',
            //'email' => $this->faker->unique()->safeEmail(),
            'email' => 'admin@wanyuenet.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$0F7YfbiPz5IFUAgyp0vrwuhnQfnvQqgHma5b5bAT9AYXCnt0xUIHe', // _1
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
