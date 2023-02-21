<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:movies', 'max:250'],
            'directors' => ['required', 'string', 'max:250'],
            'actors' =>  ['required', 'string', 'max:250'],
            'countries' => ['required', 'exists:countries,id'],
            'genres' => ['required', 'exists:genres,id'],
            'ageCategory' => ['required', 'exists:age_categories,id'],
            'plot' => ['required', 'string', 'max:4000'],
            'timeline' => ['required', 'integer', 'min:1', 'max:500'],
            'logo' => [],
            'logoMobile' => [],
        ];
    }
}
