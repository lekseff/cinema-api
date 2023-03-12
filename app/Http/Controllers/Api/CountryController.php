<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\Country\CountryResource;
use App\Http\Resources\Country\CountryCollection;
use App\Http\Requests\Country\CreateCountryRequest;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show']]);
    }

    public function index(): CountryCollection
    {
        $countries = Country::all(['id', 'name'])->sortBy('name');

        // Получаем 5 случайныйх стран - для примера
//        $country = $data->random(3)->pluck('name');
        return new CountryCollection($countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCountryRequest $request
     * @return CountryResource
     */
    public function store(CreateCountryRequest $request): CountryResource
    {
        $validated = $request->validated();
        $country = Country::class::create($validated);
        return new CountryResource($country);
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country
     * @return Response
     */
    public function show(Country $country): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Country $country
     * @return Response
     */
    public function update(Request $request, Country $country): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     * @return void
     */
    public function destroy(Country $country): void
    {
        $country->delete();
    }
}
