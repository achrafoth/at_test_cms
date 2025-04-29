<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_sessions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'trusted_specialist_id',
        'at_expert_id',
        'session_type',
        'session_date',
        'session_duration',
        'notes',
        'outcome',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'session_date' => 'datetime',
    ];

    /**
     * Get the client that owns the session.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the trusted specialist that owns the session.
     */
    public function trustedSpecialist(): BelongsTo
    {
        return $this->belongsTo(TrustedSpecialist::class);
    }

    /**
     * Get the AT expert that owns the session.
     */
    public function atExpert(): BelongsTo
    {
        return $this->belongsTo(ATExpert::class);
    }
}
