<?php

namespace App\Http\Controllers\API;

use DB;
use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApartmentResource;
use Illuminate\Support\Carbon;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $homeCitySearch = $request->location;

        return ApartmentResource::collection(Apartment::with(['services', 'sponsors'])
            ->where('visible', true)
            ->get());


        // return ApartmentResource::collection(Apartment::with(['services'])

        //->join('apartment_sponsor', 'apartments.id', '<>', 'apartment_sponsor.apartment_id')
        //  ->where('visible', true)

        //$apartmentTest = DB::table('apartments')
        //->join('apartment_service', 'apartment_service.apartment_id' , '=', 'apartments.id')
        //->join('services', 'apartment_service.service_id' , '=', 'services.id')
        //->select('apartments.*','apartment_service.*')
        //->where('address', 'like', $request->address.'%')
        //->where('n_rooms', '>=', 1)
        //->where('n_beds', '>=', 1)
        //->whereIn('service_id', [1, 3])
        // ->get());
        //return response()->json($apartmentTest);
        //return response()->json($apartments);

        return view('guest.house', compact('apartments', 'homeCitySearch'));
    }

    public function one(Request $request)
    {
        $query = $request->query();
        $id = $query['id'];
        return ApartmentResource::collection(Apartment::all()->where('id', '=', $id));


        //return response()->json($apartment, 200);
    }

    public function sponsored()
    {
        $now = Carbon::now()->setTimeZone("Europe/Rome");

        /* $apartments_sponsor = DB::table('apartments')
            ->join('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
            ->join('users', 'apartments.user_id', '=', 'users.id')
            ->join('apartment_service', 'apartment_service.apartment_id', '=', 'apartments.id')
            ->join('services', 'apartment_service.service_id', '=', 'services.id')

            ->select('apartment_sponsor.*', 'apartments.*', 'apartment_service.*')
            ->where('end', '>', $now)
            //->where('apartments.deleted_at', null)
            //->where('address', 'LIKE', '%' . $request->where . '%')
            //->where('number_rooms', '>=', $request->number_rooms)
            //->where('number_beds', '>=', $request->number_beds)
            ->get(); */

        return ApartmentResource::collection(Apartment::with(['services'])
            ->join('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
            ->where('end', '>', $now)
            ->where('visible', true)
            ->get());

        //return response()->json($apartments_sponsor, 200);
    }
}
