<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'max:255',
            'comp_id' => 'required|exists:companies,id',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'Превышен лимит',
            'comp_id.required' => 'Заполните это поля',
            'comp_id.exists' => 'Такой компании не существует',
            'price.integer' => 'Значение слишком большое'
        ];
    }
}
