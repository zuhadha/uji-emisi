<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kendaraan>
 */
class KendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehicle_types = ['Motor' => ['Vario', 'Beat'], 'Mobil' => ['Rush', 'Avanza']];
    
        $vehicle_type = $this->faker->randomElement(array_keys($vehicle_types));
        $model = $this->faker->randomElement($vehicle_types[$vehicle_type]);
        static $ujiemisi_counter=1;
    


        return [
            'nopol' => $this->faker->regexify('^[A-Z]{1,2} \d{4} [A-Z]{1,3}$'),
            'ujiemisi_id' => $ujiemisi_counter++,
            'user_id' => $this->faker->numberBetween(1,10),
            'merk' => $this->faker->randomElement(['Toyota', 'Honda', 'Suzuki', 'Mitsubishi', 'Daihatsu']),
            'tipe' => $model,
            'cc' => $this->faker->regexify('^1[1256][05]$'),
            'tahun' => $this->faker->numberBetween(2009, 2023),
            'no_rangka' => $this->faker->shuffle('1234567890129870'),
            'no_mesin' => $this->faker->shuffle('1234567890129870'),
            'bahan_bakar' => $this->faker->randomElement(['Solar', 'Bensin', 'Gas']),
        ];
    }
    
}
