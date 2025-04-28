<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact_person',
        'phone',
        'email',
    ];

    /**
     * Get the equipment supplied by this supplier.
     */
    public function equipment()
    {
        return $this->hasMany(ATEquipment::class, 'supplier_id');
    }
}
