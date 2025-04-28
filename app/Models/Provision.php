<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provision extends Model
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
        'provision_date',
        'notes',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'provision_date' => 'date',
    ];
    
    /**
     * Get the client that owns the provision.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    /**
     * Get the equipment that is provisioned.
     */
    public function equipment()
    {
        return $this->belongsTo(ATEquipment::class, 'at_equipment_id');
    }
}
