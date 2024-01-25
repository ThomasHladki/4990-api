<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $student_id
 * @property bool $has_preference
 * @property string|null $preffered_province
 * @property string|null $preferred_city
 */
class StudentLocationPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'has_preference',
        'preferred_province',
        'preferred_city'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
