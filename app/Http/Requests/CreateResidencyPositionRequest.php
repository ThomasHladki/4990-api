<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateResidencyPositionRequest extends FormRequest
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
            'name' => ['required'], 
            'description' => ['required'], 
            'medical_discipline' => ['required'], 
            'doctor_id' => ['required'], 
            'medical_institution_id' => ['required'], 
            'grade_avg_requirement' => ['sometimes'], 
            'letter_of_reccomendation_req' => ['required'], 
            'research_focused' => ['required'], 
            'prefers_new_grads' => ['required'], 
        ];
    }
}
