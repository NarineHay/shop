<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function infoCustomer(): BelongsTo
    {
        return $this->belongsTo(InfoCustomer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Удобный аксессор, чтобы получить имя покупателя независимо от типа
    public function getCustomerNameAttribute()
    {
        if ($this->user) {
            return $this->user->name;
        } elseif ($this->infoCustomer) {
            return $this->infoCustomer->name;
        }
        return null;
    }

    public function payment(): HasOne
    {
      return $this->hasOne(Payment::class);
    }
}
