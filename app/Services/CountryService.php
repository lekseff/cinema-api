<?php

namespace App\Services;

use App\Models\Country;

class CountryService
{

    public function create($params): Country
    {
        return Country::class::create([
            'name' => $params['name']
        ]);
    }
}
