<?php

namespace App\Http\Requests;

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

 class UpdateStudentRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(){
        return [
            'id' =>  ['required'],
            'name' => ['sometimes'],
            'dob' => ['sometimes'],
            'gender' =>  ['sometimes'],
            'graduation_year' =>  ['sometimes'],
            'educational_institution_id' => ['sometimes'],
            'medical_discipline' => ['sometimes'],
            'prefers_research' => ['sometimes'],
        ];
    }
}
