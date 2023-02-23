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
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Сообщения об ошибке
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name' => 'Фильм с таким названием уже существует'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:movies', 'max:250'],
            'directors' => ['required', 'string', 'max:250'],
            'actors' => ['required', 'string', 'max:250'],
            'countries' => ['required', 'array'],
            'genres' => ['required', 'array'],
            'ageCategory' => ['required', 'exists:age_categories,id'],
            'plot' => ['required', 'string', 'max:4000'],
            'timeline' => ['required', 'integer', 'min:1', 'max:500'],
            'logo' => ['required', 'file', 'image', 'max:2048'],
            'logoMobile' => ['required', 'file', 'image', 'max:1024'],
        ];
    }
}
