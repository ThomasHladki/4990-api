<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property \DateTime $dob
 * @property string $gender
 * @property int $graduation_year
 * @property int $educational_institution_id
 * @property EducationalInstitution $educational_institution
 * @property string $medical_discipline
 * @property bool $prefers_research 
 * @property int $user_id
 * @property User $user
 */

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'gender',
        'graduation_year',
        'educational_institution_id',
        'medical_discipline',
        'prefers_research',
        'user_id'
    ];

    public function educationalInstitution():BelongsTo
    {
        return $this->belongsTo(EducationalInstitution::class);
    }

    public function residencyPositionApplications():HasMany
    {
        return $this->hasMany(ResidencyPositionApplication::class);
    }

    public function studentGrades(): HasMany
    {
        return $this->hasMany(StudentGrade::class);
    }

    public function studentLocationPreference(): HasOne
    {
        return $this->hasOne(StudentLocationPreference::class);
    }

    public function residencyPositionMatches(): HasMany
    {
        return $this->hasMany(ResidencyPositionMatch::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
