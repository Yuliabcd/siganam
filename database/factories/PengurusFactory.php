<?php

namespace Database\Factories;

use App\Models\Pengurus;
use App\Models\Posisi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PengurusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pengurus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jenis_kelamin = $this->faker->randomElement(['l', 'p']);
        $nama = $this->faker->name($jenis_kelamin === 'l' ? 'male' : 'female');

        return [
            'posisi_id' => Posisi::inRandomOrder()->first()->id,
            'nama' =>  $nama,
            'nama_panggilan' => Str::words($nama, 1, ''),
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->numerify('+628##########'),
            'email' => $this->faker->email(),
        ];
    }
}
