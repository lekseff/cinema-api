<?php

namespace Database\Seeders;

use App\Models\AgeCategory;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (AgeCategory::$categories as $category) {
            AgeCategory::factory()->create(
                ['name' => $category]
            );
        }
    }
}
