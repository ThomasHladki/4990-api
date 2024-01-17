<?php

use Illuminate\Foundation\Http\FormRequest;

/** 
 * 
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
            '' => ['required'],
        ];
    }
}