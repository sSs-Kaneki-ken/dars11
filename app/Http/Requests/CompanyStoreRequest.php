<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'phone' => 'required|max:14',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Заполните это поля',
            'name.max' => 'Превышен лимит',
            'phone.required' => 'Заполните это поля',
            'phone.max' => 'Превышен лимит',
            'user_id.required' => 'Заполните это поля',
            'user_id.exists' => 'Такого пользователя не существует'
        ];
    }
}
