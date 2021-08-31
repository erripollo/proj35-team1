<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    protected $fillable = ['title', 'city', 'address', 'latitude', 'longitude', 'image', 'description', 'n_rooms', 'n_baths', 'n_beds', 'square_meters', 'visible', 'user_id'];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

}
