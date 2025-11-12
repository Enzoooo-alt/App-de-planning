<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quantity_total',
        'quantity_available',
        'price',
        'category',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Helper methods
     */
    public function isAvailable()
    {
        return $this->status === 'available' && $this->quantity_available > 0;
    }

    public function borrowItem($quantity = 1)
    {
        if ($this->quantity_available >= $quantity) {
            $this->quantity_available -= $quantity;
            return $this->save();
        }
        return false;
    }

    public function returnItem($quantity = 1)
    {
        if ($this->quantity_available + $quantity <= $this->quantity_total) {
            $this->quantity_available += $quantity;
            return $this->save();
        }
        return false;
    }
}
