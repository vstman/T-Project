<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Bu örnekte, kullanıcıya bu isteği yapma yetkisi veriliyor
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users,email',
            'password' => 'required|string',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    /**
     * Customize the error messages for the request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.required' => 'İsim alanı gereklidir.',
            'name.string' => 'İsim geçerli bir metin olmalıdır.',
            'name.max' => 'İsim 50 karakterden uzun olmamalıdır.',
            'email.required' => 'E-posta adresi gereklidir.',
            'email.email' => 'Geçerli bir e-posta adresi girin.',
            'email.max' => 'E-posta adresi 50 karakterden uzun olmamalıdır.',
            'email.unique' => 'Bu e-posta adresi zaten kayıtlı.',
            'password.required' => 'Şifre alanı gereklidir.',
            'password.string' => 'Şifre geçerli bir metin olmalıdır.',
            'password.min' => 'Şifre en az 8 karakter olmalıdır.',
            'password.confirmed' => 'Şifre onayı hatalı.',
            'role_id.required' => 'Rol seçimi gereklidir.',
            'role_id.exists' => 'Seçilen rol geçerli değil.',
        ];
    }
}
