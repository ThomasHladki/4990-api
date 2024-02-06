<?php

/**
 * @property string $name
 * @property string $type
 * @property string $street_address
 * @property string $city 
 * @property string $province
 * @property string $postal_code
 * @property string $email_domain
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalInstitution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'street_address',
        'city',
        'province',
        'postal_code',
        'email_domain'
    ];

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }

    public function residencyPositions(): HasMany
    {
        return $this->hasMany(ResidencyPosition::class);
    }
}
