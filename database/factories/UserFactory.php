<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\AssignOp\Concat;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        $bengkel = "Bengkel ";
        $username = explode(' ', $name)[0] . '123';
        $bengkel_name = "$bengkel $name";


        return [
            'username' => $username,
            'password' => Hash::make('password'),
            'bengkel_name' => $bengkel_name,
            'kepala_bengkel' => $name,
            'jalan' => $this->faker->sentence(2),
            'kab_kota' => $this->faker->city(),
            'kecamatan' => $this->faker->word(),
            'kelurahan' => $this->faker->word(),
            // 'user_kategori' => $this->faker->word(),
            'remember_token' => Str::random(10),
        ];
    }
}
