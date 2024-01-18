<?php
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property Date $dob
 * @property string $gender
 * @property int $medical_institution_id
 * @property string $medical_discipline
 */
class CreateDoctorRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(){
        return [
            'name' => ['required'],
            'dob' => ['required'],
            'gender' => ['required'],
            'medical_institution_id' => ['required'],
            'medical_discipline' => ['required'],
        ];
    }
}