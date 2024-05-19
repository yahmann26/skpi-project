<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => fake()->nim()->unique(),
            'nama_mahasiswa' => fake(),
            'tempat_lahir' => fake()->text(),
            'tgl_lahir' => now(),
            'jenis_kelamin' => fake()->text('L' or 'p'),
            'prodi_id' => '1',
            'tgl_masuk' => now(),
            'tgl_lulus' => now(),

        ];
    }
}
