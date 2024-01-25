<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property \Date $dob
 * @property string $gender
 * @property int $medical_institution_id
 * @property string $medical_discipline
 * @property int $user_id
 * @property User $user
 */
class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob', 
        'gender',
        'medical_institution_id',
        'medical_discipline',
        'user_id'
    ];

    public function medicalInstitution(): BelongsTo
    {
        return $this->belongsTo(MedicalInstitution::class);
    }

    public function residencyPositions(): HasMany
    {
        return $this->hasMany(ResidencyPosition::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
