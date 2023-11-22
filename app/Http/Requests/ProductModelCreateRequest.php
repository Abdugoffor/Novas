<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductModelCreateRequest extends FormRequest
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
            'name_size' => 'required',
            'size' => 'required',
            'imgs.*' => 'mimes:jpg,png,jpeg|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'name_size.required' => 'Введите имя',
            'size.required' => 'Введите размер',
            'imgs.mimes' => 'Изображение должно быть в формате jpg или png',
            'imgs.max' => 'Размер изображения должен быть меньше 2 МБ.',
        ];
    }
}
