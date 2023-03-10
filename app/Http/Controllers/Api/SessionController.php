<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Session\CeateSessionRequest;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;


class SessionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $sessions = Session::query()->get();

        return response($sessions, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CeateSessionRequest $request
     * @return Response
     */
    public function store(CeateSessionRequest $request): Response
    {
        $validated = $request->validated();

        // Создаем объект даты
        $date = new Carbon($validated['date'] . $validated['time']);

        $places = Hall::class::find($validated['hallId'], 'structure');

        $data = [
            'movie_id' => $validated['movieId'],
            'hall_id' => $validated['hallId'],
            'date' => $date,
            'places' => $places['structure'],
        ];

        $session = Session::query()->create($data);

        return response($session, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Session $session
     * @return Response
     */
    public function show(Session $session): Response
    {
        return response($session->toArray(), 200);
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
     * @param Session $session
     * @return void
     */
    public function destroy(Session $session): void
    {
        $session->delete();
    }

    /**
     * Получает все сеансы и в формате для timeline админки
     * @return Response
     */
    public function timetable(): Response
    {
        $sessions = Session::query()->get(['id', 'movie_id', 'hall_id', 'date']);

// Формируем структуру для ответа
        $data = [];
        foreach ($sessions as $session) {
            $data[] = [
                'id' => $session['id'],
                'hallId' => $session['hall_id'],
                'movieName' => Movie::class::find($session['movie_id'])->name,
                'hallName' => Hall::class::find($session['hall_id'])->name,
                'date' => $session['date'],
                'time' => $session['date']->format('H:i'),
                'calendarDate' => $session['date']->format('Y-m-d'),
            ];
        }

//  Сортируем и группируем по дате
        $collection = collect($data)->sortBy('date')->groupBy('calendarDate');

//  Группируем до залам внутри дат
        $response = [];
        foreach ($collection as $key => $item) {
            $response[$key] = collect($item)->sortByDesc('hall')->groupBy('hallId');//
        }

        return response($response, 200);
    }
}
