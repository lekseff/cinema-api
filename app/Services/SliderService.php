<?php

namespace App\Services;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function create($params)
    {
        $slide = Slider::class::create($params);

        $photoPath = Storage::disk('public')->putFile('images/slider', $params['photo']);

        $slide->update([
            'photo' => $photoPath
        ]);

        return $slide;
    }
}
