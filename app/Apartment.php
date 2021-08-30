<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = ['title', 'city', 'address', 'latitude', 'longitude', 'image', 'description', 'n_rooms', 'n_baths', 'n_beds', 'square_meters', 'visible'];
}
