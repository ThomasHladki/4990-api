<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResidencyPositionRequest extends FormRequest
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
            'id' => ['required'], 
            'name' => ['sometimes'],  
            'description' => ['sometimes'], 
            'medical_discipline' => ['sometimes'], 
            'medical_institution_id' => ['sometimes'], 
            'grade_avg_requirement' => ['sometimes'], 
            'letter_of_reccomendation_req' => ['sometimes'], 
            'research_focused' => ['sometimes'],
            'prefers_new_grads' => ['sometimes'],
        ];
    }
}
