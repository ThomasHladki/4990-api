<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentGradeRequest extends FormRequest{
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
            'course_code' => ['required'],
            'grade' => ['required']
        ];
    }
}