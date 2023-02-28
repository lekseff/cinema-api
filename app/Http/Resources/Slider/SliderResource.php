<?php

namespace App\Http\Resources\Slider;

use App\Models\Movie;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $movie
 * @property mixed $photo
 */
class SliderResource extends JsonResource
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
            'movie' => $this->movie,
            'name' => Movie::class::find($this->movie)->name,
            'photo' => url('/storage/' . $this->photo)
        ];
    }
}
