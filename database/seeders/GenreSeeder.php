<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Genre::factory()->createMany([
            ['name' => 'Комедия'],
            ['name' => 'Фантастика'],
            ['name' => 'Драма'],
            ['name' => 'Ужасы'],
            ['name' => 'Боевик'],
            ['name' => 'Мелодрама'],
            ['name' => 'Приключения'],
            ['name' => 'Семейный'],
            ['name' => 'Триллер'],
            ['name' => 'Детектив'],
        ]);
    }
}
