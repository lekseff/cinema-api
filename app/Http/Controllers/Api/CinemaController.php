<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Movie\MovieCollection;
use App\Http\Resources\Movie\MovieResource;
use App\Http\Resources\Session\SessionResource;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CinemaController extends Controller
{
    public function index()
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
//            ->flatten()
            ->sortBy('date');
//            ->groupBy('movie_id')
//            ->sortDesc();

        // Фильмы для которых есть активные сеансы
        $movies = Movie::query()->whereIn('id', $sessions->groupBy('movie_id')->keys()->toArray())->get();

        return response([
            'movies' => MovieResource::collection($movies),
            'sessions' => SessionResource::collection($sessions)->groupBy('movie_id'),
            'dates' => $sessionsControl,
        ], 200);
    }
}
