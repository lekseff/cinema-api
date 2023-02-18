<?php

namespace App\Http\Requests\Hall;

use Illuminate\Foundation\Http\FormRequest;

class CreateHallRequest extends FormRequest
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
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name' => 'Зал с таким именем уже существует',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        //        :FIXME: Поправить json валидацию для structure
        return [
            'name' => ['required', 'string', 'unique:halls', 'max:50'],
            'rows' => ['required', 'integer', 'min:1', 'max:50'],
            'places' => ['required', 'integer', 'min:1', 'max:50'],
            'price' => ['required', 'integer', 'min:1', 'max:10000'],
            'available' => ['boolean'],
            'priceVip' => ['required', 'integer', 'min:1', 'max:10000'],
            'structure' => ['required']
        ];
    }
}
