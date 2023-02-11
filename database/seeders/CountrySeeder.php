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
    public function run()
    {
//        Country::factory(10)->create()->unique();
        foreach (Country::$countries as $country) {
            Country::factory()->create(
                ['name' => $country]
            );
        }

    }
}
