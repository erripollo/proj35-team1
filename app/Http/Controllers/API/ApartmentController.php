<?php

namespace App\Http\Controllers\API;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApartmentResource;

class ApartmentController extends Controller
{
    public function index()
    {
        return ApartmentResource::collection(Apartment::with(['services'])->where('visible', true )->paginate());
    }
}
