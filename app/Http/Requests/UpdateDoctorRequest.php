<?php
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $id
 * @property string|null $name
 * @property Date|null $dob
 * @property string|null $gender
 * @property int|null $medical_institution_id
 * @property string|null $medical_discipline
 */
class UpdateDoctorRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(){
        return [
            'id' => ['required'],
            'name' => ['sometimes'],
            'dob' => ['sometimes'],
            'gender' => ['sometimes'],
            'medical_institution_id' => ['sometimes'],
            'medical_discipline' => ['sometimes'],
        ];
    }
}