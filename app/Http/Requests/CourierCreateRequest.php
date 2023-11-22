<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourierCreateRequest extends FormRequest
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
            'staf_id' => 'required|exists:stafs,id',
            'phone' => 'required|numeric|digits:12',
            'car_number' => 'required|numeric',
            'telegram_id' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'staf_id.required' => 'Выберите сотрудника',
            'phone.required' => 'Введите телефон',
            'phone.numeric' => 'Телефон должен быть числовым',
            'phone.digits' => 'Номер телефона должен состоять из 12 цифр. 999 99 999 99 99',
            'car_number.required' => 'Введите номер машины',
            'car_number.numeric' => 'Номер машины должен быть числовым',
            'telegram_id.required' => 'Введите телеграмма_id',
            'telegram_id.numeric' => 'Телеграмма_id должен быть числовым',
        ];
    }
}
