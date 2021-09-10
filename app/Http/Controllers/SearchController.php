<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;
use App\Apartment;
use App\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApartmentResource;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        //dd($request);
        $homeCitySearch = $request->location;

        function calcDistance($lat1, $lon1, $lat2, $lon2)
        {
            $distance = (6371 * 3.1415926 * sqrt(($lat2 - $lat1) * ($lat2 - $lat1) + cos($lat2 / 57.29578) * cos($lat1 / 57.29578) * ($lon2 - $lon1) * ($lon2 - $lon1))) / 180;

            return $distance;
        }

        

        $apartments = ApartmentResource::collection(Apartment::with(['services'])
        //$apartmentTest = DB::table('apartments')
        /* ->join('apartment_service', 'apartment_service.apartment_id' , '=', 'apartments.id')
        ->join('services', 'apartment_service.service_id' , '=', 'services.id')
        ->select('apartments.*','apartment_service.*') */
        ->where('visible', true )
        ->select('SELECT clacDistance($latProva, $lonProva, "apartments.latitude", "apartment.longitude" )')
        //->where('address', 'like', $homeCitySearch.'%')
        ->get());
        //return response()->json($apartmentTest);

        
        

        return view('guest.house',compact('apartments','homeCitySearch'));
    }


    public function show(Apartment $apartment)
    {
        $services = Service::all();
        if (Auth::user()) {
            $user = Auth::user()->email;
        }else{
            $user = '';
        }
        //dd($user);
        //dd($user);
        //$apartment = Apartment::all();
        return view('guest.apartments.show', compact('apartment', 'services', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request, Apartment $apartment)
    {
        
        //dd($apartment);
        $validate = $request->validate([ 
            'name'=>'required | max:255 | min: 3',
            'lastname'=>'required | max:255 | min: 3',
            'email'=>'required',
            'body'=>'required | min: 10'
        ]);

        $message = Message::create($validate);
        $message->apartment_id = $apartment->id;
        $message->save();

        return redirect()->route('guest.apartment.show', $apartment->id)->with('message', 'The message has been sended!!');
    }

}
