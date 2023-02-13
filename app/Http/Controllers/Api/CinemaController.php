<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    public function index()
    {
        // Активные залы
        $activeHalls = Hall::query()
            ->where('available', true)
            ->get(['id']);

        // Все сеансы от текущей даты
        $sessions = Session::query()
            ->whereDate('date', '>=', new Carbon(now()))
            ->get();

        // Получаем сеансы только активных залов и группируем по фильмам
        $sessions = $sessions->filter(
            function ($value, $key) use ($activeHalls) {
                return $activeHalls->contains('id', $value->hall_id);
            }
        )
            ->flatten()
            ->sortBy('date')
            ->groupBy('movie_id')
            ->sortDesc();

        // Фильмы для которых есть активные сеансы
        $movies = Movie::query()->whereIn('id', $sessions->keys()->toArray())->get();

        $key = collect(['movies', 'sessions']);
        $responseData = $key->combine([$movies, $sessions]);

        return response($responseData);
//        return response($activeHalls);
    }
}
