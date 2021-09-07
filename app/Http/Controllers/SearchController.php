<?php

namespace App\Http\Controllers;

use DB;
use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApartmentResource;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        //dd($request);
        $homeCitySearch = $request->location;
        $apartments = ApartmentResource::collection(Apartment::with(['services'])
        //$apartmentTest = DB::table('apartments')
        /* ->join('apartment_service', 'apartment_service.apartment_id' , '=', 'apartments.id')
        ->join('services', 'apartment_service.service_id' , '=', 'services.id')
        ->select('apartments.*','apartment_service.*') */
        ->where('visible', true )
        ->where('address', 'like', $homeCitySearch.'%')
       
        ->get());
        //return response()->json($apartmentTest);

        return view('guest.house',compact('apartments','homeCitySearch'));
    }

}
