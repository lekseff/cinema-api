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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::query()->get();

        return response($sessions, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CeateSessionRequest $request)
    {
        $validated = $request->validated();

        // Создаем объект даты
        $date = new Carbon($validated['date'] . $validated['time']);

        $places = Hall::class::find($validated['hallId'], 'structure');

//        dd($places['structure']);
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
    public function show(Session $session)
    {
        return response($session->toArray(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        $session->delete();
    }

    public function timetable()
    {

        $sessions = Session::query()->get(['id', 'movie_id', 'hall_id', 'date']);

// Формируем структуру для ответа
        $data = [];
        foreach ($sessions as $session) {
            $data[] = [
                'id' => $session['id'],
                'hallId' => $session['hall_id'],
                'movieName' => Movie::find($session['movie_id'])->name,
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

        return response($response);
    }
}
