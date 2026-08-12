<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'mobile',
    ];

    /**
     * Get the vehicles owned by this customer.
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * Get the bills for this customer.
     */
    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }
}
