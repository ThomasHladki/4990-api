<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $student_id
 * @property string $course_code
 * @property int $grade
 */

class StudentGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_code',
        'grade'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
