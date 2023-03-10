<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Country::factory()->createMany([
            ['name' => 'США'],
            ['name' => 'Индия'],
            ['name' => 'Россия'],
            ['name' => 'Канада'],
            ['name' => 'Франция'],
            ['name' => 'Новая Зеландия'],
            ['name' => 'Великобритания'],
        ]);
    }
}
