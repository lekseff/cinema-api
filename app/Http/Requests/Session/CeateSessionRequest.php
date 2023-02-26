<?php

namespace App\Http\Requests\Session;

use Illuminate\Foundation\Http\FormRequest;

class CeateSessionRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'movieId' => ['required', 'integer', 'exists:movies,id'],
            'hallId' => ['required', 'integer', 'exists:halls,id'],
            'date' => ['required', 'string'],
            'time' => ['required', 'string'],
        ];
    }
}
