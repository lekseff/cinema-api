<?php

namespace App\Http\Resources\Session;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $date
 * @property mixed $hall_id
 * @property mixed $movie_id
 */
class SessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'hallId' => $this->hall_id,
            'movieId' => $this->movie_id,
            'date' => $this->date,
            'time' => $this->date->format('H:i'),
            'calendarDate' => $this->date->format('Y-m-d'),
            'isAvailable' => new Carbon($this->date) > now()
        ];
    }
}
