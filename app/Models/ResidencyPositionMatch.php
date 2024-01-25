<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResidencyPositionMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'residency_position_id',
        'match_score'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function ResidencyPosition(): BelongsTo
    {
        return $this->belongsTo(ResidencyPosition::class);
    }
}
