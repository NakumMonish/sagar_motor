<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'customer_id',
        'car_number',
        'car_name',
        'car_model',
        'car_company',
    ];

    /**
     * Get the customer that owns this vehicle.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the bills for this vehicle.
     */
    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }
}
