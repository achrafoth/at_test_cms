<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATExpert extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'expertise_area',
        'email',
        'phone',
    ];

    /**
     * Get the clients assigned to this AT expert.
     */
    public function clients()
    {
        return $this->hasMany(Client::class, 'assigned_at_expert_id');
    }
}
