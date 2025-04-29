<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WishlistItem extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'at_equipment_id',
        'at_software_id',
        'approximate_value',
        'priority',
        'requested_by',
        'notes',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'approximate_value' => 'decimal:2',
    ];
    
    /**
     * Get the client associated with the wishlist item.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    
    /**
     * Get the equipment associated with the wishlist item.
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(ATEquipment::class, 'at_equipment_id');
    }
    
    /**
     * Get the software associated with the wishlist item.
     */
    public function software(): BelongsTo
    {
        return $this->belongsTo(ATSoftware::class, 'at_software_id');
    }
    
    /**
     * Get the user who requested this item.
     */
    public function requestedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
