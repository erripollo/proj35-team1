<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    protected $fillable=['ip_address','date','apartment_id'];

    public function apartment(): BelongsTo
{
    return $this->belongsTo(Apartment::class);
}
}
