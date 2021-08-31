<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = ['name', 'lastname', 'email', 'body', 'apartment_id'];
    
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}
