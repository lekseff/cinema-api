<?php

namespace App\Http\Resources\Hall;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $rows
 * @property mixed $places
 * @property mixed $available
 * @property mixed $price
 * @property mixed $price_vip
 * @property mixed $structure
 */
class HallResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'rows' => $this->rows,
            'places' => $this->places,
            'available' => boolval($this->available),
            'price' => $this->price,
            'price_vip' => $this->price_vip,
            'structure' => $this->structure,
        ];
    }
}
