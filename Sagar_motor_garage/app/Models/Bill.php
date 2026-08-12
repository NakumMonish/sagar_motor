<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bill extends Model
{
    protected $fillable = [
        'bill_number',
        'customer_id',
        'vehicle_id',
        'service_type',
        'subtotal',
        'labor_cost',
        'grand_total',
        'payment_status',
        'bill_date',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'bill_date' => 'date',
            'subtotal' => 'decimal:2',
            'labor_cost' => 'decimal:2',
            'grand_total' => 'decimal:2',
        ];
    }

    /**
     * Boot the model and auto-generate bill number.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($bill) {
            if (empty($bill->bill_number)) {
                $today = now()->format('Ymd');
                $lastBill = static::where('bill_number', 'like', "SM-{$today}-%")
                    ->orderBy('bill_number', 'desc')
                    ->first();

                if ($lastBill) {
                    $lastNumber = (int) substr($lastBill->bill_number, -4);
                    $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $nextNumber = '0001';
                }

                $bill->bill_number = "SM-{$today}-{$nextNumber}";
            }
        });
    }

    /**
     * Get the customer for this bill.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the vehicle for this bill.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the line items for this bill.
     */
    public function items(): HasMany
    {
        return $this->hasMany(BillItem::class);
    }

    /**
     * Get a human-readable service type.
     */
    public function getServiceTypeLabelAttribute(): string
    {
        return match ($this->service_type) {
            'denting' => 'Denting',
            'painting' => 'Painting',
            'general_service' => 'General Service',
            default => ucfirst($this->service_type),
        };
    }

    /**
     * Get a human-readable payment status.
     */
    public function getPaymentStatusBadgeAttribute(): string
    {
        return match ($this->payment_status) {
            'paid' => '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/20 text-emerald-400">Paid</span>',
            'pending' => '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-500/20 text-amber-400">Pending</span>',
            default => $this->payment_status,
        };
    }
}
