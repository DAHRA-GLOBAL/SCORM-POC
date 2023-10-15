<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScormRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'scorm_package' => 'required|file|mimes:zip|max:20480', // Example: Accepts zip files up to 20MB
            // Add more rules as needed
        ];
    }
}
