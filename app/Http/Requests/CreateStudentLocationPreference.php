<?php
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $student_id
 * @property bool $has_preference
 * @property string|null $preffered_province
 * @property string|null $preferred_city
 */

class CreateStudentLocationPreference extends FormRequest{

     /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(){
        return [
            'student_id' => ['required'],
            'has_preference' => ['sometimes'],
            'prefered_province' => ['sometimes'],
            'preferred_city' => ['sometimes'] 
        ];
    }



}