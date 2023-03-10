<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\SliderService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Slider\SliderResource;
use App\Http\Requests\Slider\CreateSliderRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $slides = Slider::query()->get();
        return SliderResource::collection($slides);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSliderRequest $request
     * @param SliderService $service
     * @return Response
     */
    public function store(CreateSliderRequest $request, SliderService $service): Response
    {
        $validated = $request->validated();
        $slide = $service->create($validated);
        return response($slide, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Slider $slider
     * @return Response
     */
    public function show(Slider $slider): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Slider $slider
     * @return Response
     */
    public function update(Request $request, Slider $slider): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return void
     */
    public function destroy(Slider $slider): void
    {
        $slider->delete();
    }
}
