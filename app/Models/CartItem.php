<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CartItem extends Model
{
    protected $guarded = [];


    protected $casts = [
        'attributes' => 'array', // JSON автоматически в массив
    ];


    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
