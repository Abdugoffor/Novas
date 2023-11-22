<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StafRequest extends FormRequest
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
            'phone' => 'required',
            'adres' => 'required',
            'img' => 'required|mimes:jpg,png,jpeg',
            'file' => 'required|mimes:pdf,doc,docx',
            'working_time' => 'required',
            'department_id' => 'required',
            'salary__type_id' => 'required',
            'sum' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя',
            'phone.required' => 'Введите телефон',
            'adres.required' => 'Введите адрес',
            'img.required' => 'Введите изображение',
            'file.required' => 'Введите файл',
            'working_time.required' => 'Введите рабочее время',
            'department_id.required' => 'Введите отделение',
            'salary__type_id.required' => 'Введите тип зарплаты',
            'sum.required' => 'Введите сумма',
        ];
    }
}
