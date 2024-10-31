<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|max:255',
            'comp_id' => 'required|exists:companies,id',
            'image' => 'required|file|mimes:png,jpg,jpeg',
            'price' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Заполните это поля',
            'name.max' => 'Превышен лимит',
            'comp_id.required' => 'Заполните это поля',
            'comp_id.exists' => 'Такой компании не существует',
            'image.required' => 'Заполните это поля',
            'image.mimes' => 'Не верный формат (jpg, jpeg, png)',
            'price.required' => 'Заполните это поля'
        ];
    }
}
