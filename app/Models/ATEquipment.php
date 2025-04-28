<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATEquipment extends Model
{
    use HasFactory;

    protected $table = 'at_equipment';

    protected $fillable = [
        'name',
        'model',
        'description',
        'category_id',
        'supplier_id',
        'serial_number',
        'quantity',
        'photo',
    ];

    /**
     * Get the category of this equipment.
     */
    public function category()
    {
        return $this->belongsTo(ATCategory::class, 'category_id');
    }

    /**
     * Get the supplier of this equipment.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    /**
     * Get the provisions for this equipment.
     */
    public function provisions()
    {
        return $this->hasMany(Provision::class, 'at_equipment_id');
    }

    /**
     * Get the loans for this equipment.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class, 'at_equipment_id');
    }
}
