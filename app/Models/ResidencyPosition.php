<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string $status
 * @property string $medical_discipline
 * @property Doctor $doctor
 */

class ResidencyPosition extends Model
{
    use HasFactory;

    const STATUS_OPEN = 'OPEN';
    const STATUS_CLOSED = 'CLOSED';

    protected $fillable = [
        'name',
        'status',
        'description',
        'medical_discipline',
        'doctor_id',
        'medical_institution_id',
        'grade_avg_requirement',
        'letter_of_reccomendation_req',
        'research_focused',
        'prefers_new_grads',
        
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function residencyPositionGrade(): HasMany
    {
        return $this->hasMany(ResidencyPositionGrade::class);
    }

    public function residencyPositionMatches(): HasMany
    {
        return $this->hasMany(ResidencyPositionMatch::class);
    }

    public function residencyPositionApplications(): HasMany
    {
        return $this->hasMany(ResidencyPositionApplication::class);
    }
}
