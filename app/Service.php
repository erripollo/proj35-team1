<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $fillable = ['name'];

    public function apartments() : BelongsToMany
    {
        return $this->belongsToMany(Apartment::class);
    }
}
