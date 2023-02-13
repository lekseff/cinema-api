<?php

namespace Database\Seeders;

use App\Models\Hall;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hall::factory()->create([
            'name' => 'Зал 1',
            'rows' => 10,
            'places' => 15,
            'available' => true,
            'price' => 250,
            'price_vip' => 350,
            'structure' => '{"name": 123}'
        ]);
    }
}
