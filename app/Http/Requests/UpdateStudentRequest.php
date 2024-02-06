<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int|null $id
 * @property string|null $name
 * @property \DateTime|null $dob
 * @property string|null $gender
 * @property int|null $graduation_year
 * @property int|null $educational_institution_id
 * @property string|null $medical_discipline
 * @property bool|null $prefers_research 
 * @property bool|null $has_letter_of_req
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
            'has_letter_of_req' => ['sometimes'],
        ];
    }
}
