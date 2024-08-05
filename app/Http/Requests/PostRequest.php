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
}
