<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillItem extends Model
{
    protected $fillable = [
        'bill_id',
        'part_name',
        'quantity',
        'price',
        'total',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    /**
     * Get the bill that owns this item.
     */
    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }
}
