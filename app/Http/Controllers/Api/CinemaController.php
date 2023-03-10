<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Slider;
use App\Models\Session;
use App\Http\Controllers\Controller;
use App\Http\Resources\Movie\MovieResource;
use App\Http\Resources\Slider\SliderResource;
use App\Http\Resources\Session\SessionResource;


class CinemaController extends Controller
{
    public function index(): \Illuminate\Http\Response
    {
        // Фильтр по дням
        $sessionsControl = [];
        for ($i = 0; $i < 5; ++$i) {
            $newDate = Carbon::now()->locale('ru')->addDay($i);
            $name = $newDate->isoFormat('D MMMM');  // формат '16 февраля'
            $day = $newDate->getTranslatedDayName('dddd');  // день недели
            $date = $newDate->format('Y-m-d');  // формат 2023-02-16
            $sessionsControl[] = [
                'name' => $name,
                'day' => $day,
                'date' => $date
            ];
        }

        // Получаем элементы слайдера
        $slides = Slider::query()->get();

        // Активные залы
        $activeHalls = Hall::query()
            ->where('available', true)
            ->get(['id']);

        // Все сеансы от текущей даты
        $sessions = Session::query()
            ->whereDate('date', '>=', new Carbon(now()))
            ->get(['id', 'movie_id', 'hall_id', 'date']);

//  :FIXME: Тут поправить комменты, если все ок
        // Получаем сеансы только активных залов и группируем по фильмам
        $sessions = $sessions->filter(
            function ($value, $key) use ($activeHalls) {
                return $activeHalls->contains('id', $value->hall_id);
            }
        )
            ->sortBy('date');

        // Фильмы для которых есть активные сеансы
        $movies = Movie::query()->whereIn('id', $sessions->groupBy('movie_id')->keys()->toArray())->get();

        return response([
            'movies' => MovieResource::collection($movies),
            'slider' => SliderResource::collection($slides),
            'sessions' => SessionResource::collection($sessions)->groupBy('movie_id'),
            'dates' => $sessionsControl,
        ], 200);
    }
}
