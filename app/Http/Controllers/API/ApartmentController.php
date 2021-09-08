<?php

namespace App\Http\Controllers\API;

use DB;
use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApartmentResource;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $homeCitySearch = $request->location;
        
        return ApartmentResource::collection(Apartment::with(['services'])
        //$apartmentTest = DB::table('apartments')
        //->join('apartment_service', 'apartment_service.apartment_id' , '=', 'apartments.id')
        //->join('services', 'apartment_service.service_id' , '=', 'services.id')
        //->select('apartments.*','apartment_service.*')
        ->where('visible', true )
        //->where('address', 'like', $request->address.'%')
        //->where('n_rooms', '>=', 1)
        //->where('n_beds', '>=', 1)
        //->whereIn('service_id', [1, 3])
        ->paginate());
        //return response()->json($apartmentTest);

        return view('guest.house',compact('apartments','homeCitySearch'));
    }

}
