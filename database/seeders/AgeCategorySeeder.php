<?php

namespace Database\Seeders;

use App\Models\AgeCategory;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        AgeCategory::factory()->createMany([
            ['name' => '0+'],
            ['name' => '6+'],
            ['name' => '12+'],
            ['name' => '16+'],
            ['name' => '18+'],
        ]);
    }
}
