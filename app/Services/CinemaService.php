<?php

namespace App\Services;

use App\Http\Resources\Movie\MovieResource;
use App\Http\Resources\Session\SessionResource;
use App\Http\Resources\Slider\SliderResource;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CinemaService
{
    /**
     * Основные данные для главной страницы сайта
     * @return array
     */
    public function getData(): array
    {
        // Фильтр по дням
        $sessionsControl = $this->getDays();

        // Получаем элементы слайдера
        $slides = Slider::query()->get();

        // id активных залов
        $activeHalls = Hall::query()
            ->where('available', true)
            ->get(['id']);

        // Все сеансы от текущей даты
        $sessions = $this->getSessions($activeHalls);

        // Фильмы для которых есть активные сеансы
        $movies = Movie::query()->whereIn('id', $sessions->groupBy('movie_id')->keys()->toArray())->get();

        return [
            'movies' => MovieResource::collection($movies),
            'slider' => SliderResource::collection($slides),
            'sessions' => SessionResource::collection($sessions)->groupBy('movie_id'),
            'dates' => $sessionsControl,
        ];
    }

    /**
     * Формирует список дат для фильтра
     * @param $count - кол-во дней
     * @return array
     */
    public function getDays(int $count = 5): array
    {
        // Фильтр по дням
        $sessionsControl = [];
        for ($i = 0; $i < $count; ++$i) {
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
        return $sessionsControl;
    }

    /**
     * Получает активные сеансы от текущей даты
     * @param Collection $activeHallsId
     * @return Collection
     */
    public function getSessions(Collection $activeHallsId): Collection
    {
        // Все сеансы от текущей даты
        $sessions = Session::query()
            ->whereDate('date', '>=', new Carbon(now()))
            ->get(['id', 'movie_id', 'hall_id', 'date']);

        // Получаем сеансы только активных залов и группируем по фильмам
        return $sessions
            ->filter(
                function ($value, $key) use ($activeHallsId) {
                    return $activeHallsId->contains('id', $value->hall_id);
                }
            )
            ->sortBy('date');
    }
}
