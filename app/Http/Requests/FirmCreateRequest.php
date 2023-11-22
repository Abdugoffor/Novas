<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FirmCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'prone1' => 'required',
            'prone2' => 'required',
            'long' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя',
            'phone1.required' => 'Введите телефон 1',
            'phone2.required' => 'Введите телефон 2',
            'balans.required' => 'Введите Баланис',
        ];
    }

}
