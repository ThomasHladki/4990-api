<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResidencyPositionApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'residency_position_id',
        'message'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
