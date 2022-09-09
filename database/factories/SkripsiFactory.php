<?php

namespace Database\Factories;

use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skripsi>
 */
class SkripsiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'nim' => fake()->uuid(),
            'tahun_ajaran_id' => TahunAjaran::factory()->create()->id,
            'judul' => fake()->text(),
            'pembimbing1' => fake()->name(),
            'pembimbing2' => fake()->name(),
            'no_pembayaran' => fake()->uuid(),
            'file_skripsi' => null,
        ];
    }
}
