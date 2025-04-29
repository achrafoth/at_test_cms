<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ATEquipmentItem extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'at_equipment_items';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'at_equipment_id',
        'serial_number',
        'purchase_value',
        'status',
        'notes',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'purchase_value' => 'decimal:2',
    ];
    
    /**
     * Get the equipment that this item belongs to.
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(ATEquipment::class, 'at_equipment_id');
    }
}
