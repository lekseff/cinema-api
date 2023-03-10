<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\MovieService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Movie\MovieResource;
use App\Http\Resources\Movie\MovieCollection;
use App\Http\Requests\Movie\CreateMovieRequest;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return MovieCollection
     */
    public function index(): MovieCollection
    {
        $movie = Movie::class::all();
        return new MovieCollection($movie);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateMovieRequest $request
     * @param MovieService $service
     * @return Response
     */
    public function store(CreateMovieRequest $request, MovieService $service): Response
    {
        $validated = $request->validated();
        $movie = $service->create($validated);
        return response($movie);
    }

    /**
     * Display the specified resource.
     *
     * @param Movie $movie
     * @return MovieResource
     */
    public function show(Movie $movie): MovieResource
    {
        return new MovieResource($movie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return void
     */
    public function destroy(Movie $movie): void
    {
        $movie->delete();
    }
}
