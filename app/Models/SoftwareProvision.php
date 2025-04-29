<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoftwareProvision extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'at_software_id',
        'provision_date',
        'cost',
        'notes',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'provision_date' => 'date',
        'cost' => 'decimal:2',
    ];
    
    /**
     * Get the client that owns the software provision.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    
    /**
     * Get the software that is provisioned.
     */
    public function software(): BelongsTo
    {
        return $this->belongsTo(ATSoftware::class, 'at_software_id');
    }
}
