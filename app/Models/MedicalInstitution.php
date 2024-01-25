<?php

/**
 * @var string $name
 * @var string $type
 * @var string $street_address
 * @var string $city 
 * @var string $postal_code
 * @var string $email_domain
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
}
