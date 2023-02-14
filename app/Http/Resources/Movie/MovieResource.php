<?php

namespace App\Http\Resources\Movie;

use App\Models\AgeCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $plot
 * @property mixed $logo
 * @property mixed $actors
 * @property mixed $timeline
 * @property mixed $age_category
 * @property mixed $countries
 */
class MovieResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {

//  :FIXME: Посмотреть как можно получать данные стран без цикла
        $countries = [];
        foreach ($this->countries as $country)
        {
           $countries[] = $country->name;
        }

        $genres = [];
        foreach ($this->genres as $genre)
        {
            $genres[] = $genre->name;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'directors' => $this->directors,
            'ageCategory' => AgeCategory::class::find($this->age_category)->name,
            'countries' => $countries,
            'genres' => $genres,
            'plot' => $this->plot,
            'actors' => $this->actors,
            'timeline' => $this->timeline,
            'logo' => $this->logo
        ];
    }

}
