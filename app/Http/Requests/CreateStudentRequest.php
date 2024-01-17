<?php

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $id
 * @property string $name
 * @property \DateTime $dob
 * @property string $gender
 * @property int $graduation_year
 * @property int $educational_institution_id
 * @property string $medical_discipline
 * @property bool $prefers_research 
 */

class CreateStudentRequest extends FormRequest{
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
            'graduation_year' => ['required'],
            'educational_institution_id' => ['required'],
            'medical_discipline' => ['required'],
            'prefers_research' => ['required'],
        ];
    }
}