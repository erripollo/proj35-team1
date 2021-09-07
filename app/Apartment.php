<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Apartment extends Model
{
    protected $fillable = ['title', 'address', 'latitude', 'longitude', 'image', 'description', 'n_rooms', 'n_baths', 'n_beds', 'square_meters', 'visible', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class);
    }
        
    public function message(): HasMany
    {
        return $this->hasMany(Message::class);
    }


    public function services() : BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
}
