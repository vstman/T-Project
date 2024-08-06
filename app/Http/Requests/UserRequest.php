<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Bu örnekte, tüm kullanıcıların bu isteği yapmasına izin veriyoruz.
        // Eğer kullanıcı yetkilendirmesi eklemek isterseniz, burada kontrol yapabilirsiniz.
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user,
            'password' => 'string|min:8|confirmed', 
            'roles' => 'nullable|array', 
            'roles.*' => 'exists:roles,id', 
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
            'name.required' => 'İsim gereklidir.',
            'email.required' => 'E-posta adresi gereklidir.',
            'email.email' => 'Geçerli bir e-posta adresi girin.',
            'email.unique' => 'Bu e-posta adresi zaten kayıtlı.',
            'password.min' => 'Şifre en az 8 karakter olmalıdır.',
            'password.confirmed' => 'Şifre onayı hatalı.',
            'roles.array' => 'Roller dizisi geçerli değil.',
            'roles.*.exists' => 'Seçilen roller geçerli değil.',
        ];
    }
}
