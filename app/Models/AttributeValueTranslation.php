<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeValueTranslation extends Model
{
    public $timestamps = false;
    // protected $fillable = ['attribute_value_id', 'locale', 'name'];
        protected $guarded = [];


    public function attributeValue(): BelongsTo
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
