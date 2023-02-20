<?php

namespace App\Http\Resources\AgeCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AgeCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            $this->collection
        ];
    }
}
