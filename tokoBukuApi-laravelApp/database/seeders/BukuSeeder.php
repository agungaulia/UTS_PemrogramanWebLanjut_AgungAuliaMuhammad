<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            Buku::create([
                'judul' => $faker->sentence(3),
                'penulis' => $faker->name,
                'penerbit' => $faker->company,
                'tahun_terbit' => $faker->year,
                'stok' => $faker->numberBetween(1, 50),
                'cover' => 'https://loremflickr.com/320/480/bookcover?random=' . $i,
            ]);
        }
    }
}
