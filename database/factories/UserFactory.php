<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
            'id_posyandu' => "1",
            'name' => "name-test",
            // 'email' => "email@ehealth.test",
            'email_verified_at' => now(),
            'password' => Hash::make("admin123"), // password
            'nik' => 1111111111111111, 
            'no_kk' => 1111111111111112, 
            'alamat' => null, 
            'role' => 4, 
            'jenis_kelamin' => "pria", 
            'created_at' => now(),
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
