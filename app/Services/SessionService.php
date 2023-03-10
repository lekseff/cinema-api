<?php

namespace App\Services;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use Illuminate\Support\Carbon;

class SessionService
{
    /**
     * Создает сеанс
     * @param $params - данные для создания сеанса
     * @return Session
     */
    public function create($params): Session
    {
        // Создаем объект даты
        $date = new Carbon($params['date'] . $params['time']);

        // Получаем структуру мест
        $places = Hall::class::find($params['hallId'], 'structure');

        $data = [
            'movie_id' => $params['movieId'],
            'hall_id' => $params['hallId'],
            'date' => $date,
            'places' => $places['structure'],
        ];

        return Session::class::create($data);
    }

    /**
     * Возвращает сеансы в формате для timeline админки
     * @return array
     */
    public function sessionsFromTimeline(): array
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

        // Сортируем и группируем по дате
        $collection = collect($data)->sortBy('date')->groupBy('calendarDate');

        // Группируем до залам внутри дат
        $response = [];
        foreach ($collection as $key => $item) {
            $response[$key] = collect($item)->sortByDesc('hall')->groupBy('hallId');
        }

        return $response;
    }
}
