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

        //$apartments = Apartment::where('visible', true )->paginate();
        //return $apartments;

        return ApartmentResource::collection(Apartment::with(['services'])->paginate());
    }
}
