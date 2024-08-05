<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

     //@return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     
    public function rules(): array
    {
        return [
            'supporting_organization' => 'required|string|max:255',
            'project_title' => 'required|string|max:255',
            'project_code' => 'required|string|max:50',
            'duration' => 'required|integer',
            'budget' => 'required|numeric',
            'supervisor_name.*' => 'nullable|string|max:255',
            'supervisor_department.*' => 'nullable|string|max:255',
            'supervisor_photo.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'team_name.*' => 'nullable|string|max:255',
            'team_position.*' => 'nullable|string|max:255',
            'team_department.*' => 'nullable|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'supporting_organization.required' => 'Destekleyen kuruluş gereklidir.',
            'supporting_organization.string' => 'Destekleyen kuruluş bir metin olmalıdır.',
            'supporting_organization.max' => 'Destekleyen kuruluş en fazla :max karakter uzunluğunda olabilir.',
            'project_title.required' => 'Proje başlığı gereklidir.',
            'project_title.string' => 'Proje başlığı bir metin olmalıdır.',
            'project_title.max' => 'Proje başlığı en fazla :max karakter uzunluğunda olabilir.',
            'project_code.required' => 'Proje kodu gereklidir.',
            'project_code.string' => 'Proje kodu bir metin olmalıdır.',
            'project_code.max' => 'Proje kodu en fazla :max karakter uzunluğunda olabilir.',
            'duration.required' => 'Süre gereklidir.',
            'budget.required' => 'Bütçe gereklidir.',
            'budget.numeric' => 'Bütçe bir sayısal değer olmalıdır.',
            'supervisor_name.*.string' => 'Her bir süpervizör adı bir metin olmalıdır.',
            'supervisor_name.*.max' => 'Her bir süpervizör adı en fazla :max karakter uzunluğunda olabilir.',
            'supervisor_department.*.string' => 'Her bir süpervizör departmanı bir metin olmalıdır.',
            'supervisor_department.*.max' => 'Her bir süpervizör departmanı en fazla :max karakter uzunluğunda olabilir.',
            'supervisor_photo.*.image' => 'Her bir süpervizör fotoğrafı bir resim olmalıdır.',
            'supervisor_photo.*.mimes' => 'Her bir süpervizör fotoğrafı yalnızca :values uzantılarına sahip dosyalar olabilir.',
            'supervisor_photo.*.max' => 'Her bir süpervizör fotoğrafı en fazla :max kilobayt uzunluğunda olabilir.',
            'team_name.*.string' => 'Her bir takım adı bir metin olmalıdır.',
            'team_name.*.max' => 'Her bir takım adı en fazla :max karakter uzunluğunda olabilir.',
            'team_position.*.string' => 'Her bir takım pozisyonu bir metin olmalıdır.',
            'team_position.*.max' => 'Her bir takım pozisyonu en fazla :max karakter uzunluğunda olabilir.',
            'team_department.*.string' => 'Her bir takım departmanı bir metin olmalıdır.',
            'team_department.*.max' => 'Her bir takım departmanı en fazla :max karakter uzunluğunda olabilir.',
        ];
    }
}
