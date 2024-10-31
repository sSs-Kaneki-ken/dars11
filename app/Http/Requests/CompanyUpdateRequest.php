<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'max:255',
            'phone' => 'max:14',
            'user_id' => 'required|exists:users,id',
        ];
        
    }
    public function messages()
    {
        return [
            'name.max' => 'Превышен лимит в Название',
            'phone.max' => 'Превышен лимит',
            'user_id.required' => 'Заполните это поля',
            'user_id.exists' => 'Такого пользователя не существует'
        ];
    }
}
