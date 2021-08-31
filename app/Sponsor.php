<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsor extends Model
{
    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}
