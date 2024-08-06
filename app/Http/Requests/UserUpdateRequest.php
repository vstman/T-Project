<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Change this based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:50|unique:users,email,',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'email.required' => 'E-posta alanı gereklidir.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.max' => 'E-posta adresi 50 karakterden uzun olmamalıdır.',
            'email.unique' => 'Bu e-posta adresi zaten kullanılıyor.',
            'role_id.required' => 'Rol seçimi gereklidir.',
            'role_id.exists' => 'Seçilen rol geçerli değil.',
        ];
    }
}
