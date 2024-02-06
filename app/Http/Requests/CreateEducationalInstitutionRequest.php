<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $medical_school_name
 * @property string $street_address
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $email_domain
 */

class CreateEducationalInstitutionRequest extends FormRequest
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
            'medical_school_name' => ['required'],
            'street_address' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'postal_code' => ['required'],
            'email_domain' => ['required']
        ];
    }
}
