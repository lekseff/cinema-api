<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age_category' => AgeCategory::class::find($this->age_category)->name,
            'plot' => $this->plot,
            'actors' => $this->actors,
            'timeline' => $this->timeline,
            'logo' => $this->logo
        ];
    }

}
