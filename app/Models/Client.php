<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'age',
        'gender',
        'disability_type',
        'nationality',
        'contact_phone',
        'email',
        'assigned_trusted_specialist_id',
        'assigned_at_expert_id',
        'status',
    ];

    protected $casts = [
        'age' => 'integer',
    ];

    /**
     * Get the trusted specialist assigned to this client.
     */
    public function trustedSpecialist(): BelongsTo
    {
        return $this->belongsTo(TrustedSpecialist::class, 'assigned_trusted_specialist_id');
    }

    /**
     * Get the AT expert assigned to this client.
     */
    public function atExpert(): BelongsTo
    {
        return $this->belongsTo(ATExpert::class, 'assigned_at_expert_id');
    }

    /**
     * Get the provisions for this client.
     */
    public function provisions()
    {
        return $this->hasMany(Provision::class);
    }

    /**
     * Get the loans for this client.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
