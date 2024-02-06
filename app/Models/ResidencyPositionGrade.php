<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $residency_position_id
 * @property string $course_code  
 */

class ResidencyPositionGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'residency_position_id',
        'course_code',
    ];

    public function residencyPosition(): BelongsTo
    {
        return $this->belongsTo(ResidencyPosition::class);
    }
}
