<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone1' => 'required',
            'phone2' => 'required',
            'balans' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя клиента',
            'phone1.required' => 'Введите телефон 1',
            'phone2.required' => 'Введите телефон 2',
            'balans.required' => 'Введите Баланис',
        ];
    }
}
