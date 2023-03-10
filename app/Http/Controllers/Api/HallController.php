<?php

namespace App\Http\Controllers\Api;

use App\Models\Hall;
use App\Http\Controllers\Controller;
use App\Http\Resources\Hall\HallResource;
use App\Http\Resources\Hall\HallCollection;
use App\Http\Requests\Hall\CreateHallRequest;
use App\Http\Requests\Hall\UpdateHallRequest;

class HallController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show']]);
    }

    public function index(): HallCollection
    {
        $halls = Hall::query()->get();
        return new HallCollection($halls);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateHallRequest $request
     * @return void
     */
    public function store(CreateHallRequest $request): void
    {
        $validated = $request->validated();

// :FIXME Меняем priceVip на price_vip, чтобы добавить в таблицу
        $validated = $request->safe()->merge(['price_vip' => $validated['priceVip']]);
        unset($validated['priceVip']);

        Hall::class::create($validated->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Hall $hall
     * @return HallResource
     */
    public function show(Hall $hall): HallResource
    {
        return new HallResource($hall);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHallRequest $request
     * @param Hall $hall
     * @return void
     */
    public function update(UpdateHallRequest $request, Hall $hall): void
    {
        $validated = $request->validated();

        // :FIXME Меняем priceVip на price_vip, чтобы добавить в таблицу
        if (isset($validated['priceVip'])) {
            $validated = $request->safe()->merge(['price_vip' => $validated['priceVip']]);
            unset($validated['priceVip']);

            $hall->update($validated->all());
        } else {
            $hall->update($validated);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hall $hall
     * @return void
     */
    public function destroy(Hall $hall): void
    {
        $hall->delete();
    }
}
