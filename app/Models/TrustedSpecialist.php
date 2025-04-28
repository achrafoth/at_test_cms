<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrustedSpecialist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
        'email',
        'phone',
    ];

    /**
     * Get the clients assigned to this trusted specialist.
     */
    public function clients()
    {
        return $this->hasMany(Client::class, 'assigned_trusted_specialist_id');
    }
}
