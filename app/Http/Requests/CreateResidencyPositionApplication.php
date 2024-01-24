<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $student_id
 * @property int $residency_position_id
 * @property string $message
 */

class CreateResidencyPositionApplication extends FormRequest{
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
            'residency_position_id' => ['required'],
            'message' => ['required']
        ];
    }
}