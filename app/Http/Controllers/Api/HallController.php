<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hall\CreateHallRequest;
use App\Http\Requests\Hall\UpdateHallRequest;
use App\Http\Resources\Hall\HallCollection;
use App\Http\Resources\Hall\HallResource;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{

    public function index()
    {
        $halls = Hall::query()->get();
        return new HallCollection($halls);
//        return response()->json($halls, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHallRequest $request)
    {
        $validated = $request->validated();

// :FIXME Меняем priceVip на price_vip, чтобы добавить в таблицу (Может можно как-то проще это сделать)
        $validated = $request->safe()->merge(['price_vip' => $validated['priceVip']]);
        unset($validated['priceVip']);

        Hall::class::create($validated->all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Hall $hall
     * //     * @return \Illuminate\Http\Response
     */
    public function show(Hall $hall)
    {
        return new HallResource($hall);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Hall $hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
//        $validated = $request->validated();
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Hall $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        $hall->delete();
    }
}
