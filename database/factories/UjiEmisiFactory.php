<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UjiEmisi>
 */
class UjiEmisiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // public function definition(): array
    // {
    //     return [
    //         'kendaraan_id' => $this->faker->unique()->numberBetween(1,10),
    //         'user_id' => $this->faker->numberBetween(1,10),
    //         'odometer' => $this->faker->numberBetween(1,20),
    //         'co' => $this->faker->numberBetween(1,10),
    //         'hc' => $this->faker->numberBetween(1,10),
    //         'opasitas' => $this->faker->numberBetween(2009, 2023),
    //         'co2' => $this->faker->numberBetween(1,10),
    //         'co_koreksi' =>$this->faker->numberBetween(1,10),
    //         'o2' => $this->faker->numberBetween(1,10),
    //         'putaran' => $this->faker->numberBetween(1,10),
    //         'temperatur' => $this->faker->numberBetween(1,10),
    //         'lambda' => $this->faker->numberBetween(1,10),
    //         'tanggal_uji' => $this->faker->dateTimeThisDecade(),
    //     ];
    // }

    public function definition(): array
    {
        static $kendaraanId = 1;
        $prefix_certificate = '00';
        $number_from_one = 1;


        return [
            'kendaraan_id' => $kendaraanId++,
            'user_id' => $this->faker->numberBetween(1, 10),
            'odometer' => $this->faker->numberBetween(10000, 1000000),
            'co' => $this->faker->randomFloat(2, 1, 10),
            'hc' => $this->faker->randomFloat(0, 100, 2000),
            'opasitas' => $this->faker->randomFloat(2, 1, 100),
            'co2' => $this->faker->randomFloat(2, 1, 10),
            'co_koreksi' => $this->faker->randomFloat(2, 1, 10),
            'o2' => $this->faker->randomFloat(2, 1, 10),
            'putaran' => $this->faker->randomFloat(2, 1, 10),
            'temperatur' => $this->faker->randomFloat(2, 1, 10),
            'lambda' => $this->faker->randomFloat(2, 1, 10),
            'tanggal_uji' => $this->faker->dateTimeThisDecade()->format('Y/m/d'), // Format tanggal sesuai yang diinginkan
            'no_sertifikat' => $this->faker->regexify('^[A-Z]{1,2}\d{6}'),
        ];
    }

}
