<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
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
        'start_date',
        'expected_return_date',
        'actual_return_date',
        'status',
        'notes',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'expected_return_date' => 'date',
        'actual_return_date' => 'date',
    ];
    
    /**
     * Get the client that owns the loan.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    /**
     * Get the equipment that is loaned.
     */
    public function equipment()
    {
        return $this->belongsTo(ATEquipment::class, 'at_equipment_id');
    }
}
