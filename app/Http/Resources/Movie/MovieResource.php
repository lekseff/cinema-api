<?php

namespace App\Http\Resources\Movie;

use App\Http\Resources\Country\CountryResource;
use App\Http\Resources\Genre\GenreCollection;
use App\Http\Resources\Genre\GenreResource;
use App\Models\AgeCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $plot
 * @property mixed $logo
 * @property mixed $genres
 * @property mixed $actors
 * @property mixed $timeline
 * @property mixed $countries
 * @property mixed $directors
 * @property mixed $age_category
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

//  :FIXME: Посмотреть как можно получать genres и countries без id

//        $countries = [];
//        foreach ($this->countries as $country)
//        {
//           $countries[] = $country->name;
//        }

//        $genres = [];
//        foreach ($this->genres as $genre)
//        {
//            $genres[] = $genre->name;
//        }
//        :FIXME Поправить и добавить веде logoMobile
        return [
            'id' => $this->id,
            'name' => $this->name,
            'directors' => $this->directors,
            'actors' => $this->actors,
            'genres' => GenreResource::collection($this->genres),
            'countries' => CountryResource::collection($this->countries),
            'ageCategory' => AgeCategory::class::find($this->age_category)->name,
            'timeline' => $this->timeline,
            'plot' => $this->plot,
            'logo' => $this->logo,
            'logoMobile' => $this->logo
        ];
    }

}
